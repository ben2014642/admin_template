<?php

namespace App\Admin\Repositories\DanhMuc;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface DanhMucRepositoryInterface extends EloquentRepositoryInterface
{
    public function getFlatTreeNotInNode(array $nodeId);
    public function searchAllLimit($value = '', $meta = [], $limit = 10);

    public function getFlatTree();
}
