# Naming Conventions

## PHP Variables and Functions/Methods: camelCase

All PHP variable names and function/method names MUST use camelCase, never `snake_case`.

```php
// Good
$planPriceId = $data['plan_price_id'];
$organizationCurrency = strtoupper($organization->currency);

function calculateTotalPrice(int $quantity, int $unitPriceMinor): int
{
    return $quantity * $unitPriceMinor;
}

// Avoid
$plan_price_id = $data['plan_price_id'];
$organization_currency = strtoupper($organization->currency);

function calculate_total_price(int $quantity, int $unit_price_minor): int
{
    return $quantity * $unit_price_minor;
}
```

This applies to local variables, method parameters, and function/method names everywhere in `app/`, `database/`, `tests/`, and `routes/`.

## Exception: keys that mirror an external contract

Array keys and Data Object properties that mirror something outside the PHP code itself stay in whatever case that external thing uses — renaming them would be misleading, not clean:

- Database column names (`$data['plan_price_id']`, `$model->created_at`) — Laravel's own convention, and Eloquent/migrations use `snake_case` columns throughout this project.
- Raw request/validated-array keys that map 1:1 to a column or an external API field (`$request->validate(['plan_price_id' => ...])`).
- Payloads sent to or received from the engine API or other third-party services, which use their own casing.

Only the **PHP identifier itself** (the variable or function/method name) must be camelCase — the string key inside an array literal is data, not an identifier, and stays whatever case the thing it represents uses.

```php
// Good: camelCase variable, snake_case DB/array key preserved
$planPriceId = $data['plan_price_id'];
$workloadPlanAssignment = WorkloadPlanAssignment::create(['plan_price_id' => $planPriceId]);
```
