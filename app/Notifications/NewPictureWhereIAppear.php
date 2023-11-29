<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class NewPictureWhereIAppear extends Notification
{
    use Queueable;
    protected $eventName;
    /**
     * Create a new notification instance.
     */
    public function __construct(String $eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toFcm($notifiable): FcmMessage
    {
        return FcmMessage::create()
            //->setData(['data1' => 'value', 'data2' => 'value2'])
            ->setNotification(FcmNotification::create()
                ->setTitle('Nueva fotografía!')
                ->setBody('Has aparecido en una foto del evento ' . $this->eventName));
                //->setImage('https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.flaticon.com%2Ffree-icon%2Fimage_1160358&psig=AOvVaw0RegY3s5z0yK6HsbDM4ASa&ust=1701344237157000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCIiu5KiP6YIDFQAAAAAdAAAAABAJ'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
