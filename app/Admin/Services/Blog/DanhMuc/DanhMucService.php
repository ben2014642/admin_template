<?php

namespace App\Admin\Services\Blog\DanhMuc;

use App\Admin\Services\Blog\DanhMuc\DanhMucServiceInterface;
use  App\Admin\Repositories\DanhMuc\DanhMucRepositoryInterface;
use Illuminate\Http\Request;

class DanhMucService implements DanhMucServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(DanhMucRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){

        $this->data = $request->validated();

        return $this->repository->create($this->data);
    }

    public function update(Request $request){

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}
