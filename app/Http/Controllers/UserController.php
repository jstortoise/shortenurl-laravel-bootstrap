<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function register() {
      if ($this->existUser($_REQUEST['email'])) {
        return $_REQUEST['email'] . " already exists";
      }
      $user = new User;
      $user->name = $_REQUEST['name'];
      $user->email = $_REQUEST['email'];
      $user->password = $_REQUEST['password'];
      $user->save();
      return redirect('/');
    }

    function login() {
      if (isset($_REQUEST['email'])) {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        if ($this->existUser($email)) {
          if ($this->confirmUser($email, $password)) {
            return redirect('/');
          } else {
            return view('login', ['msg' => "Password is incorrect"]);
          }
        }
        return view('login', ['msg' => "Email($email) doesn't exist"]);
      }
      return view('login');
    }

    function logout() {
      $this->clearSession();
      return redirect('/');
    }

    function clearSession() {
      session()->forget('email');
      session()->flush();
    }

    function existUser($email, $password = null) {
      $user = User::where('email', $email)->first();
      if (empty($user)) {
        return false;
      } else {
        return true;
      }
    }

    function confirmUser($email, $password = null) {
      $user = User::where('email', $email)->where('password', $password)->first();
      if (empty($user)) {
        return false;
      } else {
        session()->put('email', $user['email']);
        return true;
      }
    }
}
