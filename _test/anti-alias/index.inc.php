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
        goto kkMmD;kkMmD:
        $name = $_GPC["m"];
        goto CLnGh;CLnGh:
        $defineDir = IA_ROOT . "/addons/" . $_GPC["m"];
        goto CxqpT;CxqpT:
        $_W["template"] = "default";
        goto p_F3i;p_F3i:
        if (defined("IN_SYS")) {
            goto tPlb6;tPlb6:
            goto So26H;So26H:
            $source = IA_ROOT . "/web/themes/{$_W["template"]}/{$name}/{$filename}.html";
            goto iDsb8;iDsb8:
            $compile = IA_ROOT . "/data/tpl/web/{$_W["template"]}/{$name}/{$filename}.tpl.php";
            goto v2daI;v2daI:
            if (is_file($source)) {
                goto X3Kpv;X3Kpv:
                goto YwNEG;YwNEG:
                if (is_file($source)) {
                    goto VXP_m;VXP_m:
                    goto i06lQ;i06lQ:
                    if (is_file($source)) {
                        goto hKLMI;hKLMI:
                        goto bQA_E;bQA_E:
                        if (is_file($source)) {
                            goto qjQp8;qjQp8:
                            goto yYQ0g;yYQ0g:
                            goto o2q8I;o2q8I:
                            if (is_file($source)) {
                                goto Xv_eF;Xv_eF:
                                goto LGNQ_;LGNQ_:
                                $paths = pathinfo($compile);
                                goto TdhOi;TdhOi:
                                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                                goto TSWTw;TSWTw:
                                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                    goto UX4FX;UX4FX:
                                    goto gQoco;gQoco:
                                    return $compile;
                                }
                                goto muiec;muiec:
                                template_compile($source, $compile, true);
                                goto dEI0_;dEI0_:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto n5nbi;n5nbi:
                            exit("Error: template source '{$filename}' is not exist!");
                        }
                        goto II8Sa;II8Sa:
                        $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                        goto cV5pq;cV5pq:
                        goto yYQ0g;yYQ0g:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto UFcPn;UFcPn:
                    $source = IA_ROOT . "/web/themes/{$_W["template"]}/{$filename}.html";
                    goto Qu4Pq;Qu4Pq:
                    goto bQA_E;bQA_E:
                    if (is_file($source)) {
                        goto qjQp8;qjQp8:
                        goto yYQ0g;yYQ0g:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto II8Sa;II8Sa:
                    $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                    goto cV5pq;cV5pq:
                    goto yYQ0g;yYQ0g:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto hFb2I;hFb2I:
                $source = $defineDir . "/template/{$filename}.html";
                goto lD8kK;lD8kK:
                goto i06lQ;i06lQ:
                if (is_file($source)) {
                    goto hKLMI;hKLMI:
                    goto bQA_E;bQA_E:
                    if (is_file($source)) {
                        goto qjQp8;qjQp8:
                        goto yYQ0g;yYQ0g:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto II8Sa;II8Sa:
                    $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                    goto cV5pq;cV5pq:
                    goto yYQ0g;yYQ0g:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto UFcPn;UFcPn:
                $source = IA_ROOT . "/web/themes/{$_W["template"]}/{$filename}.html";
                goto Qu4Pq;Qu4Pq:
                goto bQA_E;bQA_E:
                if (is_file($source)) {
                    goto qjQp8;qjQp8:
                    goto yYQ0g;yYQ0g:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto II8Sa;II8Sa:
                $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                goto cV5pq;cV5pq:
                goto yYQ0g;yYQ0g:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto deKcL;deKcL:
            $source = IA_ROOT . "/web/themes/default/{$name}/{$filename}.html";
            goto rl1hM;rl1hM:
            goto YwNEG;YwNEG:
            if (is_file($source)) {
                goto VXP_m;VXP_m:
                goto i06lQ;i06lQ:
                if (is_file($source)) {
                    goto hKLMI;hKLMI:
                    goto bQA_E;bQA_E:
                    if (is_file($source)) {
                        goto qjQp8;qjQp8:
                        goto yYQ0g;yYQ0g:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto II8Sa;II8Sa:
                    $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                    goto cV5pq;cV5pq:
                    goto yYQ0g;yYQ0g:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto UFcPn;UFcPn:
                $source = IA_ROOT . "/web/themes/{$_W["template"]}/{$filename}.html";
                goto Qu4Pq;Qu4Pq:
                goto bQA_E;bQA_E:
                if (is_file($source)) {
                    goto qjQp8;qjQp8:
                    goto yYQ0g;yYQ0g:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto II8Sa;II8Sa:
                $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                goto cV5pq;cV5pq:
                goto yYQ0g;yYQ0g:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto hFb2I;hFb2I:
            $source = $defineDir . "/template/{$filename}.html";
            goto lD8kK;lD8kK:
            goto i06lQ;i06lQ:
            if (is_file($source)) {
                goto hKLMI;hKLMI:
                goto bQA_E;bQA_E:
                if (is_file($source)) {
                    goto qjQp8;qjQp8:
                    goto yYQ0g;yYQ0g:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto II8Sa;II8Sa:
                $source = IA_ROOT . "/web/themes/default/{$filename}.html";
                goto cV5pq;cV5pq:
                goto yYQ0g;yYQ0g:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto UFcPn;UFcPn:
            $source = IA_ROOT . "/web/themes/{$_W["template"]}/{$filename}.html";
            goto Qu4Pq;Qu4Pq:
            goto bQA_E;bQA_E:
            if (is_file($source)) {
                goto qjQp8;qjQp8:
                goto yYQ0g;yYQ0g:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto II8Sa;II8Sa:
            $source = IA_ROOT . "/web/themes/default/{$filename}.html";
            goto cV5pq;cV5pq:
            goto yYQ0g;yYQ0g:
            goto o2q8I;o2q8I:
            if (is_file($source)) {
                goto Xv_eF;Xv_eF:
                goto LGNQ_;LGNQ_:
                $paths = pathinfo($compile);
                goto TdhOi;TdhOi:
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                goto TSWTw;TSWTw:
                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                    goto UX4FX;UX4FX:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto muiec;muiec:
                template_compile($source, $compile, true);
                goto dEI0_;dEI0_:
                goto gQoco;gQoco:
                return $compile;
            }
            goto n5nbi;n5nbi:
            exit("Error: template source '{$filename}' is not exist!");
        }
        goto Av5Ob;Av5Ob:
        $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$name}/{$filename}.html";
        goto oIWKa;oIWKa:
        $compile = IA_ROOT . "/data/tpl/app/{$_W["template"]}/{$name}/{$filename}.tpl.php";
        goto Mckry;Mckry:
        if (is_file($source)) {
            goto TaIPt;TaIPt:
            goto yH8d0;yH8d0:
            if (is_file($source)) {
                goto Rr2c5;Rr2c5:
                goto eEzqI;eEzqI:
                if (is_file($source)) {
                    goto Ws_n0;Ws_n0:
                    goto OBY_5;OBY_5:
                    if (is_file($source)) {
                        goto WxNej;WxNej:
                        goto IOC42;IOC42:
                        if (is_file($source)) {
                            goto Awryv;Awryv:
                            goto rDmr2;rDmr2:
                            goto gKxaB;gKxaB:
                            goto o2q8I;o2q8I:
                            if (is_file($source)) {
                                goto Xv_eF;Xv_eF:
                                goto LGNQ_;LGNQ_:
                                $paths = pathinfo($compile);
                                goto TdhOi;TdhOi:
                                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                                goto TSWTw;TSWTw:
                                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                    goto UX4FX;UX4FX:
                                    goto gQoco;gQoco:
                                    return $compile;
                                }
                                goto muiec;muiec:
                                template_compile($source, $compile, true);
                                goto dEI0_;dEI0_:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto n5nbi;n5nbi:
                            exit("Error: template source '{$filename}' is not exist!");
                        }
                        goto ELQg_;ELQg_:
                        if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                            goto ouMij;ouMij:
                            goto VLp0o;VLp0o:
                            $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                            goto uqN0a;uqN0a:
                            goto fZ71S;fZ71S:
                            goto rDmr2;rDmr2:
                            goto gKxaB;gKxaB:
                            goto o2q8I;o2q8I:
                            if (is_file($source)) {
                                goto Xv_eF;Xv_eF:
                                goto LGNQ_;LGNQ_:
                                $paths = pathinfo($compile);
                                goto TdhOi;TdhOi:
                                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                                goto TSWTw;TSWTw:
                                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                    goto UX4FX;UX4FX:
                                    goto gQoco;gQoco:
                                    return $compile;
                                }
                                goto muiec;muiec:
                                template_compile($source, $compile, true);
                                goto dEI0_;dEI0_:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto n5nbi;n5nbi:
                            exit("Error: template source '{$filename}' is not exist!");
                        }
                        goto reRed;reRed:
                        $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                        goto J8Pu6;J8Pu6:
                        goto FSB0R;FSB0R:
                        goto fZ71S;fZ71S:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto zV1Rw;zV1Rw:
                    $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
                    goto O7QZ8;O7QZ8:
                    goto IOC42;IOC42:
                    if (is_file($source)) {
                        goto Awryv;Awryv:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto ELQg_;ELQg_:
                    if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                        goto ouMij;ouMij:
                        goto VLp0o;VLp0o:
                        $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                        goto uqN0a;uqN0a:
                        goto fZ71S;fZ71S:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto reRed;reRed:
                    $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                    goto J8Pu6;J8Pu6:
                    goto FSB0R;FSB0R:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto DS0PK;DS0PK:
                $source = $defineDir . "/template/webapp/{$filename}.html";
                goto YLaVN;YLaVN:
                goto OBY_5;OBY_5:
                if (is_file($source)) {
                    goto WxNej;WxNej:
                    goto IOC42;IOC42:
                    if (is_file($source)) {
                        goto Awryv;Awryv:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto ELQg_;ELQg_:
                    if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                        goto ouMij;ouMij:
                        goto VLp0o;VLp0o:
                        $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                        goto uqN0a;uqN0a:
                        goto fZ71S;fZ71S:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto reRed;reRed:
                    $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                    goto J8Pu6;J8Pu6:
                    goto FSB0R;FSB0R:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto zV1Rw;zV1Rw:
                $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
                goto O7QZ8;O7QZ8:
                goto IOC42;IOC42:
                if (is_file($source)) {
                    goto Awryv;Awryv:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto ELQg_;ELQg_:
                if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                    goto ouMij;ouMij:
                    goto VLp0o;VLp0o:
                    $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                    goto uqN0a;uqN0a:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto reRed;reRed:
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                goto J8Pu6;J8Pu6:
                goto FSB0R;FSB0R:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto Mv8aC;Mv8aC:
            $source = $defineDir . "/template/mobile_template/{$filename}.html";
            goto JIoYN;JIoYN:
            goto eEzqI;eEzqI:
            if (is_file($source)) {
                goto Ws_n0;Ws_n0:
                goto OBY_5;OBY_5:
                if (is_file($source)) {
                    goto WxNej;WxNej:
                    goto IOC42;IOC42:
                    if (is_file($source)) {
                        goto Awryv;Awryv:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto ELQg_;ELQg_:
                    if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                        goto ouMij;ouMij:
                        goto VLp0o;VLp0o:
                        $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                        goto uqN0a;uqN0a:
                        goto fZ71S;fZ71S:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto reRed;reRed:
                    $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                    goto J8Pu6;J8Pu6:
                    goto FSB0R;FSB0R:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto zV1Rw;zV1Rw:
                $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
                goto O7QZ8;O7QZ8:
                goto IOC42;IOC42:
                if (is_file($source)) {
                    goto Awryv;Awryv:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto ELQg_;ELQg_:
                if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                    goto ouMij;ouMij:
                    goto VLp0o;VLp0o:
                    $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                    goto uqN0a;uqN0a:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto reRed;reRed:
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                goto J8Pu6;J8Pu6:
                goto FSB0R;FSB0R:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto DS0PK;DS0PK:
            $source = $defineDir . "/template/webapp/{$filename}.html";
            goto YLaVN;YLaVN:
            goto OBY_5;OBY_5:
            if (is_file($source)) {
                goto WxNej;WxNej:
                goto IOC42;IOC42:
                if (is_file($source)) {
                    goto Awryv;Awryv:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto ELQg_;ELQg_:
                if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                    goto ouMij;ouMij:
                    goto VLp0o;VLp0o:
                    $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                    goto uqN0a;uqN0a:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto reRed;reRed:
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                goto J8Pu6;J8Pu6:
                goto FSB0R;FSB0R:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto zV1Rw;zV1Rw:
            $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
            goto O7QZ8;O7QZ8:
            goto IOC42;IOC42:
            if (is_file($source)) {
                goto Awryv;Awryv:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto ELQg_;ELQg_:
            if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                goto ouMij;ouMij:
                goto VLp0o;VLp0o:
                $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                goto uqN0a;uqN0a:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto reRed;reRed:
            $source = IA_ROOT . "/app/themes/default/{$filename}.html";
            goto J8Pu6;J8Pu6:
            goto FSB0R;FSB0R:
            goto fZ71S;fZ71S:
            goto rDmr2;rDmr2:
            goto gKxaB;gKxaB:
            goto o2q8I;o2q8I:
            if (is_file($source)) {
                goto Xv_eF;Xv_eF:
                goto LGNQ_;LGNQ_:
                $paths = pathinfo($compile);
                goto TdhOi;TdhOi:
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                goto TSWTw;TSWTw:
                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                    goto UX4FX;UX4FX:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto muiec;muiec:
                template_compile($source, $compile, true);
                goto dEI0_;dEI0_:
                goto gQoco;gQoco:
                return $compile;
            }
            goto n5nbi;n5nbi:
            exit("Error: template source '{$filename}' is not exist!");
        }
        goto r_Vl2;r_Vl2:
        $source = IA_ROOT . "/app/themes/default/{$name}/{$filename}.html";
        goto fpx21;fpx21:
        goto yH8d0;yH8d0:
        if (is_file($source)) {
            goto Rr2c5;Rr2c5:
            goto eEzqI;eEzqI:
            if (is_file($source)) {
                goto Ws_n0;Ws_n0:
                goto OBY_5;OBY_5:
                if (is_file($source)) {
                    goto WxNej;WxNej:
                    goto IOC42;IOC42:
                    if (is_file($source)) {
                        goto Awryv;Awryv:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto ELQg_;ELQg_:
                    if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                        goto ouMij;ouMij:
                        goto VLp0o;VLp0o:
                        $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                        goto uqN0a;uqN0a:
                        goto fZ71S;fZ71S:
                        goto rDmr2;rDmr2:
                        goto gKxaB;gKxaB:
                        goto o2q8I;o2q8I:
                        if (is_file($source)) {
                            goto Xv_eF;Xv_eF:
                            goto LGNQ_;LGNQ_:
                            $paths = pathinfo($compile);
                            goto TdhOi;TdhOi:
                            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                            goto TSWTw;TSWTw:
                            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                                goto UX4FX;UX4FX:
                                goto gQoco;gQoco:
                                return $compile;
                            }
                            goto muiec;muiec:
                            template_compile($source, $compile, true);
                            goto dEI0_;dEI0_:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto n5nbi;n5nbi:
                        exit("Error: template source '{$filename}' is not exist!");
                    }
                    goto reRed;reRed:
                    $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                    goto J8Pu6;J8Pu6:
                    goto FSB0R;FSB0R:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto zV1Rw;zV1Rw:
                $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
                goto O7QZ8;O7QZ8:
                goto IOC42;IOC42:
                if (is_file($source)) {
                    goto Awryv;Awryv:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto ELQg_;ELQg_:
                if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                    goto ouMij;ouMij:
                    goto VLp0o;VLp0o:
                    $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                    goto uqN0a;uqN0a:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto reRed;reRed:
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                goto J8Pu6;J8Pu6:
                goto FSB0R;FSB0R:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto DS0PK;DS0PK:
            $source = $defineDir . "/template/webapp/{$filename}.html";
            goto YLaVN;YLaVN:
            goto OBY_5;OBY_5:
            if (is_file($source)) {
                goto WxNej;WxNej:
                goto IOC42;IOC42:
                if (is_file($source)) {
                    goto Awryv;Awryv:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto ELQg_;ELQg_:
                if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                    goto ouMij;ouMij:
                    goto VLp0o;VLp0o:
                    $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                    goto uqN0a;uqN0a:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto reRed;reRed:
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                goto J8Pu6;J8Pu6:
                goto FSB0R;FSB0R:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto zV1Rw;zV1Rw:
            $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
            goto O7QZ8;O7QZ8:
            goto IOC42;IOC42:
            if (is_file($source)) {
                goto Awryv;Awryv:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto ELQg_;ELQg_:
            if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                goto ouMij;ouMij:
                goto VLp0o;VLp0o:
                $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                goto uqN0a;uqN0a:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto reRed;reRed:
            $source = IA_ROOT . "/app/themes/default/{$filename}.html";
            goto J8Pu6;J8Pu6:
            goto FSB0R;FSB0R:
            goto fZ71S;fZ71S:
            goto rDmr2;rDmr2:
            goto gKxaB;gKxaB:
            goto o2q8I;o2q8I:
            if (is_file($source)) {
                goto Xv_eF;Xv_eF:
                goto LGNQ_;LGNQ_:
                $paths = pathinfo($compile);
                goto TdhOi;TdhOi:
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                goto TSWTw;TSWTw:
                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                    goto UX4FX;UX4FX:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto muiec;muiec:
                template_compile($source, $compile, true);
                goto dEI0_;dEI0_:
                goto gQoco;gQoco:
                return $compile;
            }
            goto n5nbi;n5nbi:
            exit("Error: template source '{$filename}' is not exist!");

        }
        goto Mv8aC;Mv8aC:
        $source = $defineDir . "/template/mobile_template/{$filename}.html";
        goto JIoYN;JIoYN:
        goto eEzqI;eEzqI:
        if (is_file($source)) {
            goto Ws_n0;Ws_n0:
            goto OBY_5;OBY_5:
            if (is_file($source)) {
                goto WxNej;WxNej:
                goto IOC42;IOC42:
                if (is_file($source)) {
                    goto Awryv;Awryv:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto ELQg_;ELQg_:
                if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                    goto ouMij;ouMij:
                    goto VLp0o;VLp0o:
                    $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                    goto uqN0a;uqN0a:
                    goto fZ71S;fZ71S:
                    goto rDmr2;rDmr2:
                    goto gKxaB;gKxaB:
                    goto o2q8I;o2q8I:
                    if (is_file($source)) {
                        goto Xv_eF;Xv_eF:
                        goto LGNQ_;LGNQ_:
                        $paths = pathinfo($compile);
                        goto TdhOi;TdhOi:
                        $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                        goto TSWTw;TSWTw:
                        if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                            goto UX4FX;UX4FX:
                            goto gQoco;gQoco:
                            return $compile;
                        }
                        goto muiec;muiec:
                        template_compile($source, $compile, true);
                        goto dEI0_;dEI0_:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto n5nbi;n5nbi:
                    exit("Error: template source '{$filename}' is not exist!");
                }
                goto reRed;reRed:
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
                goto J8Pu6;J8Pu6:
                goto FSB0R;FSB0R:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto zV1Rw;zV1Rw:
            $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
            goto O7QZ8;O7QZ8:
            goto IOC42;IOC42:
            if (is_file($source)) {
                goto Awryv;Awryv:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto ELQg_;ELQg_:
            if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                goto ouMij;ouMij:
                goto VLp0o;VLp0o:
                $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                goto uqN0a;uqN0a:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto reRed;reRed:
            $source = IA_ROOT . "/app/themes/default/{$filename}.html";
            goto J8Pu6;J8Pu6:
            goto FSB0R;FSB0R:
            goto fZ71S;fZ71S:
            goto rDmr2;rDmr2:
            goto gKxaB;gKxaB:
            goto o2q8I;o2q8I:
            if (is_file($source)) {
                goto Xv_eF;Xv_eF:
                goto LGNQ_;LGNQ_:
                $paths = pathinfo($compile);
                goto TdhOi;TdhOi:
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                goto TSWTw;TSWTw:
                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                    goto UX4FX;UX4FX:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto muiec;muiec:
                template_compile($source, $compile, true);
                goto dEI0_;dEI0_:
                goto gQoco;gQoco:
                return $compile;
            }
            goto n5nbi;n5nbi:
            exit("Error: template source '{$filename}' is not exist!");
        }
        goto DS0PK;DS0PK:
        $source = $defineDir . "/template/webapp/{$filename}.html";
        goto YLaVN;YLaVN:
        goto OBY_5;OBY_5:
        if (is_file($source)) {
            goto WxNej;WxNej:
            goto IOC42;IOC42:
            if (is_file($source)) {
                goto Awryv;Awryv:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto ELQg_;ELQg_:
            if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
                goto ouMij;ouMij:
                goto VLp0o;VLp0o:
                $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
                goto uqN0a;uqN0a:
                goto fZ71S;fZ71S:
                goto rDmr2;rDmr2:
                goto gKxaB;gKxaB:
                goto o2q8I;o2q8I:
                if (is_file($source)) {
                    goto Xv_eF;Xv_eF:
                    goto LGNQ_;LGNQ_:
                    $paths = pathinfo($compile);
                    goto TdhOi;TdhOi:
                    $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                    goto TSWTw;TSWTw:
                    if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                        goto UX4FX;UX4FX:
                        goto gQoco;gQoco:
                        return $compile;
                    }
                    goto muiec;muiec:
                    template_compile($source, $compile, true);
                    goto dEI0_;dEI0_:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto n5nbi;n5nbi:
                exit("Error: template source '{$filename}' is not exist!");
            }
            goto reRed;reRed:
            $source = IA_ROOT . "/app/themes/default/{$filename}.html";
            goto J8Pu6;J8Pu6:
            goto FSB0R;FSB0R:
            goto fZ71S;fZ71S:
            goto rDmr2;rDmr2:
            goto gKxaB;gKxaB:
            goto o2q8I;o2q8I:
            if (is_file($source)) {
                goto Xv_eF;Xv_eF:
                goto LGNQ_;LGNQ_:
                $paths = pathinfo($compile);
                goto TdhOi;TdhOi:
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                goto TSWTw;TSWTw:
                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                    goto UX4FX;UX4FX:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto muiec;muiec:
                template_compile($source, $compile, true);
                goto dEI0_;dEI0_:
                goto gQoco;gQoco:
                return $compile;
            }
            goto n5nbi;n5nbi:
            exit("Error: template source '{$filename}' is not exist!");
        }
        goto zV1Rw;zV1Rw:
        $source = IA_ROOT . "/app/themes/{$_W["template"]}/{$filename}.html";
        goto O7QZ8;O7QZ8:
        goto IOC42;IOC42:
        if (is_file($source)) {
            goto Awryv;Awryv:
            goto rDmr2;rDmr2:
            goto gKxaB;gKxaB:
            goto o2q8I;o2q8I:
            if (is_file($source)) {
                goto Xv_eF;Xv_eF:
                goto LGNQ_;LGNQ_:
                $paths = pathinfo($compile);
                goto TdhOi;TdhOi:
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                goto TSWTw;TSWTw:
                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                    goto UX4FX;UX4FX:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto muiec;muiec:
                template_compile($source, $compile, true);
                goto dEI0_;dEI0_:
                goto gQoco;gQoco:
                return $compile;
            }
            goto n5nbi;n5nbi:
            exit("Error: template source '{$filename}' is not exist!");
        }
        goto ELQg_;ELQg_:
        if (in_array($filename, ["header", "footer", "slide", "toolbar", "message"])) {
            goto ouMij;ouMij:
            goto VLp0o;VLp0o:
            $source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
            goto uqN0a;uqN0a:
            goto fZ71S;fZ71S:
            goto rDmr2;rDmr2:
            goto gKxaB;gKxaB:
            goto o2q8I;o2q8I:
            if (is_file($source)) {
                goto Xv_eF;Xv_eF:
                goto LGNQ_;LGNQ_:
                $paths = pathinfo($compile);
                goto TdhOi;TdhOi:
                $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
                goto TSWTw;TSWTw:
                if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                    goto UX4FX;UX4FX:
                    goto gQoco;gQoco:
                    return $compile;
                }
                goto muiec;muiec:
                template_compile($source, $compile, true);
                goto dEI0_;dEI0_:
                goto gQoco;gQoco:
                return $compile;
            }
            goto n5nbi;n5nbi:
            exit("Error: template source '{$filename}' is not exist!");
        }
        goto reRed;reRed:
        $source = IA_ROOT . "/app/themes/default/{$filename}.html";
        goto J8Pu6;J8Pu6:
        goto FSB0R;FSB0R:
        goto fZ71S;fZ71S:
        goto rDmr2;rDmr2:
        goto gKxaB;gKxaB:
        goto o2q8I;o2q8I:
        if (is_file($source)) {
            goto Xv_eF;Xv_eF:
            goto LGNQ_;LGNQ_:
            $paths = pathinfo($compile);
            goto TdhOi;TdhOi:
            $compile = str_replace($paths["filename"], $_W["uniacid"] . "_" . $paths["filename"], $compile);
            goto TSWTw;TSWTw:
            if (!(DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile))) {
                goto UX4FX;UX4FX:
                goto gQoco;gQoco:
                return $compile;
            }
            goto muiec;muiec:
            template_compile($source, $compile, true);
            goto dEI0_;dEI0_:
            goto gQoco;gQoco:
            return $compile;
        }
        goto n5nbi;n5nbi:
        exit("Error: template source '{$filename}' is not exist!");
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