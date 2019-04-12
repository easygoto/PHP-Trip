<?php

use Observer\Demo\Login;
use Observer\Demo\SecurityMonitor;

require_once '../vendor/autoload.php';

$login = new Login();
$login->attach(new SecurityMonitor());
