<?php

namespace App\Jobs;

use App\Models\Delivery;
use App\Enums\DeliveryState;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateRoute implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    protected $delivery;

    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    public function handle()
    {
        logger("Starting fake route generation for delivery ID:{$this->delivery->id}");

        sleep(3); // Simulate route generation delay

        $this->delivery->state = DeliveryState::NotStarted;
        $this->delivery->save();

        logger("Fake route generated for delivery ID:{$this->delivery->id}");
    }
}
