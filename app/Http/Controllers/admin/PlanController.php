<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Plan\StorePlanRequest;
use App\Http\Requests\Admin\Plan\UpdatePlanRequest;
use App\Models\Tenants\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {
        $validated = $request->validated();
        Plan::create(
            [
                'name' => $validated['name'],
                'duration' => $validated['duration'],
                'price' => $validated['price']
            ]
        );
        return redirect()->route('admin.plans.index')->with('success', __('plan.create_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('admin.pages.plan.show', ['data'   => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $validated = $request->validated();

        $plan->fill([
            'name' => $validated['name'],
            'duration' => $validated['duration'],
            'price' => $validated['price']
        ]);
        if ($plan->isDirty()) {
            $plan->save();
            return redirect()->back()->with('success', __('common.update_success'));
        }
        return redirect()->back()->with('warning', __('common.no_changes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
