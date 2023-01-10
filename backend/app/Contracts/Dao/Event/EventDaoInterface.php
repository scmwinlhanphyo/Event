<?php

namespace App\Contracts\Dao\Event;


/**
 * Interface for Data Accessing Object of Event
 */
interface EventDaoInterface
{

  /**
   * get all event data.
   * @return array $event Event Array.
   */
  public function getAllEventList();

  /**
   * get event by id.
   * @param Integer $id
   * @return Object $event Event Object
   */
  public function getEventById($id);

  /**
   * delete event by id.
   * @param Integer $id.
   * @return Object $msg.
   */
  public function deleteEvent($id);

  /**
   * create events.
   * @param Request $request.
   * @return Object $msg.
   */
  public function createEvent($request);

  /**
   * update events.
   * @param Request $request.
   * @return Object $msg.
   */
  public function updateEvent($request, $id);
}
