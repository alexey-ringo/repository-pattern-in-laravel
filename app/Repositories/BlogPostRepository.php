<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogPostRepository
 * 
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
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
     * getAllWithPaginate
     *
     * 
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(): LengthAwarePaginator
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',            
        ];
        
        $result = $this->startConditions()
                       ->select($columns)
                       ->orderBy('id', 'DESC')
                    //   ->with(['category', 'user'])
                       ->with([
                           //1st variant
                           'category' => function($query) {
                               $query->select(['id', 'title']);
                           },                           
                           //2d, more optimal variant
                           'user:id,name'
                       ]) 
                       ->paginate(25);
        
        return $result;

    }
}