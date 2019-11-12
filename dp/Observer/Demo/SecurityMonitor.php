<?php


namespace Trink\App\Dp\Observer\Demo;

class SecurityMonitor implements Observer
{
    public function update(Observable $observable)
    {
        $status = $observable->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            print __CLASS__."\tsending mail to sysadmin\n";
        }
    }
}
