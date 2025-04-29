<?php

namespace Database\Seeders;

use App\Models\MemberType\MemberType;
use Illuminate\Database\Seeder;

class MemberTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberTypeData = [
            [
                'type' => 'founder',
            ],
            [
                'type' => 'co-founder',
            ],
            [
                'type' => 'investor',
            ],
            [
                'type' => 'developer',
            ],
            [
                'type' => 'account',
            ],
            [
                'type' => 'marketer',
            ],
            [
                'type' => 'sales',
            ],

            [
                'type' => 'mentor',
            ],

            [
                'type' => 'consultant',
            ],

        ];


        foreach ($memberTypeData as $memberType) {
            $total = MemberType::where('type', $memberType['type'])->count();
            if ($total === 0) {
                MemberType::create($memberType);
            }
        }
    }
}
