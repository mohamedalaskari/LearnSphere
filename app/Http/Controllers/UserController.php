<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreWhereClassroomRequest;
use App\Http\Requests\StoreWhereGovernorateRequest;
use App\Http\Requests\StoreWhereSubjectRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Classroom;
use App\Models\Governorate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        Gate::authorize('viewAny', $user);
        $user = user::get();
        return $this->response(code: 200, data: $user);
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
    public function store(StoreUserRequest $request, User $user, StoreWhereClassroomRequest $classroom, StoreWhereGovernorateRequest $governorate)
    {

        $request = $request->validated();
        //subject_id
        $classroom = $classroom->validated();
        $classroom_id = Classroom::all()->where('classroom', $classroom['classroom_name'])->first()->id;
        $request['Classroom_id'] = $classroom_id;
        //governorate_id
        $governorate = $governorate->validated();
        $governorate_id = Governorate::all()->where('governorate', $governorate['governorate_name'])->first()->id;
        $request['governorate_id'] = $governorate_id;
        //hash password
        $request['password'] = Hash::make($request['password']);
        //insert_data
        $insert_data = User::create($request);
        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('view', $user);
        $id = $user->id;
        $user = User::with('classroom', 'payment', 'videowatching', 'governorate')->find($id);
        return $this->response(code: 200, data: $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user, StoreWhereClassroomRequest $classroom, StoreWhereGovernorateRequest $governorate)
    {
        Gate::authorize('update', $user);
        $request = $request->validated();
        //hash_password
        $request['password'] = Hash::make($request['password']);
        //classroom_id
        $classroom = $classroom->validated();
        $classroom_id = Classroom::all()->where('classroom', $classroom['classroom_name'])->first()->id;
        $request['classroom_id'] = $classroom_id;
        //governorate_id
        $governorate = $governorate->validated();
        $governorate_id = Governorate::all()->where('governorate', $governorate['governorate_name'])->first()->id;
        $request['governorate_id'] = $governorate_id;
        //user_id
        $user_id = Auth::user()->id;
        //update
        $update = DB::table('users')->where('id', $user_id)->update($request);
        return $this->response(code: 201, data: $update);
    }
    public function MyProfile(User $User)
    {
        $id = Auth::user()->id;
        $user = User::with('classroom', 'payment', 'videowatching', 'governorate')->find($id);
        return $this->response(code: 200, data: $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(User $user)
    // {
    //     //
    // }
    public function delete(User $user)
    {
        Gate::authorize('delete', $user);
        $delete = $user->delete();
        return $this->response(code: 202, data: $delete);
    }

    public function deleted(User $user)
    {
        Gate::authorize('deleted', $user);
        $deleted = $user->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($user, User $User)
    {
        Gate::authorize('restore', $User);
        $user = User::where('id',  $user)->restore();
        return $this->response(code: 202, data: $user);
    }
    public function delete_from_trash($user, User $User)
    {
        Gate::authorize('forceDelete', $User);
        $user  = User::where('id', $user)->forceDelete();
        return $this->response(code: 202, data: $user);
    }
}