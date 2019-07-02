<?php


namespace HeimrichHannot\GoogleChartsBundle\DataTypes;


use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractDataType implements DataTypeInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var GoogleChartsModel
     */
    protected $config;

    protected $data;

    /**
     * AbstractDataType constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param GoogleChartsModel $config
     */
    public function createDataType(GoogleChartsModel $config): void
    {
        $this->setConfig($config);
        $this->setData($config->data);
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
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