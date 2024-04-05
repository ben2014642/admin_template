<?php

namespace App\Admin\Http\Controllers\Blog\DanhMuc;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Blog\DanhMuc\DanhMucRequest;
use App\Admin\Repositories\DanhMuc\DanhMucRepositoryInterface;
use App\Admin\Services\Blog\DanhMuc\DanhMucServiceInterface;
use App\Admin\DataTables\Blog\DanhMuc\DanhMucDataTable;
use App\Enums\DefaultStatus;

class DanhMucController extends Controller
{
    public function __construct(
        DanhMucRepositoryInterface $repository,
        DanhMucServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(){

        return [
            'index' => 'admin.danhmuc.index',
            'create' => 'admin.danhmuc.create',
            'edit' => 'admin.danhmuc.edit'
        ];
    }

    public function getRoute(){

        return [
            'index' => 'admin.blog.danhmuc.index',
            'create' => 'admin.blog.danhmuc.create',
            'edit' => 'admin.blog.danhmuc.edit',
            'delete' => 'admin.blog.danhmuc.delete'
        ];
    }
    public function index(DanhMucDataTable $dataTable){

        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('blog'))->add(__('category'))
        ]);
    }

    public function create(){

        $categories = $this->repository->getFlatTree();

        return view($this->view['create'], [
            'categories' => $categories,
            'status' => DefaultStatus::asSelectArray(),
            'breadcrums' => $this->crums->add(__('blog'))->add(__('category'), route($this->route['index']))->add(__('add'))
        ]);
    }

    public function store(DanhMucRequest $request){

        $response = $this->service->store($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){

        $categories = $this->repository->getFlatTreeNotInNode([$id]);

        $category = $this->repository->findOrFail($id);

        return view(
            $this->view['edit'],
            [
                'category' => $category,
                'categories' => $categories,
                'status' => DefaultStatus::asSelectArray(),
                'breadcrums' => $this->crums->add(__('blog'))->add(__('category'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }

    public function update(DanhMucRequest $request){

        $response = $this->service->update($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
