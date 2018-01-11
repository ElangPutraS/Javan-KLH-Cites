<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Pnbp extends Notification
{
    use Queueable;

    protected $user;
    protected $trade_permit;
    protected $pnbp;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $trade_permit, $pnbp)
    {
        $this->user = $user;
        $this->trade_permit = $trade_permit;
        $this->pnbp = $pnbp;
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
            $jenis = 'Permohonan';
        }else{
            $jenis = 'Pembaharuan';
        }
        if($this->pnbp->payment_status == 1){

            $text = $jenis.' SATS-LN sudah terbit dan lunas ('. $this->trade_permit->trade_permit_code.')';
            $link = '/submission/'.$this->trade_permit->id.'/detail';
        }else{
            $text = 'Tagihan '.$jenis.' SATS-LN sudah dibuat ('. $this->trade_permit->trade_permit_code.')';
            $link = '/invoice/'.$this->trade_permit->id.'/detail';
        }

        return [
            'time'      => Carbon::now()->format('Y-m-d H:i:s'),
            'notif_for' => $notifiable,
            'user'      => $this->user,
            'text'      => $text,
            'url'       => $link,
        ];
    }
}
