<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Company;
use App\Models\Property;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Cheque;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $title = __('dashboard.dashboard');
        $companyId = user()->company_id;
        $isSuperAdmin = $companyId == 1;

        // --- 1. Base Queries with Multi-tenancy ---
        $propertiesQuery = Property::query();
        $contractsQuery = Contract::query();
        $paymentsQuery = Payment::query();
        $chequesQuery = Cheque::query();

        if (!$isSuperAdmin) {
            $propertiesQuery->where('company_id', $companyId);
            $contractsQuery->where('company_id', $companyId);
            $paymentsQuery->where('company_id', $companyId);
            $chequesQuery->where('company_id', $companyId);
        }

        // --- 2. Statistics Cards ---
        $stats = [
            'companies_count'   => $isSuperAdmin ? Company::count() : 0,
            'properties_count'  => (clone $propertiesQuery)->count(),
            'active_contracts'  => (clone $contractsQuery)->where('status', 'active')->count(),
            'total_payments'    => (clone $paymentsQuery)->whereIn('status', ['paid', 'pending'])->sum('amount'),
            'pending_cheques_value' => (clone $chequesQuery)->where('status', 'pending')->sum('amount'),
            'users_count'       => User::when(!$isSuperAdmin, fn($q) => $q->where('company_id', $companyId))->count(),
        ];

        // --- 3. Charts Data ---
        // A. Occupancy (Rented vs Available)
        // A property is rented if it has at least one 'active' contract
        $rentedCount = (clone $propertiesQuery)->whereHas('contracts', function($q) {
            $q->where('status', 'active');
        })->count();
        $availableCount = max(0, $stats['properties_count'] - $rentedCount);

        $occupancyChart = [
            'series' => [$rentedCount, $availableCount],
            'labels' => [__('properties.rented'), __('properties.available')]
        ];

        // B. Financial Trend (Last 12 Months)
        $months = [];
        $collections = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->translatedFormat('M Y');
            
            $collections[] = (clone $paymentsQuery)
                ->whereIn('status', ['paid', 'pending'])
                ->whereYear('payment_date', $date->year)
                ->whereMonth('payment_date', $date->month)
                ->sum('amount');
        }

        $financialChart = [
            'categories' => $months,
            'data'       => $collections,
        ];

        // --- 4. Alerts & Lists (Recent/Upcoming) ---
        // A. Expiring Contracts (Next 30 Days)
        $expiringContracts = (clone $contractsQuery)
            ->with(['customer', 'property'])
            ->where('status', 'active')
            ->whereBetween('end_date', [Carbon::now(), Carbon::now()->addDays(30)])
            ->orderBy('end_date', 'asc')
            ->limit(5)
            ->get();

        // B. Upcoming Cheques (Next 7 Days)
        $upcomingCheques = (clone $chequesQuery)
            ->with(['customer', 'contract.property'])
            ->where('status', 'pending')
            ->whereBetween('due_date', [Carbon::now(), Carbon::now()->addDays(7)])
            ->orderBy('due_date', 'asc')
            ->limit(5)
            ->get();

        return view('dashboard.home.index', compact(
            'title', 
            'stats', 
            'isSuperAdmin', 
            'occupancyChart', 
            'financialChart',
            'expiringContracts',
            'upcomingCheques'
        ));
    }
}

