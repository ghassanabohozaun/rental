<input type="checkbox" class="daily_reports_change_status" {{ $dailyReport->status == 'on' ? 'checked' : '' }}
    data-id="{{ $dailyReport->id }}" />
