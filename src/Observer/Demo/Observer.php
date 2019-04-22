<?php


namespace Trink\Dp\Observer\Demo;


interface Observer {
    function update(Observable $observable);
}
