<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\StoreWhereCourseRequest;
use App\Http\Requests\StoreWhereSubjectRequest;
use App\Http\Requests\StoreWhereTeacherRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        Gate::authorize('viewAny', $course);
        $Course = Course::all();
        return  $this->response(code: 200, data: $Course);
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
    public function store(StoreCourseRequest $request, StoreWhereSubjectRequest $subject, Course $course, StoreWhereTeacherRequest $teacher)
    {
        Gate::authorize('create', $course);
        $request = $request->validated();
        //discount
        $request['price'] = ($request['price']) * ($request['discount']);
        // return $request;
        // subject_id
        $subject = $subject->validated();
        $subject_id = Subject::all()->where('subject', $subject['subject_name'])->first()->id;
        $request['subject_id'] = $subject_id;
        //teacher_id
        $teacher = $teacher->validated();
        $teacher_id = Teacher::all()->where('first_name', '=', $teacher['first_name'])
            ->where('last_name', '=', $teacher['last_name'])->first()->id;
        $request['teacher_id'] = $teacher_id;
        // insert_data
        $insert_data = Course::create($request);
        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        Gate::authorize('view', $course);
        $id = $course->id;
        $course = Course::with('teacher', 'subject', 'video')->find($id);
        return $this->response(code: 200, data: $course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course, StoreWhereSubjectRequest $subject, StoreWhereTeacherRequest $teacher, StoreWhereCourseRequest $course_old)
    {
        Gate::authorize('update', $course);
        $request = $request->validated();
        //discount
        $request['price'] = ($request['price']) * ($request['discount']);
        // subject_id
        $subject = $subject->validated();
        $subject_id = Subject::all()->where('subject', $subject['subject_name'])->first()->id;
        $request['subject_id'] = $subject_id;
        //teacher_id
        $teacher = $teacher->validated();
        $teacher_id = Teacher::all()->where('first_name', '=', $teacher['first_name'])
            ->where('last_name', '=', $teacher['last_name'])->first()->id;
        $request['teacher_id'] = $teacher_id;
        // //find old_course
        $course_old = $course_old->validated();
        $course_id = Course::all()->where('name', $course_old['course_name'])->first()->id;
        //update
        $update = DB::table('courses')->where('id',  $course_id)->update($request);
        return $this->response(code: 201, data: $update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
    public function delete(Course $course)
    {
        Gate::authorize('delete', $course);
        $delete = $course->delete();
        return $this->response(code: 202, data: $delete);
    }

    public function deleted(Course $course)
    {
        Gate::authorize('deleted', $course);
        $deleted = $course->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($course, Course $g)
    {
        Gate::authorize('restore', $g);
        $course = Course::where('id',  $course)->restore();
        return $this->response(code: 202, data: $course);
    }
    public function delete_from_trash($course, Course $Course)
    {
        Gate::authorize('forceDelete', $Course);
        $course  = Course::where('id', $course)->forceDelete();
        return $this->response(code: 202, data: $course);
    }
}