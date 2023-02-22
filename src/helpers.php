<?php 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

if (! function_exists('randomHex')) {
    /**
     * Generate random hex color
     * 
     * Exmaple:
     * randomHex() -> # #FDA01E
     * 
     * @return string
     */
    function randomHex(): string
    {
       $chars = 'ABCDEF0123456789';
       $color = '#';
       for ( $i = 0; $i < 6; $i++ ) {
          $color .= $chars[rand(0, strlen($chars) - 1)];
       }
       
       return $color;
    }
}

if (! function_exists('round_up')) {
    /**
     * Rounds number up
     * 
     * round_up(2) -> 2.0
     * round_up(2.3) -> 2.3
     * round_up(2.33) -> 2.4
     * round_up(2.335) -> 2.4
     * round_up(2.335, 2) -> 2.4
     * round_up(2.335, 4) -> 2.335
     * round_up(2.335, 3) -> 2.34
     * 
     * @param int|float $number
     * @param int $precision
     *
     * @return float
     */
    function round_up(int|float $number, int $precision = 2): float
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
}

if (! function_exists('currentRoute')) {
    /**
     * Return current route name
     * 
     * currentRoute() -> 'profile'
     *
     * @return ?string
     */
    function currentRoute(): ?string
    {
        return Illuminate\Support\Facades\Route::currentRouteName();
    }
}

if (! function_exists('currentRoute')) {
    /**
     * Checks is current route name matches with argument(s)
     * 
     * currentRouteIs('profile') -> true
     * currentRouteIs(['profile'. 'orders']) -> true
     *
     * @return ?string
     */
    function currentRouteIs(string|array $name): bool
    {
        return is_string($name) 
            ? $name == currentRoute() 
            : in_array(currentRoute(), $name);
    }
}

if (! function_exists('logDB')) {
    /**
     * Logs all database queries
     * 
     * logDB() -> main .log should log all db queries
     *
     * @return void
     */
    function logDB(): void
    {
        DB::listen(function ($query) {
            Log::info(
                $query->sql, $query->bindings, $query->time
            );
        });
    }
}

if (! function_exists('getAllAttributesFor')) {
    /**
     * Get all attributes for Model
     * 
     * getAllAttributesFor(Product::class) -> ['id', 'name', ...]
     *
     * @return array
     */
    function getAllAttributesFor(string $model): array
    {
        return Schema::getColumnListing((new $model)->getTable());
    }
}

