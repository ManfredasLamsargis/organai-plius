<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Client\AuctionController;

class CheckAuctionExpirations extends Command
{
    protected $signature = 'auction:check-expirations';
    protected $description = 'Checks and expires auctions that reached end time';

    public function handle()
    {
        AuctionController::checkAuction();

        $this->info('Checked for expired auctions.');
        return Command::SUCCESS;
    }
}
