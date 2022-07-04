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
    Route::post('class-rooms/parse-csv-import', 'ClassRoomController@parseCsvImport')->name('class-rooms.parseCsvImport');
    Route::post('class-rooms/process-csv-import', 'ClassRoomController@processCsvImport')->name('class-rooms.processCsvImport');
    Route::resource('class-rooms', 'ClassRoomController');

    // Lesson Category
    Route::delete('lesson-categories/destroy', 'LessonCategoryController@massDestroy')->name('lesson-categories.massDestroy');
    Route::post('lesson-categories/parse-csv-import', 'LessonCategoryController@parseCsvImport')->name('lesson-categories.parseCsvImport');
    Route::post('lesson-categories/process-csv-import', 'LessonCategoryController@processCsvImport')->name('lesson-categories.processCsvImport');
    Route::resource('lesson-categories', 'LessonCategoryController');

    // Tuition Package
    Route::delete('tuition-packages/destroy', 'TuitionPackageController@massDestroy')->name('tuition-packages.massDestroy');
    Route::post('tuition-packages/parse-csv-import', 'TuitionPackageController@parseCsvImport')->name('tuition-packages.parseCsvImport');
    Route::post('tuition-packages/process-csv-import', 'TuitionPackageController@processCsvImport')->name('tuition-packages.processCsvImport');
    Route::resource('tuition-packages', 'TuitionPackageController');

    // Tuition Gift
    Route::delete('tuition-gifts/destroy', 'TuitionGiftController@massDestroy')->name('tuition-gifts.massDestroy');
    Route::post('tuition-gifts/parse-csv-import', 'TuitionGiftController@parseCsvImport')->name('tuition-gifts.parseCsvImport');
    Route::post('tuition-gifts/process-csv-import', 'TuitionGiftController@processCsvImport')->name('tuition-gifts.processCsvImport');
    Route::resource('tuition-gifts', 'TuitionGiftController');

    // Student Tuition
    Route::delete('student-tuitions/destroy', 'StudentTuitionController@massDestroy')->name('student-tuitions.massDestroy');
    Route::post('student-tuitions/parse-csv-import', 'StudentTuitionController@parseCsvImport')->name('student-tuitions.parseCsvImport');
    Route::post('student-tuitions/process-csv-import', 'StudentTuitionController@processCsvImport')->name('student-tuitions.processCsvImport');
    Route::resource('student-tuitions', 'StudentTuitionController');

    // Lesson Level
    Route::delete('lesson-levels/destroy', 'LessonLevelController@massDestroy')->name('lesson-levels.massDestroy');
    Route::post('lesson-levels/parse-csv-import', 'LessonLevelController@parseCsvImport')->name('lesson-levels.parseCsvImport');
    Route::post('lesson-levels/process-csv-import', 'LessonLevelController@processCsvImport')->name('lesson-levels.processCsvImport');
    Route::resource('lesson-levels', 'LessonLevelController');

    // Lesson
    Route::delete('lessons/destroy', 'LessonController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/parse-csv-import', 'LessonController@parseCsvImport')->name('lessons.parseCsvImport');
    Route::post('lessons/process-csv-import', 'LessonController@processCsvImport')->name('lessons.processCsvImport');
    Route::resource('lessons', 'LessonController');

    // Lesson Coach
    Route::delete('lesson-coaches/destroy', 'LessonCoachController@massDestroy')->name('lesson-coaches.massDestroy');
    Route::post('lesson-coaches/parse-csv-import', 'LessonCoachController@parseCsvImport')->name('lesson-coaches.parseCsvImport');
    Route::post('lesson-coaches/process-csv-import', 'LessonCoachController@processCsvImport')->name('lesson-coaches.processCsvImport');
    Route::resource('lesson-coaches', 'LessonCoachController');

    // Lesson Time
    Route::delete('lesson-times/destroy', 'LessonTimeController@massDestroy')->name('lesson-times.massDestroy');
    Route::post('lesson-times/parse-csv-import', 'LessonTimeController@parseCsvImport')->name('lesson-times.parseCsvImport');
    Route::post('lesson-times/process-csv-import', 'LessonTimeController@processCsvImport')->name('lesson-times.processCsvImport');
    Route::resource('lesson-times', 'LessonTimeController');

    // Lesson Time Coach
    Route::delete('lesson-time-coaches/destroy', 'LessonTimeCoachController@massDestroy')->name('lesson-time-coaches.massDestroy');
    Route::post('lesson-time-coaches/parse-csv-import', 'LessonTimeCoachController@parseCsvImport')->name('lesson-time-coaches.parseCsvImport');
    Route::post('lesson-time-coaches/process-csv-import', 'LessonTimeCoachController@processCsvImport')->name('lesson-time-coaches.processCsvImport');
    Route::resource('lesson-time-coaches', 'LessonTimeCoachController');

    // Lesson Time Change
    Route::delete('lesson-time-changes/destroy', 'LessonTimeChangeController@massDestroy')->name('lesson-time-changes.massDestroy');
    Route::post('lesson-time-changes/parse-csv-import', 'LessonTimeChangeController@parseCsvImport')->name('lesson-time-changes.parseCsvImport');
    Route::post('lesson-time-changes/process-csv-import', 'LessonTimeChangeController@processCsvImport')->name('lesson-time-changes.processCsvImport');
    Route::resource('lesson-time-changes', 'LessonTimeChangeController');

    // Student Lesson Progress
    Route::delete('student-lesson-progresses/destroy', 'StudentLessonProgressController@massDestroy')->name('student-lesson-progresses.massDestroy');
    Route::post('student-lesson-progresses/parse-csv-import', 'StudentLessonProgressController@parseCsvImport')->name('student-lesson-progresses.parseCsvImport');
    Route::post('student-lesson-progresses/process-csv-import', 'StudentLessonProgressController@processCsvImport')->name('student-lesson-progresses.processCsvImport');
    Route::resource('student-lesson-progresses', 'StudentLessonProgressController');

    // Student Detail
    Route::delete('student-details/destroy', 'StudentDetailController@massDestroy')->name('student-details.massDestroy');
    Route::post('student-details/parse-csv-import', 'StudentDetailController@parseCsvImport')->name('student-details.parseCsvImport');
    Route::post('student-details/process-csv-import', 'StudentDetailController@processCsvImport')->name('student-details.processCsvImport');
    Route::resource('student-details', 'StudentDetailController');

    // Student Meta
    Route::delete('student-meta/destroy', 'StudentMetaController@massDestroy')->name('student-meta.massDestroy');
    Route::post('student-meta/parse-csv-import', 'StudentMetaController@parseCsvImport')->name('student-meta.parseCsvImport');
    Route::post('student-meta/process-csv-import', 'StudentMetaController@processCsvImport')->name('student-meta.processCsvImport');
    Route::resource('student-meta', 'StudentMetaController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Coach Detail
    Route::delete('coach-details/destroy', 'CoachDetailController@massDestroy')->name('coach-details.massDestroy');
    Route::post('coach-details/parse-csv-import', 'CoachDetailController@parseCsvImport')->name('coach-details.parseCsvImport');
    Route::post('coach-details/process-csv-import', 'CoachDetailController@processCsvImport')->name('coach-details.processCsvImport');
    Route::resource('coach-details', 'CoachDetailController');

    // Coach Meta
    Route::delete('coach-meta/destroy', 'CoachMetaController@massDestroy')->name('coach-meta.massDestroy');
    Route::post('coach-meta/parse-csv-import', 'CoachMetaController@parseCsvImport')->name('coach-meta.parseCsvImport');
    Route::post('coach-meta/process-csv-import', 'CoachMetaController@processCsvImport')->name('coach-meta.processCsvImport');
    Route::resource('coach-meta', 'CoachMetaController');

    // Branch
    Route::delete('branches/destroy', 'BranchController@massDestroy')->name('branches.massDestroy');
    Route::post('branches/parse-csv-import', 'BranchController@parseCsvImport')->name('branches.parseCsvImport');
    Route::post('branches/process-csv-import', 'BranchController@processCsvImport')->name('branches.processCsvImport');
    Route::resource('branches', 'BranchController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::post('user-alerts/parse-csv-import', 'UserAlertsController@parseCsvImport')->name('user-alerts.parseCsvImport');
    Route::post('user-alerts/process-csv-import', 'UserAlertsController@processCsvImport')->name('user-alerts.processCsvImport');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::post('asset-categories/parse-csv-import', 'AssetCategoryController@parseCsvImport')->name('asset-categories.parseCsvImport');
    Route::post('asset-categories/process-csv-import', 'AssetCategoryController@processCsvImport')->name('asset-categories.processCsvImport');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::post('asset-locations/parse-csv-import', 'AssetLocationController@parseCsvImport')->name('asset-locations.parseCsvImport');
    Route::post('asset-locations/process-csv-import', 'AssetLocationController@processCsvImport')->name('asset-locations.processCsvImport');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::post('asset-statuses/parse-csv-import', 'AssetStatusController@parseCsvImport')->name('asset-statuses.parseCsvImport');
    Route::post('asset-statuses/process-csv-import', 'AssetStatusController@processCsvImport')->name('asset-statuses.processCsvImport');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::post('assets/parse-csv-import', 'AssetController@parseCsvImport')->name('assets.parseCsvImport');
    Route::post('assets/process-csv-import', 'AssetController@processCsvImport')->name('assets.processCsvImport');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::post('assets-histories/parse-csv-import', 'AssetsHistoryController@parseCsvImport')->name('assets-histories.parseCsvImport');
    Route::post('assets-histories/process-csv-import', 'AssetsHistoryController@processCsvImport')->name('assets-histories.processCsvImport');
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::post('expense-categories/parse-csv-import', 'ExpenseCategoryController@parseCsvImport')->name('expense-categories.parseCsvImport');
    Route::post('expense-categories/process-csv-import', 'ExpenseCategoryController@processCsvImport')->name('expense-categories.processCsvImport');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::post('income-categories/parse-csv-import', 'IncomeCategoryController@parseCsvImport')->name('income-categories.parseCsvImport');
    Route::post('income-categories/process-csv-import', 'IncomeCategoryController@processCsvImport')->name('income-categories.processCsvImport');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/parse-csv-import', 'ExpenseController@parseCsvImport')->name('expenses.parseCsvImport');
    Route::post('expenses/process-csv-import', 'ExpenseController@processCsvImport')->name('expenses.processCsvImport');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::post('incomes/parse-csv-import', 'IncomeController@parseCsvImport')->name('incomes.parseCsvImport');
    Route::post('incomes/process-csv-import', 'IncomeController@processCsvImport')->name('incomes.processCsvImport');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Lesson Time Student
    Route::delete('lesson-time-students/destroy', 'LessonTimeStudentController@massDestroy')->name('lesson-time-students.massDestroy');
    Route::post('lesson-time-students/parse-csv-import', 'LessonTimeStudentController@parseCsvImport')->name('lesson-time-students.parseCsvImport');
    Route::post('lesson-time-students/process-csv-import', 'LessonTimeStudentController@processCsvImport')->name('lesson-time-students.processCsvImport');
    Route::resource('lesson-time-students', 'LessonTimeStudentController');

    // Student Parent
    Route::delete('student-parents/destroy', 'StudentParentController@massDestroy')->name('student-parents.massDestroy');
    Route::post('student-parents/parse-csv-import', 'StudentParentController@parseCsvImport')->name('student-parents.parseCsvImport');
    Route::post('student-parents/process-csv-import', 'StudentParentController@processCsvImport')->name('student-parents.processCsvImport');
    Route::resource('student-parents', 'StudentParentController');

    // Address
    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::post('addresses/parse-csv-import', 'AddressController@parseCsvImport')->name('addresses.parseCsvImport');
    Route::post('addresses/process-csv-import', 'AddressController@processCsvImport')->name('addresses.processCsvImport');
    Route::resource('addresses', 'AddressController');

    // Lesson Time Post
    Route::delete('lesson-time-posts/destroy', 'LessonTimePostController@massDestroy')->name('lesson-time-posts.massDestroy');
    Route::post('lesson-time-posts/media', 'LessonTimePostController@storeMedia')->name('lesson-time-posts.storeMedia');
    Route::post('lesson-time-posts/ckmedia', 'LessonTimePostController@storeCKEditorImages')->name('lesson-time-posts.storeCKEditorImages');
    Route::post('lesson-time-posts/parse-csv-import', 'LessonTimePostController@parseCsvImport')->name('lesson-time-posts.parseCsvImport');
    Route::post('lesson-time-posts/process-csv-import', 'LessonTimePostController@processCsvImport')->name('lesson-time-posts.processCsvImport');
    Route::resource('lesson-time-posts', 'LessonTimePostController');

    // Post Content
    Route::delete('post-contents/destroy', 'PostContentController@massDestroy')->name('post-contents.massDestroy');
    Route::post('post-contents/media', 'PostContentController@storeMedia')->name('post-contents.storeMedia');
    Route::post('post-contents/ckmedia', 'PostContentController@storeCKEditorImages')->name('post-contents.storeCKEditorImages');
    Route::post('post-contents/parse-csv-import', 'PostContentController@parseCsvImport')->name('post-contents.parseCsvImport');
    Route::post('post-contents/process-csv-import', 'PostContentController@processCsvImport')->name('post-contents.processCsvImport');
    Route::resource('post-contents', 'PostContentController');

    // Post Content Submit
    Route::delete('post-content-submits/destroy', 'PostContentSubmitController@massDestroy')->name('post-content-submits.massDestroy');
    Route::post('post-content-submits/media', 'PostContentSubmitController@storeMedia')->name('post-content-submits.storeMedia');
    Route::post('post-content-submits/ckmedia', 'PostContentSubmitController@storeCKEditorImages')->name('post-content-submits.storeCKEditorImages');
    Route::post('post-content-submits/parse-csv-import', 'PostContentSubmitController@parseCsvImport')->name('post-content-submits.parseCsvImport');
    Route::post('post-content-submits/process-csv-import', 'PostContentSubmitController@processCsvImport')->name('post-content-submits.processCsvImport');
    Route::resource('post-content-submits', 'PostContentSubmitController');

    // Post Comment
    Route::delete('post-comments/destroy', 'PostCommentController@massDestroy')->name('post-comments.massDestroy');
    Route::post('post-comments/media', 'PostCommentController@storeMedia')->name('post-comments.storeMedia');
    Route::post('post-comments/ckmedia', 'PostCommentController@storeCKEditorImages')->name('post-comments.storeCKEditorImages');
    Route::post('post-comments/parse-csv-import', 'PostCommentController@parseCsvImport')->name('post-comments.parseCsvImport');
    Route::post('post-comments/process-csv-import', 'PostCommentController@processCsvImport')->name('post-comments.processCsvImport');
    Route::resource('post-comments', 'PostCommentController');

    // Post Submission
    Route::delete('post-submissions/destroy', 'PostSubmissionController@massDestroy')->name('post-submissions.massDestroy');
    Route::post('post-submissions/parse-csv-import', 'PostSubmissionController@parseCsvImport')->name('post-submissions.parseCsvImport');
    Route::post('post-submissions/process-csv-import', 'PostSubmissionController@processCsvImport')->name('post-submissions.processCsvImport');
    Route::resource('post-submissions', 'PostSubmissionController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/parse-csv-import', 'OrderController@parseCsvImport')->name('orders.parseCsvImport');
    Route::post('orders/process-csv-import', 'OrderController@processCsvImport')->name('orders.processCsvImport');
    Route::resource('orders', 'OrderController');

    // Order Items
    Route::delete('order-items/destroy', 'OrderItemsController@massDestroy')->name('order-items.massDestroy');
    Route::post('order-items/parse-csv-import', 'OrderItemsController@parseCsvImport')->name('order-items.parseCsvImport');
    Route::post('order-items/process-csv-import', 'OrderItemsController@processCsvImport')->name('order-items.processCsvImport');
    Route::resource('order-items', 'OrderItemsController');

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
