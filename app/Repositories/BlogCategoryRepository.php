<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 * 
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Get Model for edit in AdminPanel
     * 
     * @param int $id
     * 
     * @return Model
     */
    public function getEdit(int $id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * getForComboBox
     *
     * @return Collection
     */
    public function getForComboBox(): \Illuminate\Support\Collection
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        //$result[] = $this->startConditions()->all();

        //$result[] = $this
        //    ->startConditions()
        //    ->select('blog_categories.*',
        //        \DB::raw('CONCAT (id, ". ", title) AS id_title'))
        //    ->toBase()
        //    ->get();

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();        

        return $result;
    }
    
    /**
     * getAllWithPaginate
     *
     * @param  int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(int $perPage = null): LengthAwarePaginator
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            /*...*/
            ->paginate($perPage);

        return $result;

    }
}