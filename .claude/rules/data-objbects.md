# Spatie Data Objects Usage Guideline

## 1. Purpose

This guideline ensures that all structured data in the application is passed and returned as **Spatie Data Objects** for compatibility, type safety, and consistency.

---

## 2. Core Principle

* **All inputs** must be **Data Objects**, never arrays.
* **All outputs** should return **Data Objects** where applicable.
* Arrays are only allowed at the API boundary for JSON serialization.

Flow:

```
Data Object → Business Logic → Data Object
```

---

## 3. Input Example

Convert raw arrays to Data Objects at the earliest point:

```php
use App\Data\UserData;

public function createUser(UserData $data): UserData
{
    $user = User::create([
        'name' => $data->name,
        'email' => $data->email,
    ]);

    return UserData::from($user);
}
```

Controller usage:

```php
$data = UserData::from($request->all());
return $userService->createUser($data);
```

---

## 4. Return Example

Always return Data Objects internally:

```php
public function getUser(int $id): UserData
{
    $user = User::findOrFail($id);

    return UserData::from($user);
}
```

* Convert to array only at the API layer with `$userData->toArray()` for JSON.

---

## 5. Benefits

* Strong typing and IDE support.
* Safe refactoring.
* Predictable structure.
* Built-in validation.
* Compatibility across services, jobs, queues, and events.

---

## 6. Optional API Layer

```php
return response()->json($userData->toArray());
```

Internally, all layers remain as Data Objects.

---

## 7. Folder & Naming Conventions

* Folder: `app/Data/`
* Naming: `SomethingData`
* Properties: all Data Object properties must be declared as `public readonly`

Examples:

```
UserData
OrderData
PaymentData
DeliveryRequestData
```

---

## 8. Property Visibility and Immutability

All Data Objects must use constructor-promoted `public readonly` properties.

Example:

```php
final class UserData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}
```

---

## 9. Standardized Rule Summary

| Stage               | Format                  |
| ------------------- | ----------------------- |
| Internal input      | Data Object             |
| Internal processing | Data Object             |
| Internal output     | Data Object             |
| API response        | Optional: `->toArray()` |

---

## 10. Forbidden Patterns

❌ Passing raw arrays through layers.
❌ Returning mixed structures (models, arrays, objects) internally.
❌ Declaring mutable Data Object properties (non-readonly).

Always normalize using **Data Objects**.

---

