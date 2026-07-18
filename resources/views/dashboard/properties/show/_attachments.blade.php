<!-- Attachments Tab -->
<div class="tab-pane fade" id="attachments" role="tabpanel">
    <div class="card border-0 shadow-sm radius-15">
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex justify-content-between align-items-center" style="height: 50px;">
            <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                <i class="fas fa-paperclip text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('properties.property_attachments') !!}
            </h5>
            @can('properties_update')
            <a href="{!! route('dashboard.properties.edit', $property->id) !!}" class="btn btn-sm btn-light-primary radius-10">
                <i class="fas fa-edit mr-1"></i> {!! __('general.edit') !!}
            </a>
            @endcan
        </div>
        <div class="card-body p-0">
            <div class="scrollable-table-container custom-scrollbar" style="max-height: 350px; overflow-y: auto; overflow-x: auto;">
                <table class="table table-hover mb-0">
                    <thead class="bg-light" style="position: sticky; top: 0; z-index: 2; background: #f8f9fa;">
                        <tr class="text-muted" style="font-size: 14px;">
                            <th class="border-top-0" width="50">#</th>
                            <th class="border-top-0">{!! __('properties.attachment_name') !!}</th>
                            <th class="border-top-0 text-center" width="100">{!! __('general.actions') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($property->attachments as $attachment)
                        <tr>
                            <td class="py-2">#{!! $loop->iteration !!}</td>
                            <td class="py-2">
                                <div class="font-weight-bold">{!! $attachment->name !!}</div>
                            </td>
                            <td class="py-2 text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{!! asset('uploads/properties/' . $attachment->file) !!}" target="_blank" class="btn-premium-action btn-premium-action-info mx-1" title="{!! __('general.view') ?? 'عرض' !!}">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="{!! asset('uploads/properties/' . $attachment->file) !!}" download target="_blank" class="btn-premium-action btn-premium-action-success mx-1" title="{!! __('general.download') ?? 'تحميل' !!}">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
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
