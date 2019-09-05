<?php


namespace Trink\Trip\App\DotA\Skill;

use Trink\Trip\App\DotA\DotAObject;

/**
 * Class Skill
 *
 * @package Trink\Trip\App\DotA\Skill
 *
 * @method int getCostMagic()
 * @method Skill setCostMagic(int $costMagic)
 */
abstract class Skill extends DotAObject
{
    /** @var int $costMagic 消耗魔法值 */
    protected $costMagic;
}
