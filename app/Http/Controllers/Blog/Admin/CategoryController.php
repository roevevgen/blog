<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);
//        $paginator = BlogCategory::all();


        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Создаст объект но не добавит в БД
//        $item = new BlogCategory($data);
//        $item->save();

        // Создаст объект и добавит в объект
        $item = (new BlogCategory())->create($data);

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохраненно']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {

//        $item = BlogCategory::findOrFail($id);
//        $item = BlogCategory::find($id);
//        $item = BlogCategory::where('id', $id)->first();
//        dd(collect($item)->pluck('id'));
//        $categoryList = BlogCategory::all();

        $item = $categoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);

        }
        $categoryList = $categoryRepository->getForCombox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /*  $rules = [
              'title' => 'required|min:5|max:200',
              'slug' => 'max:200',
              'description' => 'string|max:500|min:3',
              'parent_id' => 'required|integer|exists:blog_categories,id'
          ];*/

//        $validateData = $this->validate($request, $rules);

//        $validateData = $request->validate($rules);

        /*   $validator = Validator::make($request->all(), $rules);
           $validateData[] = $validator->passes();
           $validateData[] = $validator->validate();
           $validateData[] = $validator->valid();
           $validateData[] = $validator->failed();
           $validateData[] = $validator->errors();
           $validateData[] = $validator->fails();

           dd($validateData); */
        $item = BlogCategory::find($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $item->update($data);

//        $result = $item->fill($data)->save();
        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
