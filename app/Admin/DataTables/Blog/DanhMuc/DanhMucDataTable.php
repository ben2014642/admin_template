<?php

namespace App\Admin\DataTables\Blog\DanhMuc;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\DanhMuc\DanhMucRepositoryInterface;

class DanhMucDataTable extends BaseDataTable
{

    protected $nameTable = 'danhmucTable';

    public function __construct(
        DanhMucRepositoryInterface $repository
    ){
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView(){
        $this->view = [
            'action' => 'admin.danhmuc.datatable.action',
            'name' => 'admin.danhmuc.datatable.name',
            'status' => 'admin.danhmuc.datatable.status',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0];

        // $this->columnSearchSelect = [
        //     [
        //         'column' => 1,
        //         'data' => DefaultStatus::asSelectArray()
        //     ],
        // ];
    }

    public function query()
    {
        $query = $this->repository->getFlatTree();
        return $query;
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.danhmuc', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'status' => $this->view['status'],
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function startBuilderDataTable($query){
        $this->instanceDataTable = datatables()->collection($query);
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['name', 'status', 'action'];
    }
}
