<?php

namespace JeffersonGoncalves\Filament\LgpdAuditLog\Resources\AuditLogs\Pages;

use Filament\Resources\Pages\ViewRecord;
use JeffersonGoncalves\Filament\LgpdAuditLog\LgpdAuditLogPlugin;
use JeffersonGoncalves\Filament\LgpdAuditLog\Resources\AuditLogs\AuditLogResource;
use JeffersonGoncalves\LgpdAuditLog\AuditLogger;

class ViewAuditLog extends ViewRecord
{
    protected static string $resource = AuditLogResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        // Opening an entry shows IP address, user agent and metadata: audit who reads the log too.
        if (LgpdAuditLogPlugin::get()->shouldLogViews()) {
            app(AuditLogger::class)->record('viewed', $this->getRecord(), purpose: 'Audit log review');
        }
    }
}
