<?php

namespace App\Http\Services\Dashboard\BookStore;

use App\Repository\BookUserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookStoreService
{

    private BookUserRepositoryInterface $bookUserRepository;

    public function __construct(BookUserRepositoryInterface $bookUserRepository)
    {
        $this->bookUserRepository = $bookUserRepository;
    }

    public function toggleActivate($id){
        $sell = $this->bookUserRepository->getById($id);
        try {
            DB::beginTransaction();
            $sell->update(['is_active' => !$sell->is_active]);
            DB::commit();
            return back()->with('success' , __('messages.updated successfully'));
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error' , __('messages.Something went wrong'));
        }
    }
}
