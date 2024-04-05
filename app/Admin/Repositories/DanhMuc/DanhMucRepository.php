<?php

namespace App\Admin\Repositories\DanhMuc;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\DanhMuc\DanhMucRepositoryInterface;
use App\Models\DanhMuc;

class DanhMucRepository extends EloquentRepository implements DanhMucRepositoryInterface
{
    public function getModel()
    {
        return DanhMuc::class;
    }
    public function getFlatTreeNotInNode(array $nodeId)
    {
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->whereNotIn('id', $nodeId)
            ->withDepth()
            ->get()
            ->toFlatTree();
        return $this->instance;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){
        $this->instance = $this->model;
        $this->getQueryBuilderFindByKey($keySearch);

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('name', 'LIKE', '%'.$key.'%');
        });
    }

    public function getFlatTree()
    {
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->withDepth()
            ->get()
            ->toFlatTree();
        return $this->instance;
    }
}
