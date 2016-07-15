<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 20:43
 */

namespace Dizzy\Trakt\Console\Generators\Endpoint;

use Dizzy\Trakt\Console\Generators\TemplateWriter;
use League\Flysystem\FilesystemInterface;

/**
 * Class Property
 * @package Dizzy\Trakt\Console\Generators\Endpoint
 */
class Property
{
    use TemplateWriter;

    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $fullClassPath;

    /**
     * @var string
     */
    private $template;

    /**
     * Property constructor.
     * @param FilesystemInterface $filesystem
     * @param string $fullClassPath
     */
    public function __construct(FilesystemInterface $filesystem, $fullClassPath)
    {
        $this->filesystem = $filesystem;
        $this->fullClassPath = collect(explode("\\", $fullClassPath));

        $this->template = $filesystem->read('/Console/stubs/endpoint/property.stub');
    }

    /**
     * Generate the property.
     * @return string
     */
    public function generate()
    {
        return $this->writePropertyType()
            ->writePropertyName()
            ->template;
    }

    /**
     * Write the property type in the template.
     * @return $this
     */
    private function writePropertyType()
    {
        return $this->writeInTemplate("property_type", $this->fullClassPath->implode("\\"));
    }

    /**
     * Write the property name in the template.
     * @return $this
     */
    private function writePropertyName()
    {
        return $this->writeInTemplate("property_name", lcfirst($this->fullClassPath->last()));
    }
}