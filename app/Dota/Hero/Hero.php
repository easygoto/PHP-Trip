<?php


namespace Trink\Dp\App\Dota\Hero;

use Trink\Dp\App\Dota\Skill\Dizziness;
use Trink\Dp\App\Dota\Skill\Hurt;
use Trink\Dp\App\Dota\Skill\Skill;

abstract class Hero
{
    /** @var float $lifeValue 生命值 */
    protected $lifeValue;

    /** @var float $magicValue 魔法值 */
    protected $magicValue;

    /** @var string 状态 */
    protected $status;

    /** @var Skill[] $skillList 技能 */
    protected $skillList;

    /**
     * @return float
     */
    public function getLifeValue(): float
    {
        return $this->lifeValue;
    }

    /**
     * @param float $lifeValue
     *
     * @return Axe
     */
    public function setLifeValue(float $lifeValue): self
    {
        $this->lifeValue = $lifeValue;
        return $this;
    }

    /**
     * @return float
     */
    public function getMagicValue(): float
    {
        return $this->magicValue;
    }

    /**
     * @param float $magicValue
     *
     * @return Hero
     */
    public function setMagicValue(float $magicValue): self
    {
        $this->magicValue = $magicValue;
        return $this;
    }

    /**
     * @param Skill $skill
     *
     * @return Hero
     */
    public function addSkill(Skill $skill): self
    {
        $this->skillList[] = $skill;
        return $this;
    }

    public function castSKill2Hero(int $action, Hero $hero)
    {
        $curSkill = $this->skillList[$action];
        $this->setMagicValue($this->getMagicValue() - $curSkill->getCostMagic());
        if ($curSkill instanceof Dizziness) {
            $msg = sprintf("%s%f", '眩晕时间 : ', $curSkill->getDizzinessTime());
            $hero->setStatus($msg);
        }
        if ($curSkill instanceof Hurt) {
            $hero->setLifeValue($hero->getLifeValue() - $curSkill->getHurtValue());
        }
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
