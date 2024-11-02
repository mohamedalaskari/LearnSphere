<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\StoreWhereClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(classroom $Classroom)
    {

        $classroom = Classroom::all();
        return  $this->response(code: 200, data: $classroom);
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
    public function store(StoreClassroomRequest $request, Classroom $classroom)
    {
        Gate::authorize('create',   $classroom);
        $request = $request->validated();
        //insert in database
        $insert_data = Classroom::create($request);

        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        Gate::authorize('view',  $classroom);
        $id = $classroom->id;
        $classroom = Classroom::with('user')->find($id);
        return $this->response(code: 200, data: $classroom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom, StoreWhereClassroomRequest $classroom_id)
    {
        Gate::authorize('update',  arguments: $classroom);
        //new_data
        $request = $request->validated();
        //old_data
        $classroom_id = $classroom_id->validated();
        //update
        $updata = DB::table('classrooms')->where('classroom',  $classroom_id['classroom_name'])->update($request);
        return $this->response(code: 201, data: $updata);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
    public function delete(Classroom $classroom)
    {
        Gate::authorize('delete',  arguments: $classroom);
        $delete = $classroom->delete();
        return $this->response(code: 202, data: $delete);
    }

    public function deleted(Classroom $classroom)
    {
        Gate::authorize('deleted',  $classroom);
        $deleted = $classroom->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($classroom, Classroom $g)
    {
        Gate::authorize('restore', $g);
        $classroom = Classroom::where('id', $classroom)->restore();
        return $this->response(code: 202, data: $classroom);
    }
    public function delete_from_trash($classroom, Classroom $Classroom)
    {
        Gate::authorize('forceDelete', $Classroom);
        $classroom  = Classroom::where('id', $classroom)->forceDelete();
        return $this->response(code: 202, data: $classroom);
    }
}
