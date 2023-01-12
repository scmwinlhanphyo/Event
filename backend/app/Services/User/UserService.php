<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
    return $this->userDao->createUser($userInfo);
  }

  /**
   * Update user
   * @param $request, $id
   * @return Object $user
   */
  public function updateUser($userInfo, $id) 
  {
    $userData = [
      'name' => $userInfo->name,
      'email' => $userInfo->email,
      'password' => Hash::make($userInfo->password),
      'role' => $userInfo->role,
      'dob' => $userInfo->dob,
      'address' => $userInfo->address,
      'phone' => $userInfo->phone,
    ];
    
    if($userInfo->profile) {
      $folder = 'users/';
      $base64Image = explode(";base64,", $userInfo->profile);
      $explodeImage = explode("image/", $base64Image[0]);
      $ext = $explodeImage[1];
      $image_base64 = base64_decode($base64Image[1]);
      $file = $folder. $id . '.' . $ext;
      $profile_name = $id . '.' . $ext; 
      file_put_contents($file, $image_base64);
      $userData['profile'] = $profile_name;
    }

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
