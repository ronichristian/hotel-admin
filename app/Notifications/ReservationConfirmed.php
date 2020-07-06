<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class ReservationConfirmed extends Notification
{
    use Queueable;

    public $guest_detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($guest_detail)
    {
        $this->guest_detail = $guest_detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'bookToConfirm' => $this->guest_detail,
            'GuestDetail' => $notifiable
        ];
    } 


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage( [
            'bookToConfirm' => $this->guest_detail,
            'GuestDetail' => $notifiable
        ]);
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
