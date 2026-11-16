<?php

namespace JeffersonGoncalves\Filament\LgpdAuditLog;

use JeffersonGoncalves\FilamentPluginCore\BasePackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class LgpdAuditLogServiceProvider extends BasePackageServiceProvider
{
    public static string $name = 'filament-lgpd-audit-log';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasTranslations();
    }
}
