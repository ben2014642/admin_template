<?php

namespace App\Admin\DataTables\Employee;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Employee\EmployeeRepositoryInterface;
use App\Enums\Gender;

class EmployeeDataTable extends BaseDataTable
{

    protected $nameTable = 'employeeTable';

    public function __construct(
        EmployeeRepositoryInterface $repository
    ){
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView(){
        $this->view = [
            'action' => 'admin.employees.datatable.action',
            'username' => 'admin.employees.datatable.username',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0, 1, 2, 3, 4];


        $this->columnSearchSelect = [
            [
                'column' => 4,
                'data' => Gender::asSelectArray()
            ]
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.employee', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'username' => $this->view['username'],
            'gender' => function($employee){
                return $employee->gender->description();
            },
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['username', 'action'];
    }
}
