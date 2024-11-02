<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWhereCourseRequest;
use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $wishlist = Wishlist::with('course')->where('user_id', $user)->get();
        return $this->response(code: 200, data: $wishlist);
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
    public function store(StoreWhereCourseRequest $course)
    {
        //course_id
        $course = $course->validated();
        $course_id = Course::all()->where('name', $course['course_name'])->first()->id;
        $request['course_id'] = $course_id;
        //user_id
        $request['user_id'] = Auth::user()->id;
        //insert_data
        $insert = Wishlist::create($request);
        return $this->response(code: 201, data: $insert);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
    public function delete(Wishlist $wishlist)
    {
        $delete = $wishlist->delete();
        return $this->response(code: 202, data: $delete);
    }
}