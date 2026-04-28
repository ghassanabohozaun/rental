<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\ChangePasswordRequest;
use App\Services\Dashboard\DailyReportService;
use App\Services\Dashboard\EmployeeService;
use App\Services\Dashboard\MonthlyReportService;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    protected $dailyReportService, $employeeService, $monthlyReportService;

    // __construct
    public function __construct(MonthlyReportService $monthlyReportService, DailyReportService $dailyReportService, EmployeeService $employeeService)
    {
        $this->dailyReportService = $dailyReportService;
        $this->employeeService = $employeeService;
        $this->monthlyReportService = $monthlyReportService;
    }

    // index
    public function index()
    {
        $employee = $this->employeeService->getOne(employee()->user()->id);
        $monthlyReports = $this->monthlyReportService->getMonthlyReportsForOneEmplpoyee($employee->id)->take(5);
        $dailyReports = $this->dailyReportService->getDailyReportsForOneEmplpoyee($employee->id)->take(5);
        
        // Statistics
        $stats = [
            'pending_tasks' => $employee->tasks()->where('is_completed', false)->count(),
            'completed_tasks' => $employee->tasks()->where('is_completed', true)->count(),
            'unread_messages' => $employee->unreadMessagesCount(),
            'sent_messages' => $employee->sentMessages()->count(),
            'notifications_count' => $employee->unreadNotifications->count(),
            'reports_count' => $employee->monthlyReports()->count(),
        ];

        return view('employees.overview.index', compact('monthlyReports', 'dailyReports', 'employee', 'stats'));
    }

    public function changeEmployeePassword(ChangePasswordRequest $request)
    {
        $data = $request->only(['employee_id', 'password', 'password_confirm']);

        $changePassword = $this->employeeService->changeEmployeePassword($data);

        if (!$changePassword) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $changePassword], 200);
    }

    public function getContractsData()
    {
        $employee = employee()->user();
        $contracts = $employee->employeeContracts()->orderBy('contract_start_date', 'desc')->get();

        if (request()->ajax()) {
            return view('employees.overview.tabs.partials._contracts_table', compact('contracts'))->render();
        }

        return response()->json(['data' => $contracts]);
    }
}
