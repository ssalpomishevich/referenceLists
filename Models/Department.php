<?php namespace Larapage\Modules\ReferenceLists\Models;

use Larapage\System\Models\BaseModel;

class Department extends BaseModel
{
    protected $table = "departments";
    protected $fillable = ['name'];

}
