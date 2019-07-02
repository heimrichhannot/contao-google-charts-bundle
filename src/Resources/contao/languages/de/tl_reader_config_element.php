<?php

$lang = &$GLOBALS['TL_LANG']['tl_reader_config_element'];

/**
 * Reference
 */
$lang['reference'] += [
    \HeimrichHannot\GoogleChartsBundle\ConfigElementType\GoogleChartsReaderConfigElementType::TYPE => 'Google Chart',
];

$lang['chartConfig'] = ['Google Charts Konfiguration', 'Wählen Sie hier die Konfiguration des Diagramms aus.'];
$lang['displayElevation'] = ['Höhenprofil anzeigen', 'Wählen Sie diese Option,  wenn ein Höhenprofil zur GoogleMap erzeugt werden soll. Diese kann im Template über die variable `elevation` dargestellt werden.'];