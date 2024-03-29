<?php


namespace HeimrichHannot\GoogleChartsBundle\Chart\Concrete;


use HeimrichHannot\GoogleChartsBundle\Chart\AbstractChart;
use HeimrichHannot\GoogleChartsBundle\DataContainer\GoogleChartsContainer;
use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;

class LineChart extends AbstractChart
{
    /**
     * @var \CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart
     */
    protected $chart;

    public function getChartType()
    {
        return GoogleChartsContainer::TYPE_LINE;
    }

    /**
     * @param GoogleChartsModel $config
     */
    public function initChart(GoogleChartsModel $config): void
    {
        $this->setChart(new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart());
        $this->setConfig($config);
        $this->setChartOptions($this->chart, $config);
    }

    /**
     * @param $chart
     * @param GoogleChartsModel $config
     */
    public function setChartOptions(&$chart, GoogleChartsModel $config): void
    {
        $this->chart->getOptions()
            ->setTitle($this->getConfigValue('title'))
            ->setCurveType($this->getConfigValue('curveType'))
            ->setLineWidth($this->getConfigValue('lineWidth'))
            ->setColors([html_entity_decode($this->getConfigValue('lineColor'))])
            ->getLegend()->setPosition('none');


        $this->chart->getOptions()->getHAxis()->getTitleTextStyle()->setItalic('false');
        $this->chart->getOptions()->getHAxis()->getTitleTextStyle()->setFontSize('14');
        $this->chart->getOptions()->getHAxis()->setTextPosition('none');
        $this->chart->getOptions()->getHAxis()->setTitle($config->labelX);
        $this->chart->getOptions()->getVAxis()->getTitleTextStyle()->setItalic('false');
        $this->chart->getOptions()->getVAxis()->getTitleTextStyle()->setFontSize('14');
        $this->chart->getOptions()->getVAxis()->setTitle($config->labelY);
    }
}