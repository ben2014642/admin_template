<?php

namespace App\Http\Controllers\Blog;

use App\Admin\Http\Controllers\Controller;
use App\Repositories\Blog\BaiVietRepositoryInterface;

class BlogController extends Controller
{
    protected $repoPost;

    public function __construct(
        BaiVietRepositoryInterface $repoPost,
    ) {
        parent::__construct();
        $this->repoPost = $repoPost;
    }
    public function getView()
    {
        return [
            'index' => 'public.posts.index',
            'detail' => 'public.posts.detail',
            'cate' => 'public.posts.post-by-cate',
        ];
    }
    public function getRoute()
    {
        return [];
    }
    public function index()
    {
        $posts = $this->repoPost->paginate([], [], []);
        $breadcrums = [['label' => trans('Tin tức')]];
        return view($this->view['index'], [
            'posts' => $posts,
            'breadcrums' => $breadcrums,
        ]);
    }

    public function showPost($slug)
    {

        $posts = $this->repoPost->findByOrFail(['slug' => $slug], ['danhmuc']);
        $breadcrums = [
            [
                'label' => 'Bài viết',
                'url' => route('post.index'),
            ],
            ['label' => $posts->title],
        ];
        $related = $this->repoPost->getByLimit([
            ['id', '!=', $posts->id]
        ], [
            'danhmuc' => fn ($q) => $q->whereIn('id', $posts->danhmuc->pluck('id')->toArray())
    ], [], 5);
    return view($this->view['detail'], [
        'posts' => $posts,
        'related' => $related,
        'breadcrums' => $breadcrums,
    ]);
    }
}
