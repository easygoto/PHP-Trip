<?php


namespace Trink\Dp\Observer\Demo;


class Login implements Observable {
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 1;
    const LOGIN_ACCESS = 1;
    private $status = [];
    private $observers;

    public function __construct() {
        $this->observers = [];
    }

    function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    function detach(Observer $observer) {
        $newObservers = [];
        foreach ($this->observers as $obs){
            if ($obs !== $observer){
                $newObservers[] = $obs;
            }
        }
        $this->observers = $newObservers;
    }

    function notify() {
        foreach ($this->observers as $obs){
            $obs->update($this);
        }
    }

    private function setStatus($status, $user, $ip){
        $this->status = [$status, $user, $ip];
    }

    function getStatus(){
        return $this->status;
    }

    function handleLogin($user, $pass, $ip){
        switch (rand(1 ,3)){
            default:
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = true; break;
            case 2:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = false; break;
            case 3:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = false; break;
        }
        $this->notify();
        return $ret;
    }
}
