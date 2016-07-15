<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 20:44
 */

namespace Dizzy\Trakt\Console\Generators;

/**
 * Class TemplateWriter
 * @package Dizzy\Trakt\Console\Generators
 */
trait TemplateWriter
{
    /**
     * @var string
     */
    protected $template;
    /**
     * @param $key
     * @param $value
     * @return $this
     */
    protected function writeInTemplate($key, $value)
    {
        $this->template = str_replace("{{" . $key . "}}", $value, $this->template);
        return $this;
    }
    /**
     * @return $this
     */
    protected function deleteUnusedPlaceholders()
    {
        $this->template = preg_replace("/{.*}/", "", $this->template);
        return $this;
    }
}