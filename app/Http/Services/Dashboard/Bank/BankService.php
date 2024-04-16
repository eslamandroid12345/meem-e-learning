<?php

namespace App\Http\Services\Dashboard\Bank;

use App\Http\Requests\Dashboard\Bank\BankRequest;
use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\BankRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BankService
{
    private BankRepositoryInterface $bankRepository;
    private FileManagerService $fileManager;

    public function __construct(BankRepositoryInterface $categoryRepository , FileManagerService $fileManager){
        $this->bankRepository = $categoryRepository;
        $this->fileManager = $fileManager;
    }

    public function store(BankRequest $request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request['is_active'] == 'on';
            if($request->image !== null){
                $data['image'] = $this->fileManager->handle('image', 'banks');
            }
            $this->bankRepository->create($data);
            DB::commit();
            return redirect()->route('banks.index')->with(['success' => __('messages.Bank created successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update($id , BankRequest $request){
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['is_active'] = $request['is_active'] == 'on';
            if($request->image !== null){
                $data['image'] = $this->fileManager->handle('image', 'banks');
            }
            $this->bankRepository->update($id , $data);
            DB::commit();
            return redirect()->route('banks.index')->with(['success' => __('messages.Bank updated successfully')]);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function delete($id) {
        try {
            $category = $this->bankRepository->delete($id);
            return redirect()->route('banks.index')->with(['success' => __('messages.Bank deleted successfully')]);

        }catch (\Exception $e){
            return redirect()->route('banks.index')->with(['error' => __('messages.Something went wrong')]);

        }

    }
}
