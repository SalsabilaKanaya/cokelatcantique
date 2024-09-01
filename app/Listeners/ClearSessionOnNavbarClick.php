<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NavbarClicked;

class ClearSessionOnNavbarClick
{
    public function handle(NavbarClicked $event)
    {
        Log::info('ClearSessionOnNavbarClick listener triggered');
        session()->forget('selected_items');
        session()->forget('order_details');
    }
}
