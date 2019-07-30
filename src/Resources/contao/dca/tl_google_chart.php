<?php

$GLOBALS['TL_DCA']['tl_google_chart'] = [
    'config'   => [
        'dataContainer'     => 'Table',
        'enableVersioning'  => true,
        'onsubmit_callback' => [
            ['huh.utils.dca', 'setDateAdded'],
        ],
        'oncopy_callback'   => [
            ['huh.utils.dca', 'setDateAddedOnCopy'],
        ],
        'sql' => [
            'keys' => [
                'id' => 'primary'            ]
        ]
    ],
    'list'     => [
        'label' => [
            'fields' => ['title'],
            'format' => '%s'
        ],
        'global_operations' => [
            'all'    => [
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            ],
        ],
        'operations' => [
            'edit'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_google_chart']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ],
            'copy'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_google_chart']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif'
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_google_chart']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ],
            'toggle' => [
                'label'           => &$GLOBALS['TL_LANG']['tl_google_chart']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => ['tl_google_chart', 'toggleIcon']
            ],
            'show'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_google_chart']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            ],
        ]
    ],
    'palettes' => [
        '__selector__' => ['published', 'type', 'dataType'],
        'default' => '{general_legend},title,type;{publish_legend},published;',
        \HeimrichHannot\GoogleChartsBundle\DataContainer\GoogleChartsContainer::TYPE_LINE => '{general_legend},title,type;{config_legend},chartClass,lineWidth,curveType,chartTemplate,lineColor,labelX,labelY;{data_legend},dataType;{publish_legend},published;'
    ],
    'subpalettes' => [
        'published'    => 'start,stop',
        'dataType_' . \Contao\System::getContainer()->get('huh.google_charts.manager.google_charts')->getClassChoice(\HeimrichHannot\GoogleChartsBundle\DataType\Concrete\DataTypeJson::class)  => 'data',
        'dataType_' . \Contao\System::getContainer()->get('huh.google_charts.manager.google_charts')->getClassChoice(\HeimrichHannot\GoogleChartsBundle\DataType\Concrete\DataTypeReference::class) => 'dataContainer,dataField,dataEntity'
    ],
    'fields'   => [
        'id' => [
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['tstamp'],
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ],
        'dateAdded' => [
            'label'                   => &$GLOBALS['TL_LANG']['MSC']['dateAdded'],
            'sorting'                 => true,
            'flag'                    => 6,
            'eval'                    => ['rgxp'=>'datim', 'doNotCopy' => true],
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ],
        'title' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['title'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'tl_class'=>'w50'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'type' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['type'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options_callback'        => ['huh.google_charts.data_container.google_charts_container', 'getChartTypes'],
            'reference'               => $GLOBALS['TL_LANG']['tl_google_chart']['type'],
            'eval'                    => ['mandatory' => true,'submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'clr w50'],
            'sql'                     => "varchar(64) NOT NULL default ''",
        ],
        'chartClass' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['chartClass'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options_callback'        => ['huh.google_charts.data_container.google_charts_container', 'getChartClasses'],
            'eval'                    => [
                'mandatory' => true,
                'includeBlankOption' => true,
                'tl_class' => 'clr w50',
                'decodeEntities'     => true
            ],
            'sql'                     => "varchar(128) NOT NULL default ''",
        ],
        'lineWidth' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['lineWidth'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => '3',
            'eval'                    => ['mandatory' => true, 'tl_class'=>'w50'],
            'sql'                     => "varchar(8) NOT NULL default ''"
        ],
        'lineColor' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['lineColor'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => '#515151',
            'eval'                    => ['tl_class'=>'w50 clr', 'colorpicker' => true],
            'sql'                     => "varchar(16) NOT NULL default ''"
        ],
        'curveType' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['curveType'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => ['huh.google_charts.data_container.google_charts_container', 'getCurveTypes'],
            'eval'                    => ['tl_class'=>'w50'],
            'sql'                     => "varchar(16) NOT NULL default ''"
        ],
        'labelX' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['labelX'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['tl_class'=>'clr w50'],
            'sql'                     => "varchar(128) NOT NULL default ''"
        ],
        'labelY' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['labelY'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['tl_class'=>'w50'],
            'sql'                     => "varchar(128) NOT NULL default ''"
        ],
        'dataType' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['dataType'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => ['huh.google_charts.data_container.google_charts_container', 'getDataTypeClasses'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_google_chart']['dataType'],
            'eval'                    => [
                'tl_class'=>'w50',
                'includeBlankOption' => true,
                'mandatory' => true,
                'submitOnChange' => true,
                'chosen' => true
            ],
            'sql'                     => "varchar(128) NOT NULL default ''"
        ],
        'data' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['data'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => ['tl_class'=>'w50', 'rte'=>'ace|json'],
            'sql'                     => "blob NULL"
        ],
        'dataContainer'  => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['dataContainer'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => ['huh.utils.choice.data_container', 'getChoices'],
            'eval'                    => [
                'chosen'             => true,
                'submitOnChange'     => true,
                'includeBlankOption' => true,
                'tl_class'           => 'w50',
                'mandatory'          => true,
            ],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'dataField'  => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['dataField'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => ['huh.google_charts.data_container.google_charts_container', 'getFields'],
            'eval'                    => [
                'chosen'             => true,
                'includeBlankOption' => true,
                'tl_class'           => 'w50',
                'mandatory'          => true,
            ],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'dataEntity'  => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['dataEntity'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => ['huh.google_charts.data_container.google_charts_container', 'getEntities'],
            'eval'                    => [
                'chosen'             => true,
                'includeBlankOption' => true,
                'tl_class'           => 'w50',
            ],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'chartTemplate' => [
            'label'            => &$GLOBALS['TL_LANG']['tl_google_chart']['chartTemplate'],
            'exclude'          => true,
            'inputType'        => 'select',
            'default'          => 'default',
            'options_callback' => ['huh.google_charts.choice.template.chart', 'getCachedChoices'],
            'eval'             => ['tl_class' => 'w50 clr', 'includeBlankOption' => true, 'mandatory' => true],
            'sql'              => "varchar(128) NOT NULL default ''",
        ],
        'published' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['published'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['doNotCopy'=>true, 'submitOnChange' => true],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'start' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['start'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'],
            'sql'                     => "varchar(10) NOT NULL default ''"
        ],
        'stop' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_google_chart']['stop'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'],
            'sql'                     => "varchar(10) NOT NULL default ''"
        ]
    ]
];


class tl_google_chart extends \Contao\Backend
{

    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $user = \Contao\BackendUser::getInstance();

        if (strlen(\Contao\Input::get('tid')))
        {
            $this->toggleVisibility(\Contao\Input::get('tid'), (\Contao\Input::get('state') === '1'), (@func_get_arg(12) ?: null));
            Controller::redirect(System::getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$user->hasAccess('tl_google_chart::published', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if (!$row['published'])
        {
            $icon = 'invisible.svg';
        }

        return '<a href="'.Controller::addToUrl($href).'&rt='.\RequestToken::get().'" title="'.\StringUtil::specialchars($title).'"'.$attributes.'>'.\Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"').'</a> ';
    }

    public function toggleVisibility($intId, $blnVisible, \DataContainer $dc=null)
    {
        $user = \Contao\BackendUser::getInstance();
        $database = \Contao\Database::getInstance();

        // Set the ID and action
        \Contao\Input::setGet('id', $intId);
        \Contao\Input::setGet('act', 'toggle');

        if ($dc)
        {
            $dc->id = $intId; // see #8043
        }

        // Trigger the onload_callback
        if (is_array($GLOBALS['TL_DCA']['tl_google_chart']['config']['onload_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_google_chart']['config']['onload_callback'] as $callback)
            {
                if (is_array($callback))
                {
                    System::importStatic($callback[0])->{$callback[1]}($dc);
                }
                elseif (is_callable($callback))
                {
                    $callback($dc);
                }
            }
        }

        // Check the field access
        if (!$user->hasAccess('tl_google_chart::published', 'alexf'))
        {
            throw new \Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to publish/unpublish google_charts item ID ' . $intId . '.');
        }

        // Set the current record
        if ($dc)
        {
            $objRow = $database->prepare("SELECT * FROM tl_google_chart WHERE id=?")
            ->limit(1)
            ->execute($intId);

            if ($objRow->numRows)
            {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new \Versions('tl_google_chart', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_google_chart']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_google_chart']['fields']['published']['save_callback'] as $callback)
            {
                if (is_array($callback))
                {
                    $blnVisible = System::importStatic($callback[0])->{$callback[1]}($blnVisible, $dc);
                }
                elseif (is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();

        // Update the database
        $database->prepare("UPDATE tl_google_chart SET tstamp=$time, published='" . ($blnVisible ? '1' : "''") . "' WHERE id=?")
        ->execute($intId);

        if ($dc)
        {
            $dc->activeRecord->tstamp = $time;
            $dc->activeRecord->published = ($blnVisible ? '1' : '');
        }

        // Trigger the onsubmit_callback
        if (is_array($GLOBALS['TL_DCA']['tl_google_chart']['config']['onsubmit_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_google_chart']['config']['onsubmit_callback'] as $callback)
            {
                if (is_array($callback))
                {
                    System::importStatic($callback[0])->{$callback[1]}($dc);
                }
                elseif (is_callable($callback))
                {
                    $callback($dc);
                }
            }
        }

        $objVersions->create();
    }

}
