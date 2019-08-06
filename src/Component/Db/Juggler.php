<?php


namespace Trink\Core\Component\Db;

use Trink\Core\Container\Statement\Config;
use Trink\Core\Container\Statement\Db;

class Juggler extends \Upfor\Juggler\Juggler implements Db
{
    public function __construct(Config $config)
    {
        $db = $config->get('db');
        parent::__construct([
            'host'     => $db['host'],
            'dbname'   => $db['name'],
            'username' => $db['user'],
            'password' => $db['pass'],
            'charset'  => $db['charset'],
        ]);
    }

    public function test()
    {
        $this->beginTransaction();
        $this->inTransaction();
        $this->commit();
        $this->rollBack();

        $this->table('');
        $this->delete();
        $this->update([]);
        $this->insert([]);
        $this->lastInsertId();
        $this->getList();
        $this->getRow();
        $this->has();
        $this->query('');
        $this->join('', '');
        $this->where('');
        $this->group('');
        $this->limit('');
        $this->order('');

        $this->count();
        $this->avg('');
        $this->max('');
        $this->min('');
        $this->sum('');
    }
}
