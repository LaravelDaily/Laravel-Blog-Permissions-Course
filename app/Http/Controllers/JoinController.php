<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class JoinController extends Controller
{

    public function create()
    {
        $organization = User::findOrFail(request('organization_id'));

        return view('join', compact('organization'));
    }

    public function store(Request $request)
    {
        auth()->user()->organizations()->attach($request->input('organization_id'));

        return redirect()->route('home');
    }

    public function organization()
    {
        $organization = User::findOrFail(request('organization_id'));
        session(['organization_id' => $organization->id, 'organization_name' => $organization->name]);

        return back();
    }
}
