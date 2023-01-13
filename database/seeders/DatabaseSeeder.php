<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Address;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Item::insert([
            [
                'item' => 'Design',
                'type' => 'Service',
                'price' => '230'
            ],[
                'item' => 'Development',
                'type' => 'Service',
                'price' => '330'
            ],[
                'item' => 'Meetings',
                'type' => 'Service',
                'price' => '60'
            ],[
                'item' => 'Computer',
                'type' => 'Item',
                'price' => '1000'
            ]
        ]);

        Address::insert([
            [
                'company' => 'Discovery Plugins',
                'address' => '41 St Vincent Place Glasgow G1 2ER Scotland'
            ],[
                'company' => 'Barringtons Publisher',
                'address' => '17 Great Sulfolk Street London SE1 0NS United Kingdom'
            ],[
                'company' => 'London Cpy',
                'address' => '123 London Street London SE1 0NS United Kingdom'
            ]
        ]);

        Invoice::insert([
            [
                'date' => date("Y-m-d"),
                'duedate' => date("Y-m-d"),
                'subject' => 'Test Invoice 1',
                'from' => 1,
                'for' => 2
            ],
            [
                'date' => date("Y-m-d"),
                'duedate' => date("Y-m-d"),
                'subject' => 'Test Invoice 2',
                'from' => 1,
                'for' => 3
            ],
            [
                'date' => date("Y-m-d"),
                'duedate' => date("Y-m-d"),
                'subject' => 'Test Invoice 3',
                'from' => 2,
                'for' => 3
            ]
        ]);
        Invoice::find(1)->items()->attach([
            1 => [
                'qty' => 5
            ],
            2 => [
                'qty' => 10
            ],
        ]);
        Invoice::find(2)->items()->attach([
            1 => [
                'qty' => 100
            ],
            3 => [
                'qty' => 2
            ],
        ]);

    }
}
