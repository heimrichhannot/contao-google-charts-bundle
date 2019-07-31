<?php

$dca = &$GLOBALS['TL_DCA']['tl_reader_config_element'];

/**
 * Fields
 */
if (\Contao\System::getContainer()->get('huh.utils.container')->isBundleActive('HeimrichHannot\ReaderBundle\HeimrichHannotContaoReaderBundle')) {
    /**
     * Palettes
     */
    $dca['palettes'][\HeimrichHannot\GoogleChartsBundle\ConfigElementType\GoogleChartsReaderConfigElementType::TYPE] =
        '{title_type_legend},title,type;{config_legend},name,chartConfig;';

    /**
     * Fields
     */
    $fields = [
        'chartConfig'      => [
            'label'            => &$GLOBALS['TL_LANG']['tl_reader_config_element']['chartConfig'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'foreignKey'       => 'tl_google_chart.title',
            'eval'             => ['tl_class' => 'clr w50', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
            'sql'              => "int(10) unsigned NOT NULL default '0'"
        ]
    ];

    $dca['fields'] = array_merge($dca['fields'], $fields);
}