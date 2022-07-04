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
                'title' => 'student_detail_create',
            ],
            [
                'id'    => 83,
                'title' => 'student_detail_edit',
            ],
            [
                'id'    => 84,
                'title' => 'student_detail_show',
            ],
            [
                'id'    => 85,
                'title' => 'student_detail_delete',
            ],
            [
                'id'    => 86,
                'title' => 'student_detail_access',
            ],
            [
                'id'    => 87,
                'title' => 'student_metum_create',
            ],
            [
                'id'    => 88,
                'title' => 'student_metum_edit',
            ],
            [
                'id'    => 89,
                'title' => 'student_metum_show',
            ],
            [
                'id'    => 90,
                'title' => 'student_metum_delete',
            ],
            [
                'id'    => 91,
                'title' => 'student_metum_access',
            ],
            [
                'id'    => 92,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 93,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 94,
                'title' => 'coach_detail_create',
            ],
            [
                'id'    => 95,
                'title' => 'coach_detail_edit',
            ],
            [
                'id'    => 96,
                'title' => 'coach_detail_show',
            ],
            [
                'id'    => 97,
                'title' => 'coach_detail_delete',
            ],
            [
                'id'    => 98,
                'title' => 'coach_detail_access',
            ],
            [
                'id'    => 99,
                'title' => 'coach_metum_create',
            ],
            [
                'id'    => 100,
                'title' => 'coach_metum_edit',
            ],
            [
                'id'    => 101,
                'title' => 'coach_metum_show',
            ],
            [
                'id'    => 102,
                'title' => 'coach_metum_delete',
            ],
            [
                'id'    => 103,
                'title' => 'coach_metum_access',
            ],
            [
                'id'    => 104,
                'title' => 'branch_management_access',
            ],
            [
                'id'    => 105,
                'title' => 'branch_create',
            ],
            [
                'id'    => 106,
                'title' => 'branch_edit',
            ],
            [
                'id'    => 107,
                'title' => 'branch_show',
            ],
            [
                'id'    => 108,
                'title' => 'branch_delete',
            ],
            [
                'id'    => 109,
                'title' => 'branch_access',
            ],
            [
                'id'    => 110,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 111,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 112,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 113,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 114,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 115,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 116,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 117,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 118,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 119,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 120,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 121,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 122,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 123,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 124,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 125,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 126,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 127,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 128,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 129,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 130,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 131,
                'title' => 'asset_create',
            ],
            [
                'id'    => 132,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 133,
                'title' => 'asset_show',
            ],
            [
                'id'    => 134,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 135,
                'title' => 'asset_access',
            ],
            [
                'id'    => 136,
                'title' => 'assets_history_show',
            ],
            [
                'id'    => 137,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 138,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 139,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 140,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 141,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 142,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 143,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 144,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 145,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 146,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 147,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 148,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 149,
                'title' => 'expense_create',
            ],
            [
                'id'    => 150,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 151,
                'title' => 'expense_show',
            ],
            [
                'id'    => 152,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 153,
                'title' => 'expense_access',
            ],
            [
                'id'    => 154,
                'title' => 'income_create',
            ],
            [
                'id'    => 155,
                'title' => 'income_edit',
            ],
            [
                'id'    => 156,
                'title' => 'income_show',
            ],
            [
                'id'    => 157,
                'title' => 'income_delete',
            ],
            [
                'id'    => 158,
                'title' => 'income_access',
            ],
            [
                'id'    => 159,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 160,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 161,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 162,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 163,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 164,
                'title' => 'lesson_time_student_create',
            ],
            [
                'id'    => 165,
                'title' => 'lesson_time_student_edit',
            ],
            [
                'id'    => 166,
                'title' => 'lesson_time_student_show',
            ],
            [
                'id'    => 167,
                'title' => 'lesson_time_student_delete',
            ],
            [
                'id'    => 168,
                'title' => 'lesson_time_student_access',
            ],
            [
                'id'    => 169,
                'title' => 'student_parent_create',
            ],
            [
                'id'    => 170,
                'title' => 'student_parent_edit',
            ],
            [
                'id'    => 171,
                'title' => 'student_parent_show',
            ],
            [
                'id'    => 172,
                'title' => 'student_parent_delete',
            ],
            [
                'id'    => 173,
                'title' => 'student_parent_access',
            ],
            [
                'id'    => 174,
                'title' => 'address_create',
            ],
            [
                'id'    => 175,
                'title' => 'address_edit',
            ],
            [
                'id'    => 176,
                'title' => 'address_show',
            ],
            [
                'id'    => 177,
                'title' => 'address_delete',
            ],
            [
                'id'    => 178,
                'title' => 'address_access',
            ],
            [
                'id'    => 179,
                'title' => 'lesson_post_management_access',
            ],
            [
                'id'    => 180,
                'title' => 'lesson_time_post_create',
            ],
            [
                'id'    => 181,
                'title' => 'lesson_time_post_edit',
            ],
            [
                'id'    => 182,
                'title' => 'lesson_time_post_show',
            ],
            [
                'id'    => 183,
                'title' => 'lesson_time_post_delete',
            ],
            [
                'id'    => 184,
                'title' => 'lesson_time_post_access',
            ],
            [
                'id'    => 185,
                'title' => 'post_content_create',
            ],
            [
                'id'    => 186,
                'title' => 'post_content_edit',
            ],
            [
                'id'    => 187,
                'title' => 'post_content_show',
            ],
            [
                'id'    => 188,
                'title' => 'post_content_delete',
            ],
            [
                'id'    => 189,
                'title' => 'post_content_access',
            ],
            [
                'id'    => 190,
                'title' => 'post_content_submit_create',
            ],
            [
                'id'    => 191,
                'title' => 'post_content_submit_edit',
            ],
            [
                'id'    => 192,
                'title' => 'post_content_submit_show',
            ],
            [
                'id'    => 193,
                'title' => 'post_content_submit_delete',
            ],
            [
                'id'    => 194,
                'title' => 'post_content_submit_access',
            ],
            [
                'id'    => 195,
                'title' => 'post_comment_create',
            ],
            [
                'id'    => 196,
                'title' => 'post_comment_edit',
            ],
            [
                'id'    => 197,
                'title' => 'post_comment_show',
            ],
            [
                'id'    => 198,
                'title' => 'post_comment_delete',
            ],
            [
                'id'    => 199,
                'title' => 'post_comment_access',
            ],
            [
                'id'    => 200,
                'title' => 'post_submission_create',
            ],
            [
                'id'    => 201,
                'title' => 'post_submission_edit',
            ],
            [
                'id'    => 202,
                'title' => 'post_submission_show',
            ],
            [
                'id'    => 203,
                'title' => 'post_submission_delete',
            ],
            [
                'id'    => 204,
                'title' => 'post_submission_access',
            ],
            [
                'id'    => 205,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 206,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 207,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 208,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 209,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 210,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 211,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 212,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 213,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 214,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 215,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 216,
                'title' => 'product_create',
            ],
            [
                'id'    => 217,
                'title' => 'product_edit',
            ],
            [
                'id'    => 218,
                'title' => 'product_show',
            ],
            [
                'id'    => 219,
                'title' => 'product_delete',
            ],
            [
                'id'    => 220,
                'title' => 'product_access',
            ],
            [
                'id'    => 221,
                'title' => 'order_create',
            ],
            [
                'id'    => 222,
                'title' => 'order_edit',
            ],
            [
                'id'    => 223,
                'title' => 'order_show',
            ],
            [
                'id'    => 224,
                'title' => 'order_delete',
            ],
            [
                'id'    => 225,
                'title' => 'order_access',
            ],
            [
                'id'    => 226,
                'title' => 'order_item_create',
            ],
            [
                'id'    => 227,
                'title' => 'order_item_edit',
            ],
            [
                'id'    => 228,
                'title' => 'order_item_show',
            ],
            [
                'id'    => 229,
                'title' => 'order_item_delete',
            ],
            [
                'id'    => 230,
                'title' => 'order_item_access',
            ],
            [
                'id'    => 231,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
