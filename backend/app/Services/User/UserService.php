<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use File;
use Illuminate\Support\Str;

/**
 * Service class for user.
 */
class UserService implements UserServiceInterface
{
  /**
   * user dao
   */
  private $userDao;
  /**
   * Class Constructor
   * @param UserDaoInterface
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * To get profile data by id
   * @return Object $profile data.
   */
  public function getProfileData()
  {
    $profile = $this->userDao->getProfileData();
    return $profile;
  }

  /**
   * get all user data.
   * @return Object $user User Object
   */
  public function getAllUserList()
  {
    $user = $this->userDao->getAllUserList();
    return $user;
  }

  /**
   * get user by id.
   * @param $id
   * @return Object $userData
   */
  public function getUserById($id)
  {
    $user = $this->userDao->getUserById($id);
    return $user;
  }

  /**
   * Create user
   * @param $userInfo
   * @return void
   */
  public function createUser($userInfo)
  {
    $userData = [
      'name' => $userInfo->name,
      'email' => $userInfo->email,
      'password' => $userInfo->password,
      'role' => $userInfo->role,
      'dob' => $userInfo->dob,
      'address' => $userInfo->address,
      'phone' => $userInfo->phone,
      'profile' => $userInfo->profile,
      'created_at' => now(),
    ];
    return $this->userDao->createUser($userData);
  }

  /**
   * Update user
   * @param $request, $id
   * @return Object $user
   */
  public function updateUser($userData, $id) 
  {
    $userData = [
      'name' => $userData->name,
      'email' => $userData->email,
      'password' => $userData->password,
      'role' => $userData->role,
      'dob' => $userData->dob,
      'address' => $userData->address,
      'phone' => $userData->phone,
      'profile' => $userData->profile,
    ];
    return $this->userDao->updateUser($userData, $id);
  }

  /**
   * Delete user data.
   * @param $id
   * @return void
   */
  public function deleteUser($id) {
    return $this->userDao->deleteUser($id);
  }

  /**
   * Move Image Files to Temp Folder
   *
   * @param $photo
   * @return void
   */
  public function moveImg($photo)
  {
    $IMAGE_FOLDER_PATH = config('constants.USER_IMG_ROUTE');
    if (!\File::exists($IMAGE_FOLDER_PATH)) {
      \File::makeDirectory($IMAGE_FOLDER_PATH, 0777, true, true);
    }

    $fileType = substr($photo, 11, 4);
    if ($fileType == "jpeg") {
      $imageData = str_replace('data:image/jpeg;base64,', '', $photo);
      $imageData = str_replace(' ', '+', $imageData);
      $file_name = Str::random(6) . "." . $fileType;
      \File::put($IMAGE_FOLDER_PATH . '/' . $file_name, base64_decode($imageData));
    }
    if ($fileType == "png;") {
      $imageData = str_replace('data:image/png;base64,', '', $photo);
      $imageData = str_replace(' ', '+', $imageData);
      $file_name = Str::random(6) . "." . $fileType;
      \File::put($IMAGE_FOLDER_PATH . '/' . $file_name, base64_decode($imageData));
    }
    return $file_name;
  }
}
