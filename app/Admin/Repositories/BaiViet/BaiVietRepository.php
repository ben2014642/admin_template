<?php

namespace App\Admin\Repositories\BaiViet;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\BaiViet\BaiVietRepositoryInterface;
use App\Models\BaiViet;

class BaiVietRepository extends EloquentRepository implements BaiVietRepositoryInterface
{

    public function getModel()
    {
        return BaiViet::class;
    }

    public function updateMultipleBy(array $filter = [], array $data)
    {

        $this->instance = $this->model;

        $this->applyFilters($filter);

        $this->instance = $this->instance->update($data);
        return $this->instance;
    }

    public function attachCategories(BaiViet $post, array $categoriesId)
    {
        return $post->danhmuc()->attach($categoriesId);
    }

    public function attachTag(BaiViet $post, array $tagId)
    {
        return $post->tags()->attach($tagId);
    }

    public function syncCategories(BaiViet $post, array $categoriesId)
    {
        return $post->danhmuc()->sync($categoriesId);
    }

    public function syncTag(BaiViet $post, array $tagId)
    {
        return $post->tags()->sync($tagId);
    }
}
