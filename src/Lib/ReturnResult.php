<?php

namespace Trink\Demo\Lib;

use ReflectionObject;

/**
 * @property array debug
 */
class ReturnResult
{
    private $status;
    private $msg;
    private $data;

    /**
     * ReturnResult constructor.
     *
     * @param int    $status
     * @param string $msg
     * @param array  $data
     */
    private function __construct(int $status, string $msg, array $data)
    {
        $this->status = $status;
        $this->msg    = $msg;
        $this->data   = $data;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->status === 0;
    }

    /**
     * @return bool
     */
    public function isFail()
    {
        return $this->status !== 0;
    }

    /**
     * @return array
     */
    public function asArray()
    {
        $properties      = [];
        $object          = new ReflectionObject($this);
        $field_list      = $object->getProperties();
        $field_name_list = array_column($field_list, 'name');
        foreach ($field_name_list as $field_name) {
            $properties[$field_name] = $this->$field_name;
        }
        return array_merge($properties, get_object_vars($this));
    }

    /**
     * @return false|mixed|string
     */
    public function asJson()
    {
        return json_encode($this->asArray());
    }

    /**
     * 错误返回
     *
     * @param string $msg    返回消息
     * @param array  $debug  调试信息
     * @param int    $status 状态码
     *
     * @return ReturnResult
     */
    public static function fail(string $msg, array $debug = [], int $status = 1): ReturnResult
    {
        $message        = new self($status, $msg, []);
        $message->debug = $debug;
        return $message;
    }

    /**
     * 正常返回
     *
     * @param array  $data   返回数据
     * @param string $msg    返回消息
     * @param int    $status 状态码
     *
     * @return ReturnResult
     */
    public static function success(array $data = [], string $msg = '', int $status = 0): ReturnResult
    {
        return new self($status, $msg, $data);
    }

    /**
     * 基础返回
     *
     * @param int    $status 状态码
     * @param string $msg    返回消息
     * @param array  $data   返回数据
     * @param array  $extra  扩展使用
     *
     * @return ReturnResult
     */
    public static function result(int $status, string $msg, array $data, array $extra = []): ReturnResult
    {
        $message = new self($status, $msg, $data);
        foreach ($extra as $key => $value) {
            $message->$key = $value;
        }
        return $message;
    }
}
