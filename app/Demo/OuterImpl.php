<?php

namespace Trink\App\Trip\Demo;

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
