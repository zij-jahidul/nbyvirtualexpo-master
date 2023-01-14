<?php

namespace App\Http\Controllers\API\Backend\Webinar;

use Helper;
use App\Models\Day\Day;
use Illuminate\Http\Request;
use App\Models\Webinar\Webinar;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Backend\Webinar\WebinarResource;

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?Webinar::orderBy('id', 'desc')->paginate($dataSorting):Webinar::where(function($query) use($search){
            $query->orWhere('meeting_id', 'LIKE', "%{$search}%")
            ->orWhere('topic', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('start_date', 'LIKE', "%{$search}%")
            ->orWhere('end_date', 'LIKE', "%{$search}%")
            ->orWhere('start_time', 'LIKE', "%{$search}%")
            ->orWhere('end_time', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $days = Day::all();
        $reNumbers = Helper::numberShow(15);
        $monthlyDaysNumbers = Helper::numberShow(30);
        
       
        return WebinarResource::collection($data)->additional(['days'=>$days, 'reNumbers'=>$reNumbers,'monthlyDaysNumbers'=>$monthlyDaysNumbers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        
        // DB::beginTransaction();
        $output = array();
        $assign_class_id = 1;
        $class_id = $request->class_id;
        $select_schedule = $request->select_schedule;
        $start_date =  Helper::dateYMD($request->start_date);
        $end_date =  Helper::dateYMD($request->end_date);
        $start_time = $request->start_time;
        $corporate_id = Auth::user()->id;

        $zoom_acc_type = $request->zoom_acc_type; //1=indivisual, 2=common

        $email = 'mehedi.uiu@gmail.com';
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6InBqRXZrOFVQUlgtUms2VkJOdUxtOWciLCJleHAiOjE2NzA3ODcwMDAsImlhdCI6MTYxMzUwNDQzMn0.cmaaJNqrAj6oOiM1zcwtm0A--jJ6NhDs4MM0mJXa540';

        $duration_hours = $request->d_hour;
        $duration_minutes = $request->d_min;
        $duration_of_sec = (int)$request->d_hour*60*60+(int)$request->d_min*60; // Calculate by seconds
        $duration_of_min = (int)$request->d_hour*60+(int)$request->d_min; // Calculate by seconds
        $end_time = strftime('%X', strtotime($start_time) + $duration_of_sec);

        //TIME CALCULATION
        $get_hour = substr($start_time, 0, 2);
        $get_time_format = substr($start_time, -2);

        $real_hour = Helper::time($get_hour,$get_time_format);
        
        $get_min = substr($start_time, -5);
        $real_min = substr($get_min, 0, 2);
                    
        $time = $real_hour.':'.$real_min.':00';

        $output['assign_class_id'] = $assign_class_id;
        //END TIME CALCULATION

        $validator = Validator::make($request->all(), [
            'select_schedule'           => 'required',
            'start_date'                => 'required',
            'start_time'                => 'required',
            'd_hour'                    => 'required|numeric',
            // 'd_min'                     => 'required|numeric'
        ]);

        if ($validator->passes()) {
            $data = [
                'select_schedule'       => $select_schedule, // 0=Single Class, 1=Recurring Class
                'start_time'            => strftime('%X', strtotime($request->start_time)),
                'duration_hours'        => $duration_hours,
                'duration_minutes'      => $duration_minutes,
                'end_time'              => $end_time
            ];

            //FOR ZOOM SCHEDULE CREATE/UPDATE INFO---
            $liveClassData = array(
                'topic'                  => $request->topic,
                'agenda'                 => $request->description,
                'start_time'             => $start_date."T".Helper::time($start_time)."Z",
                'duration'               => $duration_of_min,
                'timezone'               => 'Asia/Dhaka',
                // 'password'               => 12345678,
                'settings'               => array(
                    'join_before_host'       => false, 
                    'mute_upon_entry'        => false, 
                    'waiting_room'           => true, 
                    'meeting_authentication' => false
                ),
                
            );

            //ZOOM INFO
            $curl_url = "https://api.zoom.us/v2/users/".$email."/meetings";
            $curl_method = "POST";
            $message = "created";
            //END ZOOM SCHEDULE CREATE/UPDATE INFO---

            if ($select_schedule==1) 
            { // 1=Single Class, 2=Recurring Class

                $liveClassData['type'] = 2;
                // $zoomInfo["info"]->code = 0;
                $recurrance = 0;
                $postFields = json_encode($liveClassData);

                $zoomInfo = Helper::zoomIntegrationFunction($curl_url, $curl_method, $postFields, $token);

                if (property_exists($zoomInfo["info"], 'code')) {
                    $msgStatus = 0;
                } else {
                    $msgStatus = 1;
                }                

                if ($msgStatus==1) {
                    $liveClassZoomData = [
                        'schedule_type'     => 1, //1=Single Class
                        'topic'             => $request->topic,
                        'description'       => $request->description,
                        "recurrance"        => 0, //0= Not Recurrance Class
                        "repeat_every"      => 0, //0= Not Recurrance Class
                        'total_meeting'     => 1,
                        'd_hour'            => $request->d_hour,
                        'd_min'             => $request->d_min,
                        'type'              => $zoomInfo['info']->type,
                        'meeting_id'        => $zoomInfo['info']->id,
                        'host_id'           => $zoomInfo['info']->host_id,
                        'start_url'         => $zoomInfo['info']->start_url,
                        'join_url'          => $zoomInfo['info']->join_url,
                        'timezone'          => $zoomInfo['info']->timezone
                    ];
                    
                    //Webinar::insert($liveClassZoomData); //CREATE
                    //END LIVE CLASS ZOOM INFO

                    //START ZOOM LIVE CLASS SCHEDULES

                    array_splice($liveClassZoomData, 0, 1);
                    $liveClassZoomData['schedule_type'] = 1;     
                    $liveClassZoomData['start_date'] = $start_date;     
                    $liveClassZoomData["end_date"] = $start_date; // for single
                    $liveClassZoomData['start_time'] = strftime('%X', strtotime($request->start_time));
                    $liveClassZoomData['end_time'] = $end_time;     
                    $liveClassZoomData['day_dt'] = date('w', strtotime($start_date));
   
                    //CREATE LIVE CLASS SCHEDULE
                    DB::table('webinars')->insert($liveClassZoomData); //CREATE
                    //END LIVE CLASS SCHEDULES

                    //MESSAGE
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Webinar has been created!',
                        'icon'    => 'times',
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'danger',
                        'message' => 'Access token is expired!',
                        'icon'    => 'times',
                    ]);
                }
            }  else  { //2=Recurring Class
                $data['recurrance'] = $recurrance = $request->recurrance;
                $data['repeat_every'] = $repeat_every = $request->r_every;
                // return $recurrance;

                //RECURRANCE CLASSES
                switch ($recurrance) {
                    case 1:
                        //FOR ZOOM
                        $liveClassData_day = array(
                            'type' => '8',
                            'recurrence' => array(
                                "type" => 1,
                                "repeat_interval" => $repeat_every,
                                "end_date_time" => Helper::nextDate($end_date, 1)."T00:00:00Z",
                            ),
                        );

                        //START ZOOM SCHEDULE CREATE/UPDATE
                        $postFields = json_encode(array_merge($liveClassData, $liveClassData_day));
                        //CREATE ZOOM SCHEDULE TO ZOOM PLATFORM
                        $zoomInfo = Helper::zoomIntegrationFunction($curl_url, $curl_method, $postFields, $token);

                        if (property_exists($zoomInfo["info"], 'code')) {
                            $msgStatus = 0;
                        } else {
                            $msgStatus = 1;
                        }

                        if ($msgStatus==1) {
                            $liveClassZoomData = [
                                'total_meeting'     => count($zoomInfo['info']->occurrences),
                                'schedule_type'     => 2, //2=Recurring Class 
                                'topic'             => $request->topic,
                                'description'       => $request->description,
                                'recurrance'        => 1, //1=Daily Class
                                'repeat_every'      => $repeat_every,
                                'type'              => $zoomInfo['info']->type,
                                'meeting_id'        => $zoomInfo['info']->id,
                                'host_id'           => $zoomInfo['info']->host_id,
                                'start_url'         => $zoomInfo['info']->start_url,
                                'join_url'          => $zoomInfo['info']->join_url,
                                'timezone'          => $zoomInfo['info']->timezone
                            ];
                            //CREATE LIVE CLASS ZOOM DATA
                            //Webinar::insert($liveClassZoomData); //CREATE
                            $message = "created";
                            //END SCHEDULE CREATE

                            //START ZOOM LIVE CLASS SCHEDULES (en_classroom_live_class_schedules)
                                //MAKEING ALL SCHEDULE DATE
                                $schedules = $zoomInfo['info']->occurrences;
                                array_splice($liveClassZoomData, 0, 1);
                                //START CREATE CLASSROOM LIVE CLASS SCHEDULES
                                $i = 0;
                                foreach ($schedules as $schedule) {
                                    $r_startDate = $schedules[$i]->start_time;
                                    $recure_date = date('Y-m-d',strtotime($r_startDate));

                                    $liveClassZoomData['start_date'] = $recure_date;
                                    $liveClassZoomData['end_date'] = $end_date;
                                    $liveClassZoomData['start_time'] = strftime('%X', strtotime($request->start_time));
                                    $liveClassZoomData['end_time'] = $end_time;
                                    $liveClassZoomData['day_dt'] = date('w', strtotime($recure_date));


                                    //INSERT DATA
                                    DB::table('webinars')->insert($liveClassZoomData); //CREATE
                                    $i++;
                                }
                                //END CREATE CLASSROOM LIVE CLASS SCHEDULES                         
                            //END ZOOM LIVE CLASS SCHEDULES

                            //MESSAGE
                            return response()->json([
                                'status'  => 'success',
                                'message' => 'Webinar has been created!',
                                'icon'    => 'times',
                            ]);
                        } else {
                            return response()->json([
                                'status'  => 'danger',
                                'message' => 'Access token is expired!',
                                'icon'    => 'times',
                            ]);
                        }
                        break;

                        case 2:
                            //FOR WEEKLY DAY's
                            $w_occurs_on = array();
                            $days = $request->days;
                            for ($i=0; $i <= count($days)-1; $i++) {
                                $w_occurs_on[] = $days[$i]+1;
                            }
                            $w_occurs_on_zoom = implode(",", $w_occurs_on);
                            //END FOR WEEKLY DAY's
    
                            //FOR ZOOM
                            $liveClassData_weekly = array(
                                'type' => '8',
                                'recurrence' => array(
                                    "type" => 2,
                                    "repeat_interval" => $repeat_every,
                                    "end_date_time" => $end_date."T00:00:00Z",
                                    "weekly_days" =>$w_occurs_on_zoom
                                ),
                            );
    
                            //START ZOOM SCHEDULE CREATE/UPDATE
                            $postFields = json_encode(array_merge($liveClassData, $liveClassData_weekly));
                            //CREATE ZOOM SCHEDULE TO ZOOM PLATFORM
                            $zoomInfo = Helper::zoomIntegrationFunction($curl_url, $curl_method, $postFields, $token);
    
                            //END ZOOM SCHEDULES CREATE AND UPDATE
                            if (property_exists($zoomInfo["info"], 'code')) {
                                $msgStatus = 0;
                            } else {
                                $msgStatus = 1;
                            }

    
                            if ($msgStatus==1) {                                
                                //ZOOM LIVE CLASS DETAILS (en_live_class_details)
                                $liveClassZoomData = [
                                    'total_meeting'     => count($zoomInfo['info']->occurrences),
                                    'schedule_type'     => 2, //2=Recurring Class
                                    'topic'             => $request->topic,
                                    'description'       => $request->description,
                                    'recurrance'        => 2, //1=Weekly Class
                                    'repeat_every'      => $repeat_every,
                                    'type'              => $zoomInfo['info']->type,
                                    'meeting_id'        => $zoomInfo['info']->id,
                                    'host_id'           => $zoomInfo['info']->host_id,
                                    'start_url'         => $zoomInfo['info']->start_url,
                                    'join_url'          => $zoomInfo['info']->join_url,
                                    'timezone'          => $zoomInfo['info']->timezone
                                ];

                                //Webinar::insert($liveClassZoomData); //CREATE
    
                                //START ZOOM LIVE CLASS SCHEDULES (en_classroom_live_class_schedules)
                                    //MAKEING ALL SCHEDULE DATE
                                    $schedules = $zoomInfo['info']->occurrences;
                                    array_splice($liveClassZoomData, 0, 1);
                                    //START CREATE CLASSROOM LIVE CLASS SCHEDULES
                                    $i = 0;
                                    foreach ($schedules as $schedule) {
                                        $r_startDate = $schedules[$i]->start_time;
                                        $recure_date = date('Y-m-d',strtotime($r_startDate));
    
                                        $liveClassZoomData['start_date'] = $recure_date;
                                        $liveClassZoomData['end_date'] = $end_date;
                                        $liveClassZoomData['start_time'] = strftime('%X', strtotime($request->start_time));
                                        $liveClassZoomData['end_time'] = $end_time;
                                        $liveClassZoomData['day_dt'] = date('w', strtotime($recure_date));
    
                                        //INSERT DATA
                                        DB::table('webinars')->insert($liveClassZoomData); //CREATE
                                        $i++;
                                    }
                                //END CREATE CLASSROOM LIVE CLASS SCHEDULES
                                //MESSAGE
                                return response()->json([
                                    'status'  => 'success',
                                    'message' => 'Webinar has been created!',
                                    'icon'    => 'times',
                                ]);
                            } else {
                                return response()->json([
                                    'status'  => 'danger',
                                    'message' => 'Access token is expired!',
                                    'icon'    => 'times',
                                ]);
                            }
                            break;

                            case 3:
                                //FOR ZOOM
                                $liveClassData_monthly = array(
                                    'type' => '8',
                                    'recurrence' => array(
                                        "type" => 3,
                                        "repeat_interval" => $repeat_every,
                                        "end_date_time" => $end_date."T00:00:00Z",
                                    ),
                                );
        
                                $data['occurs_on'] = $occurs_on = $request->occurs_on;
        
                                if ($occurs_on==1) {
                                    $data['occurs_on_day'] = $request->occurs_on_day;
                                    $data['occurs_on_week'] = 1;
                                    $data['day_dt'] = 0;
        
                                    //FOR ZOOM                            
                                    $liveClassData_monthly['recurrence']['monthly_day'] = $request->monthly_days_number;
                                    //END ZOOM SCHEDULE
                                } else {
                                    $data['occurs_on_week'] = $request->occurs_on_week;
                                    $data['day_dt'] = $request->occurs_on_day;
                                    $data['occurs_on_day'] = 0;
        
                                    //FOR ZOOM
                                    $liveClassData_monthly['recurrence']['monthly_week'] = $request->occurs_on_week; 
                                    $liveClassData_monthly['recurrence']['monthly_week_day'] = $request->occurs_on_day+1;
                                    //END ZOOM SCHEDULE
                                }
        
                                //ZOOM SCHEDULE CREATE/UPDATE
                                $postFields = json_encode(array_merge($liveClassData, $liveClassData_monthly));
        
                                //CREATE ZOOM SCHEDULE TO ZOOM PLATFORM
                                $zoomInfo = Helper::zoomIntegrationFunction($curl_url, $curl_method, $postFields, $token);
        
                                //END ZOOM SCHEDULES CREATE
                                if (property_exists($zoomInfo["info"], 'code')) {
                                    $msgStatus = 0;
                                } else {
                                    $msgStatus = 1;
                                }
        
                                if ($msgStatus == 1) {
                                    $liveClassZoomData = [
                                        'total_meeting'     => count($zoomInfo['info']->occurrences),
                                        'schedule_type'     => 2, //2=Recurring Class 
                                        'topic'             => $request->topic,
                                        'description'       => $request->description,
                                        'recurrance'        => 3, //1=Monthly Class
                                        'repeat_every'      => $repeat_every,
                                        'type'              => $zoomInfo['info']->type,
                                        'meeting_id'        => $zoomInfo['info']->id,
                                        'host_id'           => $zoomInfo['info']->host_id,
                                        'start_url'         => $zoomInfo['info']->start_url,
                                        'join_url'          => $zoomInfo['info']->join_url,
                                        'timezone'          => $zoomInfo['info']->timezone
                                    ];
        
                                    //CREATE LIVE CLASS ZOOM DATA
                                    //Webinar::insert($liveClassZoomData); //CREATE
                                    $message = "created";
        
                                    //START ZOOM LIVE CLASS SCHEDULES (en_classroom_live_class_schedules)
                                    //MAKEING ALL SCHEDULE DATE
                                    $schedules = $zoomInfo['info']->occurrences;
                                    array_splice($liveClassZoomData, 0, 1);
                                    //START CREATE CLASSROOM LIVE CLASS SCHEDULES
                                    $i = 0;
                                    foreach ($schedules as $schedule) {
                                        $r_startDate = $schedules[$i]->start_time;
                                        $recure_date = date('Y-m-d',strtotime($r_startDate));
    
                                        $liveClassZoomData['start_date'] = $recure_date;
                                        $liveClassZoomData['end_date'] = $end_date;
                                        $liveClassZoomData['start_time'] = strftime('%X', strtotime($request->start_time));
                                        $liveClassZoomData['end_time'] = $end_time;
                                        $liveClassZoomData['day_dt'] = date('w', strtotime($recure_date));
    
                                        //INSERT DATA
                                        DB::table('webinars')->insert($liveClassZoomData); //CREATE
                                        $i++;
                                    }
                                    //END CREATE CLASSROOM LIVE CLASS SCHEDULES                         
                                    //END ZOOM LIVE CLASS SCHEDULES
        
        
                                    //MESSAGE
                                    return response()->json([
                                        'status'  => 'success',
                                        'message' => 'Webinar has been created!',
                                        'icon'    => 'times',
                                    ]);
                                } else {
                                    return response()->json([
                                        'status'  => 'danger',
                                        'message' => 'Access token is expired!',
                                        'icon'    => 'times',
                                    ]);
                                }  
                                break;
                }
            }
            

        } else {
            $output = Helper::vError($validator);
        }

        echo json_encode($output);
        // DB::commit();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $webinar = Webinar::findOrFail($id);
        return new WebinarResource($webinar);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = Webinar::find($id)->update($data); 
        
        return response()->json([
            'status'  => 'success',
            'message' => 'Webinar has been created!',
            'icon'    => 'times',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Webinar::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Webinar has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
