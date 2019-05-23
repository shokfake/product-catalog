<?php

namespace App\Console\Commands;

use App\Mail\AddedProducts;
use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class SendEmails extends Command
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
    protected $description = 'Send drip e-mails to a user';

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
        $superUsers = Role::findByName('Super Admin');
        $products = Product::all()->where('created_at', '>=', Carbon::today()->toDateString());
        foreach ($superUsers->users as $users) {
            Mail::to($users->email)->send(new AddedProducts($products));
        }
    }
}
