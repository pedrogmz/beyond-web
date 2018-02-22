<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Itemshop extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.paypal');
    }

    public function epay($country) {
        header ('Content-Type: application/json');
        $query = '?uid=159&mid=302&apikey=5XADJM8POZBFEKQB&cc=' . $country;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.e-payouts.com/getData.php" . $query);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        if ($result) {
            echo $result;
        }
    }
}
