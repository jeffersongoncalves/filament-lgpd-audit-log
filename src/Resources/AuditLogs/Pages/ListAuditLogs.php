<?php

namespace JeffersonGoncalves\Filament\LgpdAuditLog\Resources\AuditLogs\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\Filament\LgpdAuditLog\Resources\AuditLogs\AuditLogResource;
use JeffersonGoncalves\LgpdAuditLog\AuditLogger;

class ListAuditLogs extends ListRecords
{
    protected static string $resource = AuditLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('verify')
                ->label(AuditLogResource::label('verify.label'))
                ->icon('heroicon-o-shield-check')
                ->color('gray')
                ->action(function (): void {
                    $broken = app(AuditLogger::class)->verify();

                    if ($broken === null) {
                        Notification::make()->success()->title(AuditLogResource::label('verify.intact'))->send();

                        return;
                    }

                    Notification::make()
                        ->danger()
                        ->title(__('filament-lgpd-audit-log::filament-lgpd-audit-log.verify.broken', ['id' => $broken]))
                        ->persistent()
                        ->send();
                }),
        ];
    }
}
