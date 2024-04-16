<?php

use App\Http\Controllers\Bank\BankController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\BookStore\BookStoreController;
use App\Http\Controllers\Dashboard\Cart\CartController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\Contact\ContactController;
use App\Http\Controllers\Dashboard\Coupon\CouponController;
use App\Http\Controllers\Dashboard\Course\AttachmentController;
use App\Http\Controllers\Dashboard\Course\BookController;
use App\Http\Controllers\Dashboard\Course\BookPartController;
use App\Http\Controllers\Dashboard\Course\BookSolutionsController;
use App\Http\Controllers\Dashboard\Course\CourseController;
use App\Http\Controllers\Dashboard\Course\TrainingBagController;
use App\Http\Controllers\Dashboard\CourseBankQuestion\CourseBankQuestionController;
use App\Http\Controllers\Dashboard\Exam\ExamController;
use App\Http\Controllers\Dashboard\Exam\QuestionController;
use App\Http\Controllers\Dashboard\Field\FieldController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Info\InfoController;
use App\Http\Controllers\Dashboard\Inquiry\InquiryController;
use App\Http\Controllers\Dashboard\Lecture\LectureController;
use App\Http\Controllers\Dashboard\Manager\AdminController;
use App\Http\Controllers\Dashboard\Manager\CustomController;
use App\Http\Controllers\Dashboard\Manager\ManagerController;
use App\Http\Controllers\Dashboard\Manager\TeacherController;
use App\Http\Controllers\Dashboard\PrintRequest\PrintRequestController;
use App\Http\Controllers\Dashboard\Payment\PaymentController;
use App\Http\Controllers\Dashboard\Roles\RolesController;
use App\Http\Controllers\Dashboard\Standard\StandardController;
use App\Http\Controllers\Dashboard\Structure\CommonQuestionController;
use App\Http\Controllers\Dashboard\Structure\AboutUsController;
use App\Http\Controllers\Dashboard\Structure\ContactUsController;
use App\Http\Controllers\Dashboard\Structure\PrivacyAndPolicyController;
use App\Http\Controllers\Dashboard\Structure\TermsConditionsController;
use App\Http\Controllers\Dashboard\Student\StudentController;
use App\Http\Controllers\Dashboard\Subscriptions\CourseSubscriptionController;
use App\Http\Controllers\Dashboard\DeviceToken\DeviceTokenController;
use App\Jobs\AddUsers;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group( [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [AuthController::class, '_login']);
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', [HomeController::class, 'index'])->name('/');

        Route::resource('roles' , RolesController::class);

        Route::get('student/export/{type}', [StudentController::class, 'export'])->name('student.export');
        Route::resource('student', StudentController::class);
        Route::get('login-from-admin/{id}' , [StudentController::class , 'loginFromAdmin'])->name('student.loginFromAdmin');

        Route::group(['prefix' => 'managers'], function () {

            Route::get('teachers/export/{type}', [TeacherController::class, 'export'])->name('teachers.export');
            Route::resource('teachers', TeacherController::class)->parameters(['teachers' => 'manager']);

            Route::get('admins/export/{type}', [AdminController::class, 'export'])->name('admins.export');
            Route::resource('admins', AdminController::class)->parameters(['admins' => 'manager']);

            Route::controller(CustomController::class)
                ->as('customs.')
                ->group(function () {
                    Route::get('{role:name}/export/{type}', '_export')->name('export');
                    Route::get('{role:name}', 'index')->name('index');
                    Route::get('{role:name}/create', 'create')->name('create');
                    Route::get('{role:name}/{manager:id}', '_show')->name('show');
                    Route::post('{role:name}', 'store')->name('store');
                    Route::get('{role:name}/{manager:id}/edit', '_edit')->name('edit');
                    Route::put('{role:name}/{manager:id}/update', '_update')->name('update');
                    Route::delete('{role:name}/{manager:id}', '_destroy')->name('destroy');
                })
                ->middleware('validate.role');

        });

        Route::get('fields/export/{type}', [FieldController::class, 'export'])->name('fields.export');
        Route::resource('fields', FieldController::class);

        Route::get('categories/export/{type}', [CategoryController::class, 'export'])->name('categories.export');
        Route::resource('categories', CategoryController::class);

        Route::get('courses/export/{type}', [CourseController::class, 'export'])->name('courses.export');
        Route::resource('courses', CourseController::class);


        Route::get('books/export/{type}', [BookController::class, 'export'])->name('books.export');
        Route::resource('books' , BookController::class);

        Route::resource('bags' , TrainingBagController::class);

        Route::controller(BookPartController::class)->prefix('parts')->group(function (){
            Route::get('/{book_id}' , 'create')->name('parts.create');
            Route::post('/' , 'store')->name('parts.store');
            Route::get('/{id}/edit' , 'edit')->name('parts.edit');
            Route::put('/{id}' , 'update')->name('parts.update');
            Route::delete('/{id}' , 'destroy')->name('parts.destroy');
        });

        Route::resource('courses/{course:id}/solutions' , BookSolutionsController::class);

        Route::resource('courses/{course:id}/attachments', AttachmentController::class)->except('index');

        Route::get('standards/export/{type}', [StandardController::class, 'export'])->name('standards.export');
        Route::resource('standards', StandardController::class);

        Route::get('lectures/export/{type}', [LectureController::class, 'export'])->name('lectures.export');
        Route::resource('lectures', LectureController::class);

        Route::get('exams/export/{type}', [ExamController::class, 'export'])->name('exams.export');
        Route::get('exams/preview/{id}' , [ExamController::class , 'preview'])->name('exams.preview');
        Route::resource('exams' , ExamController::class);

        ######### Add Bank Questions To Exam ####################################
        Route::group(['prefix' => 'exam-bank-questions'], function () {
            Route::get('create/{id}', [ExamController::class, 'createBankQuestions'])->name('exam-bank-questions.create');
            Route::post('store/{id}', [ExamController::class, 'storeBankQuestions'])->name('exam-bank-questions.store');
        });

        Route::get('getBankQuestionsByCourse', [ExamController::class, 'getBankQuestionsByCourse'])->name('getBankQuestionsByCourse');



        Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
            Route::post('standards', [StandardController::class, 'fetch'])->name('standards.fetch');
            Route::post('lectures', [LectureController::class, 'fetch'])->name('lectures.fetch');
        });

        Route::get('coupons/export/{type}', [CouponController::class, 'export'])->name('coupons.export');

        Route::resource('exams/{exam:id}/questions', QuestionController::class)->except(['index', 'show']);

        Route::resource('courses/{course:id}/course_bank_questions', CourseBankQuestionController::class)->except(['index', 'show']);//Bank Questions

        Route::resource('coupons' , CouponController::class);


        Route::get('banks/export/{type}', [BankController::class, 'export'])->name('banks.export');

        Route::resource('banks' , BankController::class)->except('show');


        Route::get('payments/export/{type?}', [PaymentController::class, 'exportPayments'])->name('payments.exportPayments');


        Route::controller(PaymentController::class)
            ->prefix('payments')
            ->as('payments.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{payment:id}', 'show')->name('show');
                Route::put('/{payment:id}/confirm', 'confirm')->name('confirm');
                Route::put('/{payment:id}/decline', 'decline')->name('decline');
                Route::post('/confirm-course', 'confirmCourse')->name('confirmCourse');
                Route::post('/confirm-book', 'confirmBook')->name('confirmBook');
            });

        Route::get('bank_transfers/export/{type}', [PaymentController::class, 'exportBank'])->name('payments.exportTransfers');

        Route::get('/bank-transfers', [PaymentController::class , 'bankTransfersIndex'])->name('bank_transfers.index');

        Route::get('carts/export/{type}', [CartController::class, 'export'])->name('carts.export');

        Route::resource('carts' , CartController::class);


        Route::get('print-requests/books/export/{type}', [PrintRequestController::class, 'exportBooks'])->name('requests.exportBooks');
        Route::get('print-requests/certificates/export/{type}', [PrintRequestController::class, 'exportCertificates'])->name('requests.exportCertificates');


        Route::controller(PrintRequestController::class)->prefix('print-requests')->as('requests.')->group(function (){
            Route::get('/books' , 'indexBooks')->name('books.index');
            Route::get('/certificates' , 'indexCertificates')->name('certificates.index');
            Route::get('/{id}' , 'show')->name('show');
            Route::put('/{id?}' , 'changeStatus')->name('changeStatus');
            Route::delete('/{id}' , 'destroy')->name('destroy');
        });

        Route::get('inquiries/export/{type}', [InquiryController::class, 'export'])->name('inquiries.export');

        Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'update', 'destroy']);

        Route::prefix('content')->group(function (){
            Route::resource('home' , \App\Http\Controllers\Dashboard\Structure\HomeController::class )->only('index' , 'store');
            Route::resource('privacy' , PrivacyAndPolicyController::class )->only('index' , 'store');
            Route::resource('about-us', AboutUsController::class)->only('index', 'store');
            Route::resource('contact-us', ContactUsController::class)->only('index', 'store');
            Route::resource('common-questions' , CommonQuestionController::class )->only('index' , 'store');
            Route::resource('terms-conditions' , TermsConditionsController::class )->only('index' , 'store');
        });

        Route::get('contacts/export/{type}', [ContactController::class, 'export'])->name('contacts.export');

        Route::resource('contacts' , ContactController::class)->only('index' , 'show' , 'update' , 'destroy');
        Route::get('devicetokens' , [DeviceTokenController::class,'edit'])->name('devicetokens.edit');
        Route::post('sendsubscribe' , [DeviceTokenController::class,'sendsubscribe'])->name('devicetokens.sendsubscribe');
        Route::post('sendnotsubscribe' , [DeviceTokenController::class,'sendnotsubscribe'])->name('devicetokens.sendnotsubscribe');
        Route::post('sendnotregister' , [DeviceTokenController::class,'sendnotregister'])->name('devicetokens.sendnotregister');

        Route::get('courses_subscriptions/export/{type}', [CourseSubscriptionController::class, 'export'])->name('courses_subscriptions.export');
        Route::resource('courses_subscriptions' , CourseSubscriptionController::class)->except('create' , 'store');

        Route::controller(CourseSubscriptionController::class)->prefix('subscriptions')->group(function (){
            Route::put('toggle/{id}' , 'toggleActivate')->name('subscription.toggle');
            Route::post('addTrial' , 'addTrial')->name('subscription.addTrial');
            Route::delete('{id}' , 'destroy')->name('subscription.destroy');
        });

        Route::get('book_store/export/{type}', [BookStoreController::class, 'export'])->name('book_store.export');
        Route::controller(BookStoreController::class)->prefix('book_store')->group(function (){
            Route::get('index' ,  'index')->name('book_store.index');
            Route::put('toggle/{id}' , 'toggleActivate')->name('book_store.toggle');
        });

        Route::group(['prefix' => 'infos', 'as' => 'infos.', 'controller' => InfoController::class], function () {
            Route::get('edit','edit')->name('edit');
            Route::post('update','update')->name('update');
        });

    });

});
