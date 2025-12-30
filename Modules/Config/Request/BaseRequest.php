<?php

namespace App\Modules\Config\Request;

use App\Traits\ApiResponse\JsonResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    use JsonResponseTrait;
}
