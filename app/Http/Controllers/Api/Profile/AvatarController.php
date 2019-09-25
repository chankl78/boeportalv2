<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\BackofficeqLoggerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\AccessmUser;

class AvatarController extends Controller
{

    public function __construct(BackofficeqLoggerService $logger)
    {
        $this->logger = $logger;
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = AccessmUser::find($id);

        if(!$user){
            return response()->json([
                "status" => "error",
                "message" => "No such user!"
            ]); 
        }
       
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $path = $request->file('avatar')->store('avatars');
        $originalAvatar = $user->getOriginal('avatar');

        if (file_exists(storage_path('app/public/'.$originalAvatar)) && $originalAvatar !== 'avatars/default.png') {
            Storage::delete($originalAvatar);
        }

        $user->avatar = $path;
        $user->save();

        $this->logger->info('[Avatar] Uploaded Successfully!');

        return response()->json([
            'status' => 'success',
            "message" => 'Uploaded Successfully!'
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = AccessmUser::find($id);

        if(!$user){
            return response()->json([
                "status" => "error",
                "message" => "No such user!"
            ]); 
        }

        $originalAvatar = $user->getOriginal('avatar');

        if (file_exists(storage_path('app/public/'.$originalAvatar)) && $originalAvatar !== 'avatars/default.png') {
            Storage::delete($originalAvatar);
        }

        $user->avatar = 'avatars/default.png';
        $user->save();

        return response()->json([
            'status' => 'success',
            "message" => 'Deleted Successfully!'
        ], 200);
        
    }
}
