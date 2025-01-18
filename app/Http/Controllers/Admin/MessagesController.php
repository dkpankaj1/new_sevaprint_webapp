<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $messagesQuery = Messages::query()->latest();

            return DataTables::eloquent($messagesQuery)
                ->addIndexColumn()
                ->addColumn('created_at', fn($msg) => $msg->created_at->diffForHumans())
                ->addColumn('updated_at', fn($msg) => $msg->updated_at->diffForHumans())
                ->addColumn('action', function ($msg) {
                    return view('components.show-btn', ['url' => route('admin.messages.show', $msg->id)]);
                })
                ->make();
        }

        return view('admin.messages.index');
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
    public function show(Messages $messages)
    {
        return view('admin.messages.show', ['messages' => $messages]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
