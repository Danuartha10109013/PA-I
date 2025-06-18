<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccPemesananMail extends Mailable
{
    use Queueable, SerializesModels;

    public $produk;
    public $harga;
    public $nama;
    public $email;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($produk, $harga, $nama, $email, $password)
    {
        $this->produk = $produk;
        $this->harga = $harga;
        $this->nama = $nama;
        $this->email = $email;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Pemesanan dan Akun Login'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.acc_pemesanan'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
