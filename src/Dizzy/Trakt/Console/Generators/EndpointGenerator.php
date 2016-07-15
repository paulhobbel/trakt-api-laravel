<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 20:24
 */

namespace Dizzy\Trakt\Console\Generators;


use Dizzy\Trakt\Api\AbstractEndpoint;
use Dizzy\Trakt\Console\Generators\Endpoint\Method;
use Dizzy\Trakt\Console\Generators\Endpoint\Property;
use Dizzy\Trakt\Exceptions\ClassCanNotBeImplementedAsEndpointException;
use Dizzy\Trakt\Request\AbstractRequest;
use Illuminate\Support\Collection;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use ReflectionClass;

/**
 * Class EndpointGenerator
 * @package Dizzy\Trakt\Console\Generators
 */
class EndpointGenerator
{
    use TemplateWriter;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var QuestionHelper
     */
    private $questionHelper;

    /**
     * @var bool
     */
    private $force;

    /**
     * @var bool
     */
    private $delete;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $apiNamespace = "Dizzy\\Trakt\\Api";
    /**
     * @var string
     */
    private $requestsNamespace = "Dizzy\\Trakt\\Request\\";

    /**
     * @var Collection
     */
    private $endpoint;

    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $className;

    /**
     * @var Collection
     */
    private $uses;

    /**
     * EndpointGenerator constructor.
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param QuestionHelper $questionHelper
     * @param bool $force
     * @param bool $delete
     */
    public function __construct(
        InputInterface $input,
        OutputInterface $output,
        QuestionHelper $questionHelper,
        $force = false,
        $delete = false)
    {
        $this->input = $input;
        $this->output = $output;
        $this->questionHelper = $questionHelper;
        $this->force = $force;
        $this->delete = $delete;

        $this->filesystem = new Filesystem(new Local(__DIR__."/../.."));
    }

    /**
     * Generate all endpoints.
     */
    public function generateAllEndpoints()
    {
        $this->handleOptions();
        foreach ($this->filesystem->listContents("/Request") as $content) {
            if ($content['type'] === 'dir'
                && $content['basename'] !== "Exception"
                && $content['basename'] !== "Parameters"
            ) {
                $this->generateForEndpoint($content['basename']);
            }
        }
    }

    /**
     * Generate a single endpoint.
     * @param $endpoint
     * @return $this
     */
    public function generateForEndpoint($endpoint)
    {
        $this->template = $this->filesystem->read("/Console/stubs/endpoint.stub");
        $this->endpoint = $this->createEndpoint($endpoint);

        $this->file = "/Api/" . $this->endpoint->implode('/') . '.php';

        $this->className = $this->apiNamespace . '\\' . $this->endpoint->implode('\\');

        $this->uses = new Collection();

        if ($this->filesystem->has($this->file)) {
            if ($this->userWantsToOverwrite()) {
                $this->filesystem->delete($this->file);
                return $this->createContent()->writeToFile();
            } else {
                return $this->output->writeln("Not overwriting " . $this->file);
            }
        }
        return $this->createContent()->writeToFile();
    }

    /**
     * Create an endpoint collection.
     * @param $endpoint
     * @return Collection
     */
    private function createEndpoint($endpoint)
    {
        return collect(explode('/', $endpoint))->map(
            function ($endpoint) {
                return ucfirst($endpoint);
            }
        );
    }

    /**
     * Generate all content into the template.
     * @return $this
     */
    private function createContent()
    {
        $this->output->writeln("Generating class for API endpoint: " . $this->endpoint->implode("\\"));
        $this->writeNamespace()
            ->writeClassName()
            ->writeMethods()
            ->writeUseStatements()
            ->deleteUnusedPlaceholders();
        $this->output->writeln("Deleted unused placeholders in template");
        return $this;
    }

    /**
     * Write the endpoint file.
     * @return $this
     */
    private function writeToFile()
    {
        $this->filesystem->write($this->file, $this->template);
        $this->output->writeln(
            "Written endpoint wrapper to: " . $this->filesystem->get($this->file)->getPath()
        );
        $this->output->writeln("Class " . $this->className . " is generated");
        return $this;
    }

    /**
     * Write the namespace in the template.
     * @return $this
     */
    private function writeNamespace()
    {
        $parts = clone $this->endpoint;
        $parts->pop();
        $namespace = ($this->endpoint->count() === 1) ? $this->apiNamespace : $this->apiNamespace . '\\' .
            $parts->implode("\\");
        return $this->writeInTemplate("namespace", $namespace);
    }

    /**
     * Write the class name in the template.
     * @return $this
     */
    private function writeClassName()
    {
        return $this->writeInTemplate("class_name", $this->endpoint->last());
    }

    /**
     * Write the methods in the template.
     * @return $this
     */
    private function writeMethods()
    {
        $methods = new Collection();
        $properties = new Collection();
        foreach ($this->getRequestFolderContents() as $content) {
            try {
                if ($content['type'] === 'file') {
                    $this->handleFile($content, $methods);
                }
                if ($content['type'] === 'dir') {
                    $this->handleDirectory($properties, $content);
                }
            } catch (ClassCanNotBeImplementedAsEndpointException $exception) {
                continue;
            }
        };
        $this->output->writeln("Adding generated methods to template");
        return $this->writeInTemplate("methods", $methods->implode("\n\n\t"))->writeProperties($properties);
    }

    /**
     * Write use statements in the template.
     * @return $this
     */
    private function writeUseStatements()
    {
        if ($this->endpoint->count() > 1) {
            $this->uses->push(new ReflectionClass(AbstractEndpoint::class));
        }
        $aliases = $this->uses->unique()->map(
            function (ReflectionClass $useStatement) {
                $parent = $useStatement->getParentClass();
                if ($parent !== false && $parent->getName() === AbstractRequest::class) {
                    return $useStatement->getName() . " as " . $useStatement->getShortName() . "Request";
                } else {
                    return $useStatement->getName();
                }
            }
        );
        if ($aliases->count() > 0) {
            $uses = $aliases->implode(";\nuse ");
            $this->output->writeln(
                "Adding use statements to template"
            );
            return $this->writeInTemplate("use_statements", "use " . $uses . ";");
        }
        return $this;
    }

    /**
     * Write all properties in the template.
     * @param Collection $properties
     * @return $this
     */
    private function writeProperties(Collection $properties)
    {
        $formatted = new Collection();
        $properties->each(
            function ($property) use ($formatted) {
                $generator = new Property(
                    $this->filesystem,
                    $this->apiNamespace . "\\" . $this->endpoint->implode("\\") . "\\" . $property
                );
                $formatted->push($generator->generate());
            }
        );
        return $this->writeInTemplate('public_properties', "\n" . $formatted->implode("\n\n"));
    }

    /**
     * @return Collection
     */
    private function getRequestFolderContents()
    {
        return collect($this->filesystem->listContents("/Request/" . $this->endpoint->implode("/")));
    }

    /**
     * Handles given options
     */
    private function handleOptions()
    {
        if ($this->delete) {
            $this->getItemsToDelete()->each(
                function ($item) {
                    if ($item['type'] === 'dir') {
                        dump($item);
                        $this->filesystem->deleteDir($item['path']);
                        return true;
                    }
                    $this->filesystem->delete($item['path']);
                    return true;
                }
            );
        }
    }

    /**
     * @param $content
     * @param $methods
     * @return Collection|Method[]
     * @throws ClassCanNotBeImplementedAsEndpointException
     */
    private function handleFile($content, Collection $methods)
    {
        $method = $this->createMethod($this->endpoint, $content);
        $methods->push($method->generate());
        $this->output->writeln("Generated method for: '" . $method->getName() . "'");
        $this->updateUsages($method);
        if ($method->getName() === "summary") {
            $methods->push($this->createMethod($this->endpoint, $content, 'get')->generate());
            $this->output->writeln("Generated alias method get for summary");
        }
        return $methods;
    }

    /**
     * @param $properties
     * @param $content
     */
    private function handleDirectory(Collection $properties, $content)
    {
        $properties->push($content['filename']);
        $this->filesystem->createDir('Api/' . $this->endpoint->first());
        $generator = new EndpointGenerator($this->input, $this->output, $this->questionHelper);
        $endpoint = str_replace("Request/", "", $content['path']);
        $generator->generateForEndpoint($endpoint);
    }

    /**
     * @param $className
     * @param $file
     * @param null $methodName
     * @return Method
     * @throws ClassCanNotBeImplementedAsEndpointException
     */
    private function createMethod(Collection $className, $file, $methodName = null)
    {
        $reflection = new ReflectionClass(
            $this->requestsNamespace . $className->implode("\\") . "\\" .
            $file['filename']
        );
        if ($reflection->isTrait() || $reflection->isAbstract())
            throw new ClassCanNotBeImplementedAsEndpointException;
        return new Method($reflection, $this->filesystem, $methodName);
    }

    /**
     * @param $method
     */
    private function updateUsages(Method $method)
    {
        $this->uses = $this->uses->merge($method->getUses())->push($method->getRequestClass());
    }

    /**
     * Check if the user wants to overwrite the file.
     * @return string
     */
    private function userWantsToOverwrite()
    {
        if($this->force) return true;

        $question = new Question("Class " . $this->className . " already exist, do you want to overwrite it? (y/N) ", false);
        return $this->questionHelper->ask(
            $this->input,
            $this->output,
            $question
        );
    }

    /**
     * @return Collection
     */
    private function getItemsToDelete()
    {
        return collect($this->filesystem->listContents("/Api"))->filter(
            function ($content) {
                if ($content['filename'] === "AbstractEndpoint") {
                    return false;
                };
                return true;
            }
        );
    }
}