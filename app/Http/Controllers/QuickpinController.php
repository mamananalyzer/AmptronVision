<?php

namespace App\Http\Controllers;

use App\Models\Quickpin;
use Illuminate\Http\Request;

class QuickpinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'base.quickpin'
            // , compact('totalBelanja', 'session')
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show($created_at)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Quickpin $Quickpin)
    {
        //
    }


    // public function edit(Quickpin $Quickpin)
    //{
    //
    //}

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Quickpin $Quickpin)
    {
        //
    }

    //public function update(Request $request, Quickpin $Quickpin)
    //{
    //
    //}

    public function destroy(Quickpin $Quickpin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(Quickpin $Quickpin)
    //{
    //
    //}
}
