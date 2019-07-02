<?php


namespace HeimrichHannot\GoogleChartsBundle\Event;


use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;
use HeimrichHannot\ReaderBundle\Item\ItemInterface;
use HeimrichHannot\ReaderBundle\Model\ReaderConfigElementModel;
use Symfony\Component\EventDispatcher\Event;

class ReaderGoogleChartsBeforeAddToItemDataEvent extends Event
{
    const NAME = 'huh.google_charts.event.reader_google_charts_before_add_to_item_data';
    /**
     * @var ItemInterface
     */
    private $item;
    /**
     * @var ReaderConfigElementModel
     */
    private $readerConfigElement;
    /**
     * @var GoogleChartsModel
     */
    private $chartConfig;


    /**
     * ReaderGoogleChartsBeforeAddToItemDataEvent constructor.
     * @param ItemInterface $item
     * @param ReaderConfigElementModel $readerConfigElement
     * @param GoogleChartsModel $chartConfig
     */
    public function __construct(ItemInterface $item, ReaderConfigElementModel $readerConfigElement, GoogleChartsModel $chartConfig)
    {
        $this->item = $item;
        $this->readerConfigElement = $readerConfigElement;
        $this->chartConfig = $chartConfig;
    }

    /**
     * @return ItemInterface
     */
    public function getItem(): ItemInterface
    {
        return $this->item;
    }

    /**
     * @param ItemInterface $item
     */
    public function setItem(ItemInterface $item): void
    {
        $this->item = $item;
    }

    /**
     * @return ReaderConfigElementModel
     */
    public function getReaderConfigElement(): ReaderConfigElementModel
    {
        return $this->readerConfigElement;
    }

    /**
     * @param ReaderConfigElementModel $readerConfigElement
     */
    public function setReaderConfigElement(ReaderConfigElementModel $readerConfigElement): void
    {
        $this->readerConfigElement = $readerConfigElement;
    }

    /**
     * @return GoogleChartsModel
     */
    public function getChartConfig(): GoogleChartsModel
    {
        return $this->chartConfig;
    }

    /**
     * @param GoogleChartsModel $chartConfig
     */
    public function setChartConfig(GoogleChartsModel $chartConfig): void
    {
        $this->chartConfig = $chartConfig;
    }
}