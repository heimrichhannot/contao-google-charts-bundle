<?php


namespace HeimrichHannot\GoogleChartsBundle\Charts;


use CMEN\GoogleChartsBundle\GoogleCharts\Chart;
use Contao\StringUtil;
use HeimrichHannot\GoogleChartsBundle\DataContainer\GoogleChartsContainer;
use HeimrichHannot\GoogleChartsBundle\Event\GoogleChartsModifyChartDataEvent;
use HeimrichHannot\GoogleChartsBundle\Event\GoogleChartsModifyDataEvent;
use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractChart implements ChartInterface
{
    /**
     * @var GoogleChartsModel
     */
    protected $config;


    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Chart
     */
    protected $chart;


    /**
     * AbstractChart constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public abstract function createChart(GoogleChartsModel $config): void;

    public abstract function setChartOptions(&$chart, GoogleChartsModel $config): void;


    /**
     * @param Chart $chart
     * @param array $data
     */
    public function setChartData(Chart $chart, array $data): void
    {
        $chart->getData()->setArrayToDataTable($data);
    }


    /**
     * @return GoogleChartsModel
     */
    public function getConfig(): GoogleChartsModel
    {
        return $this->config;
    }


    /**
     * @param GoogleChartsModel $options
     */
    public function setConfig(GoogleChartsModel $config): void
    {
        $this->config = $config;
    }


    /**
     * @param string $value
     * @return mixed|null
     */
    public function getConfigValue(string $value)
    {
        return $this->getConfig()->{$value};
    }

    /**
     * @param Chart $chart
     */
    public function setChart(Chart $chart): void
    {
        $this->chart = $chart;
    }

    /**
     * @return Chart|mixed
     */
    public function getChart(): Chart
    {
        return $this->chart;
    }

    /**
     * @param GoogleChartsModel $config
     * @return array
     */
    public function getData(GoogleChartsModel $config): array
    {
        $data = [];

        if (GoogleChartsContainer::DATA_TYPE_JSON == $config->dataType) {
            $data = json_decode(StringUtil::deserialize($config->data, true)[0]);
        }

        $event = $this->container->get('event_dispatcher')->dispatch(GoogleChartsModifyChartDataEvent::NAME,
            new GoogleChartsModifyChartDataEvent($config, $data));

        return $event->getData();
    }
}