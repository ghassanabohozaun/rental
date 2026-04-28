<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMonthlyReportNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $monthlyReport;

    /**
     * Create a new notification instance.
     */
    public function __construct($monthlyReport)
    {
        $this->monthlyReport = $monthlyReport;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'id' => $this->monthlyReport->id,
            'employee_name' => $this->monthlyReport->employee->EmployeeShortName(),
            'month' => $this->monthlyReport->month,
            'year' => $this->monthlyReport->year,
            'type' => 'monthly_report',
            'created_at' => now(),
        ];
    }
}
