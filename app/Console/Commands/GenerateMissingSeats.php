<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Studio;
use App\Models\Seat;

class GenerateMissingSeats extends Command
{
    protected $signature = 'seat:generate-missing';
    protected $description = 'Generate seat untuk studio yang belum punya kursi';

    public function handle()
    {
        $studios = Studio::with('bioskop')->doesntHave('seat')->get();

        foreach ($studios as $studio) {
            $this->info("Generating seat untuk studio {$studio->name}...");

            for ($row = 'A'; $row <= 'E'; $row++) {
                for ($number = 1; $number <= 10; $number++) {
                    Seat::create([
                        'studio_id'   => $studio->id,
                        'bioskop_id'  => $studio->bioskop->id,
                        'seat_number' => $row . $number,
                        'is_available' => true,
                    ]);
                }
            }

            $this->info("✔ Seat untuk Studio {$studio->name} berhasil dibuat.");
        }

        $this->info('Selesai!');
    }
}
