<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Callout\CalloutStoreRequest;
use App\Http\Requests\Callout\CalloutUpdateRequest;
use App\Services\CalloutService;
use Illuminate\Http\JsonResponse;

class CalloutApiController extends Controller
{
    public function __construct(private CalloutService $calloutService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->calloutService->index()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalloutStoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->calloutService->store($request),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(
            $this->calloutService->show($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CalloutUpdateRequest $request, string $id): JsonResponse
    {
        return response()->json(
            $this->calloutService->update($request, $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->calloutService->delete($id);

        return response()->json([]);
    }
}
