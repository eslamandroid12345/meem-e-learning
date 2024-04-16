<?php

namespace App\Http\Services\Dashboard\Fields;

use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use App\Http\Requests\Dashboard\Fields\FieldRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\FieldRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FieldService
{
    private FieldRepositoryInterface $fieldRepository;
    private FileManagerService $fileManager;

    public function __construct(FieldRepositoryInterface $fieldRepository , FileManagerService $fileManager){
        $this->fieldRepository = $fieldRepository;
        $this->fileManager = $fileManager;
    }

    public function store(FieldRequest $request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request['is_active'] == 'on';
            $data['show_in_navbar'] = $request['show_in_navbar'] == 'on';
            $data['show_department'] = $request['show_department'] == 'on';
            if($request->image !== null)
            {
                $data['image'] = $this->fileManager->handle('image', 'fields');
            }
            $this->fieldRepository->create($data);
            DB::commit();
            return redirect()->route('fields.index')->with(['success' => __('messages.Field created successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update($id , FieldRequest $request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['common_questions'] = $data['common_questions'] ?? null;
            $data['is_active'] = $request['is_active'] == 'on';
            $data['show_in_navbar'] = $request['show_in_navbar'] == 'on';
            $data['show_department'] = $request['show_department'] == 'on';
            if($request->image !== null){
                $data['image'] = $this->fileManager->handle('image', 'fields');
            }
            $this->fieldRepository->update($id , $data);
            DB::commit();
            return redirect()->route('fields.index')->with(['success' => __('messages.Field updated successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function delete($id) {
        $field = $this->fieldRepository->getById($id);
        if (Gate::allows('delete-field', $field)) {
            $field->delete();
            return redirect()->route('fields.index')->with(['success' => __('messages.Field deleted successfully')]);
        } else {
            return redirect()->route('fields.index')->with(['error' => __('messages.Field cannotBeDeleted')]);
        }
    }
}
