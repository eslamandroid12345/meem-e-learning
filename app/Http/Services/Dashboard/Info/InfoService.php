<?php

namespace App\Http\Services\Dashboard\Info;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\FileManager;
use App\Repository\InfoRepositoryInterface;
use Illuminate\Support\Facades\DB;

class InfoService
{
    use FileManager;
    public function __construct(private InfoRepositoryInterface $infoRepository,private FileManagerService $fileManagerService)
    {

    }

    public function edit()
    {
        $text=$this->infoRepository->getText();
        $images=$this->infoRepository->getImages();
        return view('dashboard.site.infos.edit', compact('text','images'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $this->updateText($request->text);
            $this->updateImages($request->images);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
//            dd($e);
            return baxck()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function updateText($array){
        foreach ($array ?? [] as $key => $value){
            $this->infoRepository->updateValues($key,$value);
        }
    }
    public function updateImages($array){
        foreach ($array ?? [] as $key => $value){
            $value=$this->fileManagerService->handle('images.' . $key , folderName : 'images/info_control');
            $this->infoRepository->updateValues($key,$value);
        }
    }
}
