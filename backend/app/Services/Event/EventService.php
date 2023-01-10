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
}
