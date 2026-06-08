<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\PropertyStatus;
use App\Models\Owner;
use App\Exports\PropertiesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PropertiesReportsController extends Controller
{
    // show report
    public function index()
    {
        Gate::authorize('reports_properties');
        $title = __('reports.properties_reports');

        $propertyColumnNames = $this->propertyColumnNamesFunction();
        $propertyTypes = PropertyType::active()->get()->unique('name')->values();
        $propertyStatuses = PropertyStatus::active()->get()->unique('name')->values();
        $owners = Owner::select('id', 'name')->get();

        $companies = null;
        if (user()->company_id == 1) {
            $companies = \App\Models\Company::where('status', 'active')->get();
        }

        return view('dashboard.reports.properties.index', compact('title', 'propertyColumnNames', 'propertyTypes', 'propertyStatuses', 'owners', 'companies'));
    }

    public function exportExcel(Request $request)
    {
        Gate::authorize('reports_properties');
        $filters = $request->except(['_token', 'columns']);

        if (empty($request->input('columns'))) {
            $selectedColumns = ['id', 'name', 'property_number', 'property_type_id', 'property_status_id', 'area', 'price', 'location', 'owner'];
        } else {
            $selectedColumns = $request->input('columns');
        }

        $fileName = 'properties_report_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new PropertiesExport($selectedColumns, $filters), $fileName);
    }

    // property columns name function
    public function propertyColumnNamesFunction()
    {
        $tableName = 'properties';
        $excludedColumns = [
            'id',
            'deleted_at',
            'updated_at',
            'company_id',
            'parent_id',
            'name', // We'll add custom name at start
        ];
        $allColumnNames = DB::getSchemaBuilder()->getColumnListing($tableName);
        $columnNames = collect($allColumnNames)
            ->filter(function ($column) use ($excludedColumns) {
                return !in_array($column, $excludedColumns);
            })
            ->values()
            ->toArray();

        // Custom columns to append/prepend
        array_unshift($columnNames, 'name'); // Name first

        // Add owner explicitly as a related column
        array_push($columnNames, 'owner');

        return $columnNames;
    }
}
