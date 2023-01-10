<?php

namespace App\Contracts\Dao\Event;


/**
 * Interface for Data Accessing Object of Event
 */
interface EventDaoInterface
{

  /**
   * get all event data.
   * @return Object $event Event Object
   */
  public function getAllEventList();
}
