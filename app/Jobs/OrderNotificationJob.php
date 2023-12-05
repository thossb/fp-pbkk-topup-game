<?php

namespace App\Jobs;

use App\Mail\OrderNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $user;
    // public $transaction;
    // public $game;
    // public $denom;

    // public $email;

    public $email;
    public $user_name;
    public $transaction_created_at;
    public $transaction_id;
    public $game_name;
    public $game_unit;
    public $denom_denom;
    public $denom_price;
    /**
     * Create a new job instance.
     */
    public function __construct($email,  $user_name,  $transaction_created_at,  $transaction_id,  $game_name,  $game_unit,  $denom_denom,  $denom_price)
    {
        //
        // $this->email = $email;
        // $this->user = $user;
        // $this->transaction = $transaction;
        // $this->game = $game;
        // $this->denom = $denom;
        $this->email = $email;
        $this->user_name = $user_name;
        $this->transaction_created_at = $transaction_created_at;
        $this->transaction_id = $transaction_id;
        $this->game_name = $game_name;
        $this->game_unit = $game_unit;
        $this->denom_denom = $denom_denom;
        $this->denom_price = $denom_price;
        info('construct cok');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        info('Invoice sent to ' . $this->email);

        Mail::to($this->email)->send(new OrderNotificationMail($this->email,  $this->user_name,  $this->transaction_created_at,  $this->transaction_id,  $this->game_name,  $this->game_unit,  $this->denom_denom,  $this->denom_price));
    }
}
