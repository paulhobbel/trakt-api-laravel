<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 14-7-2016
 * Time: 01:07
 */

namespace Dizzy\Trakt\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Trakt
 * @package Dizzy\Trakt\Facades
 */
class Trakt extends Facade
{
    /**
     * Tells laravel which binding it has to use.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'trakt';
    }
}