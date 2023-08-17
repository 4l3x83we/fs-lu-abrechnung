<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: SendInvitationNotification.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 11:55
 */

namespace App\Notifications;

use App\Models\Admin\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendInvitationNotification extends Notification
{
    use Queueable;

    public Invitation $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('You are invited to the team "'.auth()->user()->teamName().'"')
            ->action('Accept Invitation', route('invitations.accept', $this->invitation->token))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
