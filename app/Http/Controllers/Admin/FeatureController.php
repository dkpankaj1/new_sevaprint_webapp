<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Services\Contracts\FeatureServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeatureController extends Controller
{
    protected $featureService;
    public function __construct(FeatureServiceInterface $featureService)
    {
        $this->featureService = $featureService; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->expectsJson()) {
           return $this->featureService->getDataTableData();
        }
        return view('admin.feature.index');        
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.feature.show', ['feature' => $this->featureService->findFeature($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.feature.edit', ['feature' => $this->featureService->findFeature($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            "name" => ['required', 'string', 'max:255'],
            "description" => ['nullable', 'string'],
            "thumbnail" => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            "fee" => ['required', 'numeric', 'min:0'],
            "commission" => ['required', 'numeric', 'min:0'],
            "commission_type" => ['required', Rule::in([0,1])],
            "enable" => ['required', 'boolean'],
        ]);

        try {

            if ($request->has('thumbnail')) {
                $this->featureService->updateFeatureIcon($id,$request->file('thumbnail'));
            }

            $this->featureService->updateFeature($id, $validated);           

            $notification = ['message' => 'service update success.', 'type' => 'success'];
            return redirect()->route('admin.feature.index')->with($notification);
        } catch (\Exception $e) {            
            $notification = ['message' => 'Failed to update service. Please try again.', 'type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

}
