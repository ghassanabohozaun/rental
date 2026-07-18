<input type="hidden" id="companies-total-count" value="{!! $companies->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id="myTable">
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('companies.logo') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('companies.company_name') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('companies.email') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('companies.created_by') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-xl-table-cell">{!! __('companies.phone') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('companies.status') !!}</th>
                @can('companies_update')
                <th class="text-center align-middle py-3 border-top-0">{!! __('companies.manage_status') !!}</th>
                @endcan
                <!-- Actions Column Removed for Bottom Action Bar -->
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr id="row{{ $company->id }}" class="premium-table-row pointer" data-row-title="شركة | {!! $company->name !!}">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>

                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <div class="premium-modal-header"></div>
                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        @include('dashboard.companies.parts.logo', ['size' => 100])
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $company->name !!}</h4>
                                    <span class="modal-role-badge">{!! __('companies.plan_' . strtolower($company->subscription_plan)) !!}</span>
                                </div>

                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.created_by') !!}</span>
                                            <span class="detail-info-value text-muted">{!! $company->creator->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-envelope"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.email') !!}</span>
                                            <span class="detail-info-value text-muted">{!! $company->email ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.phone') !!}</span>
                                            <span class="detail-info-value text-muted">{!! $company->phone ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.address') !!}</span>
                                            <span class="detail-info-value text-muted">{!! $company->address ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($companies->currentPage() - 1) * $companies->perPage() !!}
                        </span>
                    </td>

                    <!-- Logo -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        @include('dashboard.companies.parts.logo')
                    </td>

                    <!-- Name -->
                    <td class="align-middle property-info-td">
                        <!-- Hidden Actions for Bottom Bar -->
                        <div class="row-actions-html d-none">
                            @include('dashboard.companies.parts.actions')
                        </div>

                        <!-- Hidden Subtitle for Bottom Bar -->
                        <div class="row-subtitle-html d-none">
                            <span class="badge badge-light-primary"><i class="fas fa-envelope mr-25"></i> {!! $company->email ?? '---' !!}</span>
                            <span class="badge badge-light-secondary"><i class="fas fa-phone mr-25"></i> {!! $company->phone ?? '---' !!}</span>
                            <span class="badge badge-light-info"><i class="fas fa-user-plus mr-25"></i> {!! $company->creator->name ?? '---' !!}</span>
                        </div>

                        <a href="javascript:void(0)" class="company-chip">
                            <i class="fas fa-briefcase mr-1"></i>
                            {!! $company->name !!}
                        </a>
                    </td>

                    <!-- Email -->
                    <td class="text-center align-middle d-none d-lg-table-cell">{!! $company->email ?? '---' !!}</td>

                    <!-- Created By -->
                    <td class="text-center align-middle d-none d-lg-table-cell">{!! $company->creator->name ?? '---' !!}</td>

                    <!-- Phone (XL and above) -->
                    <td class="text-center align-middle d-none d-xl-table-cell">{!! $company->phone ?? '---' !!}</td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        @include('dashboard.companies.parts.status')
                    </td>

                    <!-- Manage Status -->
                    @can('companies_update')
                    <td class="text-center align-middle">
                        @include('dashboard.companies.parts.manage_status')
                    </td>
                    @endcan

                    <!-- Actions Column Removed -->
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> {!! __('companies.no_companies_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="float-right mt-2 custom-pagination">
        {!! $companies->links() !!}
    </div>
</div>



