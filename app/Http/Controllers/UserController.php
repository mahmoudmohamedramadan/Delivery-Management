<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
  public function editProfileForm()
  {
    $editProfileSection = view('project.settings.edit_profile')->renderSections();
    return response()->json([
      'status' => true,
      'editProfileSection' => $editProfileSection['editProfileSection']
    ]);
  }

  public function update(User $user)
  {
    $user->update([
      'name' => request()->name,
      'email' => request()->email,
      'phone' => request()->phone
    ]);
    $user->addMedia(request()->avatar)
      ->toMediaCollection('avatar');
    return response()->json([
      'status' => true
    ]);
  }

  public function notify()
  {
    auth()->user()
      ->notify(new \App\Notifications\UserNotification(auth()->user()->name));
  }
}
