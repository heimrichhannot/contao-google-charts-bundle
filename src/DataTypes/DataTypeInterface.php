<?php


namespace HeimrichHannot\GoogleChartsBundle\DataTypes;


use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;

interface DataTypeInterface
{
    public function createDataType(GoogleChartsModel $config): void;

    public function getData();

    public function setData($data): void;

    public function getConfig(): GoogleChartsModel;

    public function setConfig(GoogleChartsModel $config): void;

}