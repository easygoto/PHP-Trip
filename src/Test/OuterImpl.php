<?php


namespace Trink\Demo\Test;

use IteratorIterator;

class OuterImpl extends IteratorIterator
{
    public function current()
    {
        return parent::current() . 'outerImpl';
    }

    public function key()
    {
        return parent::key() . 'outerImpl';
    }
}
