<?php


namespace HeimrichHannot\GoogleChartsBundle\ConfigElementType;


use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\System;
use HeimrichHannot\GoogleChartsBundle\DataType\Concrete\DataTypeReference;
use HeimrichHannot\GoogleChartsBundle\Event\ReaderGoogleChartsBeforeAddToItemDataEvent;
use HeimrichHannot\ReaderBundle\ConfigElementType\ConfigElementType;
use HeimrichHannot\ReaderBundle\Item\ItemInterface;
use HeimrichHannot\ReaderBundle\Model\ReaderConfigElementModel;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GoogleChartsReaderConfigElementType implements ConfigElementType
{
    const TYPE = 'google_charts';

    /**
     * @var ContaoFrameworkInterface
     */
    protected $framework;


    protected $twig;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * @var ContainerInterface
     *
     */
    protected $container;

    /**
     * GoogleChartsReaderConfigElementType constructor.
     * @param ContaoFrameworkInterface $framework
     */
    public function __construct(ContaoFrameworkInterface $framework)
    {
        $this->framework  = $framework;
        $this->container  = System::getContainer();
        $this->twig       = $this->container->get('twig');
        $this->dispatcher = $this->container->get('event_dispatcher');
    }

    /**
     * @param ItemInterface $item
     * @param ReaderConfigElementModel $readerConfigElement
     */
    public function addToItemData(ItemInterface $item, ReaderConfigElementModel $readerConfigElement)
    {
        if(!$readerConfigElement->chartConfig) {
            return;
        }

        $manager = $this->container->get('huh.google_charts.manager.google_charts');

        if(null === ($chartConfig = $manager->getChartConfig($readerConfigElement->chartConfig))) {
            return;
        }

        if($manager->getClassChoice(DataTypeReference::class) == $chartConfig->dataType) {
            $chartConfig->dataEntity = $item->getRawValue('id');
        }

        $event = $this->dispatcher->dispatch(ReaderGoogleChartsBeforeAddToItemDataEvent::NAME, new ReaderGoogleChartsBeforeAddToItemDataEvent($item, $readerConfigElement, $chartConfig));
        $chart = $this->container->get('huh.google_charts.manager.google_charts')->renderChart($event->getChartConfig());

        $item->setFormattedValue('googleChart', $chart);
    }
}