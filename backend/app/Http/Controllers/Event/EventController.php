<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Contracts\Services\Event\EventServiceInterface;
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
   * Create category
   * @param Request $request
   * @return void
   */
  public function createEvent(Request $request)
  {
    $validator = $this->validateEvent($request);
    if ($validator->fails()) {
      return response()->json(400);
    } else {
      $eventInfo = $this->eventInfo($request);
      $event = $this->eventInterface->createEvent($eventInfo);
      // if ($request->image) {
      //   $img_name = $this->eventInterface->moveImg($request->image);
      //   if (!$img_name) {
      //     return response()->json(['error_msg' => 'File Upload Failed。'], 302);
      //   }
      //   $request->image = $img_name;
      //   $eventInfo = $this->eventInfo($request);
      //   $event = $this->eventInterface->createEvent($eventInfo);
      // } else {
      //   return response()->json(['error_msg' => 'Image Size Too Large']);
      // }
      return Response::json($event, 200);
    }
  }

  /**
   * Update Event
   *
   * @param Request $request
   * @return Response
   */
  public function updateEvent(Request $request)
  {
    $validator = $this->validateEvent($request);
    if ($validator->fails()) {
      return response()->json(400);
    } else {
      $eventInfo = $this->eventInfo($request);
      $event = $this->eventInterface->updateEvent($eventInfo, $request['id']);
      // if ($request->image || $request->old_image) {
      //   if ($request->image) {
      //     $img_name = $this->eventInterface->moveImg($request->image);

      //     if (!$img_name) {
      //       return response()->json(['error_msg' => 'File Upload Failed。'], 302);
      //     }

      //     $request->image = $img_name;
      //   } else {
      //     $request->image = $request->old_image;
      //   }
      //   $eventInfo = $this->eventInfo($request);
      //   $event = $this->eventInterface->updateEvent($eventInfo, $request['id']);
      // } else {
      //   return response()->json(['error_msg' => 'Image Size Too Large']);
      // }

      // $eventInfo = $this->eventInfo($request);
      // $event = $this->eventInterface->updateEvent($eventInfo, $request['id']);
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
    $eventInfoObj->image = trim($request->image);
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
      'approved_by_user_id' => 'required',
      'address' => 'required',
      'image' => 'required',
    ]);
  }
}
