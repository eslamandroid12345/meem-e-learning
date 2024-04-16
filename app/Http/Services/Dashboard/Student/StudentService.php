<?php

namespace App\Http\Services\Dashboard\Student;

use App\Http\Requests\Dashboard\Student\StudentRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\UserAddressRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StudentService
{

    private UserRepositoryInterface $userRepository;
    protected FileManagerService $fileManager;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FileManagerService $fileManagerService,
    )
    {
        $this->userRepository = $userRepository;
        $this->fileManager = $fileManagerService;
    }

    public function store(StudentRequest $request) {
        DB::beginTransaction();
        try {
            $studentData = $request->validated();
            $studentData['is_active'] = $request->is_active == 'on';

            $studentAddresses = $request->address ?? [];
            if($request->image !== null) {
                $studentData['image'] = $this->fileManager->handle('image', 'profiles/students/images');
            }

            $student = $this->userRepository->create($studentData);;
            $this->syncStudentAddresses($student, $studentAddresses);
            DB::commit();
            return redirect()->route('student.create')->with(['success' => __('messages.Student created successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('student.create')->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update(StudentRequest $request, $id) {
        $student = $this->userRepository->getById($id);
        DB::beginTransaction();
        try {
            $studentData = $request->validated();
            $studentData['is_active'] = $request->is_active == 'on';

            $studentAddresses = $request->address ?? [];

            if($request->image !== null) {
                $studentData['image'] = $this->fileManager->handle('image', 'profiles/students/images', $student->image);
            }
            if($studentData['password'] == null){
                unset($studentData['password']);
            }

            $student->update($studentData);
            $this->syncStudentAddresses($student, $studentAddresses);
            DB::commit();
            return redirect()->route('student.index')->with(['success' => __('messages.Student updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('student.update', $id)->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function delete($id) {
        DB::beginTransaction();
        try {
            $this->userRepository->delete($id, ['image']);
            DB::commit();
            return redirect()->route('student.index')->with(['success' => __('messages.Student deleted successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('student.index')->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function syncStudentAddresses($student, $addresses) {
        $student->addresses()->delete();
        foreach ($addresses as $address) {
            if (!empty($address)) {
                $student->addresses()->create([
                    'content' => $address,
                ]);
            }
        }
    }
}
