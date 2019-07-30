<?php

$dca = &$GLOBALS['TL_DCA']['tl_module'];

/**
 * Palettes
 */
$dca['palettes'][\HeimrichHannot\GoogleChartsBundle\Module\ModuleGoogleCharts::TYPE] = '{title_legend},name,headline,type;'
                                                                                        . '{config_legend},googleChartsConfig;'
                                                                                        . '{template_legend:hide},customTpl;'
                                                                                        . '{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

/**
 * Fields
 */
$dca['fields']['googleChartsConfig'] = [
    'label'      => &$GLOBALS['TL_LANG']['tl_module']['googleChartsConfig'],
    'exclude'    => true,
    'filter'     => true,
    'inputType'  => 'select',
    'foreignKey' => 'tl_google_chart.title',
    'eval'       => ['tl_class' => 'long clr', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
    'sql'        => "int(10) unsigned NOT NULL default '0'"
];
