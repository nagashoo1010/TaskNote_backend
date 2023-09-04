<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i = 1; $i < 10; $i++){
        //     Task::create([
        //         'task' => 'テストテキスト{i}'
        //     ]);
        // }
        Task::factory()->count(10)->create();


    }
}
