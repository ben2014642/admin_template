<?php

namespace App\Admin\Repositories\Employee;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Employee\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository extends EloquentRepository implements EmployeeRepositoryInterface
{

    public function getModel(){
        return Employee::class;
    }
    public function count(){
        return $this->model->count();
    }
    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){

        $this->instance = $this->model;

        $this->getQueryBuilderFindByKey($keySearch);

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('username', 'LIKE', '%'.$key.'%')
                ->orWhere('email', 'LIKE', '%'.$key.'%')
                ->orWhere('gender', $key);
        });
    }
}
