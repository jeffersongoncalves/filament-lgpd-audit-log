<?php

namespace JeffersonGoncalves\Filament\LgpdAuditLog\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\LgpdAuditLog\LgpdAuditLogPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                LgpdAuditLogPlugin::make(),
            ]);
    }
}
