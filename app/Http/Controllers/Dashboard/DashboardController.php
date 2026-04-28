<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $title = __('dashboard.dashboard');
        
        $companyId = user()->company_id;
        $isSuperAdmin = $companyId == 1;

        // Base queries
        $usersQuery = User::query();
        $departmentsQuery = Department::query();
        $rolesQuery = Role::query();

        // Apply Multi-tenant Isolation
        if (!$isSuperAdmin) {
            $usersQuery->where('company_id', $companyId);
            $departmentsQuery->where('company_id', $companyId);
            $rolesQuery->where('company_id', $companyId);
        }

        // Get Counts (Clone queries to reuse them for chart data)
        $stats = [
            'users_count' => (clone $usersQuery)->count(),
            'departments_count' => (clone $departmentsQuery)->count(),
            'roles_count' => (clone $rolesQuery)->count(),
            'companies_count' => $isSuperAdmin ? Company::count() : 0,
        ];

        // Fetch Real Chart Data (Last 12 Months)
        $months = [];
        $usersChart = [];
        $departmentsChart = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M'); // e.g. Jan, Feb
            
            $usersChart[] = (clone $usersQuery)->whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
            $departmentsChart[] = (clone $departmentsQuery)->whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
        }

        $chartData = [
            'categories' => $months,
            'users'      => $usersChart,
            'departments'=> $departmentsChart,
        ];

        return view('dashboard.home.index', compact('title', 'stats', 'isSuperAdmin', 'chartData'));
    }
}

