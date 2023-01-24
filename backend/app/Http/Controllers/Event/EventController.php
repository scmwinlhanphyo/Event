<?php

namespace App\Http\Controllers\Event;

use App\Contracts\Services\Event\EventServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Response;
use Validator;

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

  /**
   * Get Top Event
   * @return Response
   */
  public function getTopEvent()
  {
    $event = $this->eventInterface->getTopEventList();
    return response()->json($event, 200);
  }

  /**
   * Get Previous Event
   * @return Response
   */
  public function getPreviousEvent()
  {
    $event = $this->eventInterface->getPreviousEventList();
    return response()->json($event, 200);
  }

  /**
   * Get Event By Id
   *
   * @param Integer $id
   * @return Response
   */
  public function getEventById($id)
  {
    $event = $this->eventInterface->getEventById($id);
    return response()->json($event, 200);
  }

  public function deleteEventById($id)
  {
    $event = $this->eventInterface->deleteEvent($id);
    return response()->json($event, 200);
  }

  /**
   * Create Event
   * @param Request $request
   * @return void
   */
  public function createEvent(EventRequest $request)
  {
    info($request);
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(storage_path('app/public/events'), $imageName);
    $event = Event::create([
      'event_name' => $request->event_name,
      'description' => $request->description,
      'from_date' => $request->from_date,
      'to_date' => $request->to_date,
      'from_time' => $request->from_time,
      'to_time' => $request->to_time,
      'status' => $request->status,
      'image' => $request->image,
      'address' => $request->address,
      'approved_by_user_id' => $request->approved_by_user_id ?? 1,
    ]);
    return response()->json(['message' => 'New Event is successfully created!', 'event' => $event]);
  }

  /**
   * Update Event
   *
   * @param Request $request
   * @return Response
   */
  public function updateEvent(Request $request,int $id)
  {
    $validator = $this->validateEvent($request);
    if ($validator->fails()) {
      return response()->json(400);
    } else {
      $eventInfo = $this->eventInfo($request);
      $event = $this->eventInterface->updateEvent($eventInfo, $id);
      return response()->json($event, 200);
    }
  }

  /**
   * Event info
   *
   * @param Request $request
   * @return void
   */
  private function eventInfo($request)
  {
    $eventInfoObj = new \stdClass();
    $eventInfoObj->event_name  = trim($request->event_name);
    $eventInfoObj->description  = trim($request->description);
    $eventInfoObj->from_date = trim($request->from_date);
    $eventInfoObj->to_date = trim($request->from_date);
    $eventInfoObj->from_time = trim($request->from_time);
    $eventInfoObj->to_time = trim($request->to_time);
    $eventInfoObj->status = trim($request->status);
    $eventInfoObj->approved_by_user_id = trim($request->approved_by_user_id);
    $eventInfoObj->address = trim($request->address);
    if ($request->file('image')) {
      $file = $request->file('image');
      $fileName = 'event-' . time() . '.' . $file->getClientOriginalExtension();
      $path = $file->storeAs('public/events', $fileName);
      $eventInfoObj->image = trim($path);
    }
    return $eventInfoObj;
  }

  /**
   * Validate Event
   *
   * @param Request $request
   * @return Obj
   */
  private function validateEvent(Request $request)
  {
    return $validator = Validator::make($request->all(), [
      'event_name' => 'required',
      'from_date' => 'required',
      'to_date' => 'required',
      'from_time' => 'required',
      'to_time' => 'required',
      'status' => 'required',
      'address' => 'required',
      'image' => 'required',
    ]);
  }
}
