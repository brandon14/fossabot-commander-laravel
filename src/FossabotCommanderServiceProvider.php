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

namespace Brandon14\FossabotCommanderLaravel;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use Psr\Http\Message\RequestFactoryInterface;
use Brandon14\FossabotCommander\FossabotCommander;
use Psr\Http\Client\ClientInterface as PsrClientInterface;
use Brandon14\FossabotCommanderLaravel\Commands\MakeFossabotCommand;
use Brandon14\FossabotCommander\Contracts\FossabotCommander as FossabotCommanderInterface;

/**
 * Registers FossabotCommander services and commands with Laravel's container.
 *
 * @author Brandon Clothier <brandon14125@gmail.com>
 */
final class FossabotCommanderServiceProvider extends ServiceProvider
{
    /**
     * Boot service provider.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->setUpConfig();
            $this->setUpStubs();
            $this->setUpCommands();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        // Bind FossabotCommander as singleton.
        $this->app->singleton(FossabotCommanderInterface::class, static function (Container $app) {
            $config = $app->make('config')->get('fossabot-commander');
            $logging = $config['logging']['enable'];
            $channel = $config['logging']['channel'];

            // If logging is enabled, get the logger for the configured channel, otherwise set as null.
            $logger = $logging ? $app->make('log')->channel($channel) : null;

            // Get PSR compliant client. First check for base PSR interface binding, then Guzzle client interface.
            // Fallback to making the default Guzzle Client instance.
            if ($app->bound(PsrClientInterface::class)) {
                $http = $app->make(PsrClientInterface::class);
            } elseif ($app->bound(ClientInterface::class)) {
                $http = $app->make(ClientInterface::class);
            } else {
                $http = $app->make(Client::class);
            }

            // Get PSR compliant request factory. First check for the PSR interface binding, then fall back to the
            // default Guzzle HttpFactory instance.
            if ($app->bound(RequestFactoryInterface::class)) {
                $request = $app->make(RequestFactoryInterface::class);
            } else {
                $request = $app->make(HttpFactory::class);
            }

            return new FossabotCommander($http, $request, $logger, $logging);
        });

        // Add alias.
        $this->app->alias(FossabotCommanderInterface::class, 'fossabot-commander');
    }

    /**
     * Set up package commands.
     */
    private function setUpCommands(): void
    {
        $this->commands([MakeFossabotCommand::class]);
    }

    /**
     * Set up package configuration.
     */
    private function setUpConfig(): void
    {
        $source = __DIR__.'/../config/fossabot-commander.php';

        $this->publishes(
            [$source => config_path('fossabot-commander.php')],
            'fossabot-commander-config'
        );

        $this->mergeConfigFrom($source, 'fossabot-commander');
    }

    /**
     * Set up package stubs.
     */
    private function setUpStubs(): void
    {
        $this->publishes(
            [__DIR__.'/../resources/stubs' => resource_path('stubs/vendor/fossabot-commander')],
            'fossabot-commander-stubs'
        );
    }

    /**
     * {@inheritDoc}
     */
    public function provides(): array
    {
        // Don't worry about testing the service provider provides.
        // @codeCoverageIgnoreStart
        return [
            'fossabot-commander',
        ];
        // @codeCoverageIgnoreEnd
    }
}
