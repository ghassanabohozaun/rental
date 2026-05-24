<?php

namespace App\Services\Dashboard;

use App\Models\ContractClauseTemplate;
use Illuminate\Http\Request;

class ContractClauseTemplateService
{
    public function getClauseTemplates(Request $request)
    {
        $query = ContractClauseTemplate::query();

        // Handle search
        if ($request->has('search') && $request->search['value']) {
            $searchValue = $request->search['value'];
            $query->where('title', 'like', "%{$searchValue}%");
        }

        // Apply company scope
        if (auth()->user()->role_id != 1) {
            $query->where('company_id', auth()->user()->company_id);
        } else {
            // Super admin filter
            if ($request->has('company_id') && $request->company_id) {
                $query->where('company_id', $request->company_id);
            }
        }

        // Apply status filter
        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        return $query->orderBy('order_num', 'asc')->orderBy('id', 'desc');
    }

    public function store(array $data)
    {
        if (auth()->user()->role_id != 1) {
            $data['company_id'] = auth()->user()->company_id;
        }

        $data['is_default'] = isset($data['is_default']) ? true : false;
        $data['status'] = isset($data['status']) ? true : false;
        
        if (empty($data['order_num'])) {
            $data['order_num'] = 0;
        }

        return ContractClauseTemplate::create($data);
    }

    public function update(ContractClauseTemplate $template, array $data)
    {
        if (auth()->user()->role_id != 1) {
            $data['company_id'] = auth()->user()->company_id;
        }

        $data['is_default'] = isset($data['is_default']) ? true : false;
        $data['status'] = isset($data['status']) ? true : false;
        
        if (empty($data['order_num'])) {
            $data['order_num'] = 0;
        }

        $template->update($data);

        return $template;
    }

    public function destroy(ContractClauseTemplate $template)
    {
        $template->delete();
    }
}
