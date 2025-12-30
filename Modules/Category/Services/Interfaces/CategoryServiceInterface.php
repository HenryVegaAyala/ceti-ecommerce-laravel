<?php

namespace App\Modules\Category\Services\Interfaces;

interface CategoryServiceInterface
{
    public function getAllCategories(): mixed;

    public function getCategoryById(int $id): mixed;

    public function createCategory(array $data): mixed;

    public function updateCategory(int $id, array $data): mixed;

    public function deleteCategory(int $id): mixed;
}
