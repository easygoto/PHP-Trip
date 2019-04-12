<?php

use Trink\Observer\Demo\Login;
use Trink\Observer\Demo\SecurityMonitor;

require_once '../vendor/autoload.php';

$login = new Login();
$login->attach(new SecurityMonitor());
