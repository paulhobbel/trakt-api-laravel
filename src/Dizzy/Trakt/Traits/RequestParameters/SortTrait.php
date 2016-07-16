<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 20:46
 */

namespace Dizzy\Trakt\Traits\RequestParameters;
use Dizzy\Trakt\Exceptions\WrongParameterValueException;

/**
 * Class SortTrait
 * @package Dizzy\Trakt\Traits\RequestParameters
 */
trait SortTrait
{
    private $sort;

    /**
     * Validate and set the sort. Can be set to newest, oldest, likes or replies.
     * @param $sort
     */
    public function setSort($sort)
    {
        $allowedValues = ['newest', 'oldest', 'likes', 'replies'];
        if(in_array($sort, $allowedValues, true)) {
            $this->sort = $sort;
        } else {
            throw new WrongParameterValueException($allowedValues);
        }
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }
}