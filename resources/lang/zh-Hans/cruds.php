<?php

return [
    'userManagement' => [
        'title'          => '用户管理',
        'title_singular' => '用户管理',
    ],
    'permission' => [
        'title'          => '权限',
        'title_singular' => '权限',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => '角色',
        'title_singular' => '角色',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => '用户',
        'title_singular' => '用户',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'tuitionManagement' => [
        'title'          => 'Tuition Management',
        'title_singular' => 'Tuition Management',
    ],
    'lessonManagement' => [
        'title'          => 'Lesson Management',
        'title_singular' => 'Lesson Management',
    ],
    'coachManagement' => [
        'title'          => 'Coach Management',
        'title_singular' => 'Coach Management',
    ],
    'studentManagement' => [
        'title'          => 'Student Management',
        'title_singular' => 'Student Management',
    ],
    'classRoom' => [
        'title'          => 'Class Room',
        'title_singular' => 'Class Room',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'room_title'          => 'Room Title',
            'room_title_helper'   => ' ',
            'is_available'        => 'Is Available',
            'is_available_helper' => ' ',
            'branch_efk'          => 'Branch',
            'branch_efk_helper'   => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
        ],
    ],
    'lessonCategory' => [
        'title'          => 'Lesson Category',
        'title_singular' => 'Lesson Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'desc'              => 'Desc',
            'desc_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
        ],
    ],
    'tuitionPackage' => [
        'title'          => 'Tuition Package',
        'title_singular' => 'Tuition Package',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'price'                  => 'Price',
            'price_helper'           => ' ',
            'total_minute'           => 'Total Minute',
            'total_minute_helper'    => ' ',
            'lesson_category'        => 'Lesson Category',
            'lesson_category_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'created_by'             => 'Created By',
            'created_by_helper'      => ' ',
        ],
    ],
    'tuitionGift' => [
        'title'          => 'Tuition Gift',
        'title_singular' => 'Tuition Gift',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'total_minute'           => 'Total Minute',
            'total_minute_helper'    => ' ',
            'quantity'               => 'Quantity',
            'quantity_helper'        => ' ',
            'tuition_package'        => 'Tuition Package',
            'tuition_package_helper' => ' ',
            'inventory_efk'          => 'Inventory',
            'inventory_efk_helper'   => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'type'                   => 'Type',
            'type_helper'            => ' ',
            'created_by'             => 'Created By',
            'created_by_helper'      => ' ',
        ],
    ],
    'studentTuition' => [
        'title'          => 'Student Tuition',
        'title_singular' => 'Student Tuition',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'minute_left'            => 'Minute Left',
            'minute_left_helper'     => ' ',
            'tuition_package'        => 'Tuition Package',
            'tuition_package_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'created_by'             => 'Created By',
            'created_by_helper'      => ' ',
            'student_efk'            => 'Student',
            'student_efk_helper'     => ' ',
        ],
    ],
    'lessonLevel' => [
        'title'          => 'Lesson Level',
        'title_singular' => 'Lesson Level',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'level'                  => 'Level',
            'level_helper'           => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'lesson_category'        => 'Lesson Category',
            'lesson_category_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'created_by'             => 'Created By',
            'created_by_helper'      => ' ',
        ],
    ],
    'lesson' => [
        'title'          => 'Lesson',
        'title_singular' => 'Lesson',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'no_of_class'         => 'No Of Class',
            'no_of_class_helper'  => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'syllabus'            => 'Syllabus',
            'syllabus_helper'     => ' ',
            'lesson_level'        => 'Lesson Level',
            'lesson_level_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
        ],
    ],
    'lessonCoach' => [
        'title'          => 'Lesson Coach',
        'title_singular' => 'Lesson Coach',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'lesson'            => 'Lesson',
            'lesson_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'coach_efk'         => 'Coach',
            'coach_efk_helper'  => ' ',
        ],
    ],
    'lessonTimeManagement' => [
        'title'          => 'Lesson Time Management',
        'title_singular' => 'Lesson Time Management',
    ],
    'lessonTime' => [
        'title'          => 'Lesson Time',
        'title_singular' => 'Lesson Time',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'lesson_code'        => 'Lesson Code',
            'lesson_code_helper' => ' ',
            'date_from'          => 'Date From',
            'date_from_helper'   => ' ',
            'date_to'            => 'Date To',
            'date_to_helper'     => ' ',
            'attended_at'        => 'Attended At',
            'attended_at_helper' => ' ',
            'leaved_at'          => 'Leaved At',
            'leaved_at_helper'   => ' ',
            'class_room'         => 'Class Room',
            'class_room_helper'  => ' ',
            'lesson'             => 'Lesson',
            'lesson_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
            'student_efk'        => 'Student',
            'student_efk_helper' => ' ',
        ],
    ],
    'lessonTimeCoach' => [
        'title'          => 'Lesson Time Coach',
        'title_singular' => 'Lesson Time Coach',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'lesson_time'        => 'Lesson Time',
            'lesson_time_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
            'coach_efk'          => 'Coach',
            'coach_efk_helper'   => ' ',
        ],
    ],
    'lessonTimeChange' => [
        'title'          => 'Lesson Time Change',
        'title_singular' => 'Lesson Time Change',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'date_from'                => 'Date From',
            'date_from_helper'         => ' ',
            'date_to'                  => 'Date To',
            'date_to_helper'           => ' ',
            'status'                   => 'Status',
            'status_helper'            => ' ',
            'request_date'             => 'Request Date',
            'request_date_helper'      => ' ',
            'response_date'            => 'Response Date',
            'response_date_helper'     => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'old_lesson_time'          => 'Old Lesson Time',
            'old_lesson_time_helper'   => ' ',
            'class_room'               => 'Class Room',
            'class_room_helper'        => ' ',
            'lesson'                   => 'Lesson',
            'lesson_helper'            => ' ',
            'created_by'               => 'Created By',
            'created_by_helper'        => ' ',
            'student_efk'              => 'Student',
            'student_efk_helper'       => ' ',
            'request_user_efk'         => 'Request User',
            'request_user_efk_helper'  => ' ',
            'response_user_efk'        => 'Response User',
            'response_user_efk_helper' => ' ',
        ],
    ],
    'studentLessonProgress' => [
        'title'          => 'Student Lesson Progress',
        'title_singular' => 'Student Lesson Progress',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'progress'               => 'Progress',
            'progress_helper'        => ' ',
            'lesson_category'        => 'Lesson Category',
            'lesson_category_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'created_by'             => 'Created By',
            'created_by_helper'      => ' ',
            'student_efk'            => 'Student',
            'student_efk_helper'     => ' ',
        ],
    ],
    'studentWorkManagement' => [
        'title'          => 'Student Work Management',
        'title_singular' => 'Student Work Management',
    ],
    'studentDetail' => [
        'title'          => 'Student Detail',
        'title_singular' => 'Student Detail',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'full_name'           => 'Full Name',
            'full_name_helper'    => ' ',
            'parent_name'         => 'Parent Name',
            'parent_name_helper'  => ' ',
            'parent_phone'        => 'Parent Phone',
            'parent_phone_helper' => ' ',
            'group'               => 'Group',
            'group_helper'        => ' ',
            'is_disabled'         => 'Is Disabled',
            'is_disabled_helper'  => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
            'student_efk'         => 'Student',
            'student_efk_helper'  => ' ',
        ],
    ],
    'studentMetum' => [
        'title'          => 'Student Meta',
        'title_singular' => 'Student Metum',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'meta_key'           => 'Meta Key',
            'meta_key_helper'    => ' ',
            'meta_value'         => 'Meta Value',
            'meta_value_helper'  => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
            'student_efk'        => 'Student',
            'student_efk_helper' => ' ',
        ],
    ],
    'studentWork' => [
        'title'          => 'Student Work',
        'title_singular' => 'Student Work',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'category'                 => 'Category',
            'category_helper'          => ' ',
            'title'                    => 'Title',
            'title_helper'             => ' ',
            'desc'                     => 'Desc',
            'desc_helper'              => ' ',
            'start_at'                 => 'Start At',
            'start_at_helper'          => ' ',
            'end_at'                   => 'End At',
            'end_at_helper'            => ' ',
            'lesson_time'              => 'Lesson Time',
            'lesson_time_helper'       => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'time_given_minute'        => 'Time Given Minute',
            'time_given_minute_helper' => ' ',
            'created_by'               => 'Created By',
            'created_by_helper'        => ' ',
        ],
    ],
    'submission' => [
        'title'          => 'Submission',
        'title_singular' => 'Submission',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'status'              => 'Status',
            'status_helper'       => ' ',
            'submit_at'           => 'Submit At',
            'submit_at_helper'    => ' ',
            'mark'                => 'Mark',
            'mark_helper'         => ' ',
            'mark_at'             => 'Mark At',
            'mark_at_helper'      => ' ',
            'student_work'        => 'Student Work',
            'student_work_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
            'student_efk'         => 'Student',
            'student_efk_helper'  => ' ',
        ],
    ],
    'workResource' => [
        'title'          => 'Work Resource',
        'title_singular' => 'Work Resource',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'title'                => 'Title',
            'title_helper'         => ' ',
            'question_text'        => 'Question Text',
            'question_text_helper' => ' ',
            'url'                  => 'Url',
            'url_helper'           => ' ',
            'student_work'         => 'Student Work',
            'student_work_helper'  => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'created_by'           => 'Created By',
            'created_by_helper'    => ' ',
        ],
    ],
    'submitResource' => [
        'title'          => 'Submit Resource',
        'title_singular' => 'Submit Resource',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'title'               => 'Title',
            'title_helper'        => ' ',
            'answer_text'         => 'Answer Text',
            'answer_text_helper'  => ' ',
            'url'                 => 'Url',
            'url_helper'          => ' ',
            'student_work'        => 'Student Work',
            'student_work_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'coachDetail' => [
        'title'          => 'Coach Detail',
        'title_singular' => 'Coach Detail',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'enrollment_status'        => 'Enrollment Status',
            'enrollment_status_helper' => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'created_by'               => 'Created By',
            'created_by_helper'        => ' ',
            'coach_efk'                => 'Coach',
            'coach_efk_helper'         => ' ',
        ],
    ],
    'coachMetum' => [
        'title'          => 'Coach Meta',
        'title_singular' => 'Coach Metum',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'meta_key'          => 'Meta Key',
            'meta_key_helper'   => ' ',
            'meta_value'        => 'Meta Value',
            'meta_value_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'coach_efk'         => 'Coach',
            'coach_efk_helper'  => ' ',
        ],
    ],
    'contentManagement' => [
        'title'          => 'Content management',
        'title_singular' => 'Content management',
    ],
    'contentCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentPage' => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'category'              => 'Categories',
            'category_helper'       => ' ',
            'tag'                   => 'Tags',
            'tag_helper'            => ' ',
            'page_text'             => 'Full Text',
            'page_text_helper'      => ' ',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
        ],
    ],
];
