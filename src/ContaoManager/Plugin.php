<?php

namespace HeimrichHannot\GoogleChartsBundle\ContaoManager;

use CMEN\GoogleChartsBundle\CMENGoogleChartsBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Contao\ManagerPlugin\Config\ContainerBuilder;
use Contao\ManagerPlugin\Config\ExtensionPluginInterface;
use HeimrichHannot\GoogleChartsBundle\ContaoGoogleChartsBundle;
use HeimrichHannot\UtilsBundle\Container\ContainerUtil;
use Symfony\Component\Config\Loader\LoaderInterface;

class Plugin implements BundlePluginInterface, ExtensionPluginInterface, ConfigPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        $loadAfter = [ContaoCoreBundle::class, CMENGoogleChartsBundle::class];

        if (class_exists('HeimrichHannot\ReaderBundle\HeimrichHannotContaoReaderBundle')) {
            $loadAfter[] = 'HeimrichHannot\ReaderBundle\HeimrichHannotContaoReaderBundle';
        }

        if (class_exists('HeimrichHannot\GoogleMapsBundle\HeimrichHannotContaoGoogleMapsBundle')) {
            $loadAfter[] = 'HeimrichHannot\GoogleMapsBundle\HeimrichHannotContaoGoogleMapsBundle';
        }

        return [
            BundleConfig::create(CMENGoogleChartsBundle::class),
            BundleConfig::create(ContaoGoogleChartsBundle::class)->setLoadAfter($loadAfter)
        ];
    }

    public function getExtensionConfig($extensionName, array $extensionConfigs, ContainerBuilder $container)
    {
        $extensionConfigs = ContainerUtil::mergeConfigFile(
            'huh_reader',
            $extensionName,
            $extensionConfigs,
            __DIR__ . '/../Resources/config/config_reader.yml'
        );

        return $extensionConfigs;
    }

    /**
     * Allows a plugin to load container configuration.
     */
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig)
    {
        $loader->load('@ContaoGoogleChartsBundle/Resources/config/config.yml');
        $loader->load('@ContaoGoogleChartsBundle/Resources/config/datacontainers.yml');
        $loader->load('@ContaoGoogleChartsBundle/Resources/config/services.yml');
    }
}