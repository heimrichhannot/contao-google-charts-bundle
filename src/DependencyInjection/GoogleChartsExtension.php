<?php

/*
 * Copyright (c) 2023 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\GoogleChartsBundle\DependencyInjection;

use HeimrichHannot\GoogleChartsBundle\EventListener\PrivacyCenterListener;
use HeimrichHannot\PrivacyCenterBundle\HeimrichHannotPrivacyCenterBundle;
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

        if (!class_exists(HeimrichHannotPrivacyCenterBundle::class)) {
            $container->removeDefinition(PrivacyCenterListener::class);
        }
    }
}
