<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddedProducts extends Mailable
{
    use Queueable, SerializesModels;

    private $products;

    /**
     * Create a new message instance.
     *
     * @param Collection $products
     */
    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.products')->with(['products' =>   $this->products]);
    }
}
