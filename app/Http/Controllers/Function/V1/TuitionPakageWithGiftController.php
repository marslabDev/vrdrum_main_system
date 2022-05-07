<?php

namespace App\Http\Controllers\Function\V1;

use App\Http\Controllers\Helper\HttpResponse;
use App\Http\Controllers\Controller;
use App\Models\LessonCategory;
use App\Models\TuitionPackage;
use App\Models\TuitionGift;
use Illuminate\Http\Request;

class TuitionPakageWithGiftController extends Controller
{
    protected function index(Request $request){
        try{
            $all_tuition = TuitionPackage::all();

            foreach ($all_tuition as $index => $value){
                $tuition_gifts = TuitionGift::where('tuition_package_id', $all_tuition[$index]->id)->get();
                $lesson_category = LessonCategory::find($all_tuition[$index]->lesson_category_id);

                $all_tuition[$index]->tuition_gifts = $tuition_gifts;
                $all_tuition[$index]->lesson_category = $lesson_category;
            }

            return HttpResponse::successResponse(result: $all_tuition);

        }catch(Exception $e){
            return HttpResponse::errorResponse($e->message);
        }
    }
}
