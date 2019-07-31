<?php


namespace HeimrichHannot\GoogleChartsBundle\DataContainer;


use Contao\DataContainer;
use Contao\System;
use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;
use HeimrichHannot\GoogleChartsBundle\Manager\GoogleChartsManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GoogleChartsContainer
{
    const TYPE_LINE = 'line';

    const CURVE_TYPE_NONE     = 'none';
    const CURVE_TYPE_FUNCTION = 'function';

    const CURVE_TYPES = [
        self::CURVE_TYPE_NONE,
        self::CURVE_TYPE_FUNCTION
    ];

    const DATA_TYPE_JSON       = 'json';
    const DATA_TYPE_REFERENCE  = 'reference';
    const DATA_TYPE_CONTEXTUAL = 'contextual';

    const DATA_TYPES = [
        self::DATA_TYPE_JSON,
        self::DATA_TYPE_REFERENCE,
        self::DATA_TYPE_CONTEXTUAL
    ];

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var GoogleChartsManager
     */
    protected $manager;

    public function __construct(ContainerInterface $container, GoogleChartsManager $manager)
    {
        $this->container = $container;
        $this->manager   = $manager;
    }


    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getChartTypes(DataContainer $dc): array
    {
        return [
            static::TYPE_LINE
        ];
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getChartClasses(DataContainer $dc)
    {
        return $this->manager->getChartClassesByType($dc->activeRecord->type);
    }


    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getDataTypeClasses(DataContainer $dc)
    {
        return $this->manager->getDataTypeClasses();
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getCurveTypes(DataContainer $dc): array
    {
        return static::CURVE_TYPES;
    }

    /**
     * @param DataContainer $dc
     * @return array|null
     */
    public function getAllGoogleChartConfigs(DataContainer $dc)
    {
        if (null === ($configs = System::getContainer()->get('contao.framework')->getAdapter(GoogleChartsModel::class)->findAll())) {
            return null;
        }

        return $configs->fetchEach('name');
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getDataTypes(DataContainer $dc): array
    {
        return static::DATA_TYPES;
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getFields(DataContainer $dc)
    {
        if (!$dc->activeRecord->dataContainer) {
            return [];
        }

        return $this->container->get('huh.utils.dca')->getFields($dc->activeRecord->dataContainer);
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getEntities(DataContainer $dc)
    {
        if (!$dc->activeRecord->dataContainer) {
            return [];
        }

        if (null === ($entities = $this->container->get('huh.utils.model')->findAllModelInstances($dc->activeRecord->dataContainer))) {
            return [];
        }

        return $entities->fetchEach('headline');
    }
}