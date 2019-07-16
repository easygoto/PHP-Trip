<?php


namespace Trink\Trip\App\Dota\Skill;

use Trink\Trip\App\Dota\DObject;

/**
 * Class Skill
 *
 * @package Trink\Trip\App\Dota\Skill
 *
 * @method int getCostMagic()
 * @method Skill setCostMagic(int $costMagic)
 */
abstract class Skill extends DObject
{
    /** @var int $costMagic 消耗魔法值 */
    protected $costMagic;
}
