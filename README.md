<!-- markdownlint-disable MD033 -->
<p align="center">
  <a href="https://packagist.org/packages/brandon14/fossabot-commander-laravel" target="_blank"><img alt="Packagist PHP Version" src="https://img.shields.io/packagist/dependency-v/brandon14/fossabot-commander-laravel/php?style=for-the-badge&cacheSeconds=3600"></a>
</p>
<p align="center">
  <a href="https://github.com/brandon14/fossabot-commander-laravel/actions/workflows/run-tests.yml" target="_blank"><img alt="GitHub Actions Workflow Status" src="https://img.shields.io/github/actions/workflow/status/brandon14/fossabot-commander-laravel/run-tests.yml?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://codeclimate.com/github/brandon14/fossabot-commander-laravel/maintainability" target="_blank"><img alt="Code Climate maintainability" src="https://img.shields.io/codeclimate/maintainability-percentage/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://codecov.io/gh/brandon14/fossabot-commander-laravel" target="_blank"><img alt="Codecov" src="https://img.shields.io/codecov/c/github/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://github.com/brandon14/fossabot-commander-laravel/blob/main/LICENSE" target="_blank"><img alt="GitHub" src="https://img.shields.io/github/license/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
</p>
<p align="center">
  <a href="https://github.com/brandon14/fossabot-commander-laravel/issues" target="_blank"><img alt="GitHub issues" src="https://img.shields.io/github/issues/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://github.com/brandon14/fossabot-commander-laravel/issues?q=is%3Aissue+is%3Aclosed" target="_blank"><img alt="GitHub closed issues" src="https://img.shields.io/github/issues-closed/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://github.com/brandon14/fossabot-commander-laravel/pulls" target="_blank"><img alt="GitHub pull requests" src="https://img.shields.io/github/issues-pr/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://github.com/brandon14/fossabot-commander-laravel/pulls?q=is%3Apr+is%3Aclosed" target="_blank"><img alt="GitHub closed pull requests" src="https://img.shields.io/github/issues-pr-closed/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
</p>
<p align="center">
  <a href="https://github.com/brandon14/fossabot-commander-laravel/releases" target="_blank"><img alt="GitHub release (with filter)" src="https://img.shields.io/github/v/release/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://github.com/brandon14/fossabot-commander-laravel/commits/main" target="_blank"><img alt="GitHub commit activity (branch)" src="https://img.shields.io/github/commit-activity/m/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
  <a href="https://github.com/brandon14/fossabot-commander-laravel/commits/main" target="_blank"><img alt="GitHub last commit (by committer)" src="https://img.shields.io/github/last-commit/brandon14/fossabot-commander-laravel?style=for-the-badge&cacheSeconds=3600">
  </a>
</p>
<!-- markdownlint-enable MD033 -->

# brandon14/fossabot-commander-laravel

## Source code for [brandon14/fossabot-commander-laravel](https://github.com/brandon14/fossabot-commander-laravel)

## Table of Contents

1. [Requirements](https://github.com/brandon14/fossabot-commander-laravel#requirements)
2. [Purpose](https://github.com/brandon14/fossabot-commander-laravel#purpose)
3. [Installation](https://github.com/brandon14/fossabot-commander-laravel#installation)
4. [Usage](https://github.com/brandon14/fossabot-commander-laravel#usage)
5. [Standards](https://github.com/brandon14/fossabot-commander-laravel#standards)
6. [Coverage](https://github.com/brandon14/fossabot-commander-laravel#coverage)
7. [Documentation](https://github.com/brandon14/fossabot-commander-laravel#documentation)
8. [Contributing](https://github.com/brandon14/fossabot-commander-laravel#contributing)
9. [Versioning](https://github.com/brandon14/fossabot-commander-laravel#versioning)
10. [Security Vulnerabilities](https://github.com/brandon14/fossabot-commander-laravel#security-vulnerabilities)

## Requirements

| Dependency                    | Version                              |
|-------------------------------|--------------------------------------|
| php                           | ^7.4 \|\| ^8.0                       |
| brandon14/fossabot-commander  | ^1.0.2                               |
| guzzlehttp/guzzle             | ^6.5.8 \|\| ^7.4.5                   |
| illuminate/console            | ^8.0 \|\| ^9.0 \|\| ^10.0 \|\| ^11.0 |
| illuminate/support            | ^8.0 \|\| ^9.0 \|\| ^10.0 \|\| ^11.0 |

## Purpose

This is a simple wrapper for the [fossabot-commander](https://github.com/brandon14/fossabot-commander)
package for Laravel. This allows for easy integration into a Laravel project.

This library provides all the bindings for the Laravel IoC container to set up
the fossabot-commander library, and also includes a helper function
`fossabot_commander()` to get the commander class from the container. It also provides
a FossabotCommander facade. The package is bound to the container under the
`Brandon14\FossabotCommander\Contracts\FossabotCommander` interface, and also as the
alias `fossabot-commander`.

## Installation

```bash
composer require brandon14/fossabot-commander-laravel
```

## Usage

You will first need to get the custom API token from the request header. It will be in the
`x-fossabot-customapitoken` header.

For a simple command in Laravel:

```php
// FooCommand.php
<?php

declare(strict_types=1);

namespace App\Fossabot\Commands;

use Brandon14\FossabotCommander\FossabotCommand;
use Brandon14\FossabotCommander\Contracts\Context\FossabotContext;

class FooCommand extends FossabotCommand
{
    /**
     * {@inheritDoc}
     */
    public function getResponse(?FossabotContext $context = null) : string
    {
        return 'Hello chat!';
    }
}

// In some Laravel Controller
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fossabot\Commands\FooCommand;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Brandon14\FossabotCommander\Contracts\FossabotCommander;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    private FossabotCommander $commander;

    public function __construct(FossabotCommander $commander)
    {
        $this->commander = $commander;
    }

    public function fooCommand(Request $request): string
    {
        // Get Fossabot API token.
        $apiToken = $request->header('x-fossabot-customapitoken');

        // Invoke command.
        return $this->commander->runCommand(new FooCommand(), $apiToken);
    }
}
```
To use the helper:

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fossabot\Commands\FooCommand;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use function Brandon14\FossabotCommanderLaravel\fossabot_commander;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function fooCommand(Request $request): string
    {
        // Get Fossabot API token.
        $apiToken = $request->header('x-fossabot-customapitoken');

        return fossabot_commander()->runCommand(new FooCommand(), $apiToken);
    }
}
```

To use the facade:

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fossabot\Commands\FooCommand;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Brandon14\FossabotCommanderLaravel\Facades\FossabotCommander;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    
    public function fooCommand(Request $request): string
    {
        // Get Fossabot API token.
        $apiToken = $request->header('x-fossabot-customapitoken');

        return FossabotCommander::runCommand(new FooCommand(), $apiToken);
    }
}
```

To make commands via the Artisan command:

```bash
php artisan fossabot:make:command NameOfCommand
```

## Standards

We strive to meet the [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style for PHP projects, and enforce our
coding standard via the [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) linting tool. Our ruleset can be
found in the `.php-cs-fixer.dist.php` file.

## Coverage

The latest code coverage information can be found via [Codecov](https://codecov.io/gh/brandon14/fossabot-commander-laravel). We
strive to maintain 100% coverage across the entire Flysystem adapter, so if you are
[contributing](https://github.com/brandon14/fossabot-commander-laravel#contributing), please make sure to include tests for new
code added.

## Documentation

Documentation to this project can be found [here](https://brandon14.github.io/fossabot-commander-laravel/).

## Contributing

Got something you want to add? Found a bug or otherwise bad code? Feel free to submit pull
requests to add in new features, fix bugs, or clean things up. Just be sure to follow the
[Code of Conduct](https://github.com/brandon14/fossabot-commander-laravel/blob/master/.github/CODE_OF_CONDUCT.md)
and [Contributing Guide](https://github.com/brandon14/fossabot-commander-laravel/blob/master/.github/CONTRIBUTING.md),
and we encourage creating clean and well described pull requests if possible.

If you notice an issues with the library or want to suggest new features, feel free to create issues appropriately using
the [issue tracker](https://github.com/brandon14/fossabot-commander-laravel/issues).

In order to run the tests, it is recommended that you sign up for a Cloudinary account (it's a free service), and use that
account to run the full integration tests. In order to do that, you will need to copy `.env.example` to `.env` and fill
in the variables using the details in your account. The integration tests will use random prefixed directories and clean
everything up before and after the tests.

## Versioning

`brandon14/fossabot-commander-laravel` uses [semantic versioning](https://semver.org/) that looks like `MAJOR.MINOR.PATCH`.

Major version changes will include backwards-incompatible changes and may require refactoring of projects using it.
Minor version changes will include backwards-compatible new features and changes and will not break existing usages.
Patch version changes will include backwards-compatible bug and security fixes, and should be updated as soon as
possible.

## Security Vulnerabilities

If you discover a vulnerability within this package, please email Brandon Clothier via
[brandon14125@gmail.com](mailto:brandon14125@gmail.com). All security vulnerabilities will be promptly
addressed.

This code is released under the MIT license.

Copyright &copy; 2023-2024 Brandon Clothier

[![X (formerly Twitter) Follow](https://img.shields.io/twitter/follow/inhal3exh4le?style=for-the-badge&logo=twitter&cacheSeconds=3600)](https://twitter.com/intent/follow?screen_name=inhal3exh4le)
