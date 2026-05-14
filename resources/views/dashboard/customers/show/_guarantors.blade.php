<!-- Guarantors Tab -->
<div class="tab-pane fade" id="guarantors" role="tabpanel">
    <div class="card border-0 shadow-sm mb-2 radius-15">
        <div class="card-header bg-transparent border-0 pt-2 pb-0">
            <h5 class="card-title font-weight-bold mb-0">
                <i class="fas fa-user-shield text-info mr-1"></i> {!! __('guarantors.guarantor_details') !!}
            </h5>
        </div>
        <div class="card-body p-0 mt-2">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light-info-opacity">
                        <tr class="text-muted" style="font-size: 13px;">
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{!! __('guarantors.name') !!}</th>
                            <th class="border-top-0">{!! __('guarantors.relationship') !!}</th>
                            <th class="border-top-0">{!! __('guarantors.id_number') !!}</th>
                            <th class="border-top-0">{!! __('guarantors.phone') !!}</th>
                            <th class="border-top-0">{!! __('guarantors.address') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($customer->guarantors as $index => $guarantor)
                        <tr>
                            <td class="py-2">{!! $index + 1 !!}</td>
                            <td class="py-2">
                                <div class="font-weight-bold text-dark">{!! $guarantor->name !!}</div>
                            </td>
                            <td class="py-2">
                                @php
                                    $relKey = $guarantor->relationship ?? '';
                                    $relName = __('guarantors.relationships.' . $relKey);
                                    if (strpos($relName, 'guarantors.relationships') !== false) {
                                        $relName = $relKey;
                                    }
                                @endphp
                                <span class="badge badge-light-info-opacity text-info badge-pill border-0 px-2 font-weight-bold">
                                    {!! $relName !!}
                                </span>
                            </td>
                            <td class="py-2 text-dark font-weight-bold">{!! $guarantor->id_number !!}</td>
                            <td class="py-2 text-dark font-weight-bold">{!! $guarantor->phone !!}</td>
                            <td class="py-2 text-dark">{!! $guarantor->address ?: '---' !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-user-shield font-large-2 d-block mb-1 opacity-20"></i>
                                {!! __('general.no_data_found') !!}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
