<?php

namespace App\Admin\Http\Controllers\Blog\BaiViet;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Blog\BaiViet\BaiVietRequest;
use App\Admin\Http\Requests\Blog\Post\PostRequest;
use App\Admin\Repositories\BaiViet\BaiVietRepositoryInterface;
use App\Admin\Repositories\DanhMuc\DanhMucRepositoryInterface;
use App\Admin\Services\Blog\BaiViet\BaiVietServiceInterface;
use App\Admin\DataTables\Blog\BaiViet\BaiVietDataTable;
use App\Admin\Repositories\Tag\TagRepositoryInterface;
use App\Enums\DefaultStatus;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    protected $repoCat;

    protected $repoTag;

    public function __construct(
        BaiVietRepositoryInterface $repository,
        DanhMucRepositoryInterface $repoCat,
        TagRepositoryInterface $repoTag,
        BaiVietServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;
        $this->repoCat = $repoCat;
        $this->repoTag = $repoTag;
        $this->service = $service;
    }

    public function getView(){

        return [
            'index' => 'admin.baiviet.index',
            'create' => 'admin.baiviet.create',
            'edit' => 'admin.baiviet.edit'
        ];
    }

    public function getRoute(){

        return [
            'index' => 'admin.blog.baiviet.index',
            'create' => 'admin.blog.baiviet.create',
            'edit' => 'admin.blog.baiviet.edit',
            'delete' => 'admin.blog.baiviet.delete'
        ];
    }
    public function index(BaiVietDataTable $dataTable){

        $actionMultiple = [
            'delete' => trans('delete'),
            'publishedStatus' => DefaultStatus::Published->description(),
            'draftStatus' => DefaultStatus::Draft->description()
        ];
        return $dataTable->render($this->view['index'], [
            'actionMultiple' => $actionMultiple,
            'breadcrums' => $this->crums->add(__('blog'))->add(__('baiviet'))
        ]);
    }

    public function create(){

        $categories = $this->repoCat->getFlatTree();

        return view($this->view['create'], [
            'categories' => $categories,
            'status' => DefaultStatus::asSelectArray(),
            'breadcrums' => $this->crums->add(__('blog'))->add(__('post'), route($this->route['index']))->add(__('add'))
        ]);
    }

    public function store(BaiVietRequest $request){

        $response = $this->service->store($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){

        $categories = $this->repoCat->getFlatTree();

        $post = $this->repository->findOrFail($id, ['danhmuc', 'tags']);

        return view(
            $this->view['edit'],
            [
                'categories' => $categories,
                'post' => $post,
                'status' => DefaultStatus::asSelectArray(),
                'breadcrums' => $this->crums->add(__('blog'))->add(__('post'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }

    public function update(PostRequest $request){

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

    public function actionMultipleRecode(Request $request){

        $response = $this->service->actionMultipleRecode($request);

        if($response){

            return $response;
        }

        return back()->with('error', __('notifyFail'));
    }
}
