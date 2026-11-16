<?php

use Illuminate\Support\Facades\DB;
use JeffersonGoncalves\Filament\LgpdAuditLog\LgpdAuditLogPlugin;
use JeffersonGoncalves\Filament\LgpdAuditLog\Resources\AuditLogs\AuditLogResource;
use JeffersonGoncalves\Filament\LgpdAuditLog\Resources\AuditLogs\Pages\ListAuditLogs;
use JeffersonGoncalves\Filament\LgpdAuditLog\Resources\AuditLogs\Pages\ViewAuditLog;
use JeffersonGoncalves\Filament\LgpdAuditLog\Tests\Fixtures\TestUser;
use JeffersonGoncalves\LgpdAuditLog\Facades\LgpdAuditLog;
use JeffersonGoncalves\LgpdAuditLog\Models\AuditLog;
use Livewire\Livewire;

beforeEach(function () {
    $this->admin = TestUser::create(['name' => 'Admin', 'email' => 'admin@example.com']);
    $this->subject = TestUser::create(['name' => 'Maria', 'email' => 'maria@example.com']);
    $this->actingAs($this->admin);
});

it('lists who did what to whose data', function () {
    $viewed = LgpdAuditLog::record('viewed', $this->subject, ['email'], 'Support ticket');
    $exported = LgpdAuditLog::record('exported', $this->subject, ['email']);

    Livewire::test(ListAuditLogs::class)
        ->assertCanSeeTableRecords([$viewed, $exported])
        ->assertSee('TestUser #'.$this->admin->getKey())
        ->assertSee('TestUser #'.$this->subject->getKey())
        ->assertSee('Viewed')
        ->assertSee('Exported')
        ->filterTable('action', 'exported')
        ->assertCanSeeTableRecords([$exported])
        ->assertCanNotSeeTableRecords([$viewed]);
});

it('shows an entry with its hash', function () {
    $log = LgpdAuditLog::record('viewed', $this->subject, ['email'], 'Support ticket', ['ticket' => 42]);

    Livewire::test(ViewAuditLog::class, ['record' => $log->getKey()])
        ->assertSuccessful()
        ->assertSee('Support ticket')
        ->assertSee($log->hash);
});

it('verifies the chain from the panel', function () {
    foreach (range(1, 3) as $i) {
        LgpdAuditLog::record('viewed', $this->subject);
    }

    Livewire::test(ListAuditLogs::class)
        ->callAction('verify')
        ->assertNotified('The audit log is intact.');

    $second = AuditLog::query()->orderBy('id')->skip(1)->first();
    DB::table('lgpd_audit_logs')->where('id', $second->id)->update(['action' => 'exported']);

    Livewire::test(ListAuditLogs::class)
        ->callAction('verify')
        ->assertNotified("The chain breaks at entry #{$second->id}: it or the entry before it was altered, removed or inserted.");
});

it('shows custom actions as they are', function () {
    expect(AuditLogResource::action('printed'))->toBe('printed')
        ->and(AuditLogResource::action('anonymized'))->toBe('Anonymized');
});

it('is read-only and applies the fluent plugin options', function () {
    LgpdAuditLogPlugin::get()->navigationGroup('LGPD')->slug('audit');

    expect(AuditLogResource::canCreate())->toBeFalse()
        ->and(AuditLogResource::getPages())->toHaveKeys(['index', 'view'])->not->toHaveKey('edit')
        ->and(AuditLogResource::getNavigationGroup())->toBe('LGPD')
        ->and(AuditLogResource::getSlug())->toBe('audit');
});
