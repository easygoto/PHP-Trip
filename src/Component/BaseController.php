<?php

namespace Trink\Frame\Component;

use Trink\Frame\Container\App;

abstract class BaseController
{
    public string $id = '';

    public string $actionId = '';

    public array $moduleList = [];

    public BaseResponse $response;

    public function __construct()
    {
        $this->response = App::instance()->response;
    }

    public function renderPart($view = '')
    {
        return VIEW_DIR . implode('/', array_merge($this->moduleList, [$this->id, $this->actionId])) . '.php';
    }
}
