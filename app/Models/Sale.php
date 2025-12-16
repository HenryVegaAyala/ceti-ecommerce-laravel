<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $table = 'sales';

    protected $fillable = ['user_id', 'serial', 'date_created', 'status', 'total_amount'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'];
}
