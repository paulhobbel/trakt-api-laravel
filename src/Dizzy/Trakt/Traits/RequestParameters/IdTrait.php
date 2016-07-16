<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 20:41
 */

namespace Dizzy\Trakt\Traits\RequestParameters;

/**
 * Class IdTrait
 * @package Dizzy\Trakt\Traits\RequestParameters
 */
trait IdTrait
{
    private $id;

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}