# Hello, laravel devs.

#### This package just contains helpers to make development enjoyable, easy and of course to make life a better place to live

## Helper functions
```php
# Generate random hex color 
randomHex(): string
# Example:
randomHex() // #FDA01E 

# Round number
round_up(int|float $number, int $precision = 2): float
# Example:
round_up(2) # 2.0
round_up(2.3) # 2.3
round_up(2.33) # 2.4
round_up(2.335) # 2.4
round_up(2.335, 2) # 2.4
round_up(2.335, 4) # 2.335
round_up(2.335, 3) # 2.34

# Return current route name
currentRoute(): ?string
# Example:
currentRoute() # 'web.users.profile'

# Checks is current route name matches with argument(s)
currentRouteIs(string|array $name): bool
# Example:
currentRouteIs('web.users.profile') # true
currentRouteIs(['web.users.profile'. 'web.users.profile.edit']) # true

# Log all database queries
logDB(): void
# Example:
logDB() # main .log file should log all db queries, run this function inside AppServiceProvider
```

## Helper Macros
```php
# Makes json responses more clean, pragmatic
Response::rest(mixed $data = [], int $status_code = 200, string $message = 'success')
# Example:
response()->rest(Post::all())
response()->rest([], 201)
response()->rest([], 201, 'created resource')

# Makes json paginated responses more clean, pragmatic
Response::rest_paginate(mixed $data, int $status_code = 200, string $message = 'success')
# Example:
response()->rest_paginate(Post::paginate(20))

# Provides ordering by translations for spatie translatable, supported databases: ['postgres']
Moodel::orderByTranslation($field, $order = 'asc', $locale = null): Illuminate\Database\Eloquent\Builder
# Example:
Post::orderByTranslation()->get()

# Get table name statically for model
Moodel::tableName(): string
# Example
Product::tableName() // 'products'

# Get table coloumns for model
Moodel::getColumns(): array
# Example
Post::getColumns() # ['id', 'name', 'slug', ...]
```
