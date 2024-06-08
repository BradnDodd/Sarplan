<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserContactMethod\UserContactMethodStoreRequest;
use App\Http\Requests\User\UserContactMethod\UserContactMethodUpdateRequest;
use App\Services\UserContactMethodService;

class UserContactMethodApiController extends Controller
{
    public function __construct(private UserContactMethodService $userContactMethodService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->userContactMethodService->index()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserContactMethodStoreRequest $request)
    {
        return response()->json(
            $this->userContactMethodService->store($request),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            $this->userContactMethodService->show($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserContactMethodUpdateRequest $request, string $id)
    {
        return response()->json(
            $this->userContactMethodService->update($request, $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(
            $this->userContactMethodService->delete($id)
        );
    }
}
