# Changelog

All notable changes to this project will be documented in this file.

## 1.1.0 - 2026-11-16

- Opening an audit entry in the panel is logged too (`viewed`, subject = the entry, purpose `Audit log review`); turn it off with `->logViews(false)`
- Translations for 17 more languages: ar, az, de, es, fa, fr, hi, it, ja, nl, pl, pt, ru, tr, uk, uz, zh_CN (19 in total with en and pt_BR)

## 1.0.0 - 2026-11-16

Filament 3: audit trail viewer for [laravel-lgpd-audit-log](https://github.com/jeffersongoncalves/laravel-lgpd-audit-log).

- Every entry: when, who, action, data subject, columns (names only) and purpose; filters by action and subject model
- View page with IP address, user agent, metadata and hash
- Verify chain: tells which entry was altered, removed or inserted
- Read-only, like the append-only log
- English and Brazilian Portuguese

## [Unreleased]
