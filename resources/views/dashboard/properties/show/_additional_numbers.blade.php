<div class="tab-pane fade" id="additional-numbers" role="tabpanel" aria-labelledby="additional-numbers-tab">
    <div class="card border-0 shadow-sm mb-2 radius-15">
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center justify-content-between" style="height: 50px;">
            <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                <i class="fas fa-list-ol text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('properties.important_additional_details') !!}
            </h5>
        </div>
        <div class="card-body pt-2 pb-3">
            @if(empty($property->additional_numbers) || count($property->additional_numbers) == 0)
                <div class="alert alert-light-warning mb-0 border-0 radius-10 d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle text-warning mr-2" style="font-size: 1.5rem;"></i>
                    <span class="font-weight-bold">{!! __('properties.no_additional_numbers_added') !!}</span>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light-primary-opacity">
                            <tr>
                                <th class="py-3 border-top-0" style="width: 40%;">{!! __('properties.number_type') !!}</th>
                                <th class="py-3 border-top-0">{!! __('properties.number_value') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($property->additional_numbers as $number)
                                <tr>
                                    <td class="align-middle">
                                        @if($number['type'] == 'electricity_account')
                                            <i class="fas fa-bolt text-warning mr-1"></i> {!! __('properties.electricity_account_number') !!}
                                        @elseif($number['type'] == 'water_account')
                                            <i class="fas fa-tint text-info mr-1"></i> {!! __('properties.water_account_number') !!}
                                        @elseif($number['type'] == 'title_deed')
                                            <i class="fas fa-scroll text-dark mr-1"></i> {!! __('properties.title_deed_number') !!}
                                        @elseif($number['type'] == 'cadastral_number')
                                            <i class="fas fa-hashtag text-info mr-1"></i> {!! __('properties.property_number') !!}
                                        @else
                                            <i class="fas fa-info-circle text-primary mr-1"></i> {!! __('general.other') !!}
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <span class="font-weight-bold text-dark">{{ $number['value'] ?? '---' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
