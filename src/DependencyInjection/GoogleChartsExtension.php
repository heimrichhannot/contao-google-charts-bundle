<?php


namespace HeimrichHannot\GoogleChartsBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class GoogleChartsExtension extends Extension
{
    public function getAlias()
    {
        return 'huh_google_charts';
    }


    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration(true);
        $processedConfig = $this->processConfiguration($configuration, $configs);

        $container->setParameter('huh.google_charts', $processedConfig);
    }
}