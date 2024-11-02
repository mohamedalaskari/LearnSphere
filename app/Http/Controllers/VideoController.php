<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\StoreWhereCourseRequest;
use App\Http\Requests\StoreWhereSubjectRequest;
use App\Http\Requests\StoreWhereTeacherRequest;
use App\Http\Requests\StoreWhereVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Video $video)
    {
        Gate::authorize('viewAny', $video);
        $video = Video::get();
        return $this->response(code: 200, data: $video);
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
    public function store(StoreVideoRequest $request, Video $video, StoreWhereTeacherRequest $teacher, StoreWhereCourseRequest $course, StoreWhereSubjectRequest $subject)
    {
        Gate::authorize('create', $video);
        $request = $request->validated();
        //teacher_id
        $teacher = $teacher->validated();
        $teacher_id = Teacher::all()->where('first_name', $teacher['first_name'])->where('last_name', $teacher['last_name'])->first()->id;
        $request['teacher_id'] = $teacher_id;
        //course_id
        $course = $course->validated();
        $course_id = Course::all()->where('name', $course['course_name'])->first()->id;
        $request['course_id'] = $course_id;
        //subject_id
        $subject = $subject->validated();
        $subject_id = Subject::all()->where('subject', $subject['subject_name'])->first()->id;
        $request['subject_id'] = $subject_id;
        //insert_data
        $insert_data = Video::create($request);
        $old_number_of_video = Course::where('id', $insert_data['course_id'])->first()->number_of_videos;
        //update number_of_video

        $update = DB::table('courses')->where('id', $insert_data['course_id'])->update([
            'number_of_videos' => $old_number_of_video + 1
        ]);
        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        Gate::authorize('view', $video);
        $id = $video->id;
        $video = Video::with('teacher', 'subject', 'course', 'videowatching')->find($id);
        return $this->response(code: 200, data: $video);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video, StoreWhereTeacherRequest $teacher, StoreWhereCourseRequest $course, StoreWhereSubjectRequest $subject, StoreWhereVideoRequest $video_old)
    {
        Gate::authorize('update', $video);
        $request = $request->validated();
        //teacher_id
        $teacher = $teacher->validated();
        $teacher_id = Teacher::all()->where('first_name', $teacher['first_name'])->where('last_name', $teacher['last_name'])->first()->id;
        $request['teacher_id'] = $teacher_id;
        //course_id
        $course = $course->validated();
        $course_id = Course::all()->where('name', $course['course_name'])->first()->id;
        $request['course_id'] = $course_id;
        //subject_id
        $subject = $subject->validated();
        $subject_id = Subject::all()->where('subject', $subject['subject_name'])->first()->id;
        $request['subject_id'] = $subject_id;
        //where video
        $video_old = $video_old->validated();
        $video_id = Video::all()->where('video_url', $video_old['video_url_old'])->first()->id;
        //update
        $update = DB::table('videos')->where('id', $video_id)->update($request);
        return $this->response(code: 201, data: $update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
    public function delete(Video $video)
    {
        Gate::authorize('delete', $video);
        $delete = $video->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Video $video)
    {
        Gate::authorize('deleted', $video);
        $deleted = $video->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($video, Video $V)
    {
        Gate::authorize('restore', $V);
        $video = Video::where('id', $video)->restore();
        return $this->response(code: 202, data: $video);
    }
    public function delete_from_trash($video, Video $Video)
    {
        Gate::authorize('forceDelete', $Video);
        $video = Video::where('id', $video)->forceDelete();
        return $this->response(code: 202, data: $video);
    }
}