<?php

namespace App\Http\Controllers\Dashboard\Inquiry;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Inquiry\InquiryRequest;
use App\Http\Services\Dashboard\Inquiry\InquiryService;
use App\Http\Services\Mutual\ExportService;
use App\Repository\CourseInquireRepositoryInterface;
use App\Repository\CourseRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class InquiryController extends Controller
{
    private CourseInquireRepositoryInterface $courseInquireRepository;
    private CourseRepositoryInterface $courseRepository;
    protected InquiryService $inquiry;
    private ExportService $export;

    public function __construct(
        CourseInquireRepositoryInterface $courseInquireRepository,
        CourseRepositoryInterface $courseRepository,
        InquiryService $inquiryService,
        ExportService $export,
    )
    {
        $this->middleware('auth:manager');
        $this->middleware('permission:inquiries-read')->only('index' , 'show');
        $this->middleware('permission:inquiries-update')->only(['show', 'update']);
        $this->middleware('permission:inquiries-delete')->only('destroy');
        $this->courseInquireRepository = $courseInquireRepository;
        $this->courseRepository = $courseRepository;
        $this->inquiry = $inquiryService;
        $this->export = $export;
    }

    public function index()
    {
        $inquiries = $this->courseInquireRepository->getManagerInquiries();
        $courses = $this->courseRepository->getAll(['id' , 'name_ar' , 'name_en']);
        return view('dashboard.site.inquiries.index', ['inquiries' => $inquiries , 'courses' => $courses]);
    }

    public function show($id)
    {
        $inquiry = $this->courseInquireRepository->getById($id);
        abort_unless(Gate::allows('control-course', $inquiry->course), 403);
        if (Gate::allows('operate-inquiry', $inquiry)) {
            return view('dashboard.site.inquiries.show', ['inquiry' => $inquiry]);
        } else {
            abort(403);
        }
    }

    public function update(InquiryRequest $request, $id)
    {
        return $this->inquiry->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->inquiry->destroy($id);
    }

    public function export(string $type)
    {
        $inquiries = $this->courseInquireRepository->managerInquiries()->get();
        $data = [
            'inquiries' => $inquiries
        ];

        return $this->export->handle('inquiries', 'dashboard.site.inquiries.export', $data, 'inquiries', $type);
    }
}
