<input type="checkbox" class="daily_reports_change_status" {{ $monthlyReport->status == 'on' ? 'checked' : '' }}
    data-id="{{ $monthlyReport->id }}" />
