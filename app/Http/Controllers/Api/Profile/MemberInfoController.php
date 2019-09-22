<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\AccessmUser;

class MemberInfoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = AccessmUser::find($id);

        if(!$user){
            return response()->json([
                "status" => "error",
                "message" => "No such user!"
            ]);
        }
        try{
            $member = AccessmUser::find($id)->member->only([
                "rhq",
                "zone",
                "Chapter",
                "District",
                "Position",
                "Division"
            ]);

            return response()->json([
                "status" => "success",
                "data" => $member
            ]);
        } catch(\Throwable $t) {
            return response()->json([
                "status" => "error",
                "message" => "No such SSA member!"
            ]);
        }
    }
}
