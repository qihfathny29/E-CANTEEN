<?php

namespace App\Console\Commands;

use App\Models\Menu;
use Illuminate\Console\Command;

class ResetMenuStock extends Command
{
    protected $signature   = 'menu:reset-stock {--default=50 : Default stock to set for all menus}';
    protected $description = 'Reset stok semua menu ke nilai default (jalankan tiap pagi)';

    public function handle()
    {
        $default = (int) $this->option('default');
        $updated = Menu::where('stock', '<=', 0)->update(['stock' => $default]);
        $this->info("Reset stok selesai. {$updated} menu diisi ulang ke {$default} porsi.");
        return Command::SUCCESS;
    }
}
