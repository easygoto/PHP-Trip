<?php


namespace Trink\Dp\App\Dota\Skill;

trait Hurt
{
    /** @var float $hurtValue */
    protected $hurtValue;

    /**
     * @return float
     */
    public function getHurtValue(): float
    {
        return $this->hurtValue;
    }

    /**
     * @param float $hurtValue
     */
    public function setHurtValue(float $hurtValue): void
    {
        $this->hurtValue = $hurtValue;
    }
}
