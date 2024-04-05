<?php

namespace App\Admin\Http\Controllers\Blog\DanhMuc;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\DanhMuc\DanhMucRepositoryInterface;
use App\Admin\Http\Resources\DanhMuc\DanhMucSearchSelectResource;

class DanhMucSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        DanhMucRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => DanhMucSearchSelectResource::collection($this->instance)
        ];
    }
}
