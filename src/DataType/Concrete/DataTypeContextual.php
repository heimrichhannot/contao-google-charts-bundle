<?php


namespace HeimrichHannot\GoogleChartsBundle\DataType\Concrete;


use HeimrichHannot\GoogleChartsBundle\DataType\AbstractDataType;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsChartDataEmpty;

class DataTypeContextual extends AbstractDataType
{
    /**
     * @param $data
     * @throws GoogleChartsChartDataEmpty
     */
    public function setData($data): void {}
}