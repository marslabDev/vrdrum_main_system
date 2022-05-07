<?php

namespace App\Http\Controllers\Helper;

use Rexlabs\Enum\Enum;

class ResponseStrings extends Enum{
    // required data
    // const REQUIRED_TIMEZONE_OFFSET = "Timezone offset is null, required timezone offset";


    // invalid data
    const INVALID_LESSON_ID = 'Invalid lesson id';
    const INVALID_LESSON_TIME_ID = 'Invalid lesson time id';
    const INVALID_TUITION_PACKAGE_ID = 'Invalid tuition package id';
    const INVALID_STUDENT_ID = 'Invalid student id';


    // disallowed action


    // duplicated action


    // not exist
    const NOT_EXIST_LESSON = "Lesson %s not found";
    const NOT_EXIST_LESSON_TIME_CODE = "Lesson time code %s not found";
    const NOT_EXIST_STUDENT_ID_LESSON = "Student %s lesson time not found";
    const NOT_EXIST_STUDENT_DETAIL = "Student detail %s not found";
    const NOT_EXIST_DRUM_LEVEL = "Drum level %s not found";


    // failed


    // others

}
