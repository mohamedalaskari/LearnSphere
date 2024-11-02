<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\StoreWhereSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject)
    {
        $subject = Subject::get();
        return $this->response(code: 200, data: $subject);
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
    public function store(StoreSubjectRequest $request, Subject $subject)
    {
        Gate::authorize('create', $subject);

        $request = $request->validated();
        //insert
        $insert_data = Subject::create($request);
        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        Gate::authorize('view', $subject);

        $id = $subject->id;
        $subject = Subject::with('course')->find($id);
        return $this->response(code: 200, data: $subject);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject, StoreWhereSubjectRequest $subject_old)
    {
        Gate::authorize('update', $subject);

        //new subject
        $request = $request->validated();
        //old subject
        $subject_old = $subject_old->validated();
        $subject_id = Subject::all()->where('subject', $subject_old['subject_name'])->first()->id;
        //update
        $update = DB::table('subjects')->where('id',  $subject_id)->update($request);
        return $this->response(code: 201, data: $update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
    public function delete(Subject $subject)
    {
        Gate::authorize('delete', $subject);

        $delete = $subject->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Subject $subject)
    {
        Gate::authorize('deleted', $subject);

        $deleted = $subject->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($subject, Subject $S)
    {
        Gate::authorize('restore', $S);
        $subject = Subject::where('id', $subject)->restore();
        return $this->response(code: 202, data: $subject);
    }
    public function delete_from_trash($subject, Subject $Subject)
    {
        Gate::authorize('forceDelete', $Subject);
        $subject  = Subject::where('id', $subject)->forceDelete();
        return $this->response(code: 202, data: $subject);
    }
}
