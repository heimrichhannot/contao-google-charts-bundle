<?php

$dca = &$GLOBALS['TL_DCA']['tl_reader_config_element'];

/**
 * Fields
 */
if (\Contao\System::getContainer()->get('huh.utils.container')->isBundleActive('HeimrichHannot\ReaderBundle\HeimrichHannotContaoReaderBundle')) {

    /**
     * Palettes
     */
    $dca['palettes']['__selector__'][] = 'displayElevation';
    $dca['palettes'][\HeimrichHannot\GoogleChartsBundle\ConfigElementType\GoogleChartsReaderConfigElementType::TYPE] =
        '{title_type_legend},title,type;{config_legend},name,chartConfig;';
    $dca['palettes'][\HeimrichHannot\GoogleMapBundle\ConfigElementType\GoogleMapReaderConfigElementType::TYPE] = str_replace('googlemaps_skipJs', 'googlemaps_skipJs, displayElevation;', $dca['palettes'][\HeimrichHannot\GoogleMapBundle\ConfigElementType\GoogleMapReaderConfigElementType::TYPE]);

    /**
     * Subpalettes
     */
    $dca['subpalettes']['displayElevation'] = 'chartConfig,stepPerKilometer';

    /**
     * Fields
     */
    \Contao\System::loadLanguageFile('tl_content');

    $fields = [
        'displayElevation' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_reader_config_element']['displayElevation'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['doNotCopy'=>true, 'submitOnChange' => true, 'tl_class' => 'clr w50'],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'chartConfig'      => [
            'label'            => &$GLOBALS['TL_LANG']['tl_reader_config_element']['chartConfig'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'foreignKey'       => 'tl_google_charts.title',
            'eval'             => ['tl_class' => 'clr w50', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
            'sql'              => "int(10) unsigned NOT NULL default '0'"
        ],
        'stepPerKilometer' => [
            'label'            => &$GLOBALS['TL_LANG']['tl_reader_config_element']['stepPerKilometer'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'text',
            'default'          => 10,
            'eval'             => ['tl_class' => 'clr w50'],
            'sql'              => "int(10) unsigned NOT NULL default ''"
        ]
    ];

    $dca['fields'] = array_merge($dca['fields'], $fields);
}