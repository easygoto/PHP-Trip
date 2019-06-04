<?php


namespace Trink\Dp\App\Dota\Hero;

use Trink\Dp\App\Dota\DObject;
use Trink\Dp\App\Dota\Skill\Skill;

/**
 * Class Hero
 *
 * @package Trink\Dp\App\Dota\Hero
 *
 * @method float getLifeValue()
 * @method float getMagicValue()
 * @method string getStatus()
 * @method Hero setStatus(string $status)
 * @method Hero setLifeValue(float $lifeValue)
 * @method Hero setMagicValue(float $magicValue)
 */
abstract class Hero extends DObject
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
//        if ($curSkill instanceof Dizziness) {
            $msg = sprintf("眩晕时间 : %.2f 秒", $curSkill->getDizzinessTime());
            $hero->setStatus($msg);
//        }
//        if ($curSkill instanceof Hurt) {
            $hero->setLifeValue($hero->getLifeValue() - $curSkill->getHurtValue());
//        }
    }
}
