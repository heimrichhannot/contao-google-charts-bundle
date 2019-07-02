<?php


namespace HeimrichHannot\GoogleChartsBundle\Choice;


use Contao\System;
use HeimrichHannot\UtilsBundle\Choice\AbstractChoice;

class ChartTemplateChoice extends AbstractChoice
{
    /**
     * @return array
     */
    protected function collect()
    {
        $container = System::getContainer();
        $choices = [];
        $config = $container->getParameter('huh.google_charts');

        if (isset($config['templates']['chart_prefixes'])) {
            $choices = $container->get('huh.utils.choice.twig_template')->setContext($config['templates']['chart_prefixes'])->getCachedChoices();
        }

        asort($choices);

        return $choices;

    }
}