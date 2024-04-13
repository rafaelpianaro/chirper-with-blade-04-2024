<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChirpRequest;
use App\Models\Chirp;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        // dd(Chirp::with('user')->latest()->get());
        return view('chirps.index',[
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
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
    public function store(StoreChirpRequest $request) : RedirectResponse
    {
        // $validated = $request->validate([
        //     'message' => 'required|string|max:255',
        // ]);

        $validated = $request->validated();
        $request->user()->chirps()->create($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        // dd($chirp);
        Gate::authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreChirpRequest $request, Chirp $chirp) : RedirectResponse
    {
        Gate::authorize('update', $chirp);
        // validation
        // $validated = $request->validate([
        //     'message' => 'required|string|max:255',
        // ]);

        $validated = $request->validated();

        // update the chirp
        $chirp->update($validated);
        
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
