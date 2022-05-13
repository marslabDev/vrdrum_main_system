<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Class Room
    Route::delete('class-rooms/destroy', 'ClassRoomController@massDestroy')->name('class-rooms.massDestroy');
    Route::resource('class-rooms', 'ClassRoomController');

    // Lesson Category
    Route::delete('lesson-categories/destroy', 'LessonCategoryController@massDestroy')->name('lesson-categories.massDestroy');
    Route::resource('lesson-categories', 'LessonCategoryController');

    // Tuition Package
    Route::delete('tuition-packages/destroy', 'TuitionPackageController@massDestroy')->name('tuition-packages.massDestroy');
    Route::resource('tuition-packages', 'TuitionPackageController');

    // Tuition Gift
    Route::delete('tuition-gifts/destroy', 'TuitionGiftController@massDestroy')->name('tuition-gifts.massDestroy');
    Route::resource('tuition-gifts', 'TuitionGiftController');

    // Student Tuition
    Route::delete('student-tuitions/destroy', 'StudentTuitionWithProgressController@massDestroy')->name('student-tuitions.massDestroy');
    Route::resource('student-tuitions', 'StudentTuitionWithProgressController');

    // Lesson Level
    Route::delete('lesson-levels/destroy', 'LessonLevelController@massDestroy')->name('lesson-levels.massDestroy');
    Route::resource('lesson-levels', 'LessonLevelController');

    // Lesson
    Route::delete('lessons/destroy', 'LessonWithLessonCoachController@massDestroy')->name('lessons.massDestroy');
    Route::resource('lessons', 'LessonWithLessonCoachController');

    // Lesson Coach
    // Route::delete('lesson-coaches/destroy', 'LessonCoachController@massDestroy')->name('lesson-coaches.massDestroy');
    // Route::resource('lesson-coaches', 'LessonCoachController');

    // Lesson Time
    Route::delete('lesson-times/destroy', 'LessonTimeWithLessonTimeCoachController@massDestroy')->name('lesson-times.massDestroy');
    Route::resource('lesson-times', 'LessonTimeWithLessonTimeCoachController');

    // Lesson Time Coach
    // Route::delete('lesson-time-coaches/destroy', 'LessonTimeCoachController@massDestroy')->name('lesson-time-coaches.massDestroy');
    // Route::resource('lesson-time-coaches', 'LessonTimeCoachController');

    // Lesson Time Change
    Route::delete('lesson-time-changes/destroy', 'LessonTimeChangeController@massDestroy')->name('lesson-time-changes.massDestroy');
    Route::resource('lesson-time-changes', 'LessonTimeChangeController');
    
    // Student Lesson Progress
    Route::delete('student-lesson-progresses/destroy', 'StudentLessonProgressController@massDestroy')->name('student-lesson-progresses.massDestroy');
    Route::resource('student-lesson-progresses', 'StudentLessonProgressController');

    // Student Detail
    Route::delete('student-details/destroy', 'StudentDetailController@massDestroy')->name('student-details.massDestroy');
    Route::resource('student-details', 'StudentDetailController');

    // Student Meta
    Route::delete('student-meta/destroy', 'StudentMetaController@massDestroy')->name('student-meta.massDestroy');
    Route::resource('student-meta', 'StudentMetaController');

    // Student Work
    Route::delete('student-works/destroy', 'StudentWorkController@massDestroy')->name('student-works.massDestroy');
    Route::resource('student-works', 'StudentWorkController');

    // Submission
    Route::delete('submissions/destroy', 'SubmissionController@massDestroy')->name('submissions.massDestroy');
    Route::resource('submissions', 'SubmissionController');

    // Work Resource
    Route::delete('work-resources/destroy', 'WorkResourceController@massDestroy')->name('work-resources.massDestroy');
    Route::resource('work-resources', 'WorkResourceController');

    // Submit Resource
    Route::delete('submit-resources/destroy', 'SubmitResourceController@massDestroy')->name('submit-resources.massDestroy');
    Route::resource('submit-resources', 'SubmitResourceController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Coach Detail
    Route::delete('coach-details/destroy', 'CoachDetailController@massDestroy')->name('coach-details.massDestroy');
    Route::resource('coach-details', 'CoachDetailController');

    // Coach Meta
    Route::delete('coach-meta/destroy', 'CoachMetaController@massDestroy')->name('coach-meta.massDestroy');
    Route::resource('coach-meta', 'CoachMetaController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Branch
    Route::delete('branches/destroy', 'BranchController@massDestroy')->name('branches.massDestroy');
    Route::resource('branches', 'BranchController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});


Route::group(['prefix' => 'function', 'as' => 'function.', 'namespace' => 'Function', 'middleware' => ['auth']], function () {
    Route::post('lesson-time-changes/{id}/approve', 'LessonTimeChangeActionController@toApproved')->name('lesson-time-changes.toApproved');
    Route::post('lesson-time-changes/{id}/reject', 'LessonTimeChangeActionController@toRejected')->name('lesson-time-changes.toRejected');

    Route::post('student-lesson-progresses/{id}/toNextLevel', 'StudentLessonProgressControlController@toNextLevel')->name('student-lesson-progresses.toNextLevel');
    Route::post('student-lesson-progresses/{id}/toLowLevel', 'StudentLessonProgressControlController@toLowLevel')->name('student-lesson-progresses.toLowLevel');
});
// Route::group(['prefix' => 'function', 'as' => 'function.', 'namespace' => 'Function\V1', 'middleware' => ['auth']], function () {
//     // get tuition package with lesson category & tuition gift
//     Route::get('get-tuition-with-gift', 'TuitionPakageWithGiftController@index');

// });
