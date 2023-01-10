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
