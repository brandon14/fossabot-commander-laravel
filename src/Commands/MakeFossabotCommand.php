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

namespace Brandon14\FossabotCommanderLaravel\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Console\Concerns\CreatesMatchingTest;

// Ignore code coverage on this command for now until we write tests for it.
// @codeCoverageIgnoreStart

/**
 * Command to generate {@link \Brandon14\FossabotCommander\Contracts\FossabotCommand} instances.
 *
 * @author Brandon Clothier <brandon14125@gmail.com>
 */
final class MakeFossabotCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * {@inheritDoc}
     */
    protected $signature = 'make:fossabot-command
                            {name : Name of command class}
                            {--force : Whether to overwrite command if it already exists}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Generate a FossabotCommand.';

    /**
     * {@inheritDoc}
     */
    protected $type = 'class';

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\Fossabot\Commands";
    }

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        // Check for published stubs in the application directory.
        $published = resource_path('stubs/vendor/fossabot-commander').'/fossabot-command.stub';
        $included = __DIR__.'/../../resources/stubs/fossabot-command.stub';

        // Use overridden stub if present.
        if ($this->files->exists($published)) {
            return $published;
        }

        return $included;
    }
}

// @codeCoverageIgnoreEnd
