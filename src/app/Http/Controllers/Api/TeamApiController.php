<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Services\TeamService;
use Illuminate\Http\JsonResponse;

class TeamApiController extends Controller
{
    public function __construct(private TeamService $teamService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->teamService->index()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamStoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->teamService->store($request),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(
            $this->teamService->show($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamUpdateRequest $request, string $id): JsonResponse
    {
        return response()->json(
            $this->teamService->update($request, $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->teamService->delete($id);

        return response()->json([]);
    }
}
