<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;

//use Au;

class UserRest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $info = $user->shop;
            return Response::json(
                array(
                    'accept' => 1,
                    'user'   => Auth::user()->toArray(),
                    'info'   => $info
                ),
                200
            );
        } else {
            return Response::json(
                array(
                    'accept' => 0,
                ),
                200
            );
        }
    }

    public function logout()
    {
        Auth::logout();
        return Response::json(
            array(
                'accept' => 1,
            ),
            200
        );
    }

    public function index()
    {
        //
        return Response::json(
            array(
                'values' => "User index",
            ),
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Response::json(
            array(
                'values' => "Create User",
            ),
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        return Response::json(
            array(
                'values' => "Store User",
            ),
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Response::json(
            array(
                'values' => "Show an User",
            ),
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return Response::json(
            array(
                'values' => "Edit info User",
            ),
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return Response::json(
            array(
                'values' => "Update info  User",
            ),
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Response::json(
            array(
                'values' => "Deletes User",
            ),
            200
        );
    }
}
