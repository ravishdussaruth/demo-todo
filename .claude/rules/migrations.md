# Migration Guidelines

## Use `$table->foreignIdFor()` for Foreign Keys

Always use `$table->foreignIdFor(Model::class)` instead of `$table->foreignUuid()` or `$table->foreignId()` with a string column name.

```php
// Good
$table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
$table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();

// Avoid
$table->foreignUuid('tenant_id')->constrained('tenants')->cascadeOnDelete();
$table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
```

**Why**: `$table->foreignIdFor()` auto-resolves the column name and type from the model, reducing hardcoded strings and ensuring consistency across the codebase.

## Order Migrations by FK Dependency

Migrations must run in dependency order. If table B has a FK to table A, migration B must have a later timestamp than migration A.

Common ordering for this project:

| Timestamp | Tables |
|-----------|--------|
| `0001_01_01_*` | `users`, `tenants`, `sessions`, etc. (framework base) |
| `102921` | `social_accounts` (depends on `tenants`) |
| `102922` | `campaigns`, `conversations`, `media_assets` (depend on `tenants`) |
| `102923` | `prompts`, `aggregated_metrics` (depend on `tenants`/`users`) |
| `102924` | `generated_contents` (→`prompts`), `messages` (→`conversations`) |
| `102925` | `posts` (→`generated_contents`, `social_accounts`, `users`) |
| `102926` | `metrics`, `campaign_posts`, `post_logs`, `ai_recommendations`, `replies` |
| `1743xx` | Ads tables (`ad_accounts`, `ad_campaigns`, etc.) |

## Always Use `constrained()` with FKs

Always chain `->constrained()` on FK columns to auto-link to the referenced table. Always specify deletion behavior:

```php
$table->foreignIdFor(Tenant::class)->constrained()->cascadeOnDelete();
$table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
```

## Indexes

Add indexes on columns used in `WHERE`, `ORDER BY`, and `JOIN` conditions. Add compound indexes when multiple columns are used together:

```php
$table->index(['tenant_id', 'platform']);
$table->index(['post_id', 'recorded_at']);
```

## Never Modify Production Migrations

Do not edit migrations that have already run in production. If a column is missing, create a new `add_*_to_*_table` migration.

## One Concern Per Migration

Each migration should create or modify one table. Do not mix DDL for multiple tables in a single migration file.

