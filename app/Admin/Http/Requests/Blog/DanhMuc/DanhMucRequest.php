<?php

namespace App\Admin\Http\Requests\Blog\DanhMuc;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\DefaultStatus;
use App\Admin\Rules\Category\CategoryParent;
use Illuminate\Validation\Rules\Enum;

class DanhMucRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:App\Models\DanhMuc,id'],
            'position' => ['required', 'integer'],
            'status' => ['required', new Enum(DefaultStatus::class)]
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\DanhMuc,id'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:App\Models\DanhMuc,slug,'.$this->id],
            'parent_id' => ['nullable', 'exists:App\Models\DanhMuc,id', new CategoryParent($this->id)],
            'position' => ['nullable', 'integer'],
            'status' => ['required', new Enum(DefaultStatus::class)]
        ];
    }
}
