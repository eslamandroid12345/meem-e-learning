<?php

namespace App\Http\Services\Dashboard\Categories;

use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CategoryService
{
    private CategoryRepositoryInterface $categoryRepository;
    private FileManagerService $fileManager;

    public function __construct(CategoryRepositoryInterface $categoryRepository , FileManagerService $fileManager){
        $this->categoryRepository = $categoryRepository;
        $this->fileManager = $fileManager;
    }

    public function store(CategoryRequest $request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request['is_active'] == 'on';
            if($request->image !== null){
                $data['image'] = $this->fileManager->handle('image', 'categories');
            }
            $this->categoryRepository->create($data);
            DB::commit();
            return redirect()->route('categories.index')->with(['success' => __('messages.Category created successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update($id , CategoryRequest $request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request['is_active'] == 'on';
            if($request->image !== null){
                $data['image'] = $this->fileManager->handle('image', 'fields');
            }
            $this->categoryRepository->update($id , $data);
            DB::commit();
            return redirect()->route('categories.index')->with(['success' => __('messages.Category updated successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }


    public function delete($id) {
        $category = $this->categoryRepository->getById($id);
        if (Gate::allows('delete-category', $category)) {
            $category->delete();
            return redirect()->route('categories.index')->with(['success' => __('messages.Category deleted successfully')]);
        } else {
            return redirect()->route('categories.index')->with(['error' => __('messages.Category cannotBeDeleted')]);
        }
    }
}
