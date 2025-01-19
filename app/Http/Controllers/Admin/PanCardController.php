<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FormStatus;
use App\Http\Controllers\Controller;
use App\Models\PanCard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PanCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $nsdlPanQuery = PanCard::query()->latest();

            return DataTables::eloquent($nsdlPanQuery)
                ->addIndexColumn()
                ->addColumn('status', function ($nsdlPan) {
                    $badgeType = match ($nsdlPan->status) {
                        'complete' => 'success',
                        'pending' => 'info',
                        'failed' => 'danger',
                        default => 'secondary',
                    };
                    return view('components.badges', [
                        'type' => $badgeType,
                        'text' => ucfirst($nsdlPan->status),
                    ]);
                })

                ->addColumn('acknowledgement_no', fn($nsdlPan) => $nsdlPan->acknowledgement_no ? $nsdlPan->acknowledgement_no : "N/A")

                ->addColumn('created_at', fn($nsdlPan) => $nsdlPan->created_at->diffForHumans())
                ->addColumn('updated_at', fn($nsdlPan) => $nsdlPan->updated_at->diffForHumans())

                ->addColumn('action', function ($nsdlPan) {
                    return view('components.show-btn', ['url' => route('admin.pan-card.show', $nsdlPan->id)]);
                })

                ->make();
        }
        return view('admin.pancard.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PanCard $panCard)
    {
        return view('admin.pancard.show',['panCard' => $panCard]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PanCard $panCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PanCard $panCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PanCard $panCard)
    {
        //
    }
}
