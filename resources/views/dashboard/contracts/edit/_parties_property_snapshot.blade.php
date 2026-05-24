<!-- Party One -->
<div class="premium-mandatory-section mb-4">
    <div class="premium-mandatory-header">
        <div class="title-wrapper">
            <i class="fas fa-building"></i>
            <span class="font-weight-bold">الطرف الأول (الشركة / المالك)</span>
        </div>
    </div>
    <div class="premium-mandatory-body">
        <p class="text-muted small mb-3"><i class="fas fa-info-circle"></i> هذه البيانات ستطبع في العقد كـ "الطرف الأول". التعديل هنا فقط للطباعة.</p>
        
        <div class="row">
            <div class="col-md-6">
                <div class="premium-form-group">
                    <label for="first_party_name_ar" class="premium-label">اسم الطرف الأول (عربي)</label>
                    <input type="text" id="first_party_name_ar" name="contract_detail[first_party_data][name][ar]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.first_party_data.name.ar', $contract->contractDetail->first_party_data['name']['ar'] ?? ($contract->contractDetail->first_party_data['name'] ?? '')) !!}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="premium-form-group">
                    <label for="first_party_name_en" class="premium-label">اسم الطرف الأول (إنجليزي)</label>
                    <input type="text" id="first_party_name_en" name="contract_detail[first_party_data][name][en]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.first_party_data.name.en', $contract->contractDetail->first_party_data['name']['en'] ?? '') !!}">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Party Two -->
<div class="premium-mandatory-section mb-4">
    <div class="premium-mandatory-header">
        <div class="title-wrapper">
            <i class="fas fa-user"></i>
            <span class="font-weight-bold">الطرف الثاني (المستأجر)</span>
        </div>
    </div>
    <div class="premium-mandatory-body">
        <p class="text-muted small mb-3"><i class="fas fa-info-circle"></i> هذه البيانات ستطبع في العقد كـ "الطرف الثاني".</p>
        
        <div class="row">
            <div class="col-md-6">
                <div class="premium-form-group">
                    <label for="second_party_name_ar" class="premium-label">اسم الطرف الثاني (عربي)</label>
                    <input type="text" id="second_party_name_ar" name="contract_detail[second_party_data][name][ar]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.second_party_data.name.ar', $contract->contractDetail->second_party_data['name']['ar'] ?? ($contract->contractDetail->second_party_data['name'] ?? '')) !!}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="premium-form-group">
                    <label for="second_party_name_en" class="premium-label">اسم الطرف الثاني (إنجليزي)</label>
                    <input type="text" id="second_party_name_en" name="contract_detail[second_party_data][name][en]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.second_party_data.name.en', $contract->contractDetail->second_party_data['name']['en'] ?? '') !!}">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="premium-form-group">
                    <label for="second_party_id" class="premium-label">رقم الهوية/الجواز</label>
                    <input type="text" id="second_party_id" name="contract_detail[second_party_data][id_number]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.second_party_data.id_number', $contract->contractDetail->second_party_data['id_number'] ?? '') !!}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-form-group">
                    <label for="second_party_nationality" class="premium-label">الجنسية</label>
                    <input type="text" id="second_party_nationality" name="contract_detail[second_party_data][nationality]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.second_party_data.nationality', $contract->contractDetail->second_party_data['nationality'] ?? '') !!}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-form-group">
                    <label for="second_party_phone" class="premium-label">رقم الجوال</label>
                    <input type="text" id="second_party_phone" name="contract_detail[second_party_data][phone]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.second_party_data.phone', $contract->contractDetail->second_party_data['phone'] ?? '') !!}">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Property Data -->
<div class="premium-mandatory-section mb-4">
    <div class="premium-mandatory-header">
        <div class="title-wrapper">
            <i class="fas fa-home"></i>
            <span class="font-weight-bold">بيانات العقار</span>
        </div>
    </div>
    <div class="premium-mandatory-body">
        <div class="row">
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="property_zone" class="premium-label">رقم المنطقة</label>
                    <input type="text" id="property_zone" name="contract_detail[property_data][zone_number]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.property_data.zone_number', $contract->contractDetail->property_data['zone_number'] ?? '') !!}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="property_street" class="premium-label">رقم / اسم الشارع</label>
                    <input type="text" id="property_street" name="contract_detail[property_data][street_number]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.property_data.street_number', $contract->contractDetail->property_data['street_number'] ?? '') !!}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="property_building" class="premium-label">رقم المبنى</label>
                    <input type="text" id="property_building" name="contract_detail[property_data][building_number]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.property_data.building_number', $contract->contractDetail->property_data['building_number'] ?? '') !!}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="property_deed" class="premium-label">رقم سند الملكية</label>
                    <input type="text" id="property_deed" name="contract_detail[property_data][title_deed_number]" class="form-control premium-input shadow-none"
                        value="{!! old('contract_detail.property_data.title_deed_number', $contract->contractDetail->property_data['title_deed_number'] ?? '') !!}">
                </div>
            </div>
        </div>
    </div>
</div>
