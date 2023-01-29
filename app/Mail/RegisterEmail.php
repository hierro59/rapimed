<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Data
     */
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@rapimed.online', 'RapiMed')
            ->subject('Se ha registrado correctamente')
            ->view('mails.register')
            ->text('mails.register_plain')
            ->attach(public_path('/img') . '/logo-rapimed-2023.jpg', [
                'as' => 'logo-rapimed-2023.jpg',
                'mime' => 'image/jpeg',
            ]);
    }
}
