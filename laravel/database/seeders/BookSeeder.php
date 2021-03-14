<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Book $model)
    {
        for ($i = 0; $i < 70; $i++) {
            $exist = $model::factory()->create();

            for ($x = 0; $x < random_int(0,4); $x++) {
                DB::table('author_book')->insert(
                    ['author_id'=> random_int(1,10), 'book_id'=>$exist->id]
                );
            }
        }
    }
}
