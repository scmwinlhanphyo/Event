<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Contracts\Services\Event\EventServiceInterface;

class EventController extends Controller
{
  /**
   * event interface
   */
  private $eventInterface;

  /**
   * Class Constructor
   * @param eventService
   * @return
   */
  public function __construct(EventServiceInterface $eventServiceInterface)
  {
    $this->eventInterface = $eventServiceInterface;
  }

  /**
   * Get All events.
   * @return Response
   */
  public function getAllEventList()
  {
    $event = $this->eventInterface->getAllEventList();
    return response()->json($event, 200);
  }
}
