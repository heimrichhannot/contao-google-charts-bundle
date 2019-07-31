<?php

$lang = &$GLOBALS['TL_LANG']['tl_google_chart'];

/**
 * Fields
 */
$lang['tstamp']        = ['Änderungsdatum', ''];
$lang['title']         = ['Titel', 'Geben Sie hier bitte den Titel ein.'];
$lang['published']     = ['Veröffentlichen', 'Wählen Sie diese Option zum Veröffentlichen.'];
$lang['start']         = ['Anzeigen ab', 'Diagramm erst ab diesem Tag auf der Webseite anzeigen.'];
$lang['stop']          = ['Anzeigen bis', 'Diagramm nur bis zu diesem Tag auf der Webseite anzeigen.'];
$lang['lineWidth']     = ['Linienstärke', 'Geben Sie hier die Stärke der Linie im Diagramm an.'];
$lang['curveType']     = ['Darstellungstyp', 'Wählen Sie hier den Darstellungstyp der Linie aus. "function" erzeugt eine geglättete Linie.'];
$lang['chartTemplate'] = ['Diagramm-Template', 'Wählen Sie hier das Template des Diagramms aus.'];
$lang['dataContainer'] = ['Referenz-Tabelle', 'Wählen Sie hier die Tabelle aus von der die Datenquelle bezogen werden soll.'];
$lang['dataField']     = ['Referenz-Feld', 'Wählen Sie hier das Feld aus das die Daten hält.'];
$lang['dataEntity']    = ['Referenz-Entität', 'Wählen Sie die Entität aus die die Datenquelle hält.'];
$lang['chartClass']    = ['Diagramm-Klasse', 'Wählen Sie hier die Klasse zur Erzeugung des Diagramms aus.'];
$lang['lineColor']     = ['Linienfarbe', 'Wählen Sie hier die Farbe aus, in der die Diagrammlinie dargestellt werden soll.'];
$lang['labelX']        = ['Titel der X-Achse', 'Tragen Sie hier den Titel der X-Achse ein.'];
$lang['labelY']        = ['Titel der Y-Achse', 'Tragen Sie hier den Titel der Y-Achse ein.'];

$lang['type']     = [
    'Typ',
    'Wählen Sie hier den Typ des Diagramms',
    \HeimrichHannot\GoogleChartsBundle\DataContainer\GoogleChartsContainer::TYPE_LINE => 'Linien-Diagramm',
];
$lang['dataType'] = [
    'Datentyp',
    'Wählen Sie hier den Typ der Datenquelle aus.',
    \HeimrichHannot\GoogleChartsBundle\DataContainer\GoogleChartsContainer::DATA_TYPE_JSON                                                                                        => 'JSON',
    \HeimrichHannot\GoogleChartsBundle\DataContainer\GoogleChartsContainer::DATA_TYPE_REFERENCE                                                                                   => 'Referenz',
    \Contao\System::getContainer()->get('huh.google_charts.manager.google_charts')->getClassChoice(\HeimrichHannot\GoogleChartsBundle\DataType\Concrete\DataTypeJson::class)      => 'JSON',
    \Contao\System::getContainer()->get('huh.google_charts.manager.google_charts')->getClassChoice(\HeimrichHannot\GoogleChartsBundle\DataType\Concrete\DataTypeReference::class) => 'Referenz'
];


/**
 * Legends
 */
$lang['general_legend'] = 'Allgemeine Einstellungen';
$lang['config_legend']  = 'Diagrammeinstellungen';
$lang['publish_legend'] = 'Veröffentlichung';
$lang['data_legend']    = 'Dateneinstellungen';

/**
 * Buttons
 */
$lang['new']    = ['Neues Diagramm', 'Diagramm erstellen'];
$lang['edit']   = ['Diagramm bearbeiten', 'Diagramm ID %s bearbeiten'];
$lang['copy']   = ['Diagramm duplizieren', 'Diagramm ID %s duplizieren'];
$lang['delete'] = ['Diagramm löschen', 'Diagramm ID %s löschen'];
$lang['toggle'] = ['Diagramm veröffentlichen', 'Diagramm ID %s veröffentlichen/verstecken'];
$lang['show']   = ['Diagramm Details', 'Diagramm-Details ID %s anzeigen'];

