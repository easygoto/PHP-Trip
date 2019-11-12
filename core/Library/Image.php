<?php


namespace Trink\Core\Library;

class Image
{
    /** @var integer */
    protected $width;

    /** @var integer */
    protected $height;

    /** @var string */
    protected $mime;

    /** @var string */
    protected $absolutePath;

    /** @var string */
    protected $relativePath;

    /** @var string */
    protected $fileName;

    /** @var string */
    protected $suffix;

    /** @var Result */
    protected $executeResult;

    public function __construct($absolutePath)
    {
        $this->absolutePath = $absolutePath;
        $this->relativePath = substr($absolutePath, strlen(TRIP_ROOT));
        if (!file_exists($absolutePath)) {
            $this->executeResult = Result::fail('文件不存在');
        } else {
            $fileData = pathinfo($absolutePath);
            if (!$fileData) {
                $this->executeResult = Result::fail('文件错误');
            } else {
                $this->suffix = $fileData['extension'];
                $this->fileName = $fileData['filename'];
            }

            $imageData = getimagesize($absolutePath);
            if (!$imageData) {
                $this->executeResult = Result::fail('非图片格式');
            } else {
                $this->width = $imageData[0];
                $this->height = $imageData[1];
                $this->mime = $imageData['mime'];
            }
        }
    }

    public function isValid()
    {
        return $this->executeResult ? $this->executeResult->isSuccess() : true;
    }

    public function getResult()
    {
        return $this->executeResult;
    }

    private function createImage()
    {
        switch ($this->mime) {
            default:
            case 'image/jpeg':
                $img = imagecreatefromjpeg($this->absolutePath);
                break;
            case 'image/png':
                $img = imagecreatefrompng($this->absolutePath);
                break;
            case 'image/bmp':
                $img = imagecreatefrombmp($this->absolutePath);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($this->absolutePath);
                break;
        }
        return $img;
    }

    /* 裁切 */
    /* 缩放 */
    /* 加水印 */
    /* 文件转码到base64 */
    /* base64转码到文件 */

    public function handle($targetWidth, $targetHeight, $isScale = false, $isCutting = false)
    {
        $rawImgObj = $this->createImage();
        imagedestroy($rawImgObj);
        return Result::success();
    }

    public static function base64FacePicToFile($base64String, $targetPathNoFix)
    {
        list($picType, $picData) = explode(',', $base64String);
        if (!is_dir(basename($targetPathNoFix))) {
            mkdir(basename($targetPathNoFix), 0777, true);
        }
        $start = strpos($picType, '/') + 1;
        $end = strpos($picType, ';');
        $afterFix = substr($picType, $start, $end - $start);
        $filePath = "{$targetPathNoFix}.{$afterFix}";
        file_put_contents($targetPathNoFix, base64_decode($picData));
        return $filePath;
    }

    public static function test()
    {
        $targetFile = TRIP_ROOT . 'test.jpg';
        $seqIndex = strrpos($targetFile, '.');
        echo substr($targetFile, 0, $seqIndex) . '.squ' . substr($targetFile, $seqIndex);
        $result = getimagesize($targetFile);
        $width = $result[0];
        $height = $result[1];
        $mime = $result['mime'];
        $size = min($width, $height);
        if ($mime == 'image/png') {
            $srcImg = imagecreatefrompng($targetFile);
        } else {
            $srcImg = imagecreatefromjpeg($targetFile);
        }
        $dstImg = imagecreatetruecolor($size, $size);
        imagecopy($dstImg, $srcImg, 0, 0, ($width - $size) / 2, ($height - $size) / 2, $size, $size);
        imagepng($dstImg, TRIP_ROOT . 'test.png');
        imagedestroy($dstImg);
        imagedestroy($srcImg);
    }

    public static function split($width, $height)
    {
        return '20191011_c48a525077334.jpg';
    }
}
