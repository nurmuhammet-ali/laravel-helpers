<?php

namespace Nurmuhammet\Helpers\Models;

use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'device',
        'important'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'important' => 'bool'
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        return config('helpers.api.app_versions_table');
    }

    /**
     * Default rules
     * 
     * @return array
     */
    public static function defaultRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'device' => ['required', 'string', 'max:255'],
            'important' => ['required', 'boolean']
        ];
    }
}
