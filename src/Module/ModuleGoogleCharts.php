<?php


namespace HeimrichHannot\GoogleChartsBundle\Module;


use Contao\BackendTemplate;
use Contao\Module;
use Contao\System;
use Patchwork\Utf8;


class ModuleGoogleCharts extends Module
{
    const TYPE = 'huh_google_charts';

    protected $strTemplate = 'mod_google_charts';


    public function generate()
    {
        if (System::getContainer()->get('huh.utils.container')->isBackend()) {
            $objTemplate           = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . Utf8::strtoupper($GLOBALS['TL_LANG']['FMD'][$this->type][0]) . ' ###';
            $objTemplate->title    = $this->headline;
            $objTemplate->id       = $this->id;
            $objTemplate->link     = $this->name;
            $objTemplate->href     = 'contao?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        if (!$this->googleChartsConfig) {
            return '';
        }

        return parent::generate();
    }

    /**
     * @codeCoverageIgnore
     */
    protected function compile()
    {
        $this->Template->hl    = $this->hl;

        $this->Template->chart = System::getContainer()->get('huh.google_charts.manager.google_charts')->createChart((int) $this->googleChartsConfig);
    }

}