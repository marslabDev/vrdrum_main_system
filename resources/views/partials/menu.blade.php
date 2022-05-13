<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('student_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/student-lesson-progresses*") ? "c-show" : "" }} {{ request()->is("admin/student-details*") ? "c-show" : "" }} {{ request()->is("admin/student-meta*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-graduate c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.studentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('student_lesson_progress_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-lesson-progresses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-lesson-progresses") || request()->is("admin/student-lesson-progresses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hourglass-half c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentLessonProgress.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-details") || request()->is("admin/student-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_metum_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-meta.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-meta") || request()->is("admin/student-meta/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentMetum.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('student_work_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/student-works*") ? "c-show" : "" }} {{ request()->is("admin/submissions*") ? "c-show" : "" }} {{ request()->is("admin/work-resources*") ? "c-show" : "" }} {{ request()->is("admin/submit-resources*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.studentWorkManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('student_work_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-works.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-works") || request()->is("admin/student-works/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentWork.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('submission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.submissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/submissions") || request()->is("admin/submissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-check-double c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.submission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('work_resource_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.work-resources.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/work-resources") || request()->is("admin/work-resources/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.workResource.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('submit_resource_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.submit-resources.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/submit-resources") || request()->is("admin/submit-resources/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-file-archive c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.submitResource.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('coach_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/coach-details*") ? "c-show" : "" }} {{ request()->is("admin/coach-meta*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.coachManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('coach_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.coach-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coach-details") || request()->is("admin/coach-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.coachDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('coach_metum_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.coach-meta.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coach-meta") || request()->is("admin/coach-meta/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.coachMetum.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('tuition_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/tuition-packages*") ? "c-show" : "" }} {{ request()->is("admin/tuition-gifts*") ? "c-show" : "" }} {{ request()->is("admin/student-tuitions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.tuitionManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('tuition_package_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tuition-packages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tuition-packages") || request()->is("admin/tuition-packages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tuitionPackage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tuition_gift_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tuition-gifts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tuition-gifts") || request()->is("admin/tuition-gifts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-gift c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tuitionGift.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_tuition_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-tuitions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-tuitions") || request()->is("admin/student-tuitions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentTuition.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('lesson_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/lesson-categories*") ? "c-show" : "" }} {{ request()->is("admin/lesson-levels*") ? "c-show" : "" }} {{ request()->is("admin/lessons*") ? "c-show" : "" }} {{ request()->is("admin/lesson-coaches*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.lessonManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('lesson_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lesson-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-categories") || request()->is("admin/lesson-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lessonCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lesson_level_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lesson-levels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-levels") || request()->is("admin/lesson-levels/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-shoe-prints c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lessonLevel.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lesson_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lessons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lessons") || request()->is("admin/lessons/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lesson.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lesson_coach_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lesson-coaches.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-coaches") || request()->is("admin/lesson-coaches/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lessonCoach.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('lesson_time_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/lesson-times*") ? "c-show" : "" }} {{ request()->is("admin/lesson-time-coaches*") ? "c-show" : "" }} {{ request()->is("admin/lesson-time-changes*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.lessonTimeManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('lesson_time_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lesson-times.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-times") || request()->is("admin/lesson-times/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-clock c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lessonTime.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lesson_time_coach_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lesson-time-coaches.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-time-coaches") || request()->is("admin/lesson-time-coaches/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-clock c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lessonTimeCoach.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lesson_time_change_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lesson-time-changes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-time-changes") || request()->is("admin/lesson-time-changes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-stopwatch c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lessonTimeChange.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('class_room_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.class-rooms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/class-rooms") || request()->is("admin/class-rooms/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.classRoom.title') }}
                </a>
            </li>
        @endcan
        @can('audit_log_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.auditLog.title') }}
                </a>
            </li>
        @endcan
        @can('branch_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/branches*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-code-branch c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.branchManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('branch_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.branches.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/branches") || request()->is("admin/branches/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-school c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.branch.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('asset_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/asset-categories*") ? "c-show" : "" }} {{ request()->is("admin/asset-locations*") ? "c-show" : "" }} {{ request()->is("admin/asset-statuses*") ? "c-show" : "" }} {{ request()->is("admin/assets*") ? "c-show" : "" }} {{ request()->is("admin/assets-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.assetManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('asset_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetLocation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.asset.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('assets_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets-histories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetsHistory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('expense_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/expense-categories*") ? "c-show" : "" }} {{ request()->is("admin/income-categories*") ? "c-show" : "" }} {{ request()->is("admin/expenses*") ? "c-show" : "" }} {{ request()->is("admin/incomes*") ? "c-show" : "" }} {{ request()->is("admin/expense-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.expenseManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('expense_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.income-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.incomeCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expenses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expense.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.incomes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.income.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>