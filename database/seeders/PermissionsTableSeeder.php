<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'tuition_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'lesson_management_access',
            ],
            [
                'id'    => 19,
                'title' => 'coach_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'student_management_access',
            ],
            [
                'id'    => 21,
                'title' => 'class_room_create',
            ],
            [
                'id'    => 22,
                'title' => 'class_room_edit',
            ],
            [
                'id'    => 23,
                'title' => 'class_room_show',
            ],
            [
                'id'    => 24,
                'title' => 'class_room_delete',
            ],
            [
                'id'    => 25,
                'title' => 'class_room_access',
            ],
            [
                'id'    => 26,
                'title' => 'lesson_category_create',
            ],
            [
                'id'    => 27,
                'title' => 'lesson_category_edit',
            ],
            [
                'id'    => 28,
                'title' => 'lesson_category_show',
            ],
            [
                'id'    => 29,
                'title' => 'lesson_category_delete',
            ],
            [
                'id'    => 30,
                'title' => 'lesson_category_access',
            ],
            [
                'id'    => 31,
                'title' => 'tuition_package_create',
            ],
            [
                'id'    => 32,
                'title' => 'tuition_package_edit',
            ],
            [
                'id'    => 33,
                'title' => 'tuition_package_show',
            ],
            [
                'id'    => 34,
                'title' => 'tuition_package_delete',
            ],
            [
                'id'    => 35,
                'title' => 'tuition_package_access',
            ],
            [
                'id'    => 36,
                'title' => 'tuition_gift_create',
            ],
            [
                'id'    => 37,
                'title' => 'tuition_gift_edit',
            ],
            [
                'id'    => 38,
                'title' => 'tuition_gift_show',
            ],
            [
                'id'    => 39,
                'title' => 'tuition_gift_delete',
            ],
            [
                'id'    => 40,
                'title' => 'tuition_gift_access',
            ],
            [
                'id'    => 41,
                'title' => 'student_tuition_create',
            ],
            [
                'id'    => 42,
                'title' => 'student_tuition_edit',
            ],
            [
                'id'    => 43,
                'title' => 'student_tuition_show',
            ],
            [
                'id'    => 44,
                'title' => 'student_tuition_delete',
            ],
            [
                'id'    => 45,
                'title' => 'student_tuition_access',
            ],
            [
                'id'    => 46,
                'title' => 'lesson_level_create',
            ],
            [
                'id'    => 47,
                'title' => 'lesson_level_edit',
            ],
            [
                'id'    => 48,
                'title' => 'lesson_level_show',
            ],
            [
                'id'    => 49,
                'title' => 'lesson_level_delete',
            ],
            [
                'id'    => 50,
                'title' => 'lesson_level_access',
            ],
            [
                'id'    => 51,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 52,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 53,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 54,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 55,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 56,
                'title' => 'lesson_coach_create',
            ],
            [
                'id'    => 57,
                'title' => 'lesson_coach_edit',
            ],
            [
                'id'    => 58,
                'title' => 'lesson_coach_show',
            ],
            [
                'id'    => 59,
                'title' => 'lesson_coach_delete',
            ],
            [
                'id'    => 60,
                'title' => 'lesson_coach_access',
            ],
            [
                'id'    => 61,
                'title' => 'lesson_time_management_access',
            ],
            [
                'id'    => 62,
                'title' => 'lesson_time_create',
            ],
            [
                'id'    => 63,
                'title' => 'lesson_time_edit',
            ],
            [
                'id'    => 64,
                'title' => 'lesson_time_show',
            ],
            [
                'id'    => 65,
                'title' => 'lesson_time_delete',
            ],
            [
                'id'    => 66,
                'title' => 'lesson_time_access',
            ],
            [
                'id'    => 67,
                'title' => 'lesson_time_coach_create',
            ],
            [
                'id'    => 68,
                'title' => 'lesson_time_coach_edit',
            ],
            [
                'id'    => 69,
                'title' => 'lesson_time_coach_show',
            ],
            [
                'id'    => 70,
                'title' => 'lesson_time_coach_delete',
            ],
            [
                'id'    => 71,
                'title' => 'lesson_time_coach_access',
            ],
            [
                'id'    => 72,
                'title' => 'lesson_time_change_create',
            ],
            [
                'id'    => 73,
                'title' => 'lesson_time_change_edit',
            ],
            [
                'id'    => 74,
                'title' => 'lesson_time_change_show',
            ],
            [
                'id'    => 75,
                'title' => 'lesson_time_change_delete',
            ],
            [
                'id'    => 76,
                'title' => 'lesson_time_change_access',
            ],
            [
                'id'    => 77,
                'title' => 'student_lesson_progress_create',
            ],
            [
                'id'    => 78,
                'title' => 'student_lesson_progress_edit',
            ],
            [
                'id'    => 79,
                'title' => 'student_lesson_progress_show',
            ],
            [
                'id'    => 80,
                'title' => 'student_lesson_progress_delete',
            ],
            [
                'id'    => 81,
                'title' => 'student_lesson_progress_access',
            ],
            [
                'id'    => 82,
                'title' => 'student_work_management_access',
            ],
            [
                'id'    => 83,
                'title' => 'student_detail_create',
            ],
            [
                'id'    => 84,
                'title' => 'student_detail_edit',
            ],
            [
                'id'    => 85,
                'title' => 'student_detail_show',
            ],
            [
                'id'    => 86,
                'title' => 'student_detail_delete',
            ],
            [
                'id'    => 87,
                'title' => 'student_detail_access',
            ],
            [
                'id'    => 88,
                'title' => 'student_metum_create',
            ],
            [
                'id'    => 89,
                'title' => 'student_metum_edit',
            ],
            [
                'id'    => 90,
                'title' => 'student_metum_show',
            ],
            [
                'id'    => 91,
                'title' => 'student_metum_delete',
            ],
            [
                'id'    => 92,
                'title' => 'student_metum_access',
            ],
            [
                'id'    => 93,
                'title' => 'student_work_create',
            ],
            [
                'id'    => 94,
                'title' => 'student_work_edit',
            ],
            [
                'id'    => 95,
                'title' => 'student_work_show',
            ],
            [
                'id'    => 96,
                'title' => 'student_work_delete',
            ],
            [
                'id'    => 97,
                'title' => 'student_work_access',
            ],
            [
                'id'    => 98,
                'title' => 'submission_create',
            ],
            [
                'id'    => 99,
                'title' => 'submission_edit',
            ],
            [
                'id'    => 100,
                'title' => 'submission_show',
            ],
            [
                'id'    => 101,
                'title' => 'submission_delete',
            ],
            [
                'id'    => 102,
                'title' => 'submission_access',
            ],
            [
                'id'    => 103,
                'title' => 'work_resource_create',
            ],
            [
                'id'    => 104,
                'title' => 'work_resource_edit',
            ],
            [
                'id'    => 105,
                'title' => 'work_resource_show',
            ],
            [
                'id'    => 106,
                'title' => 'work_resource_delete',
            ],
            [
                'id'    => 107,
                'title' => 'work_resource_access',
            ],
            [
                'id'    => 108,
                'title' => 'submit_resource_create',
            ],
            [
                'id'    => 109,
                'title' => 'submit_resource_edit',
            ],
            [
                'id'    => 110,
                'title' => 'submit_resource_show',
            ],
            [
                'id'    => 111,
                'title' => 'submit_resource_delete',
            ],
            [
                'id'    => 112,
                'title' => 'submit_resource_access',
            ],
            [
                'id'    => 113,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 114,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 115,
                'title' => 'coach_detail_create',
            ],
            [
                'id'    => 116,
                'title' => 'coach_detail_edit',
            ],
            [
                'id'    => 117,
                'title' => 'coach_detail_show',
            ],
            [
                'id'    => 118,
                'title' => 'coach_detail_delete',
            ],
            [
                'id'    => 119,
                'title' => 'coach_detail_access',
            ],
            [
                'id'    => 120,
                'title' => 'coach_metum_create',
            ],
            [
                'id'    => 121,
                'title' => 'coach_metum_edit',
            ],
            [
                'id'    => 122,
                'title' => 'coach_metum_show',
            ],
            [
                'id'    => 123,
                'title' => 'coach_metum_delete',
            ],
            [
                'id'    => 124,
                'title' => 'coach_metum_access',
            ],
            [
                'id'    => 125,
                'title' => 'branch_management_access',
            ],
            [
                'id'    => 126,
                'title' => 'branch_create',
            ],
            [
                'id'    => 127,
                'title' => 'branch_edit',
            ],
            [
                'id'    => 128,
                'title' => 'branch_show',
            ],
            [
                'id'    => 129,
                'title' => 'branch_delete',
            ],
            [
                'id'    => 130,
                'title' => 'branch_access',
            ],
            [
                'id'    => 131,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 132,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 133,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 134,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 135,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 136,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 137,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 138,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 139,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 140,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 141,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 142,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 143,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 144,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 145,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 146,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 147,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 148,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 149,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 150,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 151,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 152,
                'title' => 'asset_create',
            ],
            [
                'id'    => 153,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 154,
                'title' => 'asset_show',
            ],
            [
                'id'    => 155,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 156,
                'title' => 'asset_access',
            ],
            [
                'id'    => 157,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 158,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 159,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 160,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 161,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 162,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 163,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 164,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 165,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 166,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 167,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 168,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 169,
                'title' => 'expense_create',
            ],
            [
                'id'    => 170,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 171,
                'title' => 'expense_show',
            ],
            [
                'id'    => 172,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 173,
                'title' => 'expense_access',
            ],
            [
                'id'    => 174,
                'title' => 'income_create',
            ],
            [
                'id'    => 175,
                'title' => 'income_edit',
            ],
            [
                'id'    => 176,
                'title' => 'income_show',
            ],
            [
                'id'    => 177,
                'title' => 'income_delete',
            ],
            [
                'id'    => 178,
                'title' => 'income_access',
            ],
            [
                'id'    => 179,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 180,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 181,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 182,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 183,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 184,
                'title' => 'profile_password_edit',
            ],
            // ------------------------------ custom permission ------------------------------
            [
                'id'    => 185,
                'title' => 'student_lesson_progress_upgrade'
            ],
            [
                'id'    => 186,
                'title' => 'student_lesson_progress_downgrade'
            ],
            [
                'id'    => 187,
                'title' => 'lesson_time_change_approve'
            ],
            [
                'id'    => 188,
                'title' => 'lesson_time_change_reject'
            ],
            // ------------------------------ custom permission ------------------------------
        ];

        Permission::insert($permissions);
    }
}
