<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {

            $videoQuery = Videos::query()->latest();

            return DataTables::eloquent($videoQuery)

                ->addIndexColumn()

                ->addColumn('url', fn($videos) => "<a href='{$videos->url}' target='_blank'>{$videos->url}</a>")

                ->addColumn('is_active', fn($videos) => $videos->is_active == 1
                    ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                    : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))

                ->addColumn('created_at', fn($videos) => $videos->created_at->diffForHumans())

                ->addColumn('updated_at', fn($videos) => $videos->updated_at->diffForHumans())

                ->addColumn('action', function ($videos) {
                    return view('components.show-btn', ['url' => route('admin.website.videos.show', $videos->id)]) .
                        view('components.edit-btn', ['url' => route('admin.website.videos.edit', $videos->id)]) .
                        view('components.delete-btn', ['url' => route('admin.website.videos.destroy', $videos->id)]);
                })

                ->rawColumns(['url', 'action'])

                ->make();
        }

        return view('admin.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videos.form', ['video' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'url' => 'required|url',
            'is_active' => 'required|boolean',
        ]);

        try {
            Videos::create($request->all());
            return redirect()->route('admin.website.videos.index')
                ->with(['message' => 'videos added success', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to add video', 'type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Videos $video)
    {
        return view('admin.videos.show', ['video' => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videos $video)
    {
        return view('admin.videos.form', ['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videos $video)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'url' => 'required|url',
            'is_active' => 'required|boolean',
        ]);

        try {
            $video->update($request->all());
            return back()->with('admin.website.videos.index')
                ->with(['message' => 'videos update success', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to update video', 'type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videos $video)
    {
        try {
            $video->delete();
            return response()->json([
                'message' => 'video deleted successfully.',
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
