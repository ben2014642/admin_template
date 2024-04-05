<?php

namespace App\Admin\Http\Requests\Blog\BaiViet;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\DefaultStatus;
use Illuminate\Validation\Rules\Enum;

class BaiVietRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'categories_id' => ['required', 'array'],
            'categories_id.*' => ['required', 'exists:App\Models\DanhMuc,id'],
            'tag_id' => ['nullable', 'array'],
            'tag_id.*' => ['nullable', 'exists:App\Models\Tag,id'],
            'title' => ['required', 'string'],
            'feature_image' => ['required'],
            'status' => ['required', new Enum(DefaultStatus::class)],
            'excerpt' => ['nullable'],
            'content' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\BaiViet,id'],
            'categories_id' => ['required', 'array'],
            'categories_id.*' => ['required', 'exists:App\Models\DanhMuc,id'],
            'tag_id' => ['nullable', 'array'],
            'tag_id.*' => ['nullable', 'exists:App\Models\Tag,id'],
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:App\Models\BaiViet,slug,' . $this->id],
            'feature_image' => ['required'],
            'status' => ['required', new Enum(DefaultStatus::class)],
            'excerpt' => ['nullable'],
            'content' => ['nullable']
        ];
    }
}
