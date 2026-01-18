<?php

use App\Http\Controllers\Admin\Admin_members;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonarController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TaxCertificateController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CrowdfundingTeamController;
use App\Http\Controllers\Admin\GoalController;
use App\Http\Controllers\Admin\ProjectLocationController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\BeneficiaryController;
use App\Http\Controllers\Admin\AuditReportController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ComplianceDocumentController;
use App\Http\Controllers\Admin\FrontEnd;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\App;


Route::get('/index', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/members', [Admin_members::class, 'index'])->name('admin.members.index');
    Route::get('admin/members/create', [Admin_members::class, 'create'])->name('admin.members.create');
    Route::get('admin/members/edit/{id}', [Admin_members::class, 'edit'])->name('admin.members.edit');
    Route::get('admin/members/show/{id}', [Admin_members::class, 'show'])->name('admin.members.show');
    Route::delete('admin/members/destroy/{id}', [Admin_members::class, 'destroy'])->name('admin.members.destroy');
    Route::get('admin/members/export/csv', [Admin_members::class, 'exportCsv'])->name('admin.members.export.csv');
    Route::get('admin/members/export/pdf', [Admin_members::class, 'exportPdf'])->name('admin.members.export.pdf');
    Route::post('admin/members/toggle-status/{id}', [Admin_members::class, 'toggleStatus'])->name('admin.members.toggle.status');
    Route::get('admin/members/{id}/qr', [Admin_members::class, 'generateQr'])->name('admin.members.qr');
    Route::get('admin/gallery', [GalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('admin/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('admin/gallery/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('admin/gallery/status/{id}', [GalleryController::class, 'status'])->name('admin.gallery.status');
    Route::get('gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    Route::get('admin/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('admin/settings', [SettingController::class, 'store'])->name('admin.settings.store');
    // Event Controller 
    Route::get('admin/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::get('admin/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('admin/events/store', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('admin/events/edit/{id}', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('admin/events/update/{id}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('admin/events/delete/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    Route::get('admin/registrations', [EventController::class, 'registrations'])->name('admin.events.registrations');
    Route::get('admin/event-registrations/export', [EventController::class, 'exportCSV'])
        ->name('admin.registrations.export');

    // Blog Routes 
    Route::get('admin/blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('admin/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('admin/blogs/store', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('admin/blogs/edit/{id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('admin/blogs/update/{id}', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('admin/blogs/delete/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
    Route::resource('admin/volunteers', VolunteerController::class)->names('admin.volunteers');
    Route::get('admin/donors', [DonarController::class, 'donorList'])->name('admin.donors.donnerlist');
    Route::get('/admin/donors/export/csv', [DonarController::class, 'exportCsv'])->name('admin.donors.export.csv');
    Route::get('/admin/donors/export/pdf', [DonarController::class, 'exportPdf'])->name('admin.donors.export.pdf');
    Route::get('admin/donations/{id}/80g', [DonarController::class, 'generate80G'])->name('admin.donations.80g');
    Route::get('admin/text_certificates_80g', [TaxCertificateController::class, 'index'])->name('admin.tex_certificates.index');
    Route::get('admin/campaigns', [CampaignController::class, 'index'])->name('admin.campaigns.index');
    Route::get('admin/campaigns/create', [CampaignController::class, 'create'])->name('admin.campaigns.create');
    Route::post('admin/campaigns/store', [CampaignController::class, 'store'])->name('admin.campaigns.store');
    Route::get('admin/campaigns/edit/{id}', [CampaignController::class, 'edit'])->name('admin.campaigns.edit');
    Route::put('admin/campaigns/update/{id}', [CampaignController::class, 'update'])->name('admin.campaigns.update');
    Route::get('admin/campaigns/close/{id}', [CampaignController::class, 'close'])->name('admin.campaigns.close');
    Route::resource('admin/beneficiaries', BeneficiaryController::class)->names('admin.beneficiaries');
    Route::resource('admin/audit-reports', AuditReportController::class)->names('admin.audit-reports');
    Route::get('admin/audit-reports/{id}/download', [AuditReportController::class, 'download'])->name('admin.audit-reports.download');
    Route::resource('admin/expenses', ExpenseController::class)->names('admin.expenses');
    // Blog Category 
    Route::resource('admin/compliance-docs', ComplianceDocumentController::class)->names('admin.compliance');


    // FrontEnd Controller 

    Route::get('/admin/about', [FrontEnd::class, 'about'])->name('admin.about.index');
    Route::post('/about/update', [FrontEnd::class, 'storeOrUpdate'])->name('admin.about.store_or_update');


    Route::post('/assign-role-to-user/{id}', [RoleController::class, 'assignRoleToUser'])->name('admin.roles.assign');
});


Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('donners', DonarController::class);
    });
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('crowdfunding-teams', [CrowdfundingTeamController::class, 'index'])
        ->name('crowdfunding-teams.index');

    Route::get('crowdfunding-teams/create', [CrowdfundingTeamController::class, 'create'])
        ->name('crowdfunding-teams.create');

    Route::post('crowdfunding-teams/store', [CrowdfundingTeamController::class, 'store'])
        ->name('crowdfunding-teams.store');

    Route::get('crowdfunding-teams/{id}/edit', [CrowdfundingTeamController::class, 'edit'])
        ->name('crowdfunding-teams.edit');

    Route::put('crowdfunding-teams/{id}', [CrowdfundingTeamController::class, 'update'])
        ->name('crowdfunding-teams.update');

    Route::delete('crowdfunding-teams/{id}', [CrowdfundingTeamController::class, 'destroy'])
        ->name('crowdfunding-teams.destroy');
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('goals', [GoalController::class, 'index'])->name('goals.index');
    Route::get('goals/create', [GoalController::class, 'create'])->name('goals.create');
    Route::post('goals/store', [GoalController::class, 'store'])->name('goals.store');
    Route::get('goals/{id}/edit', [GoalController::class, 'edit'])->name('goals.edit');
    Route::put('goals/{id}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('goals/{id}', [GoalController::class, 'destroy'])->name('goals.destroy');
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('project-locations', [ProjectLocationController::class, 'index'])
        ->name('project-locations.index');

    Route::get('project-locations/create', [ProjectLocationController::class, 'create'])
        ->name('project-locations.create');

    Route::post('project-locations/store', [ProjectLocationController::class, 'store'])
        ->name('project-locations.store');

    Route::get('project-locations/{id}/edit', [ProjectLocationController::class, 'edit'])
        ->name('project-locations.edit');

    Route::put('project-locations/{id}', [ProjectLocationController::class, 'update'])
        ->name('project-locations.update');

    Route::delete('project-locations/{id}', [ProjectLocationController::class, 'destroy'])
        ->name('project-locations.destroy');
});



require __DIR__ . '/auth.php';


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('about', [HomeController::class, 'about'])->name('home.about');
Route::get('contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('member-apply', [HomeController::class, 'member_apply'])->name('home.member_apply');
Route::get('download-card', [HomeController::class, 'download_card'])->name('home.download_card');
Route::get('verifications', [HomeController::class, 'verifications'])->name('home.verifications');
Route::get('donates', [HomeController::class, 'donate'])->name('home.donates');
Route::get('crowdfunding', [HomeController::class, 'crowdfunding'])->name('home.crowdfunding');
Route::get('gallery', [HomeController::class, 'gallery'])->name('home.gallery');
Route::get('audit-report', [HomeController::class, 'audit_report'])->name('home.audit_report');

Route::resource('members', MemberController::class);


Route::post('contact_submit', [HomeController::class, 'contact_submit'])->name('home.contact_submit');
Route::post('/verify-member', [HomeController::class, 'verifyMember'])->name('verify.member');


// Route::get('/test-qr', function () {
//     $qrPath = public_path('uploads/qr/test.png');

//     // QrCode use without new Generator
//     \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
//         ->size(300)
//         ->generate('Hello GD Backend', $qrPath);

//     return response()->download($qrPath);
// });


Route::post('/donate/submit', [DonationController::class, 'store'])->name('donate.submit');
Route::get('/get-member-by-idcard', [MemberController::class, 'getByIdCard'])->name('members.getByIdCard');




Route::get('/member/payment/{id}', [MemberController::class, 'paymentPage'])
    ->name('payment.page');

Route::get('/member/payment-success', [MemberController::class, 'paymentSuccess'])
    ->name('payment.success');

Route::get('/thank-you/{payment}', function ($payment) {
    $payment = \App\Models\MemberPayment::with('member.user')->findOrFail($payment);
    return view('payment.thankyou', compact('payment'));
})->name('thankyou');


Route::get('/manage-roles', [RoleController::class, 'index']);
Route::get('admin/roles/', [RoleController::class, 'index2']);
Route::post('/create-role', [RoleController::class, 'storeRole'])->name('admin.roles.store');
Route::post('/assign-permissions/{id}', [RoleController::class, 'assignPermissions']);

Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');
Route::put('/update/{id}', [RoleController::class, 'update'])->name('admin.roles.update');





Route::post('/create-permission', [RoleController::class, 'storePermission']);


Route::get('/manage-role-permissions/{id}', [RoleController::class, 'manageRolePermissions']);
Route::post('/assign-permissions/{id}', [RoleController::class, 'assignPermissions']);

Route::fallback(function () {
    abort(404);
});


Route::get('upcomming-event', [HomeController::class, 'upcomming_event'])->name('upcomming.event');
Route::get('/event/{id}', [HomeController::class, 'event_detail'])->name('event.detail');
Route::get('/event-register/{id}', [HomeController::class, 'event_register'])->name('event.register');
Route::post('/event-register', [HomeController::class, 'store_event_registration'])->name('event.register.store');
Route::get('/team-member', [HomeController::class, 'team_member'])->name('home.team_member');



Route::get('our-solution', function () {
    return view('our_solution');
})->name('home.our_solution');

Route::get('your-problem', function () {
    return view('your_problem');
})->name('home.your_problem');

Route::get('our-project', function () {
    return view('our_project');
})->name('home.our_project');


Route::get('team-member-detail', function () {
    return view('test');
})->name('home.team_member');

Route::post('/create-order', [DonationController::class, 'createOrder'])->name('donate.createOrder');


Route::get('/lang/{lang}', function ($lang) {

    if (!in_array($lang, ['en', 'hi'])) {
        abort(404);
    }

    session()->put('locale', $lang);
    App::setLocale($lang);

    return redirect()->back();
})->name('lang.switch');


Route::get('/donate/form/{id}', [DonationController::class, 'showDonateForm'])->name('home.donates.form');
Route::post('/donation/save', [DonationController::class, 'saveTransaction'])->name('donation.save');
Route::get('/donation/receipt/{receipt_no}', [DonationController::class, 'downloadReceipt'])->name('donation.receipt');



Route::get('privacy-policy', function() {
   return view('home.privacy_policy'); 
})->name('home.privacy_policy'); 

Route::get('term-condition', function() {
    return view('home.term_condition'); 
})->name('home.term_condition'); 

Route::get('disclaimer', function() {
    return view('home.term_disclaimer'); 
})->name('home.term_disclaimer'); 

Route::get('refund-policy', function() {
    return view('home.refund_policy'); 
})->name('home.refund_policy'); 