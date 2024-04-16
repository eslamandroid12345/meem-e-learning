<?php

namespace App\Http\Services\Dashboard\Managers;

use App\Http\Requests\Dashboard\Managers\ManagerRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\Eloquent\ManagerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ManagerService
{
    private ManagerRepository $managerRepository;
    private FileManagerService $fileManager;

    public function __construct(ManagerRepository $managerRepository , FileManagerService $fileManager){
        $this->managerRepository = $managerRepository;
        $this->fileManager = $fileManager;
    }

    public function store(ManagerRequest $request ,$role ){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if($request->image !== null){
                $data['image'] = $this->fileManager->handle('image', 'profiles/managers/images');
            }
            if($request->cv_pdf !== null){
                $data['cv_pdf'] = $this->fileManager->handle('cv_pdf', 'profiles/managers/cvs');
            }
            $manager = $this->storeManager($data);
            $manager->attachRole($role);
            DB::commit();
            return Route::has($role . 's.index')
                ? redirect()->route($role . 's.index')->with(['success' => __('messages.'. ucfirst($role) .' created successfully')])
                : redirect()->route('customs.index', request()->route('role'))->with(['success' => __('messages.created successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }


    private function storeManager($data){
        return $this->managerRepository->create($data);
    }

    public function update(ManagerRequest $request , $id ){
        $manager = $this->managerRepository->getById($id);
        $role = $manager->getRoles()[0];
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if($request->image !== null) {
                $data['image'] = $this->fileManager->handle('image', 'profiles/managers/images', $manager->image);
            }
            if($request->cv_pdf !== null){
                $data['cv_pdf'] = $this->fileManager->handle('cv_pdf', 'profiles/managers/cvs', $manager->cv_pdf);
            }
            if($data['password'] == null){
                unset($data['password']);
            }
            $manager->update($data);
            DB::commit();
            return Route::has($role . 's.index')
                ? redirect()->route($role . 's.index')->with(['success' => __('messages.' . ucfirst($role) .' updated successfully')])
                : redirect()->route('customs.index', request()->route('role'))->with(['success' => __('messages.updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return Route::has($role . 's.index')
                ? redirect()->route($role . 's.edit', [request()->route('role'), $id])->with(['error' => __('messages.Something went wrong')])
                : redirect()->route('customs.edit', [request()->route('role'), $id])->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function delete($id) {
        $manager = $this->managerRepository->getById($id);
        $role = $manager->getRoles()[0];
        DB::beginTransaction();
        try {
            $this->managerRepository->delete($id, ['image', 'cv_pdf']);
            DB::commit();
            return Route::has($role . 's.index')
                ? redirect()->route($role . 's.index')->with(['success' => __('messages.' . ucfirst($role) .' deleted successfully')])
                : redirect()->route('customs.index', request()->route('role'))->with(['success' => __('messages.deleted successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return Route::has($role . 's.index')
                ? redirect()->route($role . 's.index')->with(['error' => __('messages.Something went wrong')])
                : redirect()->route('customs.index', request()->route('role'))->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
