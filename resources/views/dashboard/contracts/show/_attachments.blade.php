<div class="tab-pane fade" id="attachments" role="tabpanel">
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex align-items-center justify-content-between">
            <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                <i class="fas fa-paperclip text-primary mr-1"></i>
                <span>{!! __('properties.attachments') !!}</span>
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted" style="font-size: 15px;">
                            <th class="border-top-0 py-2">#</th>
                            <th class="border-top-0 py-2">{!! __('properties.attachment_name') !!}</th>
                            <th class="border-top-0 py-2 text-center">{!! __('general.actions') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        @forelse($contract->attachments as $attachment)
                            <tr>
                                <td class="py-2">#{!! $loop->iteration !!}</td>
                                <td class="py-2">{!! $attachment->name ?? __('properties.attachment') . ' ' . $loop->iteration !!}</td>
                                <td class="py-2 text-center">
                                    <a href="{!! Storage::disk('contracts')->url($attachment->file) !!}" target="_blank"
                                        class="btn btn-sm btn-light-info radius-10" title="{!! __('general.show') !!}">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <i class="fas fa-paperclip font-large-1 text-muted d-block mb-2 opacity-50"></i>
                                    <span class="text-muted">{!! __('general.no_data_found') !!}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
