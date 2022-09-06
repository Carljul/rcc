<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotIn('id', [1, 2])->get();
        return view('auth.register', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        \DB::beginTransaction();
        try {
            $params = $request->all();
            if (isset($params['resetPassword'])) {
                $user->password = Hash::make('123456');
            } elseif (isset($params['userRole'])) {
                $role = $user->role;

                if ($role == 1) {
                    $user->role = 2;
                } else {
                    $user->role = 1;
                }
            }else {
                $active = $user->isActive;

                if ($active == 1) {
                    $user->isActive = 0;
                } else {
                    $user->isActive = 1;
                }
            }

            $user->save();
            \DB::commit();
            return redirect()->back()->with(['message' => 'Updated']);
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);

            \DB::rollback();

            return redirect()->back()->withError(['message' => 'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
