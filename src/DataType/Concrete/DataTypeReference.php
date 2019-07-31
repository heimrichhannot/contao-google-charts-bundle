<?php


namespace HeimrichHannot\GoogleChartsBundle\DataType\Concrete;


use Contao\Validator;
use HeimrichHannot\GoogleChartsBundle\DataType\AbstractDataType;
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

        $referenceData = $reference->{$field};

        // files
        if (Validator::isUuid($referenceData))
        {
            $referenceData = $this->container->get('huh.utils.file')->getFileContentFromUuid($referenceData);
        }

        if(!is_array($referenceData)) {
            $referenceData = [$referenceData];
        }

        array_unshift($referenceData, [$config->labelX, $config->labelY]);

        $this->data = $data;
    }
}