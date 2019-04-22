<?php


namespace Trink\Dp\Observer\Demo;


interface Observable {
    function attach(Observer $observer);
    function detach(Observer $observer);
    function notify();
    function getStatus();
}
