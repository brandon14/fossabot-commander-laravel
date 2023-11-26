<?php

/**
 * This file is part of the brandon14/fossabot-commander-laravel package.
 *
 * MIT License
 *
 * Copyright (c) 2023 Brandon Clothier
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

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Brandon14\FossabotCommander\Contracts\FossabotCommander;

test('gets fossabot-commander from alias', function () {
    $commander = app('fossabot-commander');

    expect($commander)->toBeInstanceOf(FossabotCommander::class);
});

test('gets fossabot-commander from container', function () {
    $commander = app(FossabotCommander::class);

    expect($commander)->toBeInstanceOf(FossabotCommander::class);
});

test('gets fossabot-commander from helper', function () {
    $commander = fossabot_commander();

    expect($commander)->toBeInstanceOf(FossabotCommander::class);
});

test('uses psr client interface bound to container', function () {
    $app = app();

    $client = new Client();

    $app->singleton(ClientInterface::class, static function () use ($client) {
        return $client;
    });

    $commander = $app->make(FossabotCommander::class);

    expect($commander->getHttpClient())->toEqual($client);
});

test('uses guzzle client interface bound to container', function () {
    $app = app();

    $client = new Client();

    $app->singleton(\GuzzleHttp\ClientInterface::class, static function () use ($client) {
        return $client;
    });

    $commander = $app->make(FossabotCommander::class);

    expect($commander->getHttpClient())->toEqual($client);
});

test('uses request factory interface bound to container', function () {
    $app = app();

    $factory = new HttpFactory();

    $app->singleton(RequestFactoryInterface::class, static function () use ($factory) {
        return $factory;
    });

    $commander = $app->make(FossabotCommander::class);

    expect($commander->getRequestFactory())->toEqual($factory);
});

test('respects logging config option (disabled)', function () {
    $app = app();
    $config = $app->make('config');
    $config->set('fossabot-commander.logging.enable', false);

    $commander = $app->make(FossabotCommander::class);
    $logger = $commander->getLogger();

    expect($logger)->toBeNull();
});

test('respects logging config option (enabled)', function () {
    $app = app();
    $config = $app->make('config');
    $config->set('fossabot-commander.logging.enable', true);

    $commander = $app->make(FossabotCommander::class);
    $logger = $commander->getLogger();

    expect($logger)->toBeInstanceOf(LoggerInterface::class);
});
