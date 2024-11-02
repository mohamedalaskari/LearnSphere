<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\StoreWhereGovernorateRequest;
use App\Http\Requests\StoreWhereTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Governorate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Teacher $teacher)
    {
        $teacher = Teacher::get();
        return $this->response(code: 200, data: $teacher);
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
    public function store(StoreTeacherRequest $request, StoreWhereGovernorateRequest $Governorate, Teacher $teacher)
    {
        Gate::authorize('create', $teacher);

        $request = $request->validated();
        //Governorate_id
        $Governorate = $Governorate->validated();
        $Governorate_id = Governorate::all()->where('governorate', $Governorate['governorate_name'])->first()->id;
        $request['governorate_id'] = $Governorate_id;
        //insert_data
        $insert_data = Teacher::create($request);
        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        Gate::authorize('view', $teacher);

        $id = $teacher->id;
        $teacher = Teacher::with('video', 'course', 'governorate')->find($id);
        return $this->response(code: 200, data: $teacher);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, StoreWhereGovernorateRequest $Governorate, Teacher $teacher)
    {
        Gate::authorize('update', $teacher);

        $request = $request->validated();
        //Governorate_id
        $Governorate = $Governorate->validated();
        $Governorate_id = Governorate::all()->where('governorate', $Governorate['governorate_name'])->first()->id;
        $request['governorate_id'] = $Governorate_id;
        //update
        $update = DB::table('teachers')->where('id', $request['id'])->update([
            'image' => $request['image'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'bio' => $request['bio'],
            'governorate_id' => $request['governorate_id'],
        ]);
        return $this->response(code: 201, data: $update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
    public function delete(Teacher $teacher)
    {
        Gate::authorize('delete', $teacher);

        $delete = $teacher->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Teacher $teacher)
    {
        Gate::authorize('deleted', $teacher);

        $deleted = $teacher->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($teacher, Teacher $T)
    {
        Gate::authorize('restore', $T);
        $teacher = Teacher::where('id', $teacher)->restore();
        return $this->response(code: 202, data: $teacher);
    }
    public function delete_from_trash($teacher, Teacher $Teacher)
    {
        Gate::authorize('forceDelete', $Teacher);
        $teacher  = Teacher::where('id', $teacher)->forceDelete();
        return $this->response(code: 202, data: $teacher);
    }
}
