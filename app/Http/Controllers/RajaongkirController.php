<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\UserAddress;

class RajaongkirController extends Controller
{
    function getProvince()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: be8051d1c8e9df2c466bc25b04a32fec"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $result = "";
        $result .= "<option></option>";
        for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
            $result .= "<option value='" . $data['rajaongkir']['results'][$i]['province_id'] . "'>" . $data['rajaongkir']['results'][$i]['province'] . "</option>";
        }
        return $result;
    }

    function getCity(Request $req)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=" . $req->province,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: be8051d1c8e9df2c466bc25b04a32fec"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $result = "<option></option>";
        for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
            $result .= "<option value='" . $data['rajaongkir']['results'][$i]['city_id'] . "'>" . $data['rajaongkir']['results'][$i]['city_name'] . "</option>";
        }
        return $result;
    }

    function getProvinceName($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: be8051d1c8e9df2c466bc25b04a32fec"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        return $data['rajaongkir']['results']['province'];
    }

    function getCityName($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: be8051d1c8e9df2c466bc25b04a32fec"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        return $data['rajaongkir']['results']['city_name'];
    }

    function getFee(Request $request)
    {
        $cart = Cart::find($request->cart_id);

        $origin = $cart->store->city_code;
        $destination = UserAddress::find($request->address_id)->city_code;
        
        $totalweight = 0;
        
        $cart_items = $cart->cart_item;
        foreach ($cart_items as $item) {
            $totalweight += $item->qty * $item->product_variant->weight;
        }

        $courier = $request->courier;

        $weight = $totalweight;
        $courier = $request->courier;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: be8051d1c8e9df2c466bc25b04a32fec"
            ),
        ));
        //  CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir."",

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        // var_dump($data);        
        return view('partials.courier-price', compact('data'));
    }
}
