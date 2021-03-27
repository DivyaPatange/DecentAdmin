<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\JuniorAdmissionController;
use App\Http\Controllers\Admin\FeeHeadController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\PayController;
use App\Http\Controllers\Admin\AllotmentController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\InwardController;
use App\Http\Controllers\Admin\OutwardController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\PrimarySchoolController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\TeachersController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubjectTeacherController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\IssueBookController;
use App\Http\Controllers\Admin\LibraryFineController;

// Parent Controller
use App\Http\Controllers\Auth\ParentLoginController;
use App\Http\Controllers\Auth\ParentController;
use App\Http\Controllers\Auth\ParentRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.login');
});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return 'DONE'; //Return anything
});

Route::get('/routeList', function () {
    $exitCode = Artisan::call('route:list');
    return Artisan::output(); //Return anything
});

Route::get('/seed', function () {
    $exitCode = Artisan::call('db:seed');
    return 'DONE'; //Return anything
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/enquiry', [App\Http\Controllers\EnquiryController::class, 'create']);
Route::post('/enquiry/save', [App\Http\Controllers\EnquiryController::class, 'store'])->name('enquiry.submit');

Route::prefix('admin')->name('admin.')->group(function() {
    // Admin Authentication Route
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Teachers Route
    Route::resource('/teachers', TeachersController::class);
    Route::get('/teachers/status/{id}', [TeachersController::class, 'status']);

    // Academic Year Route
    Route::resource('/academic-year', AcademicYearController::class);
    Route::post('/get-academic-year', [AcademicYearController::class, 'getAcademicYear'])->name('get.academic-year');
    Route::post('/academic-year/update', [AcademicYearController::class, 'updateAcademicYear']);
    // Subject Route
    Route::resource('/subjects', SubjectController::class);
    Route::post('/get-subject', [SubjectController::class, 'getSubject'])->name('get.subject');
    Route::post('/subject/update', [SubjectController::class, 'updateSubject']);
    Route::get('/subjects/status/{id}', [SubjectController::class, 'status']);

    // Subject Teacher Route
    Route::resource('/subject-teacher', SubjectTeacherController::class);
    Route::get('/subject-teacher/status/{id}', [SubjectTeacherController::class, 'status']);
    Route::get('/get-subject-list', [SubjectTeacherController::class, 'getSubjectList']);


    // Section Route
    Route::resource('/sections', SectionController::class);
    Route::post('/get-section', [SectionController::class, 'getSection'])->name('get.section');
    Route::post('/section/update', [SectionController::class, 'updateSection']);
    Route::get('/sections/status/{id}', [SectionController::class, 'status']);
    // Class Route
    Route::resource('/class', ClassController::class);
    Route::post('/get-class', [ClassController::class, 'getClass'])->name('get.class');
    Route::post('/class/update', [ClassController::class, 'updateClass']);

    // Fee Head Route
    Route::resource('/fee-head', FeeHeadController::class);
    Route::post('/get-fee-head', [FeeHeadController::class, 'getFeeHead'])->name('get.fee-head');
    Route::post('/fee-head/update', [FeeHeadController::class, 'updateFeeHead']);

    // Add Fee Route
    Route::resource('/fee', FeeController::class);
    Route::post('/get-fee', [FeeController::class, 'getFee'])->name('get.fee');
    Route::post('/fee/update', [FeeController::class, 'updateFee']);

    // Add Fee Route
    Route::resource('/payment', PayController::class);
    Route::post('/get-payment', [PayController::class, 'getPayment'])->name('get.payment');
    Route::get('/receipt/{id}', [PayController::class, 'receipt']);
    Route::post('/receipt/save', [PayController::class, 'receiptSave'])->name('receipt.save');
    Route::get('/demo', function(){
        return view('admin.payment.demo');
    });
    Route::get('/get-student-list', [PayController::class, 'getStudentList']);
    Route::get('/get-student-name', [PayController::class, 'getStudentName']);
    Route::get('/get-fee-amount', [PayController::class, 'getFeeAmount']);
    Route::get('/pay-due-amount/{id}', [PayController::class, 'showDueAmountForm'])->name('due_amount.get');

    Route::get('/primary-school-list', [PayController::class, 'primarySchoolList'])->name('primary-school-list');
    Route::get('/school-payment/{id}', [PayController::class, 'getSchoolPayment']);
    Route::post('/get-school-payment', [PayController::class, 'getSchoolPaymentDetails'])->name('get.school-payment');

    // Allotment Route
    Route::resource('/allotment', AllotmentController::class);

    // Visitor Route
    Route::resource('/visitor', VisitorController::class);
    Route::post('/get-visitor', [VisitorController::class, 'getVisitor'])->name('get.visitor');
    Route::post('/visitor/update', [VisitorController::class, 'updateVisitor']);

    // Inward Document Management Route
    Route::resource('/inward', InwardController::class);
    Route::post('/get-inward', [InwardController::class, 'getInward'])->name('get.inward');
    Route::post('/inward/update', [InwardController::class, 'updateInward']);

    // Outward Document Management Route
    Route::resource('/outward', OutwardController::class);
    Route::post('/get-outward', [OutwardController::class, 'getOutward'])->name('get.outward');
    Route::post('/outward/update', [OutwardController::class, 'updateOutward']);

    // Certificate Route
    Route::get('/junior-certificate', [CertificateController::class, 'index'])->name('certificate.index');
    Route::get('/junior-bonafide-certificate/{id}', [CertificateController::class, 'jrBonafideCertificate'])->name('junior-bonafide.certificate');
    Route::get('/junior-character-certificate/{id}', [CertificateController::class, 'jrCharacterCertificate'])->name('junior-character.certificate');
    Route::get('/junior-leaving-certificate/{id}', [CertificateController::class, 'jrLeavingCertificate'])->name('junior-leaving.certificate');
    Route::post('/junior-leaving-certificate/save', [CertificateController::class, 'jrLeavingCertificateSave'])->name('junior-leaving.save');

    // User Route
    Route::resource('/users', UserController::class);

    // Master Document Route
    Route::resource('/documents', DocumentController::class);
    Route::post('/get-document', [DocumentController::class, 'getDocument'])->name('get.document');
    Route::post('/document/update', [DocumentController::class, 'updateDocument']);

    // Admission Route
    Route::resource('/admission', AdmissionController::class);
    Route::post('/junior-admission/store', [AdmissionController::class, 'storeJuniorAdmission']);
    Route::post('/primary-admission/store', [AdmissionController::class, 'storePrimaryAdmission']);
    Route::put('/junior-admission/update/{id}', [AdmissionController::class, 'updateJuniorAdmission'])->name('junior-admission.update');
    Route::put('/primary-admission/update/{id}', [AdmissionController::class, 'updatePrimaryAdmission'])->name('primary-admission.update');
    Route::get('/admission/status/{id}', [AdmissionController::class, 'status']);

    // Parents Route
    Route::resource('/parents', App\Http\Controllers\Admin\ParentController::class);

    // Students Route
    Route::resource('/students', StudentController::class);
    Route::get('/get-section-list', [StudentController::class, 'getSectionList']);
    Route::get('/students/status/{id}', [StudentController::class, 'status']);

    // Book Route
    Route::resource('/books', BookController::class);

    // Book Issue Route
    Route::resource('/book-issue', IssueBookController::class);
    Route::get('/book-issue/status/{id}', [IssueBookController::class, 'status']);

    // Library Fine Route
    Route::resource('/library-fine', LibraryFineController::class);

});

Route::prefix('parent')->name('parent.')->group(function() {
    // Admin Authentication Route
    Route::get('/login', [ParentLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ParentLoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [ParentRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [ParentRegisterController::class, 'register'])->name('register.submit');
    Route::get('/', [ParentController::class, 'index'])->name('dashboard');
    Route::get('/logout', [ParentLoginController::class, 'logout'])->name('logout');

    // Admission Route
    Route::resource('/admission', App\Http\Controllers\Parent\AdmissionController::class);
    Route::post('/junior-admission/store', [App\Http\Controllers\Parent\AdmissionController::class, 'storeJuniorAdmission']);
    Route::post('/primary-admission/store', [App\Http\Controllers\Parent\AdmissionController::class, 'storePrimaryAdmission']);
    Route::put('/junior-admission/update/{id}', [App\Http\Controllers\Parent\AdmissionController::class, 'updateJuniorAdmission'])->name('junior-admission.update');
    Route::put('/primary-admission/update/{id}', [App\Http\Controllers\Parent\AdmissionController::class, 'updatePrimaryAdmission'])->name('primary-admission.update');

});
