<?php

/**
 * This file is part of the brandon14/fossabot-commander-laravel package.
 *
 * MIT License
 *
 * Copyright (c) 2023-2024 Brandon Clothier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | This option controls the logging configuration that will be provided to
    | the underlying FossabotCommander library.
    |
    */

    'logging' => [
        /*
        |--------------------------------------------------------------------------
        | Enable Logging
        |--------------------------------------------------------------------------
        |
        | This options controls whether a logger will be provided to the underlying
        | FossabotCommander library. Defaults to false.
        |
        */

        'enable' => env('FOSSABOT_COMMANDER_ENABLE_LOGGING', false),

        /*
        |--------------------------------------------------------------------------
        | Include Additional Logging Context
        |--------------------------------------------------------------------------
        |
        | This options controls whether additional FossabotCommander context should
        | be included when calling logger methods.
        |
        */

        'include_context' => env('FOSSABOT_COMMANDER_INCLUDE_LOGGING_CONTEXT', true),

        /*
        |--------------------------------------------------------------------------
        | Logging Channel
        |--------------------------------------------------------------------------
        |
        | This options controls which logging channel to provide to the underlying
        | FossabotCommander library. Must be a valid Laravel logging channel.
        |
        */

        'channel' => env('FOSSABOT_COMMANDER_LOG_CHANNEL', 'default'),
    ],
];
