<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Category;
use App\Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Modules\Config\Repository\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    /**
     * Constructor function for the class.
     *
     * @param Category $model The model instance to be injected.
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getAllCategories()
    {
        return  $this->model->newQuery()->get();
    }

    public function getCategoryById(int $id)
    {
        return $this->model->newQuery()->where([['id', $id]])->first();
    }

    public function createCategory(array $data)
    {
        return $this->model->newQuery()->create($data);
    }

    public function updateCategory(int $id, array $data)
    {
        return $this->model->newQuery()->where([['id', $id]])->update($data);
    }

    public function deleteCategory(int $id)
    {
       return$this->model->newQuery()->where([['id', $id]])->delete();
    }
}
