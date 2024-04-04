<?php

namespace App\Admin\Http\Requests\Employee;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Employee\EmployeeRole;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Gender;

class EmployeeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'username' => [
                'required',
                'string', 'min:6', 'max:50',
                'unique:App\Models\Employee,username',
                'regex:/^[A-Za-z0-9_-]+$/',
                function ($attribute, $value, $fail) {
                    if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
                        $fail('The '.$attribute.' cannot be a common keyword.');
                    }
                },
            ],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'gender' => ['required', new Enum(Gender::class)],
            'roles' => ['required', new Enum(EmployeeRole::class)],
            'password' => ['required', 'string', 'confirmed'],
            'date' => ['required', 'date_format:Y-m-d']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Employee,id'],
            'username' => [
                'required',
                'string', 'min:6', 'max:50',
                'unique:App\Models\Employee,username,'.$this->id,
                'regex:/^[A-Za-z0-9_-]+$/',
                function ($attribute, $value, $fail) {
                    if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
                        $fail('The '.$attribute.' cannot be a common keyword.');
                    }
                },
            ],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email,'.$this->id],
            'gender' => ['required', new Enum(Gender::class)],
            'roles' => ['required', new Enum(EmployeeRole::class)],
            'password' => ['nullable', 'string', 'confirmed'],
            'date' => ['required', 'date_format:Y-m-d']
        ];
    }
}
