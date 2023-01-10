<?php

namespace App\Contracts\Services\Event;


/**
 * Interface for event service
 */
interface EventServiceInterface
{

  /**
   * To get all event data.
   * @return Object $event data.
   */
  public function getAllEventList();
}
