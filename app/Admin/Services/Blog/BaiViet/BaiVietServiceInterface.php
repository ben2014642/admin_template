<?php

namespace App\Admin\Services\Blog\BaiViet;
use Illuminate\Http\Request;

interface BaiVietServiceInterface
{
    public function store(Request $request);
    public function update(Request $request);
    public function delete($id);
    public function actionMultipleRecode(Request $request);
}
