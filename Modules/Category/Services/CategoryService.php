<?php

namespace App\Modules\Category\Services;

use App\Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Modules\Category\Services\Interfaces\CategoryServiceInterface;

readonly class CategoryService implements CategoryServiceInterface
{

    public function __construct(public CategoryRepositoryInterface $categoryRepository)
    {

    }

    public function getAllCategories(): mixed
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategoryById(int $id): mixed
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function createCategory(array $data): mixed
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function updateCategory(int $id, array $data): mixed
    {
        return $this->categoryRepository->updateCategory($id, $data);
    }

    public function deleteCategory(int $id): mixed
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
