<?php


namespace Trink\Dp\App\Dota\Skill;

trait Dizziness
{
    /** @var float $dizzinessTime 眩晕时间 */
    protected $dizzinessTime;

    /**
     * @return float
     */
    public function getDizzinessTime(): float
    {
        return $this->dizzinessTime;
    }

    /**
     * @param float $dizzinessTime
     *
     * @return Dizziness
     */
    public function setDizzinessTime(float $dizzinessTime): self
    {
        $this->dizzinessTime = $dizzinessTime;
        return $this;
    }
}
