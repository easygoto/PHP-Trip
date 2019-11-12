<?php


namespace Trink\App\Trip\DotA\Hero;

use ReflectionObject;
use Trink\App\Trip\DotA\DotAObject;
use Trink\App\Trip\DotA\Skill\Dizziness;
use Trink\App\Trip\DotA\Skill\Hurt;
use Trink\App\Trip\DotA\Skill\Skill;

/**
 * Class Hero
 *
 * @package Trink\App\Trip\DotA\Hero
 *
 * @method float getLifeValue()
 * @method float getMagicValue()
 * @method string getStatus()
 * @method Hero setStatus(string $status)
 * @method Hero setLifeValue(float $lifeValue)
 * @method Hero setMagicValue(float $magicValue)
 */
abstract class Hero extends DotAObject
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
        $skillObj    = new ReflectionObject($curSkill);
        $skillTraits = $skillObj->getTraitNames();
        if (in_array(Dizziness::class, $skillTraits)) {
            /** @var Dizziness $curSkill */
            $msg = sprintf("眩晕时间 : %.2f 秒", $curSkill->getDizzinessTime());
            $hero->setStatus($msg);
        }
        if (in_array(Hurt::class, $skillTraits)) {
            /** @var Hurt $curSkill */
            $hero->setLifeValue($hero->getLifeValue() - $curSkill->getHurtValue());
        }
    }
}
