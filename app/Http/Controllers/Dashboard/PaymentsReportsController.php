<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Company;
use App\Exports\PaymentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;

class PaymentsReportsController extends Controller
{
    /**
     * Show report dashboard index.
     */
    public function index()
    {
        Gate::authorize('reports_payments');

        $title = __('reports.payments_reports');

        // Column groupings
        $paymentColumns = [
            'payment_date',
            'amount',
            'method',
            'reference_number',
            'status',
            'notes',
            'created_at',
        ];

        $contractColumns = [
            'contract_number',
            'customer_name',
            'property_name',
        ];

        $chequeColumns = [
            'cheque_number',
            'bank_name',
        ];

        // Active customers/tenants with company isolation
        $customersQuery = Customer::active();
        if (user()->company_id != 1) {
            $customersQuery->where('company_id', user()->company_id);
        }
        $customers = $customersQuery->select('id', 'name')->get();

        // Super Admin company list
        $companies = null;
        if (user()->company_id == 1) {
            $companies = Company::active()->latest()->get();
        }

        return view('dashboard.reports.payments.index', compact(
            'title', 
            'paymentColumns', 
            'contractColumns', 
            'chequeColumns', 
            'customers', 
            'companies'
        ));
    }

    /**
     * Export reports to Excel.
     */
    public function exportExcel(Request $request)
    {
        Gate::authorize('reports_payments');

        $request->validate([
            'payment_date_from' => 'nullable|date',
            'payment_date_to'   => 'nullable|date',
            'amount_from'       => 'nullable|numeric',
            'amount_to'         => 'nullable|numeric',
        ]);

        $filters = $request->except(['_token', 'columns']);

        if (empty($request->input('columns'))) {
            $selectedColumns = [
                'payment_date',
                'amount',
                'method',
                'status',
                'customer_name',
                'property_name',
            ];
        } else {
            $selectedColumns = $request->input('columns');
        }

        $fileName = 'payments_report_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        
        // Clear any previous output buffers to avoid corrupted Excel files
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        
        return Excel::download(new PaymentsExport($selectedColumns, $filters), $fileName);
    }
}
