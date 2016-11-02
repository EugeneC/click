<?php

namespace ClickBundle\Routing;

use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use AppKernel;

/**
 * Class AutoLoader
 */
class AutoLoader extends YamlFileLoader
{
    /**
     * @var AppKernel
     */
    protected $kernel;

    /**
     * @param FileLocatorInterface $locator
     * @param HttpKernelInterface  $kernel
     */
    public function __construct(FileLocatorInterface $locator, HttpKernelInterface $kernel)
    {
        parent::__construct($locator);
        $this->kernel = $kernel;
    }

    /**
     * @param string      $file
     * @param null|string $type
     *
     * @return RouteCollection
     * @throws \InvalidArgumentException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function load($file, $type = null)
    {
        $routes = new RouteCollection();
        foreach ($this->kernel->getBundles() as $bundle) {
            $path = $bundle->getPath() . '/Resources/config/routing.yml';
            if (is_file($path)) {
                $routes->addCollection(parent::load($path, $type));
            }
        }

        return $routes;
    }

    /**
     * @param string $resource
     * @param string $type
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function supports($resource, $type = null)
    {
        return 'route_auto' === $type;
    }
}