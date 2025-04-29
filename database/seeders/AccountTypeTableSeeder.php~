<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User\AccountType;

class AccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountTypes = [
            ['name' => 'admin'],
            ['name' => 'buyer'],
            ['name' => 'seller'],
        ];

        foreach ($accountTypes as $accountType) {
            $total = AccountType::where('name', $accountType['name'])->count();
            if ($total === 0) {
                AccountType::create($accountType);
            }
        }

    }
}
