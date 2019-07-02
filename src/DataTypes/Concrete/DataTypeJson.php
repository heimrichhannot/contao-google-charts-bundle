<?php


namespace HeimrichHannot\GoogleChartsBundle\DataTypes\Concrete;


use Contao\StringUtil;
use HeimrichHannot\GoogleChartsBundle\DataTypes\AbstractDataType;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsChartDataEmpty;
use HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel;

class DataTypeJson extends AbstractDataType
{
    /**
     * @param $data
     * @throws GoogleChartsChartDataEmpty
     */
    public function setData($data): void
    {
        if(null === ($config = $this->getConfig())) {
            $this->data = [];
            return;
        }

        if(null === ($data = json_decode($config->data))) {
            $data = StringUtil::deserialize($config->data, true)[0];
        }

        if(empty($data)) {
            throw new GoogleChartsChartDataEmpty('Chart data is empty for chart config ' . $config->id);
        }

        array_unshift($data, [$config->labelX, $config->labelY]);

        $this->data = $data;
    }
}