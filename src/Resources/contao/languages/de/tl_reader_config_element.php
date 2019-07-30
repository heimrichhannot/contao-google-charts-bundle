<?php

$lang = &$GLOBALS['TL_LANG']['tl_reader_config_element'];

/**
 * Reference
 */
$lang['reference'] += [
    \HeimrichHannot\GoogleChartsBundle\ConfigElementType\GoogleChartsReaderConfigElementType::TYPE => 'Google Chart',
];

$lang['chartConfig']         = ['Google Charts Konfiguration', 'Wählen Sie hier die Konfiguration des Diagramms aus.'];
$lang['displayElevation']    = ['Höhenprofil anzeigen', 'Wählen Sie diese Option,  wenn ein Höhenprofil zur GoogleMap erzeugt werden soll. Diese kann im Template über die variable `elevation` dargestellt werden.'];
$lang['stepPerKilometer']    = ['Schritte pro Kilometer', 'Geben Sie hier die "Steps per kilometer" an.'];
$lang['syncMapAndElevation'] = ['Karte und Höhenprofil synchronisieren (Maus-Hover)', 'Wählen Sie diese Option, um bei Mouse-Hovering auf dem Höhenprofil einen Marker in der Karte anzeigen zu lassen.'];