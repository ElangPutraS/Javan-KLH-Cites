<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubmissionCreate extends Notification
{
    use Queueable;

    protected $user;
    protected $trade_permit;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $trade_permit)
    {
        $this->user = $user;
        $this->trade_permit = $trade_permit;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        if($this->trade_permit->permit_type == 1){
            $jenis = 'permohonan';
            $link = 'verificationSub';
        }else{
            $jenis = 'pembaharuan';
            $link = 'verificationRen';
        }

        return [
            'time'      => Carbon::now()->format('d-m-Y H:i'),
            'notif_for' => $notifiable,
            'user'      => $this->user,
            'text'      => 'Mengajukan '.$jenis.' SATS-LN',
            'url'       => '/admin/'.$link.'/'.$this->trade_permit->id.'/detail',
        ];
    }
}
