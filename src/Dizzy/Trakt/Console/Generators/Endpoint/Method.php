<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 20:42
 */

namespace Dizzy\Trakt\Console\Generators\Endpoint;


use Dizzy\Trakt\Console\Generators\TemplateWriter;
use Illuminate\Support\Collection;
use League\Flysystem\FilesystemInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Class Method
 * @package Dizzy\Trakt\Console\Generators\Endpoint
 */
class Method
{
    use TemplateWriter;

    /**
     * @var ReflectionClass
     */
    private $reflection;

    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var null
     */
    private $name;

    /**
     * @var Collection
     */
    private $classParameters;

    /**
     * @var Collection
     */
    private $methodParameters;

    /**
     * @var Collection
     */
    private $requestParameters;

    /**
     * @var Collection
     */
    private $uses;

    /**
     * Method constructor.
     * @param ReflectionClass $reflection
     * @param FilesystemInterface $filesystem
     * @param string|null $name
     */
    public function __construct(ReflectionClass $reflection, FilesystemInterface $filesystem, $name = null)
    {
        $this->reflection = $reflection;
        $this->filesystem = $filesystem;
        $this->name = $name;

        $this->template = $filesystem->read("/Console/stubs/endpoint/method.stub");

        $this->classParameters = $this->getClassParameters();
        $this->methodParameters = $this->getMethodParameters();
        $this->requestParameters = $this->getRequestParameters();

        $this->uses = $this->getUsages();
    }

    /**
     * Generate the method.
     * @return string
     */
    public function generate()
    {
        return $this->writeMethodName()
            ->writeMethodParameters()
            ->writeRequestClass()
            ->writeRequestParameters()
            ->template;
    }

    /**
     * Write the method name in the template.
     * @return $this
     */
    private function writeMethodName()
    {
        return $this->writeInTemplate("method_name", $this->getName());
    }

    /**
     * Write the method parameters in the template.
     * @return $this
     */
    private function writeMethodParameters()
    {
        $parameters = $this->methodParameters->implode(", ");
        return $this->writeInTemplate("method_parameters", $parameters);
    }

    /**
     * Write the request class into the template.
     * @return $this
     */
    private function writeRequestClass()
    {
        return $this->writeInTemplate("request_class", $this->reflection->getShortName() . "Request");
    }

    /**
     * Write the request parameters into the template
     * @return $this
     */
    private function writeRequestParameters()
    {
        $parameters = $this->requestParameters->implode(", ");
        return $this->writeInTemplate("request_parameters", $parameters);
    }

    /**
     * Generates a collection with the constructor parameters.
     * @return Collection
     */
    private function getClassParameters()
    {
        $parameters = new Collection();
        $constructor = $this->reflection->getConstructor();
        if ($constructor !== null)
        {
            foreach ($constructor->getParameters() as $parameter) {
                $parameters->push($parameter);
            }
        }
        return $parameters;
    }

    /**
     * Generates a collection with the method parameters.
     * @return Collection
     */
    private function getMethodParameters()
    {
        $parameters = new Collection();
        foreach ($this->classParameters as $parameter) {
            $className = null;
            if ($parameterClass = $parameter->getClass()) {
                $className = $parameterClass->getShortName();
            }
            $parameterString = ($className !== null) ? $className . " $" . $parameter->getName() : " $"
                . $parameter->getName();
            try {
                if ($parameter->isArray()) {
                    $parameterString = "array" . $parameterString;
                }
                if ($parameter->isDefaultValueAvailable()) {
                    $parameterString .= " = " . json_encode($parameter->getDefaultValue());
                }
            } catch (ReflectionException $exception) {
                $parameters->push(trim($parameterString));
                continue;
            }
            $parameters->push(trim($parameterString));
        }
        return $parameters;
    }

    /**
     * Generates a collection with the request parameters.
     * @return Collection
     */
    private function getRequestParameters()
    {
        $parameters = new Collection();
        foreach ($this->classParameters as $parameter) {
            $parameters->push("$" . $parameter->getName());
        }
        return $parameters;
    }

    /**
     * Generates a collection with the used classes in the class.
     * @return Collection
     */
    private function getUsages()
    {
        $uses = new Collection();
        foreach ($this->classParameters as $parameter) {
            if ($class = $parameter->getClass()) {
                $uses->push($class);
            }
        }
        return $uses;
    }

    /**
     * Gets the name of the method.
     * @return null|string
     */
    public function getName()
    {
        return ($this->name === null) ? lcfirst($this->reflection->getShortName()) : $this->name;
    }

    /**
     * Returns a instance of the reflection class.
     * @return ReflectionClass
     */
    public function getRequestClass()
    {
        return $this->reflection;
    }

    /**
     * Returns the used classes in this method.
     * @return Collection
     */
    public function getUses()
    {
        return $this->uses;
    }
}