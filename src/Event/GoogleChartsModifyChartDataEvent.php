<?php


namespace HeimrichHannot\GoogleChartsBundle\Event;


use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;
use Symfony\Contracts\EventDispatcher\Event;

class GoogleChartsModifyChartDataEvent extends Event
{
    const NAME = 'huh.google_charts.event.modify_chart_data_event';

    /**
     * @var GoogleChartsModel
     */
    protected $config;


    /**
     * @var array
     */
    protected $data;


    /**
     * GoogleChartsModifyChartDataEvent constructor.
     * @param GoogleChartsModel $config
     * @param array $data
     */
    public function __construct(GoogleChartsModel $config, array $data)
    {
        $this->config = $config;
        $this->data   = $data;
    }

    /**
     * @param $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @param GoogleChartsModel $config
     */
    public function setConfig(GoogleChartsModel $config): void
    {
        $this->config = $config;
    }

    /**
     * @return GoogleChartsModel
     */
    public function getConfig(): GoogleChartsModel
    {
        return $this->config;
    }
}