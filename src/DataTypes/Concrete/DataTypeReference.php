<?php


namespace HeimrichHannot\GoogleChartsBundle\DataTypes\Concrete;


use HeimrichHannot\GoogleChartsBundle\DataTypes\AbstractDataType;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsNoReferenceEntitySetInChartConfig;
use HeimrichHannot\GoogleChartsBundle\Exception\GoogleChartsReferenceEntityNotFound;

class DataTypeReference extends AbstractDataType
{
    /**
     * @param mixed $data
     * @throws GoogleChartsNoReferenceEntitySetInChartConfig
     * @throws GoogleChartsReferenceEntityNotFound
     */
    public function setData($data): void
    {
        if(null === ($config = $this->getConfig())) {
            $this->data = [];
            return;
        }

        if(!$config->dataEntity) {
            throw new GoogleChartsNoReferenceEntitySetInChartConfig('There was no reference entity set in chart config ' . $config->id);
        }

        $table  = $config->dataContainer;
        $field  = $config->dataField;
        $entity = $config->dataEntity;

        if(null === ($reference = $this->container->get('huh.utils.model')->findModelInstanceByPk($table, $entity))) {
            throw new GoogleChartsReferenceEntityNotFound('The referenced entity [' . $entity . '] in table ' . $table . ' could not be found');
        }

        if(!isset($reference->{$field})) {
            return;
        }

        if(!is_array($referenceData = $reference->{$field})) {
            $referenceData = [$referenceData];
        }

        array_unshift($data, [$config->labelX, $config->labelY]);


        $this->data = $data;
    }
}