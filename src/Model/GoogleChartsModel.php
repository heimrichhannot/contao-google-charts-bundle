<?php


namespace HeimrichHannot\GoogleChartsBundle\Model;


use Contao\Model;


/**
 * Class GoogleChartsModel
 * @package HeimrichHannot\GoogleChartsBundle\Model
 *
 * @property string $title
 * @property string $type
 * @property int $lineWidth
 * @property string $curveType
 * @property string $data
 */
class GoogleChartsModel extends Model
{
    static $strTable = 'tl_google_chart';
}