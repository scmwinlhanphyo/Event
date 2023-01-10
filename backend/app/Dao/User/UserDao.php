<?php

namespace App\Dao\User;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Operator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserPasswordRequest;
use App\Contracts\Dao\User\UserDaoInterface;

/**
 * Data accessing object for user
 */
class UserDao implements UserDaoInterface
{
  /**
   * To get profile data by id
   * @return Object $user user object
   */
  public function getProfileData()
  {
    return DB::transaction(function () {
      $user = User::find(Auth::id());
      return $user;
    });
  }

  /**
   * To get user list.
   * @return array $user list.
   */
  public function getAllUserList()
  {
    return DB::transaction(function () {
      if (request()->query('search')) {
        $users = User::where(
          "name",
          'LIKE',
          '%' . request()->query('search') . '%'
        )->paginate(config('constant.pagination_count'));
      } else {
        $users = User::paginate(config('constant.pagination_count'));
      }
      return $users;
    });
  }

  /**
   * Create user
   *
   * @param $userData
   * @return void
   */
  public function createUser($userData)
  {
    return User::create($userData);
  }
}
