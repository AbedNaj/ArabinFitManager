<?php

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Customer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CustomerSearchController extends Controller
{
    public function __invoke(Request $request): Collection
    {
        $search   = $request->string('search')->toString();
        $selected = (array) $request->input('selected', []);

        return Customer::query()
            ->select('id', 'name')
            ->when($search !== '', function (Builder $q) use ($search) {

                $q->where(function (Builder $qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%");
                });
            })
            ->when(
                $request->exists('selected'),
                fn(Builder $q) => $q->whereIn('id', $selected),
                fn(Builder $q) => $q->limit(10) // نفس سلوك مثال WireUI
            )
            ->orderBy('name')
            ->get()
            ->map(function (Customer $c) {
                return $c;
            });
    }
}
