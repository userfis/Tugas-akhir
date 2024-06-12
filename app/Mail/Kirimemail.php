<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class Kirimemail extends Mailable
{
    use Queueable, SerializesModels;

    public $encryptedData;
    public $filePath;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $encryptedData
     * @param  string  $filePath
     * @return void
     */
    public function __construct($encryptedData, $filePath)
    {
        $this->encryptedData = $encryptedData;
        $this->filePath = $filePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->encryptedData);
        return $this->subject('Subject Email Anda')
                    ->view('kirimEmail')
                    ->with([
                        'encryptedData' => $this->encryptedData,
                    ])
                    ->attach($this->filePath);
    }
}
