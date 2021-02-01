<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoProyecto extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proyecto, $proyecto_id, $user_name)
    {
        $this->proyecto = $proyecto;
        $this->user_name = $user_name;
        $this->proyecto_id = $proyecto_id;
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
        return (new MailMessage)
                    ->line('Se ha dado de alta un nuevo proyecto en Helios')
                    ->line('El proyecto se llama: ' . $this->proyecto)
                    ->line('Ha sido creado por: ' . $this->user_name)
                    ->action('Consulta el proyecto', url('/proyecto/'. $this->proyecto_id .'/ver'))
                    ->line('Helios');
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
