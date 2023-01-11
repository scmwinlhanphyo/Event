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
        $events = Event::join('users', 'users.id', '=', 'events.approved_by_user_id')->select('events.*', 'users.name as username', 'users.email', 'users.role', 'users.dob', 'users.address', 'users.phone', 'users.profile')->where(
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

  /**
   * Get Top Event
   * @return Response
   */
  public function getTopEventList()
  {
    return DB::transaction(function () {
      return Event::join('users', 'users.id', '=', 'events.approved_by_user_id')->select('events.*', 'users.name as username', 'users.email', 'users.role', 'users.dob', 'users.address', 'users.phone', 'users.profile')->where('events.to_date', '>=', date('Y-m-d'))->paginate(config('constant.pagination_count'));
    });
  }

  /**
   * Get Previous Event
   * @return Response
   */
  public function getPreviousEventList()
  {
    return DB::transaction(function () {
      return Event::join('users', 'users.id', '=', 'events.approved_by_user_id')->select('events.*', 'users.name as username', 'users.email', 'users.role', 'users.dob', 'users.address', 'users.phone', 'users.profile')->where('events.to_date', '<', date('Y-m-d'))->paginate(config('constant.pagination_count'));
    });
  }

  /**
   * Get Event By Id
   *
   * @param $id
   * @return void
   */
  public function getEventById($id)
  {
    return Event::join('users', 'users.id', '=', 'events.approved_by_user_id')->select('events.*', 'users.name as username', 'users.email', 'users.role', 'users.dob', 'users.address', 'users.phone', 'users.profile')->where('events.id', $id)->first();
  }

  /**
   * Delete Job
   *
   * @param $id
   * @return Obj
   */
  public function deleteEvent($id)
  {
    return DB::transaction(function () use ($id) {
      $response = ['error' => "Event does not exist."];
      $event = Event::find($id);
      if ($event) {
        $event->delete();
        $response = ['success' => "Event is deleted successfully"];
      }
      return $response;
    });
  }

  /**
   * Create event
   * @param $eventData
   * @return void
   */
  public function createEvent($eventData)
  {
    return Event::create($eventData);
  }

  /**
   * Update Event
   * @param $eventData
   * @param $id
   * @return void
   */
  public function updateEvent($eventData, $id)
  {
    return Event::where('id', $id)->update($eventData);
  }
}
