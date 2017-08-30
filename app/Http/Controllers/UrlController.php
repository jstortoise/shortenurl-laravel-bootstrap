<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Shorten;

class UrlController extends Controller
{
    protected static $chars = "123456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";
    protected static $checkUrlExists = true;

    protected $timestamp;

    public function __construct() {
        $this->timestamp = $_SERVER["REQUEST_TIME"];
    }

    public function urlList() {
      if (session()->exists('email')) {
        $email = session()->get('email');
        $urls = Shorten::where('email', $email)->get();
        return view('list', ['urls' => $urls]);
      }
      return redirect('/');
    }

    public function getFullUrl($short_code) {
        $result = Shorten::where('short_code', $short_code)->first();
        if (empty($result)) {
          return 'Not Page Found';
        } else {
          return Redirect::to($result["long_url"]);
        }
    }

    public function urlToShortCode() {
        $url = $_REQUEST["url"];
        if (empty($url)) {
            throw new Exception("No URL was supplied.");
        }

        if ($this->validateUrlFormat($url) == false) {
            throw new Exception(
                "URL does not have a valid format.");
        }

        if (self::$checkUrlExists) {
            if (!$this->verifyUrlExists($url)) {
                throw new Exception(
                    "URL does not appear to exist.");
            }
        }

        $shortCode = $this->urlExistsInDb($url);
        if ($shortCode == false) {
            $shortCode = $this->createShortCode($url);
        }

        return $shortCode;
    }

    protected function validateUrlFormat($url) {
        return filter_var($url, FILTER_VALIDATE_URL,
            FILTER_FLAG_HOST_REQUIRED);
    }

    protected function verifyUrlExists($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (!empty($response) && $response != 404);
    }

    protected function urlExistsInDb($url) {
        $result = Shorten::where('long_url', $url)->first();
        if (empty($result)) {
          return false;
        } else {
          return $result["short_code"];
        }
    }

    protected function createShortCode($url) {
        $id = $this->insertUrlInDb($url);
        $shortCode = $this->convertIntToShortCode($id);
        $this->insertShortCodeInDb($id, $shortCode);
        return $shortCode;
    }

    protected function insertUrlInDb($url) {
        $shorten = new Shorten;
        $shorten->long_url = $url;
        if (session()->has('email')) {
          $email = session()->get('email');
          $shorten->email = $email;
        }
        $shorten->save();
        return $shorten->id;
    }

    protected function convertIntToShortCode($id) {
        $id = intval($id);
        if ($id < 1) {
            throw new Exception(
                "The ID is not a valid integer");
        }

        $length = strlen(self::$chars);
        // make sure length of available characters is at
        // least a reasonable minimum - there should be at
        // least 10 characters
        if ($length < 10) {
            throw new Exception("Length of chars is too small");
        }

        $code = "";
        while ($id > $length - 1) {
            // determine the value of the next higher character
            // in the short code should be and prepend
            $code = self::$chars[fmod($id, $length)] .
                $code;
            // reset $id to remaining value to be converted
            $id = floor($id / $length);
        }

        // remaining value of $id is less than the length of
        // self::$chars
        $code = self::$chars[$id] . $code;

        return $code;
    }

    protected function insertShortCodeInDb($id, $code) {
        if ($id == null || $code == null) {
            throw new Exception("Input parameter(s) invalid.");
        }
        $shorten = Shorten::find($id);
        $shorten->short_code = $code;
        $shorten->save();
        return true;
    }
}
