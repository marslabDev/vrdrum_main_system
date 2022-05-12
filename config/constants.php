<?php

// way to use
// - config('constants.lesson.one_lesson_time');

return [
    'lesson' => [
        'one_lesson_time' => 30,
        'one_lesson_price' => 10
    ],
    'lesson_time_change' => [
        'status' => [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected'
        ]
    ],
    'phone_number_pattern' => '[+]{0,1}[6]{0,1}[0](\s){0,1}[1-9]{2}(-|\s){0,1}[0-9]{3,4}(\s){0,1}[0-9]{4}',//(+?6?)[0][1-9]{2}(\-|\s)?[0-9]{3,4}(\s)?[0-9]{4}
];