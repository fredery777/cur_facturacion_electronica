<?php

class HTTPRequester {
    /**
     * @description Make HTTP-GET call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPGet($url, array $params) {
        $query = http_build_query($params); 
        $ch    = curl_init($url.'?'.$query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    /**
     * @description Make HTTP-POST call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
   
    public static function HTTPPost($url, array $params,$token='',$json=false,$host='') {
        $query = ($json)?json_encode($params):http_build_query($params); // Encode the data array into a JSON string
       
        if($json)
        {
            $headers[] = 'Accept: application/json';
            $headers[] = 'Content-Type: application/json';
        }
        $headers[] = 'Accept-Encoding: gzip, deflate';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Connection: keep-alive';
        if(!empty($token))
        {
             $headers[] = 'Authorization: Bearer ' . $token;
        }
        if(!empty($host))
        {
            $headers[] = 'Host: '.$host; 
        }
         
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $query,
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err) 
        {
            $arr_error=array();
            $arr_error['errors']=$err;
            return json_encode($arr_error);
        } 
        
       return $response;
    }
    
    
    /**
     * @description Make HTTP-PUT call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPPut($url, array $params) {
        $query = \http_build_query($params);
        $ch    = \curl_init();
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_HEADER, false);
        \curl_setopt($ch, \CURLOPT_URL, $url);
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'PUT');
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $query);
        $response = \curl_exec($ch);
        \curl_close($ch);
        return $response;
    }
    /**
     * @category Make HTTP-DELETE call
     * @param    $url
     * @param    array $params
     * @return   HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPDelete($url, array $params) {
        $query = \http_build_query($params);
        $ch    = \curl_init();
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_HEADER, false);
        \curl_setopt($ch, \CURLOPT_URL, $url);
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'DELETE');
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $query);
        $response = \curl_exec($ch);
        \curl_close($ch);
        return $response;
    }
}
?>
