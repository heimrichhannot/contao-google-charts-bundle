<?php


namespace HeimrichHannot\GoogleChartsBundle\Manager;


use HeimrichHannot\GoogleChartsBundle\Charts\AbstractChart;
use HeimrichHannot\GoogleChartsBundle\DataTypes\AbstractDataType;
use HeimrichHannot\GoogleChartsBundle\Event\GoogleChartsModifyChartDataEvent;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsChartClassNotFound;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsConfigNotFound;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsDataTypeNotFound;
use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GoogleChartsManager
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $charts = [];

    /**
     * @var array
     */
    protected $dataTypes = [];


    /**
     * GoogleChartManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * add chart to registry
     *
     * @param AbstractChart $chart
     * @param string $className
     */
    public function addChart(AbstractChart $chart, string $className)
    {
        $this->charts[$this->getClassChoice($className)] = $chart;
    }


    /**
     * add dataType to registry
     *
     * @param AbstractDataType $dataType
     * @param string $className
     */
    public function addDataType(AbstractDataType $dataType, string $className)
    {
        $this->dataTypes[$this->getClassChoice($className)] = $dataType;
    }


    /**
     * @param int|GoogleChartsModel $config
     * @return string
     * @throws GoogleChartsChartClassNotFound
     * @throws GoogleChartsConfigNotFound
     * @throws GoogleChartsDataTypeNotFound
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function createChart($config)
    {
        if(is_int($config)) {
            $config = $this->getChartConfig($config);
        }

        if (!($config instanceof GoogleChartsModel)){
            throw new GoogleChartsConfigNotFound('Could not find google chart config for id ' . $config);
        } else {
            $configModel = $config;
        }

        if (!($chartClass = $this->getChartClassByConfig($configModel))) {
            throw new GoogleChartsChartClassNotFound('No chart class found for type ' . $configModel->type);
        }

        if (!($dataType = $this->getDataTypeByConfig($configModel))) {
            throw new GoogleChartsDataTypeNotFound('No data Type found for config ' . $configModel->id);
        }


        /**
         * @var AbstractChart $chart
         */
        $chart = $this->generateChart($chartClass, $dataType, $configModel);

        return $this->container->get('huh.utils.template')->renderTwigTemplate($configModel->chartTemplate, [
            'chart' => $chart->getChart(),
            'selector' => $this->getChartSelector($configModel)
        ]);
    }


    public function generateChart(AbstractChart $chart, AbstractDataType $dataType, GoogleChartsModel $config)
    {
        $chart->createChart($config);
        $dataType->createDataType($config);

        $event = $this->container->get('event_dispatcher')->dispatch(GoogleChartsModifyChartDataEvent::NAME, new GoogleChartsModifyChartDataEvent($config, $dataType->getData()));

        $chart->setChartData($chart->getChart(), $event->getData());

        return $chart;
    }


    /**
     * @param int $id
     * @return null|GoogleChartsModel
     */
    public function getChartConfig(int $id)
    {
        return $this->container->get('contao.framework')->getAdapter(GoogleChartsModel::class)->findByPk($id);
    }


    /**
     * @param GoogleChartsModel $config
     * @return bool|AbstractChart
     */
    public function getChartClassByConfig(GoogleChartsModel $config)
    {
        if (!$config->chartClass) {
            return false;
        }

        $chartClasses = $this->getCharts();

        if (array_key_exists($config->chartClass, $chartClasses)) {
            return $chartClasses[$config->chartClass];
        }

        return false;
    }


    /**
     * @param GoogleChartsModel $config
     * @return bool|AbstractDataType
     */
    public function getDataTypeByConfig(GoogleChartsModel $config)
    {
        if (!$config->dataType) {
            return false;
        }

        $dataTypes = $this->getDataTypes();

        if (array_key_exists($config->dataType, $dataTypes)) {
            return $dataTypes[$config->dataType];
        }

        return false;
    }


    /**
     * @param string $type
     * @return array
     */
    public function getChartClassesByType(string $type): array
    {
        $classes = [];

        foreach ($this->getCharts() as $name => $chart) {
            if ($type != $chart->getChartType()) {
                continue;
            }

            $classes[$this->getClassChoice($name)] = $name;
        }

        return $classes;
    }


    /**
     * @return array
     */
    public function getDataTypeClasses(): array
    {
        $dataTypes = [];

        foreach ($this->getDataTypes() as $name => $dataType) {
            $dataTypes[$this->getClassChoice($name)] = $name;
        }

        return $dataTypes;
    }


    /**
     * @param GoogleChartsModel $config
     * @return string
     */
    public function getChartSelector(GoogleChartsModel $config): string
    {
        return 'huh_google_charts_' . substr(md5(microtime()), rand(0, 26), 5);
    }


    /**
     * @return array
     */
    public function getCharts(): array
    {
        return $this->charts;
    }


    /**
     * @return array
     */
    public function getDataTypes(): array
    {
        return $this->dataTypes;
    }


    public function getClassChoice(string $class): string
    {
        return str_replace('\\', '_', $class);
    }

}

