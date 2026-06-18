<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Cheque;
use App\Models\Company;
use App\Exports\ChequesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;

class ChequesReportsController extends Controller
{
    /**
     * Show report dashboard index.
     */
    public function index()
    {
        Gate::authorize('reports_cheques');

        $title = __('reports.cheques_reports');

        // Column groupings
        $chequeColumns = [
            'cheque_number',
            'amount',
            'used_amount',
            'remaining_amount',
            'bank_name',
            'cheque_owner_name',
            'issue_date',
            'due_date',
            'status',
            'is_deposit',
            'notes',
            'created_at',
        ];

        $contractColumns = [
            'contract_number',
            'customer_name',
            'property_name',
            'contract_start_date',
            'contract_end_date',
        ];

        $bankAccountColumns = [
            'deposited_bank_name',
            'account_number',
            'iban',
        ];

        // Active customers/tenants with company isolation
        $customersQuery = Customer::active();
        if (user()->company_id != 1) {
            $customersQuery->where('company_id', user()->company_id);
        }
        $customers = $customersQuery->select('id', 'name')->get();

        // Company Bank Accounts with company isolation
        $bankAccountsQuery = \App\Models\CompanyBankAccount::query();
        if (user()->company_id != 1) {
            $bankAccountsQuery->where('company_id', user()->company_id);
        }
        $bankAccounts = $bankAccountsQuery->get();

        // Super Admin company list
        $companies = null;
        if (user()->company_id == 1) {
            $companies = Company::active()->latest()->get();
        }

        return view('dashboard.reports.cheques.index', compact(
            'title', 
            'chequeColumns', 
            'contractColumns', 
            'bankAccountColumns', 
            'customers', 
            'bankAccounts', 
            'companies'
        ));
    }

    /**
     * Export reports to Excel.
     */
    public function exportExcel(Request $request)
    {
        Gate::authorize('reports_cheques');

        $request->validate([
            'due_date_from' => 'nullable|date',
            'due_date_to'   => 'nullable|date',
            'amount_from'   => 'nullable|numeric',
            'amount_to'     => 'nullable|numeric',
        ]);

        $filters = $request->except(['_token', 'columns']);

        if (empty($request->input('columns'))) {
            $selectedColumns = [
                'cheque_number',
                'amount',
                'used_amount',
                'remaining_amount',
                'bank_name',
                'due_date',
                'status',
                'customer_name',
                'property_name',
            ];
        } else {
            $selectedColumns = $request->input('columns');
        }

        $fileName = 'cheques_report_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        
        // Clear any previous output buffers to avoid corrupted Excel files
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        
        return Excel::download(new ChequesExport($selectedColumns, $filters), $fileName);
    }
}
