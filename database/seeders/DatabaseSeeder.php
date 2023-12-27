<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $statuses = [
            "\\App\\Models\\User" => [
                [
                    "name" => "pending",
                    "object" => "\\App\\Models\\User",
                    "is_active" => 0
                ],
                [
                    "name" => "active",
                    "object" => "\\App\\Models\\User",
                    "is_active" => 1
                ],
                [
                    "name" => "blocked",
                    "object" => "\\App\\Models\\User",
                    "is_active" => 1
                ],
            ],
            "\\App\\Models\\Order" => [
                [
                    "name" => "pending",
                    "object" => "\\App\\Models\\Order",
                    "is_active" => 0
                ],
                [
                    "name" => "processing",
                    "object" => "\\App\\Models\\Order",
                    "is_active" => 0
                ],
                [
                    "name" => "delivered",
                    "object" => "\\App\\Models\\Order",
                    "is_active" => 0
                ],
                [
                    "name" => "complete",
                    "object" => "\\App\\Models\\Order",
                    "is_active" => 1
                ],
            ],
            "\\App\\Models\\Expense" => [
                [
                    "name" => "pending approval",
                    "object" => "\\App\\Models\\Expense",
                    "is_active" => 0
                ],
                [
                    "name" => "approved",
                    "object" => "\\App\\Models\\Expense",
                    "is_active" => 0
                ],
                [
                    "name" => "done",
                    "object" => "\\App\\Models\\Expense",
                    "is_active" => 1
                ],

            ]

        ];

        $data = [];

        foreach ($statuses as $status){
            for ($i=0, $count = count($status); $i < $count; $i++){
                $data[ ] = $status[$i];
            }
        }

        DB::table('statuses')->insert($data);

        DB::table("cms_types")->insert([
            ["name" => "page"],
            ["name" => "menu"],
            ["name" => "block"],
            ["name" => "comment"],
            ["name" => "article"],
        ]);

        DB::table('expense_types')->insert([
            ['name' => 'General', 'is_repeating' => false, 'frequency' => NULL, 'amount' => 0],
            ['name' => 'Daily Expense', 'is_repeating' => true, 'frequency' => 'DAY', 'amount' => 1],
            ['name' => 'Monthly Expense', 'is_repeating' => true, 'frequency' => 'MONTHLY', 'amount' => 1],
            ['name' => 'Annual Expense', 'is_repeating' => true, 'frequency' => 'ANNUALLY', 'amount' => 1],
            ['name' => 'Wages', 'is_repeating' => true, 'frequency' => 'MONTHLY', 'amount' => 1],
        ]);

        DB::table('product_types')->insert([
            ["name" => "Solar Panel"],
            ["name" => "Battery"],
        ]);

        DB::table('roles')->insert([
            ['name' => 'Super Admin'],
            ['name' => 'Administrator'],
            ['name' => 'Partner'],
            ['name' => 'Staff'],
            ['name' => 'Customer']
        ]);

        $branchContactId = DB::table('contacts')->insertGetId([
            "address" => "Office# 225-228, 2nd Floor, Lexus Mall",
            "area" => "Gulberg Greens",
            "city" => "Islamabad",
            "state" => "ICT",
            "mobile" => "03459042489"
        ]);

        DB::table("branches")->insert([
            "name" => "Islamabad",
            "contact_id" => $branchContactId
        ]);

        $branchContactId = DB::table('contacts')->insertGetId([
            "address" => "LG UG 31, Deans Trade Center",
            "area" => "Peshawar Cantt",
            "city" => "Peshawar",
            "mobile" => "03225312306"
        ]);

        DB::table("branches")->insert([
            "name" => "Peshawar Cantt",
            "contact_id" => $branchContactId
        ]);

        $branchContactId = DB::table('contacts')->insertGetId([
            "address" => "Ring Road, Near Sarhad University",
            "area" => "Ring Road",
            "city" => "Peshawar",
            "mobile" => "03338230872",
            "phone" => "091-5253001"
        ]);

        DB::table("branches")->insert([
            "name" => "Ring Road Peshawar",
            "contact_id" => $branchContactId
        ]);


        $contactId = DB::table('contacts')->insertGetId([
            "address" => "Office# 225-228, 2nd Floor, Lexus Mall",
            "area" => "Gulberg Greens",
            "city" => "Islamabad",
            "state" => "ICT",
            "mobile" => "03459042489"
        ]);

        $userId = DB::table("users")->insertGetId([
            "name" => "Qazi Kamran Ameen",
            "email" => "solariconx@gmail.com",
            "mobile" => "03459042489",
            "password" => \Hash::make('Mobylynk@1'),
            "contact_id" => $contactId,
            "role_id" => 1,
            "status_id" => 2
        ]);

        DB::table('contacts')->where(['id' => $contactId])->update(["user_id" => $userId]);

    }
}
