<?php

namespace App\Util;

class Helper
{
    public static function curlWrapper($url, $method, $body): array
    {
        $curl = curl_init();

        $OPTIONS = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];
        switch ($method){
            case 'DELETE':
            case 'GET':
                // Concatenating provided query parameters
                if(!empty($body)){
                    if(str_contains($OPTIONS[CURLOPT_URL], '?')) $OPTIONS[CURLOPT_URL] .= '&';
                    else $OPTIONS[CURLOPT_URL] .= '?';
                    foreach ($body as $key=>$param){
                        $OPTIONS[CURLOPT_URL] .= $key . "=" . $param . '&';
                    }
                }
                break;
            case 'POST':
                $OPTIONS[CURLOPT_POSTFIELDS] = json_encode($body);
                $OPTIONS[CURLOPT_HTTPHEADER][] = "Content-Type: application/json";
                break;
//            case 'PUT':
//                break;
        }

        curl_setopt_array($curl, $OPTIONS);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response ?? [], true);
    }
}
