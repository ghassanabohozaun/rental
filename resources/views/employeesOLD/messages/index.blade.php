@extends('layouts.employees.app')

@section('title', __('dashboard.messages'))

@section('content')
    <div class="content-wrapper">
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="home-tab">
                    
                    @livewire('employee.messages.message-center')

                </div>
            </div>
        </div>

        <!-- Compose Modal (Unified Premium Animation) -->
        <div class="modal modal-pop fade" id="composeModal" tabindex="-1" role="dialog"
            aria-labelledby="composeModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                    <div class="modal-header border-bottom-0 pb-0 shadow-none">
                        <h5 class="modal-title fw-bold fs-4" id="composeModalLabel">
                             <i class="mdi mdi-pencil-box-outline me-2 text-primary"></i>
                             {!! __('messages.compose_message') !!}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <livewire:employee.messages.compose />
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', function() {
            Livewire.on('close-modal', function() {
                var modalElement = document.getElementById('composeModal');
                var modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                modal.hide();
            });

            Livewire.on('message-sent', function() {
                window.location.reload();
            });

            Livewire.on('confirm-delete', function(data) {
                swal({
                    title: "{{ __('general.ask_delete_record') }}",
                    text: "{{ __('general.delete_warning_text') }}",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "{{ __('general.cancel') }}",
                            value: null,
                            visible: true,
                            className: "btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: "{{ __('general.yes_delete_it') }}",
                            value: true,
                            visible: true,
                            className: "btn-info",
                            closeModal: true
                        }
                    }
                }).then(isConfirm => {
                    if (isConfirm) {
                        if (data.type === 'bulk') {
                            Livewire.dispatch('doBulkDelete');
                        } else {
                            Livewire.dispatch('doDelete', {
                                messageId: data.id
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
