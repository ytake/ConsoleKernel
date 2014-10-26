<?php
namespace Iono\Console\Application;

use Iono\Console\Container;
use Doctrine\Common\Annotations\FileCacheReader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Class Reader
 * @package Iono\Console\Application
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
class Reader
{

    /** @var AnnotationReader  */
    protected $reader;

    /** @var Container  */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->reader = new FileCacheReader(
            new AnnotationReader(),
            $container['component.config']->get('cache')['path'],
            true
        );
        //
        foreach($this->getDirectory(__DIR__ . '/Annotation') as $file) {
            AnnotationRegistry::registerFile($file);
        }
    }


    /**
     * @param string $className
     */
    public function scanner($className)
    {
        $reflectionClass = new \ReflectionClass($className);
        $annotations = $this->reader->getClassAnnotations($reflectionClass);
        if($annotations) {
            $class = new $className($this->container);
            $class->register();
        }
    }


    protected function getDirectory($dir)
    {
        $result = [];
        $scanDir = scandir($dir);
        foreach ($scanDir as $key => $value) {
            if (!in_array($value, [".",".."])) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = $this->getDirectory($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $dir . DIRECTORY_SEPARATOR . $value;
                }
            }
        }
        return $result;
    }
} 