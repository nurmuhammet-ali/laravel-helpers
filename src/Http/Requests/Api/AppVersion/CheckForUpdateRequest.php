<?php

namespace Nurmuhammet\Helpers\Http\Requests\Api\AppVersion;

use Illuminate\Foundation\Http\FormRequest;
use Nurmuhammet\Helpers\Models\AppVersion;

class CheckForUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'version' => ['required', 'string', 'max:255'],
            'device' => ['required', 'string', 'max:255'],
        ];
    }
}
