<?php


namespace Trink\App\Trip\DotA\Skill;

use Trink\App\Trip\DotA\DotAObject;

/**
 * Class Skill
 *
 * @package Trink\App\Trip\DotA\Skill
 *
 * @method int getCostMagic()
 * @method Skill setCostMagic(int $costMagic)
 */
abstract class Skill extends DotAObject
{
    /** @var int $costMagic 消耗魔法值 */
    protected $costMagic;
}
