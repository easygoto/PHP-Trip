<?php


namespace Trink\Observer\Demo;


interface Observer {
    function update(Observable $observable);
}
