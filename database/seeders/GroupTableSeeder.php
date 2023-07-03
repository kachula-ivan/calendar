<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'title' => 'Без категорії',
                'color' => '#5786a400',
            ],
            [
                'title' => 'Робота',
                'color' => '#000',
            ],
            [
                'title' => 'Навчання',
                'color' => '#00ffd9',
            ],
            [
                'title' => 'Дозвілля',
                'color' => '#360e61',
            ],
        ];

        foreach ($groups as $key => $value)
        {
            Group::create($value);
        }
    }
}
