<?php


namespace HeimrichHannot\GoogleChartsBundle\Chart;


use CMEN\GoogleChartsBundle\GoogleCharts\Chart;
use Contao\StringUtil;
use HeimrichHannot\GoogleChartsBundle\DataContainer\GoogleChartsContainer;
use HeimrichHannot\GoogleChartsBundle\Event\GoogleChartsModifyChartDataEvent;
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
     * @var array
     */
    protected $eventListeners = [];


    /**
     * AbstractChart constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public abstract function initChart(GoogleChartsModel $config): void;

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

        $event = $this->container->get('event_dispatcher')->dispatch(
            new GoogleChartsModifyChartDataEvent($config, $data),
            GoogleChartsModifyChartDataEvent::NAME
        );

        return $event->getData();
    }

    /**
     * @return array
     */
    public function getEventListeners(): array
    {
        return $this->eventListeners;
    }

    /**
     * @param array $eventListeners
     */
    public function setEventListeners(array $eventListeners): void
    {
        $this->eventListeners = $eventListeners;
    }

    /**
     * @param string $eventName
     * @param string $jsCode
     */
    public function addEventListener(string $eventName, string $jsCode)
    {
        $this->eventListeners[$eventName][] = $jsCode;
    }
}