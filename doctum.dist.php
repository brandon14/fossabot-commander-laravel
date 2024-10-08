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

use Doctum\Doctum;
use Symfony\Component\Finder\Finder;
use Doctum\Version\GitVersionCollection;
use Doctum\RemoteRepository\GitHubRemoteRepository;

$dir = __DIR__.'/src';
$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir);

$versions = GitVersionCollection::create($dir)
    ->addFromTags('v*')
    ->add('main', 'main')
    ->add('1.0-dev', '1.0-dev')
    ->add('2.0-dev', '2.0-dev');

return new Doctum($iterator, [
    'versions' => $versions,
    'title' => 'brandon14/fossabot-commander-laravel Documentation',
    'source_dir' => dirname($dir).'/',
    'remote_repository' => new GitHubRemoteRepository('brandon14/fossabot-commander-laravel', dirname($dir)),
    'base_url' => 'https://brandon14.github.io/fossabot-commander-laravel/',
    'build_dir' => __DIR__.'/docs/%version%',
    'cache_dir' => __DIR__.'/doctum_cache/%version%',
    'footer_link' => [
        'href' => 'https://github.com/brandon14/fossabot-commander-laravel',
        'rel' => 'noreferrer noopener',
        'target' => '_blank',
        'before_text' => 'You can edit the configuration',
        'link_text' => 'on this', // Required if the href key is set
        'after_text' => 'repository',
    ],
]);
