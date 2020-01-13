<?php


namespace Trink\Core\Helper;

/**
 * 建议先裁切再缩放
 *
 * Class Image
 *
 * @package Trink\Core\Helper
 */
class Image
{
    protected string $fileName = '';
    protected string $suffix   = '';
    protected string $mime     = 'image/jpeg';

    protected int $defaultColor      = 0xffffff;
    protected int $defaultAlphaColor = 0x40ffffff;

    /** @var Result */
    protected $loadResult;

    /** @var static */
    protected static $instance;

    protected array $origin = [
        'width'        => 0,
        'height'       => 0,
        'resource'     => null,
        'absolutePath' => '',
    ];

    protected array $props = [
        'width'        => 0,
        'height'       => 0,
        'resource'     => null,
        'extFix'       => '',
        'absolutePath' => '',
    ];

    protected function __construct()
    {
    }

    public function __destruct()
    {
        static::destroy($this->props['resource']);
        static::destroy($this->origin['resource']);
    }

    protected function init($absolutePath)
    {
        $this->origin['absolutePath'] = $absolutePath;
        if (!file_exists($absolutePath)) {
            return Result::fail('文件不存在');
        }

        $fileData = pathinfo($absolutePath);
        if (!$fileData) {
            return Result::fail('文件错误');
        } else {
            ['extension' => $this->suffix, 'filename' => $this->fileName] = $fileData;
        }

        $imageData = getimagesize($absolutePath);
        if (!$imageData) {
            return Result::fail('非图片格式');
        } else {
            [0 => $this->origin['width'], 1 => $this->origin['height'], 'mime' => $this->mime] = $imageData;
            [0 => $this->props['width'], 1 => $this->props['height']] = $imageData;
        }

        $this->origin['resource'] = static::create($absolutePath, $this->mime);
        return Result::success();
    }

    public static function load(string $absolutePath)
    {
        $instance = new static();
        $instance->loadResult = $instance->init($absolutePath);
        static::$instance = $instance;
        return static::$instance;
    }

    public function isValid()
    {
        return $this->loadResult ? $this->loadResult->isSuccess() : false;
    }

    public function getResult()
    {
        return $this->loadResult;
    }

    public function getCurrentResource()
    {
        return $this->props['resource'] ?: $this->origin['resource'];
    }

    /**
     * 使用绝对路径创建资源
     *
     * @param        $absolutePath
     * @param string $mime
     *
     * @return false|resource
     */
    public static function create($absolutePath, $mime = 'image/jpeg')
    {
        switch ($mime) {
            default:
            case 'image/jpeg':
                return imagecreatefromjpeg($absolutePath);
            case 'image/png':
                return imagecreatefrompng($absolutePath);
            case 'image/bmp':
                return imagecreatefrombmp($absolutePath);
            case 'image/gif':
                return imagecreatefromgif($absolutePath);
        }
    }

    /**
     * 销毁一个图片资源
     *
     * @param $imageResource
     */
    public static function destroy($imageResource)
    {
        if (gettype($imageResource) == 'resource') {
            imagedestroy($imageResource);
        }
    }

    /**
     * 保存一个图片资源到文件
     *
     * @param        $image
     * @param        $absolutePath
     * @param string $mime
     *
     * @return string
     */
    public static function save($image, $absolutePath, $mime = 'image/jpeg')
    {
        switch ($mime) {
            default:
            case 'image/jpeg':
                imagejpeg($image, $absolutePath);
                break;
            case 'image/png':
                imagepng($image, $absolutePath);
                break;
            case 'image/bmp':
                imagebmp($image, $absolutePath);
                break;
            case 'image/gif':
                imagegif($image, $absolutePath);
                break;
        }
        return $absolutePath;
    }

    /**
     * 图片处理完成后保存到文件
     *
     * @return string
     */
    public function savePath()
    {
        return static::save($this->props['resource'], $this->props['absolutePath'], $this->mime);
    }

    /**
     * 裁切
     *
     * @param int|null $width
     * @param int|null $height
     *
     * @return Image
     */
    public function crop($width = null, $height = null)
    {
        $width = $width ?: min($this->props['width'], $this->props['height']);
        $height = $height ?: $width;
        $srcImg = $this->getCurrentResource();
        $dstImg = imagecreatetruecolor($width, $height);
        imagefill($dstImg, 0, 0, $this->defaultColor);

        $targetWidth = (int)(($this->props['width'] - $width) / 2);
        $targetHeight = (int)(($this->props['height'] - $height) / 2);
        imagecopy($dstImg, $srcImg, 0, 0, $targetWidth, $targetHeight, $width, $height);

        $this->props['width'] = $width;
        $this->props['height'] = $height;
        $this->props['extFix'] .= '.crop';
        $this->props['resource'] = $dstImg;
        $originAbsDir = dirname($this->origin['absolutePath']);
        $this->props['absolutePath'] = "{$originAbsDir}/{$this->fileName}{$this->props['extFix']}.{$this->suffix}";
        return $this;
    }

    /**
     * 缩放
     *
     * @param int|null $width
     * @param int|null $height
     *
     * @return Image
     */
    public function scale($width = null, $height = null)
    {
        if (!$width && !$height) {
            $width = $this->props['width'];
            $height = $this->props['height'];
        } elseif ($width) {
            $height = (int)($width * $this->props['height'] / $this->props['width']);
        } elseif ($height) {
            $width = (int)($height * $this->props['width'] / $this->props['height']);
        }
        $srcImg = $this->getCurrentResource();
        $this->props['width'] = $width;
        $this->props['height'] = $height;
        $this->props['extFix'] .= '.scale';
        $this->props['resource'] = imagescale($srcImg, $width, $height);
        $originAbsDir = dirname($this->origin['absolutePath']);
        $this->props['absolutePath'] = "{$originAbsDir}/{$this->fileName}{$this->props['extFix']}.{$this->suffix}";
        return $this;
    }

    /**
     * 水印
     *
     * @param $markImagePath
     *
     * @return Image
     */
    public function watermark($markImagePath)
    {
        $width = $height = 200;
        $targetWidth = $targetHeight = 200;
        $srcImg = $this->getCurrentResource();
        $dstImg = static::create($markImagePath);
        imagefill($dstImg, 0, 0, $this->defaultAlphaColor);
        $dstImg = imagescale($dstImg, 100);
        imagecopy($dstImg, $srcImg, 0, 0, $targetWidth, $targetHeight, $width, $height);
        static::save($srcImg, TEMP_DIR . 'src.jpg');
        static::save($dstImg, TEMP_DIR . 'dst.jpg');
        return $this;
    }

    /* 文件转码到base64 */
    public static function toBase64($absolutePath)
    {
        $content = file_get_contents($absolutePath);
        return base64_encode($content);
    }

    /**
     * base64转码到文件, 指定的路径不需要后缀名
     *
     * @param $base64String
     * @param $absolutePath
     *
     * @return string
     */
    public static function fromBase64($base64String, $absolutePath)
    {
        if (strpos($base64String, ',') !== false) {
            [$type, $data] = explode(',', $base64String);
            $start = strpos($type, '/') + 1;
            $afterFix = substr($type, $start, strpos($type, ';') - $start);
        } else {
            $data = $base64String;
            $afterFix = 'jpeg';
        }

        if (!is_dir(dirname($absolutePath))) {
            mkdir(dirname($absolutePath), 0777, true);
        }

        $filePath = "{$absolutePath}.{$afterFix}";
        file_put_contents($absolutePath, base64_decode($data));
        return $filePath;
    }
}
