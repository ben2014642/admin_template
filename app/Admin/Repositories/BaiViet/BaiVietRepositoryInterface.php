<?php

namespace App\Admin\Repositories\BaiViet;
use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\BaiViet;

interface BaiVietRepositoryInterface extends EloquentRepositoryInterface
{
    public function updateMultipleBy(array $filter = [], array $data);
    public function attachCategories(BaiViet $post, array $categoriesId);
    public function attachTag(BaiViet $post, array $tagId);
    public function syncCategories(BaiViet $post, array $categoriesId);
    public function syncTag(BaiViet $post, array $tagId);
}
