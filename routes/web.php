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
    Route::delete('student-tuitions/destroy', 'StudentTuitionController@massDestroy')->name('student-tuitions.massDestroy');
    Route::resource('student-tuitions', 'StudentTuitionController');

    // Lesson Level
    Route::delete('lesson-levels/destroy', 'LessonLevelController@massDestroy')->name('lesson-levels.massDestroy');
    Route::resource('lesson-levels', 'LessonLevelController');

    // Lesson
    Route::delete('lessons/destroy', 'LessonController@massDestroy')->name('lessons.massDestroy');
    Route::resource('lessons', 'LessonController');

    // Lesson Coach
    Route::delete('lesson-coaches/destroy', 'LessonCoachController@massDestroy')->name('lesson-coaches.massDestroy');
    Route::resource('lesson-coaches', 'LessonCoachController');

    // Lesson Time
    Route::delete('lesson-times/destroy', 'LessonTimeController@massDestroy')->name('lesson-times.massDestroy');
    Route::resource('lesson-times', 'LessonTimeController');

    // Lesson Time Coach
    Route::delete('lesson-time-coaches/destroy', 'LessonTimeCoachController@massDestroy')->name('lesson-time-coaches.massDestroy');
    Route::resource('lesson-time-coaches', 'LessonTimeCoachController');

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

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
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
