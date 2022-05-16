<?php

namespace App\Http\Controllers\Helper;

use Exception;

class CusException extends Exception{
    public $message;
    public $status;

    public function __construct($message, $status) {
        $this->message = $message;
        $this->status = $status;
    }
}
