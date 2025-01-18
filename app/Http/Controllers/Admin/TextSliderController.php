<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TextSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TextSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $textSliderQuery = TextSlider::query()->latest();

            return DataTables::eloquent($textSliderQuery)

                ->addIndexColumn()

                ->addColumn('is_active', fn($textSlider) => $textSlider->is_active == 1
                    ? view('components.badges', ['type' => 'success', 'text' => 'active'])
                    : view('components.badges', ['type' => 'danger', 'text' => 'in-active']))

                ->addColumn('created_at', fn($textSlider) => $textSlider->created_at->diffForHumans())
                ->addColumn('updated_at', fn($textSlider) => $textSlider->updated_at->diffForHumans())

                ->addColumn('action', function ($textSlider) {
                    return view('components.show-btn', ['url' => route('admin.website.text-slider.show', $textSlider->id)]) .
                        view('components.edit-btn', ['url' => route('admin.website.text-slider.edit', $textSlider->id)]) .
                        view('components.delete-btn', ['url' => route('admin.website.text-slider.destroy', $textSlider->id)]);
                })


                ->make();
        }

        return view('admin.text-slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.text-slider.form', [
            'textSlider' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
        ]);
        try {
            TextSlider::create($request->all());
            return redirect()->route('admin.website.text-slider.index')
                ->with(['message' => 'slider created', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to create text slider', 'type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TextSlider $textSlider)
    {
        return view('admin.text-slider.show', [
            'textSlider' => $textSlider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TextSlider $textSlider)
    {
        return view('admin.text-slider.form', [
            'textSlider' => $textSlider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TextSlider $textSlider)
    {
        $request->validate([
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        try {

            $textSlider->update($request->all());

            return redirect()->route('admin.website.text-slider.index')
                ->with(['message' => 'slider updated', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return back()->with(['message' => 'Failed to update text slider', 'type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TextSlider $textSlider)
    {
        try {
            $textSlider->delete();
            return response()->json([
                'message' => 'slider deleted successfully.',
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
