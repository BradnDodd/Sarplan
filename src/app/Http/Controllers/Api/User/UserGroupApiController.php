<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserGroup\UserGroupStoreRequest;
use App\Http\Requests\User\UserGroup\UserGroupUpdateRequest;
use App\Services\UserGroupService;
use Illuminate\Http\JsonResponse;

class UserGroupApiController extends Controller
{
    public function __construct(private UserGroupService $userGroupService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->userGroupService->index()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserGroupStoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->userGroupService->store($request),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(
            $this->userGroupService->show($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserGroupUpdateRequest $request, string $id): JsonResponse
    {
        return response()->json(
            $this->userGroupService->update($request, $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->userGroupService->delete($id);

        return response()->json([]);
    }
}
