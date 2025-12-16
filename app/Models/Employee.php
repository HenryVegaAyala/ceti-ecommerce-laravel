<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $table = 'employees';

    protected $fillable = ['names', 'last_name_father', 'last_name_mother', 'document_number', 'email', 'number_phone', 'address'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'];
}
