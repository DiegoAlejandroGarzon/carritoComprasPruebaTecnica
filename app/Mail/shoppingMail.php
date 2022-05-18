<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class shoppingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productos)
    {
        $this->products = $productos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('shoppingMail');
    }
}
