<?php


namespace Trink\Dp\App\Dota\Skill;

abstract class Skill
{
    /** @var int $costMagic 消耗魔法值 */
    protected $costMagic;

    /**
     * @return int
     */
    public function getCostMagic(): int
    {
        return $this->costMagic;
    }

    /**
     * @param int $costMagic
     *
     * @return Skill
     */
    public function setCostMagic(int $costMagic): self
    {
        $this->costMagic = $costMagic;
        return $this;
    }
}
