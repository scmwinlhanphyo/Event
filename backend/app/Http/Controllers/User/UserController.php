<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

  /**
   * user interface
   */
  private $userInterface;

  /**
   * Class Constructor
   * @param userService
   * @return
   */
  public function __construct(UserServiceInterface $userServiceInterface)
  {
    $this->userInterface = $userServiceInterface;
  }

  /**
   * Get All users.
   * @return Response
   */
  public function getAllUserList()
  {
    $user = $this->userInterface->getAllUserList();
    return response()->json($user, 200);
  }

  /**
   * Create user
   *
   * @param Request $request
   * @return void
   */
  public function createUser(Request $request)
  {
    $this->userInterface->createUser($request);
    return response()->json([
      'message' => 'new user successfully'
    ]);
    // $validator = $this->validateUser($request);
    // if ($validator->fails()) {
    //   return response()->json(400);
    // } else {
    //   if ($request->profile) {
    //     $img_name = $this->userInterface->moveImg($request->profile);
    //     if (!$img_name) {
    //       return response()->json(['error_msg' => 'File Upload Failed。'], 302);
    //     }
    //     $request->profile = $img_name;
    //     $userInfo = $this->userInfo($request);
    //     $user = $this->userInterface->createUser($userInfo);
    //   } else {
    //     return response()->json(['error_msg' => 'Image Size Too Large']);
    //   }
    //   return Response::json($userInfo, 200);
    // }
  }

  public function getProfileData()
  {
    $user = $this->userInterface->getProfileData();
    return response()->json($user, 200);
  }

  /**
   * Get user by id
   * @param $id
   * @return object
   */
  public function getUserById($id)
  {
    $user = $this->userInterface->getUserById($id);
    return $user;
  }

  /**
   * Validate User.
   * @param Request $request
   * @return Obj
   */
  private function validateUser(Request $request)
  {
    return $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required',
      'password' => 'required',
      'role' => 'required'
    ]);
  }

  /**
   * User info
   * @param Request $request
   * @return void
   */
  private function userInfo($request)
  {
    $userObj = new \stdClass();
    $userObj->name = trim($request->name);
    $userObj->email = trim($request->email);
    $userObj->password = trim($request->password);
    $userObj->role = trim($request->role);
    $userObj->dob = trim($request->dob);
    $userObj->address = trim($request->address);
    $userObj->phone = trim($request->phone);
    $userObj->profile = trim($request->profile);
    return $userObj;
  }

  /**
   * update user data.
   * @param $request, $id
   * @return Object
   */
  public function updateUser(Request $request, int $id) {
    $this->userInterface->updateUser($request, $id);
    return response()->json([
      'message' => 'updated'
    ]);
  }

  public function deleteUser($id) {
    $this->userInterface->deleteUser($id);
    return response()->json([
      'message' => 'deleted successfully'
    ]);
  }
}
