<?php

namespace App\Http\Controllers;

use App\Models\VideoWatching;
use App\Http\Requests\StoreVideoWatchingRequest;
use App\Http\Requests\StoreWhereVideoRequest;
use App\Http\Requests\UpdateVideoWatchingRequest;
use App\Models\Payment;
use App\Models\Video;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VideoWatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VideoWatching $videoWatching)
    {Gate::authorize('viewAny',$videoWatching);
        $videoWatching = VideoWatching::get();
        return $this->response(code: 200, data: $videoWatching);
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
    public function store(StoreWhereVideoRequest $video,VideoWatching $videoWatching)
    {Gate::authorize('create',$videoWatching);
        //user_id
        $user_id = Auth::user()->id;
        //video_id
        $video = $video->validated();
        $video = Video::where('video_url', $video['video_url_old'])->first();
        $video_id = $video['id'];
        // //course_id
        $course_id =  $video['course_id'];
        //check if user pay this course
        $user_statue = Payment::all()->where('user_id', $user_id)->where('course_id', $course_id)->first();
        //prepare request
        $request['user_id'] = $user_id;
        $request['video_id'] = $video_id;
        //check if user had watch before
        $has_watchings = VideoWatching::all()->where('user_id', $user_id)->where('video_id', $video_id)->last();
        if ($has_watchings == null) {
            $insert = VideoWatching::create($request);
            $last_count = VideoWatching::all()->where('user_id', $user_id)->where('video_id', $video_id)->last()->count;
            $request['count'] = $last_count + 1;
            $update = DB::table('video_watchings')->where('id', $insert['id'])->update([
                'count' => $request['count'],
                'last_watch' => Carbon::now(),
            ]);
        } else {
            $last_watch = VideoWatching::all()->where('user_id', $user_id)->where('video_id', $video_id)->last();
            if ($last_watch['count'] < 2) {
                $count = $last_watch['count'] + 1;
                $update = DB::table('video_watchings')->where('id', $last_watch['id'])->update([
                    'count' => $count,
                    'last_watch' => Carbon::now(),
                ]);
            } else {
                return 'you have not watchings';
            }
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(VideoWatching $videoWatching)
    {Gate::authorize('view',$videoWatching);
        $id = $videoWatching->id;
        $videoWatching = VideoWatching::with('user', 'video')->find($id);
        return $this->response(code: 200, data: $videoWatching);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoWatching $videoWatching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoWatchingRequest $request, VideoWatching $videoWatching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoWatching $videoWatching)
    {
        //
    }
    public function delete(VideoWatching $videoWatching)
    {
        Gate::authorize('delete',$videoWatching);
        $delete = $videoWatching->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(VideoWatching $videoWatching)
    {Gate::authorize('deleted',$videoWatching);
        $deleted = $videoWatching->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($videoWatching,VideoWatching $VideoWatching)
    {
        Gate::authorize('restore',$VideoWatching);
        $videoWatching = VideoWatching::where('id', $videoWatching)->restore();
        return $this->response(code: 202, data: $videoWatching);
    }
    public function delete_from_trash($videoWatching,VideoWatching $VideoWatching)
    {
        Gate::authorize('forceDelete',$VideoWatching);
        $videoWatching  = VideoWatching::where('id', $videoWatching)->forceDelete();
        return $this->response(code: 202, data: $videoWatching);
    }
}
