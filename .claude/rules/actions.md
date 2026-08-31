# Action Class Guidelines

## Single `handle()` Method Principle

Action classes in this project MUST follow the single `handle()` method principle.

## Rules

1. **Only ONE public method**: Action classes should only expose a single public `handle()` method
2. **No public getters**: Configuration or helper values should not be exposed via public getter methods
3. **No public constants for config**: Application-wide configuration values belong in config files, not as class constants
4. **Return all needed data**: If consumers need multiple pieces of data, return them all from `handle()`
5. **Never return a plain array**: `handle()` must return a Spatie Data Object (see `.claude/rules/data-objbects.md`), a single scalar/model, or `void`. Never return a bare `array`. An array return type is always a sign the result needs a named Data Object instead.

## Where to Put Configuration Values

- **App-wide settings**: Use `config/*.php` files (e.g., `config/developer.php`)
- **Action-specific constants**: Keep as `private const` if only used internally within the action

## Example of Correct Action Class

```php
<?php

declare(strict_types=1);

namespace App\Actions\Developer;

use App\Data\Developer\ProfileCompletenessData;
use App\Models\DeveloperProfile;

final class CalculateSomething
{
    /**
     * Internal constant - private, not exposed.
     */
    private const int THRESHOLD = 50;

    public function handle(DeveloperProfile $profile): ProfileCompletenessData
    {
        $result = $this->calculate($profile);
        $metadata = $this->getMetadata($profile);

        return new ProfileCompletenessData(
            result: $result,
            metadata: $metadata,
            meetsThreshold: $result >= self::THRESHOLD,
        );
    }

    /**
     * Private helper methods are allowed.
     */
    private function calculate(DeveloperProfile $profile): int
    {
        // Implementation
    }

    private function getMetadata(DeveloperProfile $profile): array
    {
        // Implementation
    }
}
```

## Anti-Patterns to Avoid

```php
// BAD: Public getter method
public function getMinimumValue(): int
{
    return self::MINIMUM_VALUE;
}

// BAD: Public constant for app-wide config
public const int MINIMUM_VALUE = 70;

// BAD: Multiple public methods
public function handle(): void { }
public function getResult(): array { }
public function validate(): bool { }

// BAD: handle() returns a plain array instead of a Data Object
public function handle(Model $model): array
{
    return ['primary_result' => $primary, 'secondary_result' => $secondary];
}
```

## Using Config for App-Wide Values

When a value needs to be accessed from multiple places (actions, components, views), store it in a config file:

```php
// config/developer.php
return [
    'profile' => [
        'minimum_completeness' => 70,
    ],
];

// Usage anywhere in the app
$minimum = config('developer.profile.minimum_completeness');
```

## Return Structure Best Practices

When an action needs to return multiple pieces of information, define a Data Object for it (per `.claude/rules/data-objbects.md`) and return that — never a bare array:

```php
// app/Data/SomeDomain/CalculationResultData.php
final class CalculationResultData extends Data
{
    public function __construct(
        public readonly int $primaryResult,
        public readonly int $secondaryResult,
        public readonly int $derivedValue,
    ) {}
}

// app/Actions/SomeDomain/CalculateSomething.php
public function handle(Model $model): CalculationResultData
{
    $primary = $this->calculatePrimary($model);
    $secondary = $this->calculateSecondary($model);

    return new CalculationResultData(
        primaryResult: $primary,
        secondaryResult: $secondary,
        derivedValue: $primary + $secondary,
    );
}
```

Consumers get typed, IDE-discoverable properties instead of magic string keys:

```php
$result = $action->handle($model);
$primaryOnly = $result->primaryResult;
```

