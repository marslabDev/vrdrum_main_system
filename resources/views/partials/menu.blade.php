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
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
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
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('student_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/student-lesson-progresses*") ? "c-show" : "" }} {{ request()->is("admin/student-details*") ? "c-show" : "" }} {{ request()->is("admin/student-meta*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.studentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('student_lesson_progress_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-lesson-progresses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-lesson-progresses") || request()->is("admin/student-lesson-progresses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentLessonProgress.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-details") || request()->is("admin/student-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_metum_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-meta.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-meta") || request()->is("admin/student-meta/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentMetum.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_work_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/student-works*") ? "c-show" : "" }} {{ request()->is("admin/submissions*") ? "c-show" : "" }} {{ request()->is("admin/work-resources*") ? "c-show" : "" }} {{ request()->is("admin/submit-resources*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

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
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.workResource.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('submit_resource_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.submit-resources.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/submit-resources") || request()->is("admin/submit-resources/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.submitResource.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('coach_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/coach-details*") ? "c-show" : "" }} {{ request()->is("admin/coach-meta*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.coachManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('coach_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.coach-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coach-details") || request()->is("admin/coach-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

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
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tuitionPackage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tuition_gift_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tuition-gifts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tuition-gifts") || request()->is("admin/tuition-gifts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

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
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/lesson-categories*") ? "c-show" : "" }} {{ request()->is("admin/lesson-levels*") ? "c-show" : "" }} {{ request()->is("admin/lessons*") ? "c-show" : "" }} {{ request()->is("admin/lesson-coaches*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
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
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

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
                    @can('lesson_time_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/lesson-times*") ? "c-show" : "" }} {{ request()->is("admin/lesson-time-coaches*") ? "c-show" : "" }} {{ request()->is("admin/lesson-time-changes*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lessonTimeManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('lesson_time_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.lesson-times.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-times") || request()->is("admin/lesson-times/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.lessonTime.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('lesson_time_change_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.lesson-time-changes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lesson-time-changes") || request()->is("admin/lesson-time-changes/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.lessonTimeChange.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('class_room_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.class-rooms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/class-rooms") || request()->is("admin/class-rooms/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.classRoom.title') }}
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
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