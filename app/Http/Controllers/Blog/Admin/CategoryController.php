<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use App\Http\Controllers\Blog\Admin\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use Str;

/**
 * Category management class
 *
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view ('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        //$item = new BlogCategory($data);
        //$item->save();

        $item = (new BlogCategory())->create($data);

        if($item) {
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        }
        else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if(empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $result = $item->fill($data)->save();
        //$result = $item->update($data);

        if($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }
        else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
