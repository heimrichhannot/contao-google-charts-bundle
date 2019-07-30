<?php


namespace HeimrichHannot\GoogleChartsBundle\Chart;


use CMEN\GoogleChartsBundle\GoogleCharts\Chart;
use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;

interface ChartInterface
{
    public function getChartType();


    public function initChart(GoogleChartsModel $config): void;

    /**
     * @param Chart $chart
     */
    public function setChart(Chart $chart): void;


    /**
     * @return Chart
     */
    public function getChart(): Chart;


    /**
     * @param GoogleChartsModel $config
     * @return array
     */
    public function getData(GoogleChartsModel $config): array;


    /**
     * @return GoogleChartsModel
     */
    public function getConfig(): GoogleChartsModel;


    /**
     * @param GoogleChartsModel $config
     */
    public function setConfig(GoogleChartsModel $config): void;


    /**
     * @param string $value
     * @return mixed
     */
    public function getConfigValue(string $value);
}