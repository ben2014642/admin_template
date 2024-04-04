<?php

namespace App\Admin\Repositories\Employee;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface EmployeeRepositoryInterface extends EloquentRepositoryInterface
{
	public function count();
	public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
