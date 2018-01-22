<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyQuota extends Notification
{
    use Queueable;
    protected $user;
    protected $quota;
    protected $jenis;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $quota, $jenis)
    {
        $this->user = $user;
        $this->quota = $quota;
        $this->jenis = $jenis;
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
        if($this->jenis == 'ubah'){
            $text = 'Perubahan kuota perusahaan spesies '.$this->quota['species_name'].' menjadi '.$this->quota['quota_amount'];
        }else{
            $text = 'Penambahan kuota spesies '.$this->quota['species_name'].' sebesar '.$this->quota['quota_amount'];
        }

        return [
            'time'      => Carbon::now()->format('Y-m-d H:i:s'),
            'notif_for' => $notifiable,
            'user'      => $this->user,
            'text'      => $text,
            'url'       => '/companyQuota/',
        ];
    }
}
