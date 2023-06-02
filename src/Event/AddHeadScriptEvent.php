<?php

/*
 * Copyright (c) 2023 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\GoogleChartsBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class AddHeadScriptEvent extends Event
{
    public const SCRIPT_SRC = 'https://www.gstatic.com/charts/loader.js';

    private ?string $code;

    public function __construct()
    {
        $this->code = static::getDefaultScriptTag();
    }

    public static function getDefaultScriptTag(): string
    {
        return '<script type="text/javascript" src="'.static::SCRIPT_SRC.'"></script>';
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code Set to null to not have code added to head section
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
