<?php

/*
 * Copyright (c) 2023 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\GoogleChartsBundle\EventListener;

use HeimrichHannot\GoogleChartsBundle\Event\AddHeadScriptEvent;
use HeimrichHannot\PrivacyCenterBundle\Manager\PrivacyCenterManager;
use HeimrichHannot\PrivacyCenterBundle\Script\ExternalScriptFile;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PrivacyCenterListener implements EventSubscriberInterface
{
    private PrivacyCenterManager $privacyCenterManager;

    public function __construct(PrivacyCenterManager $privacyCenterManager)
    {
        $this->privacyCenterManager = $privacyCenterManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            AddHeadScriptEvent::class => 'onAddHeadScript',
        ];
    }

    public function onAddHeadScript(AddHeadScriptEvent $event)
    {
        if (!$this->privacyCenterManager->isActivatedOnCurrentPage()) {
            return;
        }

        $script = new ExternalScriptFile('google_charts', $event::SCRIPT_SRC);
        $this->privacyCenterManager->addProtectedScript($script);
        $event->setCode(null);
    }
}
