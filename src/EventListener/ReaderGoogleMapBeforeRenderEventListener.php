<?php


namespace HeimrichHannot\GoogleChartsBundle\EventListener;


use CMEN\GoogleChartsBundle\GoogleCharts\Chart;
use Contao\System;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsConfigNotFound;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsNoChartConfigSet;
use HeimrichHannot\GoogleMapsBundle\Event\ReaderGoogleMapBeforeRenderEvent;


class ReaderGoogleMapBeforeRenderEventListener
{
    public function addElevationChartToItem(ReaderGoogleMapBeforeRenderEvent $event)
    {
        $item         = $event->getItem();
        $readerConfig = $event->getReaderConfigElement();

        if (!$readerConfig->displayElevation) {
            return;
        }

        if (!$readerConfig->chartConfig) {
            throw new GoogleChartsNoChartConfigSet('No chartConfig was set in readerConfig element ' . $readerConfig->title . ' [id=' . $readerConfig->id . ']');
        }

        $chartManager = System::getContainer()->get('huh.google_charts.manager.google_charts');

        if (null === ($chartConfig = $chartManager->getChartConfig($readerConfig->chartConfig))) {
            throw new GoogleChartsConfigNotFound('Chart configuration was not found for id ' . $readerConfig->chartConfig);
        }


        $chartConfig->dataEntity = $item->getRawValue('id');
        $chart                   = $chartManager->renderChart($chartConfig);

        $item->setFormattedValue('elevation', $chart);
    }

    /**
     * @param Chart $chart
     * @param $data
     */
    protected function setChartData(Chart $chart, $data)
    {
        $chart->getData()->setArrayToDataTable($data);
    }


    /**
     * @param Chart $chart
     * @param array $options
     */
    protected function setChartOptions(Chart $chart, array $options)
    {
        if (empty($options)) {
            return;
        }

        foreach ($options as $key => $option) {
            $method = 'set' . $key;
            $chart->getOptions()->{$method}($option);
        }
    }
}