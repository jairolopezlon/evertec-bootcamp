<?php

namespace App\Http\Controllers\Dashboard;

use App\Dtos\Dashboard\CustomerInAdminList;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersManagerController extends Controller
{
    /**
     * @return Collection<int, CustomerInAdminList>
     */
    private function getAllCustomer(): Collection
    {
        $customers = DB::table('users')
            ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
            ->select('users.id', 'users.name', 'users.email', 'customers.is_enabled')
            ->get();

        return $customers;
    }

    public function dashboardView(): View
    {
        $user_id = Auth::user()->id;
        $customer_exists = DB::table('admins')->where('user_id', $user_id)->exists();
        if (! $customer_exists) {
            abort(403, 'No tienes acceso a esta página');
        }

        $customers = self::getAllCustomer();

        return view('pages.dashboard.customers.index', [
            'customers' => $customers,
        ]);
    }

    public function toggleUserStatus(Customer $customer): RedirectResponse
    {
        try {
            $customer->is_enabled = ! $customer->is_enabled;
            $customer->save();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        return redirect()->back();
    }
}
