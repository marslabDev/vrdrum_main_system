<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Helper\CusStatus;

class HttpResponse {
    public static function successResponse(string $message = null, $result = null, $statusCode = 200){
        try{
            $responseData = [
                "Status"=> "Success",
                "Success"=> true,
                "Failed"=> false,
                "Message"=> $message != null ? $message : null,
                "Result"=> $result != null ? $result : null,
            ];
    
            return response($responseData, $statusCode);
    
        }catch (Exception $e){
            throw $e;
        }
    }
    
    public static function errorResponse(string $message = null, $result = null, string $customStatus = ResponseStatus::FAILED, $statusCode = 202){
        try{
            $responseData = [
                "Status"=> $customStatus,
                "Success"=> false,
                "Failed"=> true,
                "Message"=> $message != null ? $message : null,
                "Result"=> $result != null ? $result : null,
            ];
    
            return response($responseData, $statusCode);
    
        }catch (Exception $e){
            throw $e;
        }
    }
}
