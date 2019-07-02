<?php

/**
 * Model
 */
$GLOBALS['TL_MODELS']['tl_google_charts']         = 'HeimrichHannot\GoogleChartsBundle\Model\GoogleChartsModel';


/**
 * Frontend modules
 */
array_insert(
    $GLOBALS['FE_MOD']['miscellaneous'],
    3,
    [
        \HeimrichHannot\GoogleChartsBundle\Module\ModuleGoogleCharts::TYPE => \HeimrichHannot\GoogleChartsBundle\Module\ModuleGoogleCharts::class,
    ]
);

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['google_charts'] = [
    'tables' => ['tl_google_charts'],
    'icon'   => 'system/modules/google_charts_bundle/assets/img/icon_google_charts.png'
];