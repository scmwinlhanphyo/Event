<?php

namespace App\Dao\User;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Operator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserPasswordRequest;
use App\Contracts\Dao\User\UserDaoInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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
   * Get user by id
   * 
   * @param $id
   * @return Object
   */
  public function getUserById($id) 
  {
    return User::find($id);
  }

  /**
   * Create user
   *
   * @param $userData
   * @return Object
   */
  public function createUser($userInfo)
  {
    $userData = [
      'name' => $userInfo->name,
      'email' => $userInfo->email,
      'password' => Hash::make($userInfo->password),
      'role' => $userInfo->role,
      'dob' => $userInfo->dob,
      'address' => $userInfo->address,
      'phone' => $userInfo->phone,
      'created_at' => now(),
    ];

    $user = User::create($userData);
    
    if($userInfo->profile) {
      $folder = 'users/';
      $base64Image = explode(";base64,", $userInfo->profile);
      $explodeImage = explode("image/", $base64Image[0]);
      $ext = $explodeImage[1];
      $image_base64 = base64_decode($base64Image[1]);
      $file = $folder. $user->id . '.' . $ext;
      $profile_name = $user->id . '.' . $ext; 
      file_put_contents($file, $image_base64);
      $user->profile = $profile_name;
      $user->save();
    }

    return $user;
  }

  /**
   * Update user
   * 
   * @param $userData, $id
   * @return object
   */
  public function updateUser($userData, $id) 
  {
    return User::find($id)->update($userData);
  }

  public function deleteUser($id) 
  {
    return User::find($id)->delete();
  }
}
