<?php

/*
 * Copyright (c) 2023 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\GoogleChartsBundle\EventListener\Contao;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use HeimrichHannot\GoogleChartsBundle\Event\AddHeadScriptEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * @Hook("replaceDynamicScriptTags")
 */
class ReplaceDynamicScriptTagsListener
{
    private RequestStack $requestStack;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(RequestStack $requestStack, EventDispatcherInterface $eventDispatcher)
    {
        $this->requestStack = $requestStack;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(string $buffer): string
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request || !$request->attributes->get('huh_google_charts', false)) {
            return $buffer;
        }

        $event = $this->eventDispatcher->dispatch(new AddHeadScriptEvent());

        if (empty($event->getCode())) {
            return $buffer;
        }

        $nonce = '';

        if (method_exists(ContaoFramework::class, 'getNonce')) {
            $nonce = '_'.ContaoFramework::getNonce();
        }

        return str_replace("[[TL_HEAD$nonce]]", "[[TL_HEAD$nonce]]".$event->getCode(), $buffer);
    }
}
