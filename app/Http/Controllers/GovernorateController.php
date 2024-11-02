<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use App\Http\Requests\StoreGovernorateRequest;
use App\Http\Requests\StoreWhereGovernorateIdRequest;
use App\Http\Requests\StoreWhereGovernorateRequest;
use App\Http\Requests\UpdateGovernorateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Governorate = Governorate::get();
        return $this->response(code: 200, data: $Governorate);
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
    public function store(StoreGovernorateRequest $request, Governorate $governorate)
    {
        Gate::authorize('create', $governorate);

        $request = $request->validated();
        //insert_data
        $insert_data = Governorate::create($request);
        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate $governorate)
    {
        Gate::authorize('view', $governorate);

        $id = $governorate->id;
        $governorate = Governorate::with('teacher', 'user')->find($id);
        return $this->response(code: 200, data: $governorate);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Governorate $governorate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGovernorateRequest $request, Governorate $governorate, StoreWhereGovernorateRequest $governorate_old)
    {
        Gate::authorize('update', $governorate);
        //new_data
        $request = $request->validated();
        //old_data
        $governorate_old = $governorate_old->validated();
        $governorate_id = Governorate::all()->where('governorate', $governorate_old['governorate_name'])->first()->id;
        //update
        $update = DB::table('governorates')->where('id', $governorate_id)->update($request);
        return $this->response(
            code: 201,
            data: $update
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        //
    }
    public function delete(Governorate $governorate)
    {
        Gate::authorize('delete', $governorate);
        $delete = $governorate->delete();
        return $this->response(code: 202, data: $delete);
    }

    public function deleted(Governorate $governorate)
    {
        Gate::authorize('deleted', $governorate);

        $deleted = $governorate->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($governorate, Governorate $G)
    {
        Gate::authorize('restore', $G);
        $governorate = Governorate::where('id', $governorate)->restore();
        return $this->response(code: 202, data: $governorate);
    }
    public function delete_from_trash($governorate, Governorate $Governorate)
    {
        Gate::authorize('forceDelete', $Governorate);
        $governorate  = Governorate::where('id', $governorate)->forceDelete();
        return $this->response(code: 202, data: $governorate);
    }
}
