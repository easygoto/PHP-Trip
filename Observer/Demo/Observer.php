<?php


namespace Observer\Demo;


interface Observer {
    function update(Observable $observable);
}
