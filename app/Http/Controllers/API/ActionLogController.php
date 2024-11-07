<?php

namespace App\Http\Controllers\API;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //set actionLog
    public function actionLog(Request $request){
        $data = [
            'user_id' => $request->user_id ,
            'post_id' => $request->post_id,
        ];
        ActionLog::create($data);

        $data = ActionLog::where('post_id',$request->post_id)->get();

        return response()->json([
            // 'message' => "Action Log Create Success"
            'post' => $data
        ]);
    }
}
