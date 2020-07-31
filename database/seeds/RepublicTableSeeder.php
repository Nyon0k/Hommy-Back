<?php

use Illuminate\Database\Seeder;

class RepublicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory (App\Republic::class,12)->create()->each(function($Republic){
        	$user = App\User::findOrFail($Republic->user_id);
        	$Republic->republicaFavoritada()->attach($user->id);
        });
    }
}
