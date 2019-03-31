<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator          |
    |              on 2018-06-19 10:05:39              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

class MobileTemplate {
    private $module;
    public  $modulename;
    public  $weid;
    public  $uniacid;
    public  $__define;

    function saveSettings($settings) {
        global $_W;
        $pars            = ["module" => $this->modulename, "uniacid" => $_W["uniacid"]];
        $row             = [];
        $row["settings"] = iserializer($settings);
        cache_build_module_info($this->modulename);

        if (pdo_fetchcolumn("SELECT module FROM " . tablename("uni_account_modules") . " WHERE module = :module AND uniacid = :uniacid", ["\72\x6d\x6f\x64\165\154\x65" => $this->modulename, "\72\x75\x6e\x69\x61\143\x69\144" => $_W["\x75\x6e\151\x61\143\151\144"]])) {
            return pdo_update("uni_account_modules", $row, $pars) !== false;
        }
        return pdo_insert("uni_account_modules", ["settings" => iserializer($settings), "module" => $this->modulename, "uniacid" => $_W["uniacid"], "enabled" => 1]) !== false;
    }

    function createMobileUrl($do, $query = [], $noredirect = true) {
        global $_W;
        $query["do"] = $do;
        $query["m"]  = strtolower($this->modulename);
        return murl("entry", $query, $noredirect);
    }

    function createWebUrl($do, $query = []) {
        $query["do"] = $do;
        $query["m"]  = strtolower($this->modulename);
        return wurl("site/entry", $query);
    }

    function template($filename, $_W, $_GPC) {
        $name           = $_GPC["m"];
        $defineDir      = IA_ROOT . "/addons/" . $_GPC["m"];
        $_W["template"] = "default";
        if (defined("IN_SYS")) {
            $source  = IA_ROOT . "/web/themes/{$_W["template"]}/{$name}/{$filename}.html";
            $compile = IA_ROOT . "/data/tpl/web/{$_W["template"]}/{$name}/{$filename}.tpl.php";
            if (is_file($source)) {
                $paths   = pathinfo($compile);
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                    return $compile;
                }
                template_compile($source, $compile, true);
                return $compile;
            }
            $source = IA_ROOT . "/web/themes/default/{$name}/{$filename}.html";
            if (is_file($source)) {
                $paths   = pathinfo($compile);
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                    return $compile;
                }
                template_compile($source, $compile, true);
                return $compile;
            }
            $source = $defineDir . "/template/{$filename}.html";
            if (is_file($source)) {
                $paths   = pathinfo($compile);
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                    return $compile;
                }
                template_compile($source, $compile, true);
                return $compile;
            }
            $source = IA_ROOT . "/web/themes/{$_W["template"]}/{$filename}.html";
            if (is_file($source)) {
                $paths   = pathinfo($compile);
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                    return $compile;
                }
                template_compile($source, $compile, true);
                return $compile;
            }
            $source = IA_ROOT . "/web/themes/default/{$filename}.html";
            if (is_file($source)) {
                $paths   = pathinfo($compile);
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                    return $compile;
                }
                template_compile($source, $compile, true);
                return $compile;
            }
            exit("Error: template source '{$filename}' is not exist!");
        }
        $source  = IA_ROOT . "/app/themes/{$_W["template"]}/{$name}/{$filename}.html";
        $compile = IA_ROOT . "/data/tpl/app/{$_W["template"]}/{$name}/{$filename}.tpl.php";
        if (is_file($source)) {
            $paths   = pathinfo($compile);
            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
            if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                return $compile;
            }
            template_compile($source, $compile, true);
            return $compile;
        }
        $source = IA_ROOT . "/app/themes/default/{$name}/{$filename}.html";
        if (is_file($source)) {
            $paths   = pathinfo($compile);
            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
            if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                return $compile;
            }
            template_compile($source, $compile, true);
            return $compile;
        }
        $source = $defineDir . "/template/mobile_template/{$filename}.html";
        if (is_file($source)) {
            $paths   = pathinfo($compile);
            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
            if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                return $compile;
            }
            template_compile($source, $compile, true);
            return $compile;
        }
        $source = $defineDir . "/template/webapp/{$filename}.html";
        if (is_file($source)) {
            $paths   = pathinfo($compile);
            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
            if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                return $compile;
            }
            template_compile($source, $compile, true);
            return $compile;
        }
        $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
        if (is_file($source)) {
            $paths   = pathinfo($compile);
            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
            if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                return $compile;
            }
            template_compile($source, $compile, true);
            return $compile;
        }
        if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
            $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
            if (is_file($source)) {
                $paths   = pathinfo($compile);
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                    return $compile;
                }
                template_compile($source, $compile, true);
                return $compile;
            }
            exit("Error: template source '{$filename}' is not exist!");
        }
        $source = IA_ROOT . "/app/themes/default/{$filename}.html";
        if (is_file($source)) {
            $paths   = pathinfo($compile);
            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
            if (! (DEVELOPMENT || ! is_file($compile) || filemtime($source) > filemtime($compile))) {
                return $compile;
            }
            template_compile($source, $compile, true);
            return $compile;
        }
        exit("Error: template source '{$filename}' is not exist!");
    }

    function fileSave($file_string, $type = "jpg", $name = "auto") {
        global $_W;
        load()->func("file");
        $allow_ext = [
            "images" => ["gif", "jpg", "jpeg", "bmp", "png", "ico"],
            "audios" => ["mp3", "wma", "wav", "amr"],
            "videos" => ["wmv", "avi", "mpg", "mpeg", "mp4"]
        ];
        if (in_array($type, $allow_ext["images"])) {
            $type_path = "images";
        }
        if (in_array($type, $allow_ext["audios"])) {
            $type_path = "audios";
        }
        if (in_array($type, $allow_ext["videos"])) {
            $type_path = "videos";
        }
        if (! empty($type_path)) {
            $uniacid = intval($_W["uniacid"]);
            if (empty($name) || $name == "auto") {
                $path    = "{$type_path}/{$uniacid}/{$this->module["name"]}/" . date("Y/m/");
                mkdirs(ATTACHMENT_ROOT . "/" . $path);
                $filename = file_random_name(ATTACHMENT_ROOT . "/" . $path, $type);
                if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                    file_remote_upload($path);
                    return $path . $filename;
                }
                return false;
            }
            $path = "{$type_path}/{$uniacid}/{$this->module["name"]}/";
            mkdirs(dirname(ATTACHMENT_ROOT . "/" . $path));
            $filename = $name;
            if (!strexists($filename, $type)) {
                $filename .= "." . $type;
            }
            if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                file_remote_upload($path);
                return $path . $filename;
            }
            return false;
        }
        return error(1, "\xe7\xa6\201\346\255\242\344\xbf\235\xe5\255\230\346\226\x87\344\xbb\266\347\261\273\xe5\x9e\x8b");
    }

    function fileUpload($file_string, $type = "image") {
        $types = ["image", "video", "audio"];
    }

    function getFunctionFile($name) {
        $module_type = str_replace("wemodule", '', strtolower(get_parent_class($this)));
        if ($module_type == "site") {
            $module_type   = stripos($name, "doWeb") === 0 ? "web" : "mobile";
            $function_name = $module_type == "web" ? strtolower(substr($name, 5)) : strtolower(substr($name, 8));
        } else {
            $function_name = strtolower(substr($name, 6));
        }
        $dir  = IA_ROOT . "/framework/builtin/" . $this->modulename . "/inc/" . $module_type;
        $file = "{$dir}/{$function_name}.inc.php";
        if (!file_exists($file)) {
            $file = str_replace("framework/builtin", "addons", $file);
        }
        return $file;
    }

    function __call($name, $param) {
        $file = $this->getFunctionFile($name);
        if (! file_exists($file)) {
            trigger_error("\346\250\241\xe5\235\227\xe6\226\xb9\xe6\263\x95" . $name . "\344\270\215\xe5\xad\x98\xe5\x9c\xa8\x2e", E_USER_WARNING);
            return false;
        }
        require $file;
        exit;
    }
}

global $_W, $_GPC;
$uniacid = $_W["uniacid"];
if (! empty($_GET["id"])) {
    $list = pdo_get("xc_beauty_article", ["id" => $_GET["id"], "uniacid" => $uniacid]);
    if ($list) {
        $list["content"] = htmlspecialchars_decode($list["content"]);
    }
}
$mobile = new MobileTemplate();
include $mobile->template("index/index", $_W, $_GPC);
