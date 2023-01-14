<?php
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\getClientOriginalName;

class Helper{

    public static function imgProcess($image, $name, $owner, $id, $directory, $method, $model=null)
    {
            $image_path = public_path().'/'.$directory;

            $pic_owner = $owner != ''?strtolower(str_replace(' ','-', $owner)).'-':'img-';

            if($method == 'store'){

                if($image->hasFile($name)){


                    $imageArr = [];
                    if(is_array($image->file($name))){

                        foreach ($images = $image->file($name) as $key => $img) {

                           if(!empty($img)){

                            $extension = $img->getClientOriginalExtension();
                            // $fileName = $image->getClientOriginalName();
                            $fileName    = $pic_owner.$key.date('d-m-Y').'-'.time().'.'.$extension;
                            $img->move($image_path, $fileName);

                           }


                            $imageArr[$key][$name] = $fileName;
                        }

                        return $imageArr;

                    } else {

                        $image = $image->$name;
                        $extension = $image->getClientOriginalExtension();
                        // $fileName = $image->getClientOriginalName();
                        $fileName    = $pic_owner.date('d-m-Y').'-'.time().'.'.$extension;
                        $image->move($image_path, $fileName);

                    }

                } else {

                    $fileName = null;

                }

                return $fileName;

            } elseif($method == 'update') {

                $getImage = $model::find($id)[$name];

                if($image->hasFile($name)){

                    $imageArr = [];
                    if(is_array($image->file($name)) && !empty($image->file($name))){

                        foreach ($images = $image->file($name) as $key => $img) {

                           if(!empty($img)){

                            $extension = $img->getClientOriginalExtension();
                            // $fileName = $image->getClientOriginalName();
                            $fileName    = $pic_owner.$key.date('d-m-Y').'-'.time().'.'.$extension;
                            $img->move($image_path, $fileName);

                           }

                            $imageArr[$key][$name] = $fileName;
                        }

                        return $imageArr;

                    } else {

                        if($getImage){

                            if(file_exists($image_path.'/'.$getImage)){

                                unlink($image_path.'/'.$getImage);

                            }



                        }

                       $image       = $image->$name;
                       $extension   = $image->getClientOriginalExtension();
                       // $fileName = $image->getClientOriginalName();
                       $fileName    = $pic_owner.date('d-m-Y').'-'.time().'.'.$extension;
                       $image->move($image_path, $fileName);

                    }


                } else {

                   $fileName = $getImage;

                }

                return $fileName;
            }

    }

    public static function imgProcessNameOrigin($image, $name, $owner, $id, $directory, $method, $model=null)
    {
            $image_path = public_path().'/'.$directory;

            $pic_owner = $owner != ''?strtolower(str_replace(' ','-', $owner)).'-':'img-';

            if($method == 'store'){

                if($image->hasFile($name)){

                   
                    $imageArr = [];
                    if(is_array($image->file($name))){

                        foreach ($images = $image->file($name) as $key => $img) {

                           if(!empty($img)){

                            // $extension = $img->getClientOriginalExtension();
                            
                            $fileName = $img->getClientOriginalName();
                            // $fileName    = $pic_owner.$key.date('d-m-Y').'-'.time().'.'.$extension;
                            $img->move($image_path, $fileName); 

                           }
  

                            $imageArr[$key][$name] = $fileName; 
                        }  

                        return $imageArr;

                    } else {

                        $image = $image->$name;
                        // $extension = $image->getClientOriginalExtension();
                        $fileName =$image->file($name)->getClientOriginalName();
                        // $fileName    = $pic_owner.date('d-m-Y').'-'.time().'.'.$extension;
                        $image->move($image_path, $fileName);  

                    }

                } else {

                    $fileName = null;

                }

                return $fileName;

            } elseif($method == 'update') {

                $getImage = $model::find($id)[$name];

                if($image->hasFile($name)){
                
                    $imageArr = [];
                    if(is_array($image->file($name)) && !empty($image->file($name))){

                        foreach ($images = $image->file($name) as $key => $img) {

                           if(!empty($img)){

                            // $extension = $img->getClientOriginalExtension();
                            $fileName = $img->getClientOriginalName();
                            // $fileName    = $pic_owner.$key.date('d-m-Y').'-'.time().'.'.$extension;
                            $img->move($image_path, $fileName); 

                           }

                            $imageArr[$key][$name] = $fileName; 
                        }  

                        return $imageArr;

                    } else {
                        
                        if($getImage){
                            
                            if(file_exists($image_path.'/'.$getImage)){

                                unlink($image_path.'/'.$getImage);

                            }

                            
                            
                        } 
       
                       $image       = $image->$name;
                    //    $extension   = $image->getClientOriginalExtension();
                       $fileName =$image->file($name)->getClientOriginalName();
                    //    $fileName    = $pic_owner.date('d-m-Y').'-'.time().'.'.$extension;
                       $image->move($image_path, $fileName);

                    }
                

                } else {

                   $fileName = $getImage;     

                }

                return $fileName;
            }      
        
    }

    public static function publicUrl($param){
        return url('public/'.$param);
    }

    //SMS SEND
    public static function sendSMS($userphone, $message){
        $curl = curl_init('http://pisms.doeltechbd.com/api-sendsms?user=nbyit&password=123##123##&campaign=SAMPLE&number='. $userphone .'&text='.$message);


        // 'http://sms.naxhost.com/smsapi?api_key=C20064265ef950caef9914.66557842&type=text&contacts='. $userphone .'&senderid=8809601000198&msg='. $message

        curl_setopt( $curl, CURLOPT_POST, true );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec( $curl );
        curl_close( $curl );
    }

    public static function autoOtp() {
        $limit = 6;
        return rand(pow(10, $limit-1), pow(10, $limit)-1);
    }


// ZOOM FUCNTIONALITY START
    //FOR ZOOM
    public static function dateYMD($date){
        $date=date_create($date);
        return $date = date_format($date,"Y-m-d");
    }

    //Validation Error
    public static function vError($validator) {
        $output = array();
        $output['messege'] = implode($validator->messages()->all('<i class="glyphicon glyphicon-ban-circle alert-icon validationErrIcon"></i><strong>:message</strong><br>'), '');
        $output['msgType'] = 'validationError';
        return $output;
    }

    //FOR LIVE CLASS
    public static function numberShow($length){
        $number = [];
        for ($i=1; $i <= $length; $i++) {
            $number[] +=$i;
        }
        return $number;
    }

    //FOR ZOOM INTEGRATION (CREATE / UPDATE)
    public static function zoomIntegrationFunction($curl_url, $curl_method, $postFields, $token) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $curl_method,
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
            "authorization: Bearer".$token,
            "content-type: application/json"
            ),
        ));

        $response   = curl_exec($curl);
        $err        = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $output['messege'] = $err;
            $output['msgType'] = 'error';
            $output['msgStatus'] = 0;
        } else {
            $output['info'] = json_decode($response);
            $output['msgStatus'] = 1;
        }

        return $output;
    }
    //END FOR ZOOM INTEGRATION (CREATE / UPDATE)

    //TIME CALCULATION
    public static function time($time) {
        $get_hour = substr($time, 0, 2);
        $get_time_format = substr($time, -2);

        $get_min = substr($time, -5);
        $real_min = substr($get_min, 0, 2);

        $real_hour = '';
        switch(TRUE)
        {
           case ($get_hour=='12'&&$get_time_format=='AM'):
           $real_hour = "18";
           break;

           case ($get_hour=='1:'&&$get_time_format=='AM'):
           $real_hour = "19";
           break;

           case ($get_hour=='2:'&&$get_time_format=='AM'):
           $real_hour = "20";
           break;

           case ($get_hour=='3:'&&$get_time_format=='AM'):
           $real_hour = "21";
           break;

           case ($get_hour=='4:'&&$get_time_format=='AM'):
           $real_hour = "22";
           break;

           case ($get_hour=='5:'&&$get_time_format=='AM'):
           $real_hour = "23";
           break;

           case ($get_hour=='6:'&&$get_time_format=='AM'):
           $real_hour = "00";
           break;

           case ($get_hour=='7:'&&$get_time_format=='AM'):
           $real_hour = "01";
           break;

           case ($get_hour=='8:'&&$get_time_format=='AM'):
           $real_hour = "02";
           break;

           case ($get_hour=='9:'&&$get_time_format=='AM'):
           $real_hour = "03";
           break;

           case ($get_hour=='10'&&$get_time_format=='AM'):
           $real_hour = "04";
           break;

           case ($get_hour=='11'&&$get_time_format=='AM'):
           $real_hour = "05";
           break;

           case ($get_hour=='12'&&$get_time_format=='PM'):
           $real_hour = "06";
           break;

           case ($get_hour=='1:'&&$get_time_format=='PM'):
           $real_hour = "07";
           break;

           case ($get_hour=='2:'&&$get_time_format=='PM'):
           $real_hour = "08";
           break;

           case ($get_hour=='3:'&&$get_time_format=='PM'):
           $real_hour = "09";
           break;

           case ($get_hour=='4:'&&$get_time_format=='PM'):
           $real_hour = "10";
           break;

           case ($get_hour=='5:'&&$get_time_format=='PM'):
           $real_hour = "11";
           break;

           case ($get_hour=='6:'&&$get_time_format=='PM'):
           $real_hour = "12";
           break;

           case ($get_hour=='7:'&&$get_time_format=='PM'):
           $real_hour = "13";
           break;

           case ($get_hour=='8:'&&$get_time_format=='PM'):
           $real_hour = "14";
           break;

           case ($get_hour=='9:'&&$get_time_format=='PM'):
           $real_hour = "15";
           break;

           case ($get_hour=='10'&&$get_time_format=='PM'):
           $real_hour = "16";
           break;

           case ($get_hour=='11'&&$get_time_format=='PM'):
           $real_hour = "17";
           break;

           default:
           $real_hour = "00";
           break;

        }

        return $time = $real_hour.':'.$real_min.':00';
    }

    //ZOOM DATA GET/DELETE
    public static function zoomGetDelete($token, $curl_method, $meeting_id) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/meetings/". $meeting_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $curl_method,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer".$token,
                "content-type: application/json"
            ),
        ));

        $response   = curl_exec($curl);
        $err        = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $output['messege'] = $err;
            $output['msgType'] = 'error';
            $output['msgStatus'] = 0;
        } else {
            $output['info'] = json_decode($response);
            $output['msgStatus'] = 11;
            $output['messege'] = '';
        }

        return $output;
    }


    //START NEXT DATE
    public static function nextDate($date, $day) {
        $date = new DateTime($date);
        $date->add(new DateInterval('P'.$day.'D'));
        $nextDate = $date->format('Y-m-d');

        return $nextDate;
    }
    //END NEXT DATE

    //START DATE DIFFERENCE
    public static function dateDiff($startDate, $endDate) {
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);
        $dateDiff = $startDate->diff($endDate);

        return $days = $dateDiff->format('%a');
    }
    //END DATE DIFFERENCE


    //DAYS DATES
    public static function nextAllDays($startDate, $endDate, $every){
        $days = self::dateDiff($startDate, $endDate);
        $newDates[] = $startDate;
        $day = $every;
        $totalDays = explode('.', $days/$every);
        $totalDays = $totalDays[0];

        for($i=0; $i<$totalDays; $i++) {
            $Ndate = self::nextDate($startDate, $day);
            $startDate = $Ndate;
            $newDates[] = $Ndate;
        }

        return $newDates;
    }
    //END DAYS DATES


}
