<?php

namespace App\Contracts\Services\User;


/**
 * Interface for user service
 */
interface UserServiceInterface
{
  /**
   * To get profile data
   * @return Object $profile data.
   */
  public function getProfileData();

  /**
   * To get all user data.
   * @return Object $user data.
   */
  public function getAllUserList();

  /**
   * Create user.
   * @param $userInfo
   * @return Object $user data.
   */
  public function createUser($userInfo);

}
