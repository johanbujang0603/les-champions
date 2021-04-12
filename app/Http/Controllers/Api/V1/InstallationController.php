<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Installation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\V1\Installations\InstallationStoreRequest;
use App\Http\Requests\Api\V1\Installations\InstallationUpdateRequest;

class InstallationController extends Controller
{
    public function store(InstallationStoreRequest $request) : JsonResponse
    {
        $installation = new Installation;
        $installation->fill($request->validated());

        DB::transaction(function () use ($installation) {
            if (($user = Auth::user()) !== null) {
                $installation->user()->associate($user);
            }
            $installation->save();
        });

        return response()->json([
            'data' => [
                'id' => $installation->uuid,
            ],
        ], 201);
    }

    public function update(InstallationUpdateRequest $request, string $uuid) : JsonResponse
    {
        $installation = Installation::whereUuid($uuid)->firstOrFail();
        $installation->fill($request->validated());

        DB::transaction(function () use ($installation) {
            if (($user = Auth::user()) !== null) {
                $installation->user()->associate($user);
            }
            $installation->save();
        });

        return response()->json([
            'data' => [
                'id' => $installation->uuid,
            ],
        ], 201);
    }
}
