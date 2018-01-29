<?php

namespace App\Notifications;

use App\Company;
use App\TradePermit;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubmissionVerification extends Notification
{
    use Queueable;

    protected $trade_permit;
    protected $company;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( Company $company, TradePermit $tradePermit )
    {
        $this->trade_permit = $tradePermit;
        $this->company = $company;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Verifikasi Permohonan')
            ->markdown('mail.submission.verification-accept', ['company' => $this->company, 'trade_permit' => $this->trade_permit, 'type' => 'permohonan']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
