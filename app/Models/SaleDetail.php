<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $table = 'sale_details';

    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price', 'discount'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'];
}
