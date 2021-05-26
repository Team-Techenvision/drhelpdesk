<?php

namespace App;

class Notification
{
   
   private $apikey;
   private $apiUrl;
   private $registrationId;
   
   public function __construct() 
   {
   		 $this->apikey = "AAAAdtdhcXs:APA91bFAZveKVNbiUCgnkFb1zEFIfnAAFpmz_1cqkwiz9FBImOkHI7aKAHhvG9yIW-ovtbWvmhSfCejOpTMWJ9-CSJ4wM2zCoFCmWOjPnb3n5KTiYXqLx2Dp45ztWv8kr0XgBFqtorbC";
   		 $this->apiUrl = "https://fcm.googleapis.com/fcm/send";
   		 $this->registrationId = "e__NLJr91n4:APA91bElRtrhQqY6KPmu1dRwXcil6TXOczFOtcLBeYaoA4gLDIMb4Nc-RvJBNBhw0rjRIfAiY_YW_MrkKzFHrVsljoH-jikYWPwEE8K38-v-IBvTsQb0Urk0YcP1wdDygSEb0PUc0g5I";
   }
	

	private function getMessageDetail($title, $message, $contentType, $image)
    {
    	$contentTitle= html_entity_decode(stripslashes($title),ENT_QUOTES);
        $messageContent= html_entity_decode(stripslashes(str_replace(['<p>','</p>'],['',''],$message)),ENT_QUOTES);
    	//dd($messageContent);
    	$msg = array
		(
              'body'  => $messageContent,
              'title' => $contentTitle,
        	  'sound' => "default",
        	  'image' => $image
              //'type' => 1
        );
    	
    	return $msg;
    }
	
	private function callCurl($msg, $regId, $device_type)
    {
    	 
    	 if($device_type=='1') {
         	 $fields = array(
               'to' => $regId,
               'notification' => $msg,
            );
         } else {
         	$fields = array(
                'to' => $regId,
                'notification' => $msg
            );
         }
        
		$headers = array
		(
    		'Authorization:key=' . $this->apikey,
    		'Content-Type: application/json'
		);
    	//dd(json_encode( $fields ));
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $this->apiUrl);
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        
        $error_msg = '';
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close( $ch );
    	if(!empty($error_msg) ){
            
            return $error_msg;
        } else {
        	 
            return $result;
        }
	}

	public function sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image=null)
    {
        $msg = $this->getMessageDetail($title, $message, $contentType, $image);
        $result = $this->callCurl($msg, $regId, $device_type);
    
    	return $result;
    }

} 