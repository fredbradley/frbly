<?php

namespace App\Http\Controllers;

use App\Services\BitlyService;
use Illuminate\Http\Request;

class BitlinkController extends Controller
{
    public function __construct(protected BitlyService $bitlyService)
    {
        $this->middleware('auth');

    }
    public function remoteDestroy(string $domain, string $id)
    {
        //$id = str_replace("+", "/", $id);
        $delete = $this->bitlyService->delete($id);
        dd($delete);
        return redirect()->route('bitlinks.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session()->flash('alert-success', "All Bitlinks are listed below.");

        return view('bitlinks.index', [
            'bitlinks' => $this->bitlyService->getAllBitlinksByGroup(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('bitlinks.create', [

        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
