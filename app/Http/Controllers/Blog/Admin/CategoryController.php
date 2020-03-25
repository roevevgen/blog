<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $item = BlogCategory::findOrFail($id);
//        $item = BlogCategory::find($id);
//        $item = BlogCategory::where('id', $id)->first();
//        dd(collect($item)->pluck('id'));
        $categoryList = BlogCategory::all();

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
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->fill($data)->save();
        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }else {
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
