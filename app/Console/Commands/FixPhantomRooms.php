<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Properti;

class FixPhantomRooms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:phantom-rooms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove phantom room types (Single Room, Junior Suite) from specific property';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Use fuzzy search to avoid encoding/typo issues
        $p = Properti::where('id', 'LIKE', '019c6120%')->first();

        if (!$p) {
            $this->error("Property not found starting with 019c6120");
            return 1;
        }

        $this->info("Found Property: {$p->judul}");
        $this->info("Initial Room Types Count: " . $p->propertiTipeKamars()->count());

        $targetNames = ['Single Room', 'Junior Suite'];
        $count = 0;

        foreach ($p->propertiTipeKamars as $ptk) {
            if (!$ptk->tipeKamar) {
                $this->warn("Found orphan record ID: {$ptk->id}. Deleting...");
                $ptk->delete();
                $count++;
                continue;
            }

            $name = $ptk->tipeKamar->nama;
            
            if (in_array($name, $targetNames)) {
                $this->info("Deleting $name (ID: {$ptk->id})...");
                try {
                    $ptk->delete();
                    $this->info("-> Deleted successfully.");
                    $count++;
                } catch (\Exception $e) {
                    $this->error("-> Failed to delete: " . $e->getMessage());
                }
            }
        }

        $p->refresh();
        $this->info("Final Room Types Count: " . $p->propertiTipeKamars()->count());

        $p->updateRoomStats();
        $this->info("Room stats updated.");
        
        return 0;
    }
}
