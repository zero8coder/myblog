<?php

use Illuminate\Database\Seeder;
use App\Models\Wisdom;

class WisdomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wisdoms = factory(Wisdom::class)->times(50)->make();

        Wisdom::insert($wisdoms->toArray());
    }
}
