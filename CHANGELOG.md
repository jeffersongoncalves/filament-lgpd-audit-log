# Changelog

All notable changes to this project will be documented in this file.

## 2.3.0 - 2026-11-18

### Changed

- Requires the 2.0 of its Laravel package, which runs on [laravel-privacy](https://github.com/jeffersongoncalves/laravel-privacy), the engine shared by the privacy suites. Same pages, settings and tables: nothing to change in your panel.

## 2.2.0 - 2026-11-16

- Reading the log is audited too (purpose `Audit log review`): opening the list adds a `viewed` entry, and Verify chain adds a `verified` entry with the result (`intact`, `broken_at`)
- Opening an entry was already logged since 1.1.0 / 2.1.0 / 3.1.0; `->logViews(false)` turns all of it off
- New `verified` action label in the 19 languages

## 2.1.0 - 2026-11-16

- Opening an audit entry in the panel is logged too (`viewed`, subject = the entry, purpose `Audit log review`); turn it off with `->logViews(false)`
- Translations for 17 more languages: ar, az, de, es, fa, fr, hi, it, ja, nl, pl, pt, ru, tr, uk, uz, zh_CN (19 in total with en and pt_BR)

## 2.0.0 - 2026-11-16

Filament 4: audit trail viewer for [laravel-lgpd-audit-log](https://github.com/jeffersongoncalves/laravel-lgpd-audit-log).

- Every entry: when, who, action, data subject, columns (names only) and purpose; filters by action and subject model
- View page with IP address, user agent, metadata and hash
- Verify chain: tells which entry was altered, removed or inserted
- Read-only, like the append-only log
- English and Brazilian Portuguese

## [Unreleased]
