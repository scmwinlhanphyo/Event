<?php

namespace App\Services\Event;

use App\Contracts\Dao\Event\EventDaoInterface;
use App\Contracts\Services\Event\EventServiceInterface;

/**
 * Service class for event.
 */
class EventService implements EventServiceInterface
{
  /**
   * event dao
   */
  private $eventDao;
  /**
   * Class Constructor
   * @param EventDaoInterface
   */
  public function __construct(EventDaoInterface $eventDao)
  {
    $this->eventDao = $eventDao;
  }

  /**
   * get all event data.
   * @return Object $event Event Object
   */
  public function getAllEventList()
  {
    $event = $this->eventDao->getAllEventList();
    return $event;
  }

  /**
   * get event by id.
   * @param Integer $id
   * @return Object $event Event Object
   */
  public function getEventById($id)
  {
    $event = $this->eventDao->getEventById($id);
    if (!isset($event)) {
      return null;
    }
    $IMAGE_FOLDER = config('constants.EVENT_IMG_ROUTE');
    $event->path = url($IMAGE_FOLDER . $event->image);
    return $event;
  }

  /**
   * Delete Event
   * @param $id
   * @return Obj
   */
  public function deleteEvent($id)
  {
    return $this->eventDao->deleteEvent($id);
  }

  /**
   * Create event
   *
   * @param $eventInfo
   * @return void
   */
  public function createEvent($eventInfo)
  {
    $eventData = [
      'event_name' => $eventInfo->event_name,
      'description' => $eventInfo->description,
      'address' => $eventInfo->address,
      'from_date' => $eventInfo->from_date,
      'to_date' => $eventInfo->to_date,
      'from_time' => $eventInfo->from_time,
      'to_time' => $eventInfo->to_time,
      'status' => $eventInfo->status,
      'approved_by_user_id' => $eventInfo->approved_by_user_id,
      'image' => $eventInfo->image
    ];
    return $this->eventDao->createEvent($eventData);
  }

  /**
   * Update event
   *
   * @param $eventInfo
   * @param $id
   * @return void
   */
  public function updateEvent($eventInfo, $id)
  {
    $eventData = [
      'event_name' => $eventInfo->event_name,
      'description' => $eventInfo->description,
      'address' => $eventInfo->address,
      'from_date' => $eventInfo->from_date,
      'to_date' => $eventInfo->to_date,
      'from_time' => $eventInfo->from_time,
      'to_time' => $eventInfo->to_time,
      'status' => $eventInfo->status,
      'approved_by_user_id' => $eventInfo->approved_by_user_id,
      'image' => $eventInfo->image
    ];
    return $this->eventDao->updateevent($eventData, $id);
  }
}
