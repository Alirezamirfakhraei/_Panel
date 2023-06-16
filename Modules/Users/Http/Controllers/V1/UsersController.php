<?php

namespace Modules\Users\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return 10;
    }

    public function create()
    {
        return view('users::create');
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        return view('users::show');
    }

    public function edit($id)
    {
        return view('users::edit');
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
