<?php

namespace App\Admin\DataTables\Blog\BaiViet;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\DanhMuc\DanhMucRepositoryInterface;
use App\Admin\Repositories\BaiViet\BaiVietRepositoryInterface;
use App\Enums\DefaultStatus;

class BaiVietDataTable extends BaseDataTable
{

    protected $nameTable = 'baivietTable';

    protected $repoCat;

    public function __construct(
        BaiVietRepositoryInterface $repository,
        DanhMucRepositoryInterface $repoCat
    ){
        $this->repository = $repository;

        $this->repoCat = $repoCat;

        parent::__construct();
    }

    public function setView(){
        $this->view = [
            'action' => 'admin.baiviet.datatable.action',
            'feature_image' => 'admin.baiviet.datatable.feature-image',
            'title' => 'admin.baiviet.datatable.title',
            'status' => 'admin.baiviet.datatable.status',
            'danhmuc' => 'admin.baiviet.datatable.danhmuc',
            'checkbox' => 'admin.baiviet.datatable.checkbox',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [2, 3, 4, 5];

        $this->columnSearchDate = [5];

        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => DefaultStatus::asSelectArray()
            ],
        ];

        $this->columnSearchSelect2 = [
            [
                'column' => 4,
                'data' => $this->repoCat->getFlatTree()->map(function($category){
                    return [$category->id => generate_text_depth_tree($category->depth).$category->name];
                })
            ]
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getByQueryBuilder([], ['danhmuc']);
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.baiviet', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'feature_image' => $this->view['feature_image'],
            'title' => $this->view['title'],
            'status' => $this->view['status'],
            'danhmuc' => $this->view['danhmuc'],
            'created_at' => '{{ format_date($created_at) }}',
            'checkbox' => $this->view['checkbox'],
        ];
    }
    protected function setCustomFilterColumns()
    {
        $this->customFilterColumns = [
            'danhmuc' => function($query, $keyword) {
                $query->whereHas('danhmuc', function($q) use($keyword) {
                    $q->whereIn('id', explode(',', $keyword));
                });
            }
        ];
    }
    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['checkbox', 'feature_image', 'title', 'status', 'danhmuc', 'action'];
    }
}
