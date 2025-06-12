<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        // йіцвйцв
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();



        $item = (new BlogCategory())->create($data);

        if ($item) {
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успішно збережено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Помилка збереження'])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox($item->parent_id);
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запис id=[{$id}] не знайдено"])
                ->withInput();
        }

        $data = $request->all();


        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успішно збережено']);
        } else {
            return back()
                ->with(['msg' => 'Помилка збереження'])
                ->withInput();
        }
    }
    public function destroy(string $id)
    {

    }
}
