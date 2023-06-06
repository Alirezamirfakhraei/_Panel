<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('auth::register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('auth::login');
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
    public function show(User $yes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $yes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $yes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $yes)
    {
        //
    }
}
