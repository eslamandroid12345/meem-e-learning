<?php

namespace App\Http\Services\Dashboard\Standard;

use App\Http\Requests\Dashboard\Standard\StandardRequest;
use App\Repository\StandardRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Exception;

class StandardService
{
    private StandardRepositoryInterface $standardRepository;

    public function __construct(
        StandardRepositoryInterface $standardRepository,
    )
    {
        $this->standardRepository = $standardRepository;
    }

    public function store(StandardRequest $request) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $this->standardRepository->create($data);
            DB::commit();
            return redirect()->route('standards.create', ['course_id' => request('course_id')])->with(['success' => __('messages.Standard created successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('standards.create')->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update(StandardRequest $request, $id) {
        $data = $request->validated();
        $standard = $this->standardRepository->getById($id);
        abort_unless(Gate::allows('control-course', $standard->course), 401);
        DB::beginTransaction();
        try {
            $standard->update($data);
            DB::commit();
            return redirect()->route('standards.update', $id)->with(['success' => __('messages.Standard updated successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('standard.update', $id)->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id) {
        $standard = $this->standardRepository->getById($id);
        abort_unless(Gate::allows('control-course', $standard->course), 401);
        DB::beginTransaction();
        try {
            if (Gate::allows('delete-standard', $standard)) {
                $standard->delete();
                DB::commit();
                return redirect()->route('standards.index')->with(['success' => __('messages.Standard deleted successfully')]);
            } else {
                abort(401);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('standard.index')->with(['error' => __('messages.Something went wrong')]);
        }
    }

}
