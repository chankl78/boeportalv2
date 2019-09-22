<?php

namespace App\Http\Controllers\Api\Profile;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\AccessmUser;
use App\Models\ConfigurationmDefault;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdateUserInfoNotification;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|unique:Access_m_User',
            'email' => 'required|email|unique:Access_m_User',
            'subject' => 'required|string|min:6|max:256',
            'content' => 'required|string|min:6|max:256',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        };

        $email = ConfigurationmDefault::where("key", "DHET")->first()->value;
        $userId = Auth::user()->id;

        try{
            Mail::to($email)->send(new UpdateUserInfoNotification($data, $userId));
            return response()->json([
                'status' => 'success',
                'message' => 'Request sent successfully!',
            ], 200);
        } catch(\Throwable $t) {
            return response()->json([
                'status' => 'error',
                'message' => $t
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        try {
            $userInfo = AccessmUser::find($id)->only(["name", "email"]);
            return response()->json([
                "status" => "success",
                "data" => $userInfo
            ]);   
        } catch(\Throwable $t) {
            return response()->json([
                "status" => "error",
                "message" => "No such user!"
            ]); 
        }
    }
}
