<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenants\GymPlan;
use App\Http\Requests\Admin\GymPlan\StoreGymPlanRequest;
use App\Http\Requests\Admin\GymPlan\UpdateGymPlanRequest;

class GymPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreGymPlanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymPlan $gymPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymPlan $gymPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymPlanRequest $request, GymPlan $gymPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymPlan $gymPlan)
    {
        //
    }
}
