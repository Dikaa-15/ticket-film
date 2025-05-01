<?php

namespace Database\Seeders;

use App\Models\Bioskop;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $bioskops = Bioskop::with('studio')->get();

        foreach ($bioskops as $bioskop) {
            foreach ($bioskop->studio as $studio) {
                for ($row = 'A'; $row <= 'E'; $row++) {
                    for ($number = 1; $number <= 10; $number++) {
                        $seatNumber = $row . $number;

                        Seat::create([
                            'studio_id'   => $studio->id,
                            'bioskop_id'  => $bioskop->id,
                            'seat_number' => $seatNumber,
                        ]);
                    }
                }
            }
        }
    }
}
