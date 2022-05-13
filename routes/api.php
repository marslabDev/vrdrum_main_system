<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Class Room
    Route::apiResource('class-rooms', 'ClassRoomApiController');

    // Lesson Category
    Route::apiResource('lesson-categories', 'LessonCategoryApiController');

    // Tuition Package
    Route::apiResource('tuition-packages', 'TuitionPackageApiController');

    // Tuition Gift
    Route::apiResource('tuition-gifts', 'TuitionGiftApiController');

    // Student Tuition
    Route::apiResource('student-tuitions', 'StudentTuitionApiController');

    // Lesson Level
    Route::apiResource('lesson-levels', 'LessonLevelApiController');

    // Lesson
    Route::apiResource('lessons', 'LessonApiController');

    // Lesson Coach
    Route::apiResource('lesson-coaches', 'LessonCoachApiController');

    // Lesson Time
    Route::apiResource('lesson-times', 'LessonTimeApiController');

    // Lesson Time Coach
    Route::apiResource('lesson-time-coaches', 'LessonTimeCoachApiController');

    // Lesson Time Change
    Route::apiResource('lesson-time-changes', 'LessonTimeChangeApiController');

    // Student Lesson Progress
    Route::apiResource('student-lesson-progresses', 'StudentLessonProgressApiController');

    // Student Detail
    Route::apiResource('student-details', 'StudentDetailApiController');

    // Student Meta
    Route::apiResource('student-meta', 'StudentMetaApiController');

    // Student Work
    Route::apiResource('student-works', 'StudentWorkApiController');

    // Submission
    Route::apiResource('submissions', 'SubmissionApiController');

    // Work Resource
    Route::post('work-resources/media', 'WorkResourceApiController@storeMedia')->name('work-resources.storeMedia');
    Route::apiResource('work-resources', 'WorkResourceApiController');

    // Submit Resource
    Route::post('submit-resources/media', 'SubmitResourceApiController@storeMedia')->name('submit-resources.storeMedia');
    Route::apiResource('submit-resources', 'SubmitResourceApiController');

    // Coach Detail
    Route::apiResource('coach-details', 'CoachDetailApiController');

    // Coach Meta
    Route::apiResource('coach-meta', 'CoachMetaApiController');

    // Branch
    Route::apiResource('branches', 'BranchApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController');

    // Asset Category
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Location
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Status
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Asset
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'update', 'destroy']]);

    // Expense Category
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Category
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');
});
