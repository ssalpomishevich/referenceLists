<?php  namespace Larapage\ReferenceLists\Repositories\Departments;

use Larapage\Modules\ReferenceLists\Repositories\Departments\DepartmentInterface;
use Larapage\System\Repositories\Core\RepositoriesAbstract;

class EloquentDepartment extends RepositoriesAbstract implements DepartmentInterface
{
    public function __construct($model)
    {
        $this->model = $model;
    }


}
