<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\ResidenceTypeController;
use App\Http\Controllers\Admin\IncomeTypeController;

use App\Http\Controllers\Admin\TrackTypeController;
use App\Http\Controllers\Admin\TrackCategoryController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\ApplicationController;

use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FormSectionController;
use App\Http\Controllers\Admin\FormFieldController;
use App\Http\Controllers\Admin\ApplicationAnswerController;

use App\Http\Controllers\Admin\EligibilityRuleController;
use App\Http\Controllers\Admin\ScoringRuleController;
use App\Http\Controllers\Admin\TrackRankingController;

use App\Http\Controllers\Admin\ApplicationReportController;
use App\Http\Controllers\Admin\DashboardAnalyticsController;

use App\Http\Controllers\Admin\ApplicationReviewController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
     return redirect()->route('login');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
  Route::get('/dashboard', [DashboardAnalyticsController::class, 'index'])
    ->name('dashboard');
  Route::resource('users', UserController::class);
  Route::resource('roles', RoleController::class)->except(['show']);
  Route::resource('permissions', PermissionController::class)->except(['show']);

   Route::get('/settings',[SettingController::class,'index'])
        ->name('settings.index');

    Route::post('/settings',[SettingController::class,'update'])
        ->name('settings.update');

    Route::resource('governorates', GovernorateController::class);

    Route::resource('residence-types', ResidenceTypeController::class);

    Route::resource('income-types', IncomeTypeController::class);

    Route::resource('track-types', TrackTypeController::class);

    Route::resource('track-categories', TrackCategoryController::class);

    Route::resource('tracks', TrackController::class);
    Route::resource('applicants', ApplicantController::class);

    Route::resource('applications', ApplicationController::class);

    Route::patch(
        'applications/{application}/change-status',
        [ApplicationController::class, 'changeStatus']
    )->name('applications.change-status');


      Route::resource('forms', FormController::class);

    Route::get('forms/{form}/builder', [FormController::class, 'builder'])
        ->name('forms.builder');

    Route::resource('form-sections', FormSectionController::class)
        ->only(['store', 'edit', 'update', 'destroy']);

    Route::resource('form-fields', FormFieldController::class)
        ->except(['index', 'show']);

    Route::get('applications/{application}/answers/edit', [ApplicationAnswerController::class, 'edit'])
        ->name('applications.answers.edit');

    Route::post('applications/{application}/answers', [ApplicationAnswerController::class, 'update'])
        ->name('applications.answers.update');

    Route::get('applications/{application}/review', [ApplicationReviewController::class, 'review'])
        ->name('applications.review');

    Route::post('applications/{application}/analyze', [ApplicationReviewController::class, 'analyze'])
        ->name('applications.analyze');

    Route::post('applications/{application}/manual-score', [ApplicationReviewController::class, 'manualScore'])
        ->name('applications.manual-score');


          Route::resource('eligibility-rules', EligibilityRuleController::class);

    Route::resource('scoring-rules', ScoringRuleController::class);

    Route::get('rankings', [TrackRankingController::class, 'index'])
        ->name('rankings.index');

    Route::post('rankings/analyze-all', [TrackRankingController::class, 'analyzeAll'])
        ->name('rankings.analyze-all');

    Route::post('rankings/auto-select', [TrackRankingController::class, 'autoSelect'])
        ->name('rankings.auto-select');

    Route::post('rankings/reject-not-eligible', [TrackRankingController::class, 'rejectNotEligible'])
        ->name('rankings.reject-not-eligible');

         Route::get('reports/applications', [ApplicationReportController::class, 'index'])
        ->name('reports.applications.index');

    Route::get('reports/applications/export-excel', [ApplicationReportController::class, 'exportExcel'])
        ->name('reports.applications.export-excel');

    Route::get('reports/applications/export-pdf', [ApplicationReportController::class, 'exportPdf'])
        ->name('reports.applications.export-pdf');

        Route::get('/dashboard/analytics', [DashboardAnalyticsController::class, 'index'])
        ->name('dashboard.analytics');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Public\TrainingPortalController;

// Route::get('/', [TrainingPortalController::class, 'index'])
//     ->name('public.tracks.index');
// Route::get('/', [TrainingPortalController::class, 'landing'])
//     ->name('public.landing');
Route::get('/', [TrainingPortalController::class, 'landing'])
    ->name('public.landing');

Route::get('/tracks', [TrainingPortalController::class, 'index'])
    ->name('public.tracks.index');

Route::get('/tracks/{track}', [TrainingPortalController::class, 'show'])
    ->name('public.tracks.show');

Route::get('/tracks/{track}/apply', [TrainingPortalController::class, 'apply'])
    ->name('public.tracks.apply');

Route::post('/tracks/{track}/apply', [TrainingPortalController::class, 'submit'])
    ->name('public.tracks.submit');

Route::get('/applications/{application}/success', [TrainingPortalController::class, 'success'])
    ->name('public.applications.success');

require __DIR__.'/auth.php';
