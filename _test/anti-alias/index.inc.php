<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator          |
    |              on 2018-06-19 10:05:39              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

global $_W, $_GPC;
$uniacid = $_W["uniacid"];
if (empty($_GET["id"])) {
    $mobile = new MobileTemplate();
    include $mobile->template("index/index", $_W, $_GPC);
    goto _EXIT;
}
$list = pdo_get("xc_beauty_article", ["id" => $_GET["id"], "uniacid" => $uniacid]);
if (!$list) {
    $mobile = new MobileTemplate();
    include $mobile->template("index/index", $_W, $_GPC);
    goto _EXIT;
}
$list["content"] = htmlspecialchars_decode($list["content"]);
$mobile          = new MobileTemplate();
include $mobile->template("index/index", $_W, $_GPC);
goto _EXIT;
_EXIT:

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
        goto kkMmD;
        JIoYN: Rr2c5:
        goto eEzqI;
        UFcPn:
        $source = IA_ROOT . "\57\x77\x65\x62\57\164\150\x65\x6d\145\x73\x2f{$_W["\x74\145\155\160\154\141\x74\145"]}\x2f{$filename}\56\x68\x74\155\x6c";
        goto Qu4Pq;
        r_Vl2:
        $source = IA_ROOT . "\x2f\141\x70\160\57\164\150\x65\x6d\x65\163\57\x64\x65\x66\x61\x75\x6c\x74\57{$name}\x2f{$filename}\56\150\x74\155\x6c";
        goto fpx21;
        CxqpT:
        $_W["\x74\145\155\x70\x6c\x61\164\x65"] = "\144\145\x66\x61\x75\154\164";
        goto p_F3i;
        piUJw: Xv_eF:
        goto LGNQ_;
        DS0PK:
        $source = $defineDir . "\x2f\x74\x65\x6d\x70\x6c\141\164\145\x2f\x77\145\x62\x61\160\x70\57{$filename}\x2e\150\164\155\154";
        goto YLaVN;
        Qu4Pq: hKLMI:
        goto bQA_E;
        yYQ0g: gKxaB:
        goto o2q8I;
        i06lQ:
        if (is_file($source)) {
            goto hKLMI;
        }
        goto UFcPn;
        gQoco:
        return $compile;
        goto nluza;
        II8Sa:
        $source = IA_ROOT . "\x2f\x77\x65\x62\x2f\164\150\145\x6d\x65\x73\57\144\x65\x66\141\x75\x6c\x74\x2f{$filename}\56\x68\164\155\154";
        goto cV5pq;
        MSWII: ouMij:
        goto VLp0o;
        p_F3i:
        if (defined("\x49\x4e\137\x53\131\x53")) {
            goto tPlb6;
        }
        goto Av5Ob;
        IOC42:
        if (is_file($source)) {
            goto Awryv;
        }
        goto ELQg_;
        v2daI:
        if (is_file($source)) {
            goto X3Kpv;
        }
        goto deKcL;
        TdhOi:
        $compile = str_replace($paths["\x66\151\x6c\145\x6e\141\155\145"], $_W["\x75\156\x69\x61\x63\x69\x64"] . "\137" . $paths["\146\151\154\x65\x6e\x61\155\145"], $compile);
        goto TSWTw;
        YwNEG:
        if (is_file($source)) {
            goto VXP_m;
        }
        goto hFb2I;
        oIWKa:
        $compile = IA_ROOT . "\57\x64\141\x74\x61\x2f\164\160\154\57\x61\x70\160\x2f{$_W["\x74\145\155\160\x6c\x61\164\x65"]}\57{$name}\57{$filename}\56\164\x70\x6c\56\160\150\x70";
        goto Mckry;
        So26H:
        $source = IA_ROOT . "\x2f\167\x65\142\57\164\x68\145\155\145\x73\57{$_W["\x74\x65\155\160\154\x61\x74\x65"]}\57{$name}\57{$filename}\x2e\150\x74\x6d\x6c";
        goto iDsb8;
        bQA_E:
        if (is_file($source)) {
            goto qjQp8;
        }
        goto II8Sa;
        fZ71S: Awryv:
        goto rDmr2;
        reRed:
        $source = IA_ROOT . "\57\x61\x70\x70\57\164\x68\145\x6d\145\163\57\x64\145\146\141\x75\x6c\x74\57{$filename}\56\150\x74\x6d\154";
        goto J8Pu6;
        eEzqI:
        if (is_file($source)) {
            goto Ws_n0;
        }
        goto DS0PK;
        zV1Rw:
        $source = IA_ROOT . "\x2f\141\160\x70\x2f\x74\x68\145\x6d\x65\163\x2f{$_W["\164\145\155\x70\154\141\x74\x65"]}\57{$filename}\x2e\x68\164\155\154";
        goto O7QZ8;
        hFb2I:
        $source = $defineDir . "\x2f\164\x65\x6d\160\154\141\164\x65\57{$filename}\x2e\x68\x74\155\154";
        goto lD8kK;
        rDmr2:
        goto gKxaB;
        goto iE6_1;
        n5nbi:
        exit("\x45\162\162\157\x72\72\x20\164\145\155\160\154\141\164\x65\x20\163\x6f\165\162\x63\145\40\47{$filename}\47\x20\x69\x73\x20\x6e\157\x74\x20\145\x78\151\163\x74\x21");
        goto piUJw;
        O7QZ8: WxNej:
        goto IOC42;
        yH8d0:
        if (is_file($source)) {
            goto Rr2c5;
        }
        goto Mv8aC;
        muiec:
        template_compile($source, $compile, true);
        goto dEI0_;
        YLaVN: Ws_n0:
        goto OBY_5;
        J8Pu6:
        goto FSB0R;
        goto MSWII;
        iDsb8:
        $compile = IA_ROOT . "\57\144\x61\x74\x61\x2f\164\x70\x6c\57\x77\145\142\57{$_W["\164\145\x6d\x70\x6c\x61\x74\145"]}\57{$name}\57{$filename}\56\164\x70\154\x2e\x70\150\160";
        goto v2daI;
        ELQg_:
        if (in_array($filename, ["\x68\145\x61\144\145\x72", "\146\x6f\157\164\145\x72", "\x73\154\x69\144\x65", "\164\157\x6f\x6c\142\x61\x72", "\x6d\145\x73\163\x61\x67\x65"])) {
            goto ouMij;
        }
        goto reRed;
        LGNQ_:
        $paths = pathinfo($compile);
        goto TdhOi;
        deKcL:
        $source = IA_ROOT . "\57\167\x65\142\x2f\164\150\145\x6d\x65\163\57\x64\x65\x66\141\165\154\164\57{$name}\57{$filename}\56\x68\x74\x6d\x6c";
        goto rl1hM;
        CLnGh:
        $defineDir = IA_ROOT . "\57\141\144\x64\x6f\156\163\57" . $_GPC["\x6d"];
        goto CxqpT;
        kkMmD:
        $name = $_GPC["\x6d"];
        goto CLnGh;
        VLp0o:
        $source = IA_ROOT . "\57\x61\160\x70\x2f\x74\150\145\x6d\x65\163\57\x64\x65\x66\x61\x75\x6c\x74\57\x63\157\x6d\x6d\157\156\x2f{$filename}\56\150\x74\155\x6c";
        goto uqN0a;
        fpx21: TaIPt:
        goto yH8d0;
        iE6_1: tPlb6:
        goto So26H;
        uqN0a: FSB0R:
        goto fZ71S;
        cV5pq: qjQp8:
        goto yYQ0g;
        rl1hM: X3Kpv:
        goto YwNEG;
        Mckry:
        if (is_file($source)) {
            goto TaIPt;
        }
        goto r_Vl2;
        OBY_5:
        if (is_file($source)) {
            goto WxNej;
        }
        goto zV1Rw;
        Mv8aC:
        $source = $defineDir . "\57\164\145\x6d\160\154\141\164\x65\x2f\x6d\x6f\142\151\154\145\137\164\x65\x6d\x70\x6c\141\x74\145\x2f{$filename}\x2e\150\x74\x6d\x6c";
        goto JIoYN;
        TSWTw:
        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
            goto UX4FX;
        }
        goto muiec;
        lD8kK: VXP_m:
        goto i06lQ;
        o2q8I:
        if (is_file($source)) {
            goto Xv_eF;
        }
        goto n5nbi;
        Av5Ob:
        $source = IA_ROOT . "\x2f\141\x70\160\x2f\164\150\x65\155\x65\163\x2f{$_W["\x74\x65\155\160\154\141\x74\145"]}\57{$name}\57{$filename}\56\150\164\155\154";
        goto oIWKa;
        dEI0_: UX4FX:
        goto gQoco;
        nluza:
    }

    function fileSave($file_string, $type = "jpg", $name = "auto") {
        global $_W;
        load()->func("file");
        $allow_ext = ["images" => ["gif", "jpg", "jpeg", "bmp", "png", "ico"], "audios" => ["mp3", "wma", "wav", "amr"], "videos" => ["wmv", "avi", "mpg", "mpeg", "mp4"]];
        if (in_array($type, $allow_ext["images"])) {
            $type_path = "images";
            if (!empty($type_path)) {
                if (empty($name) || $name == "auto") {
                    $uniacid = intval($_W["uniacid"]);
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
                if (strexists($filename, $type)) {
                    if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                        file_remote_upload($path);
                        return $path . $filename;
                    }
                    return false;
                }
                $filename .= "." . $type;
                if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                    file_remote_upload($path);
                    return $path . $filename;
                }
                return false;
            }
            return error(1, "\xe7\xa6\201\346\255\242\344\xbf\235\xe5\255\230\346\226\x87\344\xbb\266\347\261\273\xe5\x9e\x8b");
        }
        if (in_array($type, $allow_ext["audios"])) {
            $type_path = "\141\165\144\151\x6f\163";
            if (!empty($type_path)) {
                if (empty($name) || $name == "auto") {
                    $uniacid = intval($_W["uniacid"]);
                    $path    = "{$type_path}/{$uniacid}/{$this->module["name"]}\x2f" . date("Y/m/");
                    mkdirs(ATTACHMENT_ROOT . "/" . $path);
                    $filename = file_random_name(ATTACHMENT_ROOT . "\57" . $path, $type);
                    if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                        file_remote_upload($path);
                        return $path . $filename;
                    }
                    return false;
                }
                $path = "{$type_path}/{$uniacid}/{$this->module["name"]}/";
                mkdirs(dirname(ATTACHMENT_ROOT . "/" . $path));
                $filename = $name;
                if (strexists($filename, $type)) {
                    if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                        file_remote_upload($path);
                        return $path . $filename;
                    }
                    return false;
                }
                $filename .= "\56" . $type;
                if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                    file_remote_upload($path);
                    return $path . $filename;
                }
                return false;
            }
            return error(1, "\xe7\xa6\201\346\255\242\344\xbf\235\xe5\255\230\346\226\x87\344\xbb\266\347\261\273\xe5\x9e\x8b");
        }
        if (in_array($type, $allow_ext["videos"])) {
            $type_path = "videos";
            if (!empty($type_path)) {
                if (empty($name) || $name == "auto") {
                    $uniacid = intval($_W["uniacid"]);
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
                if (strexists($filename, $type)) {
                    if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                        file_remote_upload($path);
                        return $path . $filename;
                    }
                    return false;
                }
                $filename .= "\56" . $type;
                if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                    file_remote_upload($path);
                    return $path . $filename;
                }
                return false;
            }
            return error(1, "\xe7\xa6\201\346\255\242\344\xbf\235\xe5\255\230\346\226\x87\344\xbb\266\347\261\273\xe5\x9e\x8b");
        }
        if (!empty($type_path)) {
            if (empty($name) || $name == "auto") {
                $uniacid = intval($_W["uniacid"]);
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
            if (strexists($filename, $type)) {
                if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
                    file_remote_upload($path);
                    return $path . $filename;
                }
                return false;
            }
            $filename .= "\56" . $type;
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
            $dir           = IA_ROOT . "/framework/builtin/" . $this->modulename . "/inc/" . $module_type;
            $file          = "{$dir}/{$function_name}.inc.php";
            if (file_exists($file)) {
                return $file;
            }
            $file = str_replace("framework/builtin", "addons", $file);
            return $file;
        }
        $function_name = strtolower(substr($name, 6));
        $dir           = IA_ROOT . "/framework/builtin/" . $this->modulename . "/inc/" . $module_type;
        $file          = "{$dir}/{$function_name}.inc.php";
        if (file_exists($file)) {
            return $file;
        }
        $file = str_replace("framework/builtin", "addons", $file);
        return $file;
    }

    function __call($name, $param) {
        $file = $this->getFunctionFile($name);
        if (!file_exists($file)) {
            trigger_error("\346\250\241\xe5\235\227\xe6\226\xb9\xe6\263\x95" . $name . "\344\270\215\xe5\xad\x98\xe5\x9c\xa8\x2e", E_USER_WARNING);
            return false;
        }
        require $file;
        exit;
    }
}