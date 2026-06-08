<div class="premium-mandatory-section mb-4">
    <div class="premium-mandatory-header d-flex justify-content-between align-items-center cursor-pointer collapsed" data-toggle="collapse" data-target="#smartTagsCollapse">
        <div class="title-wrapper">
            <i class="fas fa-magic text-warning"></i>
            <span class="font-weight-bold">{!! __('contracts.smart_tags_title') !!}</span>
        </div>
        <div>
            <i class="fas fa-chevron-down text-secondary"></i>
        </div>
    </div>
    
    <div id="smartTagsCollapse" class="collapse p-0 smart-tags-collapse-body">
        <div class="smart-tags-hint-bar">
            <p class="font-weight-bold">
                <i class="fas fa-info-circle"></i> {!! __('contracts.smart_tags_click_hint') !!}
            </p>
        </div>
        
        <div class="smart-tags-wrapper">
            <!-- Modern Tabs Navigation -->
            <ul class="nav nav-tabs smart-tags-tabs" id="smartTagsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="contract-data-tab" data-toggle="tab" data-target="#contract-data" type="button" role="tab" aria-controls="contract-data" aria-selected="true">
                        <i class="fas fa-file-contract"></i> {!! __('contracts.smart_tags_group_contract') !!}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="financial-data-tab" data-toggle="tab" data-target="#financial-data" type="button" role="tab" aria-controls="financial-data" aria-selected="false">
                        <i class="fas fa-money-bill-wave"></i> {!! __('contracts.smart_tags_group_financials') !!}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="parties-data-tab" data-toggle="tab" data-target="#parties-data" type="button" role="tab" aria-controls="parties-data" aria-selected="false">
                        <i class="fas fa-users"></i> {!! __('contracts.smart_tags_group_parties') !!}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="property-data-tab" data-toggle="tab" data-target="#property-data" type="button" role="tab" aria-controls="property-data" aria-selected="false">
                        <i class="fas fa-building"></i> {!! __('contracts.smart_tags_group_property') !!}
                    </button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content smart-tags-content" id="smartTagsTabContent">
                
                <!-- Tab 1: Contract Data -->
                <div class="tab-pane fade show active" id="contract-data" role="tabpanel" aria-labelledby="contract-data-tab">
                    <div class="row">
                        @php
                            $contractTags = [
                                ['label' => __('contracts.tag_conclusion_date'), 'tag' => '${conclusion_date}', 'color' => 'primary'],
                                ['label' => __('contracts.tag_start_date'), 'tag' => '${start_date}', 'color' => 'primary'],
                                ['label' => __('contracts.tag_end_date'), 'tag' => '${end_date}', 'color' => 'primary'],
                                ['label' => __('contracts.tag_contract_duration'), 'tag' => '${contract_duration}', 'color' => 'primary'],
                                ['label' => __('contracts.tag_grace_period'), 'tag' => '${grace_period}', 'color' => 'primary'],
                            ];
                        @endphp
                        @foreach($contractTags as $item)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="smart-tag-card cursor-pointer" onclick="copySmartTag(this, '{{ $item['tag'] }}')">
                                    <span class="tag-label text-secondary">{{ $item['label'] }}</span>
                                    <code class="tag-code bg-light-{{ $item['color'] }} text-{{ $item['color'] }}">{{ $item['tag'] }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tab 2: Financial Data -->
                <div class="tab-pane fade" id="financial-data" role="tabpanel" aria-labelledby="financial-data-tab">
                    <div class="row">
                        @php
                            $financialTags = [
                                ['label' => __('contracts.tag_rent_amount'), 'tag' => '${rent_amount}', 'color' => 'success'],
                                ['label' => __('contracts.tag_rent_amount_ar'), 'tag' => '${rent_amount_ar}', 'color' => 'success'],
                                ['label' => __('contracts.tag_deposit_amount'), 'tag' => '${deposit_amount}', 'color' => 'success'],
                                ['label' => __('contracts.tag_deposit_amount_ar'), 'tag' => '${deposit_amount_ar}', 'color' => 'success'],
                            ];
                        @endphp
                        @foreach($financialTags as $item)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="smart-tag-card cursor-pointer" onclick="copySmartTag(this, '{{ $item['tag'] }}')">
                                    <span class="tag-label text-secondary">{{ $item['label'] }}</span>
                                    <code class="tag-code bg-light-{{ $item['color'] }} text-{{ $item['color'] }}">{{ $item['tag'] }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tab 3: Parties -->
                <div class="tab-pane fade" id="parties-data" role="tabpanel" aria-labelledby="parties-data-tab">
                    <div class="row">
                        @php
                            $partyTags = [
                                ['label' => __('contracts.tag_first_party_name'), 'tag' => '${first_party_name}', 'color' => 'warning'],
                                ['label' => __('contracts.first_party_owner_name'), 'tag' => '${first_party_owner_name}', 'color' => 'warning'],
                                ['label' => __('contracts.first_party_owner_qid'), 'tag' => '${first_party_owner_qid}', 'color' => 'warning'],
                                ['label' => __('contracts.first_party_owner_phone'), 'tag' => '${first_party_owner_phone}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_name'), 'tag' => '${second_party_name}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_id'), 'tag' => '${second_party_id}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_nationality'), 'tag' => '${second_party_nationality}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_phone'), 'tag' => '${second_party_phone}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_company_name'), 'tag' => '${second_party_company_name}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_cr_number'), 'tag' => '${second_party_cr_number}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_license_number'), 'tag' => '${second_party_license_number}', 'color' => 'warning'],
                                ['label' => __('contracts.tag_second_party_establishment_number'), 'tag' => '${second_party_establishment_number}', 'color' => 'warning'],
                            ];
                        @endphp
                        @foreach($partyTags as $item)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="smart-tag-card cursor-pointer" onclick="copySmartTag(this, '{{ $item['tag'] }}')">
                                    <span class="tag-label text-secondary">{{ $item['label'] }}</span>
                                    <code class="tag-code bg-light-{{ $item['color'] }} text-{{ $item['color'] }}">{{ $item['tag'] }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tab 4: Property -->
                <div class="tab-pane fade" id="property-data" role="tabpanel" aria-labelledby="property-data-tab">
                    <div class="row">
                        @php
                            $propertyTags = [
                                ['label' => __('contracts.tag_property_zone'), 'tag' => '${property_zone}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_street'), 'tag' => '${property_street}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_building'), 'tag' => '${property_building}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_deed'), 'tag' => '${property_deed}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_name_ar'), 'tag' => '${property_name_ar}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_name_en'), 'tag' => '${property_name_en}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_type'), 'tag' => '${property_type}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_floor'), 'tag' => '${property_floor}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_property_description'), 'tag' => '${property_description}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_electricity_account_number'), 'tag' => '${electricity_account_number}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_water_account_number'), 'tag' => '${water_account_number}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_unit_rent_amount'), 'tag' => '${unit_rent_amount}', 'color' => 'danger'],
                                ['label' => __('contracts.tag_unit_deposit_amount'), 'tag' => '${unit_deposit_amount}', 'color' => 'danger'],
                            ];
                        @endphp
                        @foreach($propertyTags as $item)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="smart-tag-card cursor-pointer" onclick="copySmartTag(this, '{{ $item['tag'] }}')">
                                    <span class="tag-label text-secondary">{{ $item['label'] }}</span>
                                    <code class="tag-code bg-light-{{ $item['color'] }} text-{{ $item['color'] }}">{{ $item['tag'] }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copySmartTag(element, text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(function() {
            triggerFeedback(element);
        }).catch(function() {
            fallbackCopy(element, text);
        });
    } else {
        fallbackCopy(element, text);
    }
}

function fallbackCopy(element, text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        var successful = document.execCommand('copy');
        if (successful) {
            triggerFeedback(element);
        } else {
            console.error('Fallback copy failed');
        }
    } catch (err) {
        console.error('Fallback error: ', err);
    }
    document.body.removeChild(textArea);
}

function triggerFeedback(element) {
    if (window.PremiumToast) {
        window.PremiumToast.success('{!! __('contracts.smart_tags_copied') !!}');
    } else if (typeof toastr !== 'undefined') {
        toastr.success('{!! __('contracts.smart_tags_copied') !!}');
    }
    
    if (element) {
        element.classList.add('smart-tag-copied-effect');
        setTimeout(function() {
            element.classList.remove('smart-tag-copied-effect');
        }, 500);
    }
}
</script>
