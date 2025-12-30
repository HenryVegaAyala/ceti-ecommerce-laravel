<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Modules\Category\Services\Interfaces\CategoryServiceInterface;
use App\Modules\Config\Controller\ApiController;
use App\Resources\Category\GetAllCategoriesResource;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function __construct(readonly CategoryServiceInterface $categoryService)
    {
    }

    public function index()
    {
        $response = $this->categoryService->getAllCategories();

        return $this->successResponse(GetAllCategoriesResource::collection($response));
    }

    public function show($id)
    {
        $response = $this->categoryService->getCategoryById($id);

        return $this->successResponse($response);
    }

    public function store(CategoryStoreRequest $request)
    {
        $response = $this->categoryService->createCategory($request->all());

        return $this->successResponse($response);
    }

    public function update($id, Request $request)
    {
        $response = $this->categoryService->updateCategory($id, $request->all());

        return $this->successResponse($response);
    }

    public function destroy($id)
    {
        $response = $this->categoryService->deleteCategory($id);

        return $this->successResponse($response);
    }
}
