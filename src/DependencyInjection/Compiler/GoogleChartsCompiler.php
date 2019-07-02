<?php


namespace HeimrichHannot\GoogleChartsBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class GoogleChartsCompiler implements CompilerPassInterface
{
    const COMPILER_METHOD_CHART    = 'addChart';
    const COMPILER_METHOD_DATATYPE = 'addDataType';


    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('huh.google_charts.manager.google_charts')) {
            return;
        }

        $def = $container->findDefinition('huh.google_charts.manager.google_charts');

        /**
         * get chart classes
         */
        $taggedServices = $container->findTaggedServiceIds('huh.google_charts.chart');
        $this->addTaggedServices($def, $taggedServices, static::COMPILER_METHOD_CHART);

        /**
         * get data type classes
         */
        $taggedServices = $container->findTaggedServiceIds('huh.google_charts.data_type');
        $this->addTaggedServices($def, $taggedServices, static::COMPILER_METHOD_DATATYPE);
    }

    /**
     * @param Definition $definition
     * @param array $services
     * @param string $method
     */
    protected function addTaggedServices(Definition $definition, array $services, string $method)
    {
        foreach ($services as $id => $tags) {
            $definition->addMethodCall($method, [new Reference($id), $id]);
        }
    }
}