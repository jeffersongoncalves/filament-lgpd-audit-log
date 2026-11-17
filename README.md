<div class="filament-hidden">

![Filament LGPD Audit Log](https://raw.githubusercontent.com/jeffersongoncalves/filament-lgpd-audit-log/3.x/art/jeffersongoncalves-filament-lgpd-audit-log.png)

</div>

# Filament LGPD Audit Log

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-lgpd-audit-log.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-lgpd-audit-log)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-lgpd-audit-log/tests.yml?branch=3.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-lgpd-audit-log/actions?query=workflow%3Atests+branch%3A3.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-lgpd-audit-log/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-lgpd-audit-log/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A3.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-lgpd-audit-log.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-lgpd-audit-log)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-lgpd-audit-log.svg?style=flat-square)](LICENSE.md)

Browse the audit trail of [laravel-lgpd-audit-log](https://github.com/jeffersongoncalves/laravel-lgpd-audit-log) from your Filament panel: who viewed, changed, exported or anonymized whose personal data, when and why. You can also check that nobody tampered with it.

## Features

- Every entry: when, who, action, data subject, columns (names only, never values) and purpose.
- Filters by action and by data subject model.
- View page with the IP address, user agent, metadata and the entry's hash.
- Who opens an entry in the panel is logged too.
- **Verify chain:** checks the hash chain and tells you which entry was altered, removed or inserted.
- Read-only, like the log itself.
- 19 languages. Custom actions you record are shown as they are.

## Compatibility

| Plugin Version                                                                | Filament |
|-------------------------------------------------------------------------------|----------|
| [1.x](https://github.com/jeffersongoncalves/filament-lgpd-audit-log/tree/1.x) | 3.x      |
| [2.x](https://github.com/jeffersongoncalves/filament-lgpd-audit-log/tree/2.x) | 4.x      |
| [3.x](https://github.com/jeffersongoncalves/filament-lgpd-audit-log/tree/3.x) | 5.x      |

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-lgpd-audit-log:"^3.0"
php artisan vendor:publish --tag="lgpd-audit-log-migrations"
php artisan migrate
```

## Usage

```php
use JeffersonGoncalves\Filament\LgpdAuditLog\LgpdAuditLogPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            LgpdAuditLogPlugin::make()
                ->navigationGroup('LGPD')             // default: no group
                ->navigationSort(50)
                ->navigationIcon('heroicon-o-document-magnifying-glass')
                ->slug('audit-log')
                ->logViews(),                         // log who opens an entry (default: on)
        ]);
}
```

All fluent methods are optional. Opening an entry shows the IP address, user agent and metadata, so each opening is logged too: a `viewed` entry whose subject is the entry opened, with the purpose `Audit log review`. Turn it off with `->logViews(false)`.

> The resource has no authorization of its own: register it only on panels whose users may read the audit log, or add a policy for `JeffersonGoncalves\LgpdAuditLog\Models\AuditLog`.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
