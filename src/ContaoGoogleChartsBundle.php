<?php

namespace HeimrichHannot\GoogleChartsBundle;

use HeimrichHannot\GoogleChartsBundle\DependencyInjection\Compiler\GoogleChartsCompiler;
use HeimrichHannot\GoogleChartsBundle\DependencyInjection\GoogleChartsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoGoogleChartsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new GoogleChartsCompiler());
    }

    public function getContainerExtension()
    {
        return new GoogleChartsExtension();
    }
}