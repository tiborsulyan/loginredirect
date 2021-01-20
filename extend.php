<?php

/*
 * This file is part of tiborsulyan/loginredirect.
 *
 * Copyright (c) 2021 stibi.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tiborsulyan\LoginRedirect;

use Flarum\Foundation\ValidationException;
use Flarum\Settings\Event\Saving;
use Flarum\Extend;
use Illuminate\Config\Repository as ConfigRepository;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\ServiceProvider())
        ->register(AddExecuteRouteMiddleware::class),
];
