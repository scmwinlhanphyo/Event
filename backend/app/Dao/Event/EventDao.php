<?php

namespace App\Dao\Event;

use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Contracts\Dao\Event\EventDaoInterface;

/**
 * Data accessing object for event
 */
class EventDao implements EventDaoInterface
{

  /**
   * To get event list.
   * @return array $event list.
   */
  public function getAllEventList()
  {
    return DB::transaction(function () {
      if (request()->query('search')) {
        $events = Event::where(
          "name",
          'LIKE',
          '%' . request()->query('search') . '%'
        )->paginate(config('constant.pagination_count'));
      } else {
        $events = Event::paginate(config('constant.pagination_count'));
      }
      return $events;
    });
  }
}
