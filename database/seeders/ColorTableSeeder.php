<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
          [
              'title' => 'Жовтий',
              'color' => '#F7BD40',
          ],
          [
              'title' => 'Оранжевий',
              'color' => '#DF632E',
          ],
          [
              'title' => 'Червоний',
              'color' => '#E02329',
          ],
          [
              'title' => 'Рожевий',
              'color' => '#EC4899',
          ],
          [
              'title' => 'Фіолетовий',
              'color' => '#884CB2',
          ],
          [
              'title' => 'Синій',
              'color' => '#3B82F6',
          ],
        ];

        foreach ($colors as $key => $value)
        {
            Color::create($value);
        }
    }
}
