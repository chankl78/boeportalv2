<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\BackofficeqLoggerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{

    public function __construct(BackofficeqLoggerService $logger)
    {
        $this->logger = $logger;
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $path = $request->file('avatar')->store('avatars');
        $user = Auth::user();

        if (file_exists(storage_path())) {
            Storage::delete($user->avatar);
        }

        $user->avatar = $path;
        $user->save();

        $this->logger->info('[Avatar] Uploaded Successfully!');

        return response()->json([
            'status' => 'success',
            "message" => 'Uploaded Successfully!'
        ], 200);
    }
}
