<?php

namespace App\Console\Commands\Emails;

use App\Mail\AddedProducts;
use App\Product;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAddedProductsToSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send added products to super user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $emails = User::getUsersEmailsByRole(User::SUPER_USER);
        $products = Product::getProductsAddedToday();
        foreach ($emails as $email) {
            Mail::to($email)->send(new AddedProducts($products));
        }
    }
}
