<?php

namespace App\Http\Controllers\Helper;

use Rexlabs\Enum\Enum;

class ResponseStatus extends Enum{
    const REQUIRED_DATA = "Required Data";
    const INVALID_DATA = "Invalid Data";
    const DISALLOWED_ACTION = "Disallowed ACTION";
    const DUPLICATED_ACTION = "Duplicated ACTION";
    const NOT_EXIST = "Not Exist";
    const FAILED = "Failed";
    const OTHERS = "Others";

    // public static function map() : array
    // {
    //     return [
    //         static::REQUIRED_DATA => "Required Data",
    //         static::INVALID_DATA => "Invalid Data",
    //         static::DISALLOWED_ACTION => "Disallowed ACTION",
    //         static::DUPLICATED_ACTION => "Duplicated ACTION",
    //         static::NOT_EXIST => "Not Exist",
    //         static::FAILED => "Failed",
    //         static::OTHERS => "Others",
    //     ];
    // }
}