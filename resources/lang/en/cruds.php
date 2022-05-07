<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
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
        'title'          => 'Roles',
        'title_singular' => 'Role',
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
        'title'          => 'Users',
        'title_singular' => 'User',
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
            'branch_efk'          => 'Branch Efk',
            'branch_efk_helper'   => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
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
            'inventory_efk'          => 'Inventory Efk',
            'inventory_efk_helper'   => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'type'                   => 'Type',
            'type_helper'            => ' ',
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
            'student'                => 'Student',
            'student_helper'         => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
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
            'coach'             => 'Coach',
            'coach_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
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
            'student'            => 'Student',
            'student_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
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
            'coach'              => 'Coach',
            'coach_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'lessonTimeChange' => [
        'title'          => 'Lesson Time Change',
        'title_singular' => 'Lesson Time Change',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'date_from'              => 'Date From',
            'date_from_helper'       => ' ',
            'date_to'                => 'Date To',
            'date_to_helper'         => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
            'request_date'           => 'Request Date',
            'request_date_helper'    => ' ',
            'response_date'          => 'Response Date',
            'response_date_helper'   => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'old_lesson_time'        => 'Old Lesson Time',
            'old_lesson_time_helper' => ' ',
            'class_room'             => 'Class Room',
            'class_room_helper'      => ' ',
            'lesson'                 => 'Lesson',
            'lesson_helper'          => ' ',
            'student'                => 'Student',
            'student_helper'         => ' ',
            'request_user'           => 'Request User',
            'request_user_helper'    => ' ',
            'response_user'          => 'Response User',
            'response_user_helper'   => ' ',
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
            'student'                => 'Student',
            'student_helper'         => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
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
            'student'             => 'Student',
            'student_helper'      => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'studentMetum' => [
        'title'          => 'Student Meta',
        'title_singular' => 'Student Metum',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'meta_key'          => 'Meta Key',
            'meta_key_helper'   => ' ',
            'meta_value'        => 'Meta Value',
            'meta_value_helper' => ' ',
            'student'           => 'Student',
            'student_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
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
            'student'             => 'Student',
            'student_helper'      => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
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
        ],
    ],
];
