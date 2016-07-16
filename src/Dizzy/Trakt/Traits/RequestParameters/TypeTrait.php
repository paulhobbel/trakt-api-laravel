<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 16-7-2016
 * Time: 20:43
 */

namespace Dizzy\Trakt\Traits\RequestParameters;
use Dizzy\Trakt\Exceptions\WrongParameterValueException;

/**
 * Class TypeTrait
 * @package Dizzy\Trakt\Traits\RequestParameters
 */
trait TypeTrait
{
    private $type;

    /**
     * Validate and set the type. Can be set to movies or shows.
     * @param $type
     * @throws WrongParameterValueException
     */
    public function setType($type)
    {
        $allowedTypes = ['movies', 'shows'];
        if(in_array($type, $allowedTypes, true)) {
            $this->type = $type;
        } else {
            throw new WrongParameterValueException($allowedTypes);
        }
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}