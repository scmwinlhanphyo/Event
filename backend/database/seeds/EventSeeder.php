<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events =  [
            [
              'event_name' => 'BarCamp 2023',
              'description' => 'It is IT developer knowledge sharing',
              'from_date' => '09/01/2023',
              'to_date' => '09/01/2023',
              'from_time' => '09:00 AM',
              'to_time' => '05:00 PM',
              'status' => 'approved',
              'approved_by_user_id' => 1,
              'image' => '/uploads/images/events/img1.jpg',
              'address' => 'Ygn',
              'created_at' => new \DateTime(),
              'updated_at' => new \DateTime(),
            ],
            [
                'event_name' => 'Esport Event',
                'description' => 'MLBB, Pubg, Dota match',
                'from_date' => '09/01/2023',
                'to_date' => '09/01/2023',
                'from_time' => '09:00 AM',
                'to_time' => '05:00 PM',
                'status' => 'approved',
                'approved_by_user_id' => 2,
                'image' => '/uploads/images/events/img2.jpg',
                'address' => 'Mdy',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
          ];
          Event::insert($events);
    }
}
