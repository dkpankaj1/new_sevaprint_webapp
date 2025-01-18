<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\OurService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class OurServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $ourServiceQuery = OurService::query()->latest();

            return DataTables::eloquent($ourServiceQuery)

                ->addIndexColumn()

                ->addColumn('icon', fn($ourService) => view('components.user-avatar', ['src' => $ourService->icon]))

                ->addColumn('is_active', fn($ourService) => $ourService->is_active == 1
                    ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                    : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))

                ->addColumn('created_at', fn($ourService) => $ourService->created_at->diffForHumans())
                ->addColumn('updated_at', fn($ourService) => $ourService->updated_at->diffForHumans())

                ->addColumn('action', function ($ourService) {
                    return view('components.show-btn', ['url' => route('admin.website.our-services.show', $ourService->id)]) .
                        view('components.edit-btn', ['url' => route('admin.website.our-services.edit', $ourService->id)]) .
                        view('components.delete-btn', ['url' => route('admin.website.our-services.destroy', $ourService->id)]);
                })


                ->make();
        }

        return view('admin.our-service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.our-service.form', [
            'service' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'required|image',
            'is_active' => 'required|boolean',
        ]);

        try {

            $request->icon = ImageUploadHelper::uploadImage(
                $request->file('icon'),
                'upload/our-service',
                45,
                45
            );

            OurService::create([
                "title" => $request->title,
                "description" => $request->description,
                "icon" => $request->icon,
                "is_active" => $request->is_active,
            ]);

            return redirect()->route('admin.website.our-services.index')
                ->with(['message' => 'create success', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to create', 'type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OurService $ourService)
    {
        return view('admin.our-service.form', [
            'service' => $ourService
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OurService $ourService)
    {
        return view('admin.our-service.form', [
            'service' => $ourService
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OurService $ourService)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|image',
            'is_active' => 'required|boolean',
        ]);

        try {
            if ($request->has('icon')) {
                ImageUploadHelper::deleteFile($ourService->getRawOriginal('icon'));
                $request->icon = ImageUploadHelper::uploadImage(
                    $request->file('icon'),
                    'upload/our-service',
                    45,
                    45
                );
            }
            $ourService->update([
                "title" => $request->title,
                "description" => $request->description,
                "icon" => $request->icon,
                "is_active" => $request->is_active,
            ]);
            return back()->with(['message' => 'update success', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to update', 'type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OurService $ourService)
    {
        try {
            ImageUploadHelper::deleteFile($ourService->getRawOriginal('icon'));
            $ourService->delete();
            return response()->json([
                'message' => 'deleted successfully.',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return response()->json([
                'message' => 'An error occurred. Please try again.',
                'status' => 'error',
            ]);
        }
    }
}
