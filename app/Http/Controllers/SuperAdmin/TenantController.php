<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Tenants\User;
use App\Models\Tenants\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('superAdmin.pages.tenants.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superAdmin.pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'tenant_id' => 'required|string|max:255|unique:tenants,id',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:3',
            'owner_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',

        ]);


        $tenant = Tenant::create(['id' => $validated['tenant_id']]);


        $tenant->domains()->create([
            'domain' => $validated['tenant_id'] . '.' . env('APP_DOMAIN', 'arabinfitmanager.test'),
        ]);


        tenancy()->initialize($tenant);



        $user = User::create([

            'email' => $validated['tenant_id'] . '@' . env('APP_DOMAIN', 'arabinfitmanager.test'),
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('admin');
        Permission::firstOrCreate(['name' => 'customers.view', 'guard_name' => 'tenant']);

        $user->givePermissionTo('customers.view');

        \App\Models\Tenants\Gym::create([
            'name' => $validated['name'],
            'owner_name' => $validated['owner_name'] ?? '',
            'phone' => $validated['phone'] ?? '',
            'location' => $validated['location'] ?? '',
        ]);
        tenancy()->end();


        return redirect()->route('gyms.index')
            ->with('success', 'تم إنشاء الشركة بنجاح، مع حساب افتراضي للمسؤول.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        $tenant->load('domain');

        return view('superAdmin.pages.tenants.show', [
            'tenant' => $tenant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
