<?php

namespace App\Contracts\Dao\User;


/**
 * Interface for Data Accessing Object of User
 */
interface UserDaoInterface
{
  /**
   * get profile data.
   * @return Object $user user object
   */
  public function getProfileData();

  /**
   * get all user data.
   * @return Object $user User Object
   */
  public function getAllUserList();

  /**
   * create user data.
   * @return Object $user User Object
   */
  public function createUser($userData);
}
