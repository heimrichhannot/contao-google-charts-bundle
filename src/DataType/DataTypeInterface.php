<?php


namespace HeimrichHannot\GoogleChartsBundle\DataType;


use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;

interface DataTypeInterface
{
    public function initDataType(GoogleChartsModel $config): void;

    public function getData();

    public function setData($data): void;

    public function getConfig(): GoogleChartsModel;

    public function setConfig(GoogleChartsModel $config): void;

}