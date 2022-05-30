<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Session;


class OrgzitController extends Controller
{
    /* GET TOTAL AGENTS REGISTER TODAY */
    private function getTotalCountOfAgentsToday($user){

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "tpx6a1p7l9",
                                "filters": [

                                                {
                                                    "field": "email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                    "field": "created_date",
                                                    "op": "thisweek",
                                                    "values": []
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7b619f1f-5ab6-48f1-fe76-80973c04d400"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            //echo '<BR><BR><pre>';print_r($JsonToArrayObj);exit;
            return $JsonToArrayObj->meta->total_count;

        }
    }


    /* GET TOTAL TODAYS APPOINTMENTS */

    private function getTotalCountOfAppontmentsToday($user){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "fa7v9e4go6",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                    "field": "due_date",
                                                    "op": "past_today",
                                                    "values": []
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 29b5f334-c468-30c3-7667-040cbaec8d21"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            //echo '<BR>TOTAL => '.$JsonToArrayObj->meta->total_count.'<BR><BR><pre>';print_r($JsonToArrayObj);exit;
            return $JsonToArrayObj->meta->total_count;
        }
    }


    /*  GET MEETING OF THIS WEEK FOR WELCOME SECTION  */

    private function TotalMeetingsOfThisMonth($user) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "sm8kikp4yt",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                    "field": "created_date",
                                                    "op": "thisweek",
                                                    "values": []
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: b8c27193-2aa4-dd99-f9d1-639a1c8d858c"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            return $JsonToArrayObj->meta->total_count;
        }
    }

    /* GET TOTAL MEETINGS TODAYS */
    private function getTotalMeetingsOfTheMonth($user){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "sm8kikp4yt",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                    "field": "created_date",
                                                    "op": "thismonth",
                                                    "values": []
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",

            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: b8c27193-2aa4-dd99-f9d1-639a1c8d858c"
        ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            //echo '<BR><BR><pre>';print_r($JsonToArrayObj);exit;
            return $JsonToArrayObj->meta->total_count;
        }
    }


    /* GET TOTAL TODAYS MEETINGS WITH CLIENTS */

    private function getTotalCountOfMeetingssToday($user){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "sm8kikp4yt",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                    "field": "created_date",
                                                    "op": "past_today",
                                                    "values": []
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: b8c27193-2aa4-dd99-f9d1-639a1c8d858c"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            //echo '<BR><BR><pre>';print_r($JsonToArrayObj);exit;
            return $JsonToArrayObj->meta->total_count;
        }
    }


    /* GET TOTAL TODAYS Oppotunities */

    private function getTotalCountOfOppotunitiesToday($user){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "f1eivythtw",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                    "field": "created_date",
                                                    "op": "past_today",
                                                    "values": []
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 23887cf8-848f-e340-072b-dc37a392b6e2"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            //echo '<BR><BR><pre>';print_r($JsonToArrayObj);exit;
            return $JsonToArrayObj->meta->total_count;
        }
    }


    /* GET TOTAL TODAYS SALES */

    private function getTotalCountOfSalesToday($user){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "ededuslire",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                    "field": "created_date",
                                                    "op": "past_today",
                                                    "values": []
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            //echo '<BR>Sales Count<BR><pre>';print_r($JsonToArrayObj);exit;
            return $JsonToArrayObj->meta->total_count;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        //
        $user = $request->user();

        //$totalAgentsCounts = $this->getTotalCountOfAgentsToday($user);
        $totalAppointmentCounts = $this->getTotalCountOfAppontmentsToday($user);
        $totalMeetingCounts = $this->getTotalCountOfMeetingssToday($user);
        $totalOppotunitieCounts = $this->getTotalCountOfOppotunitiesToday($user);
        $totalSalesCounts = $this->getTotalCountOfSalesToday($user);

        // Month wise result
        $totalAgentsCountsMonth = $this->getTotalCountOfAgentsMonth($user);
        $totalSalesCountsMonth = $this->getTotalCountOfSalesCurrentMonth($user);
        $totalAppointmentOfTheMonth = $this->getTotalCountOfAppointmonthCurrentMonth($user);



        $arrayOrgzitCounts = array(
            //'TotalAgents' => $totalAgentsCounts,
            'TotalAppointments' => $totalAppointmentCounts,
            'TotalMeetings' => $totalMeetingCounts,
            'TotalOppotunitie' => $totalOppotunitieCounts,
            'TotalSales' => $totalSalesCounts,
            'TotalAgentMonth' => $totalAgentsCountsMonth,
            'TotalSalesMonth' => $totalSalesCountsMonth,
            'totalAppointmentOfTheMonth' => $totalAppointmentOfTheMonth
        );

        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $arrayOrgzitCounts
        ], 200);
    }

    /* GET TOTAL AGENTS REGISTER TODAY */

    private function getTotalCountOfAgentsMonth($user){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "tpx6a1p7l9",
                                "filters": [
                                                {
                                                    "field": "email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "thismonth",
                                                  "values": [
                                                    "Today"
                                                  ]
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7b619f1f-5ab6-48f1-fe76-80973c04d400"
        ),
        ));
        /*
            ,
                                                {
                                                    "field": "created_date",
                                                    "op": "today",
                                                    "values": []
                                                }
        */
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            return $JsonToArrayObj->meta->total_count;
            //print_r(json_decode($response));
        }
    }

    /* getTotalCountOf Appoint Current Month  */ 
    public function getTotalCountOfAppointmonthCurrentMonth($user){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=5",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "fa7v9e4go6",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                  "field": "due_date",
                                                  "op": "thismonth",
                                                  "values": [
                                                    "Today"
                                                  ]
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);

            //echo '<BR>DATA<BR><pre>';print_r($JsonToArrayObj);exit;

            return $JsonToArrayObj->meta->total_count;
        }
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function salesList(Request $request){
        $user = $request->user();
        $inputs = $request->all();

        $totalSalesCountsMonth = $this->getTotalCountOfSalesCurrentMonthList($user, $inputs);
        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalSalesCountsMonth
        ], 200);
    }
    
    /* GET TOTAL SALES OF CURRENT MONTH */

    private function getTotalCountOfSalesCurrentMonth($user){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=5",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "ededuslire",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "thismonth",
                                                  "values": [
                                                    "Today"
                                                  ]
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);

            return $JsonToArrayObj->meta->total_count;
        }
    }

    /* GET TOTAL SALES OF CURRENT MONTH */

    private function getTotalCountOfSalesCurrentMonthList($user,$inputs){

        $StartDate = date('Y-m-d', strtotime($inputs['start_date']));
        $EndDate = date('Y-m-d', strtotime($inputs['end_date']));

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "ededuslire",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "gte",
                                                  "values": [
                                                    "'.$StartDate.'"
                                                  ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "lte",
                                                  "values": [
                                                    "'.$EndDate.'"
                                                  ]
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
            CURLOPT_HTTPHEADER => array(
                "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                    'SalesID' => $value->fields->sales_id,
                    'soldDate' => $value->fields->sold_on,
                    'ProjectName' => $value->fields->project,
                    'salesPrice'  => number_format($value->fields->sales_price_tl, 2) .' '.$value->fields->currency,
                    'salesStatus' => $value->fields->payment_status,
                    'agent_name' => $value->fields->agent,
                    'customer_name' => $value->fields->customer_name,
                    'currency' => $value->fields->currency,
                    'agent_commission_type' => $value->fields->agent_commission_type,
                    'discount' => $value->fields->discount,
                    'grand_total' => number_format($value->fields->grand_total, 2),
                    'agent_commission_usd' => number_format($value->fields->agent_commission_usd, 2),
                    'NetSalesPrice'  => number_format($value->fields->net_sales_price_usd, 2) .' '.$value->fields->currency,
                ];
            }
            
            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }
    

    /* Display Numbers of Properties on Home Page Sidebar (SALES TBL) */

    private function getTotalPropertiesList($user,$inputs){

        $StartDate = date('Y-m-d', strtotime($inputs['start_date']));
        $EndDate = date('Y-m-d', strtotime($inputs['end_date']));

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "ededuslire",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                }                                                
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
            CURLOPT_HTTPHEADER => array(
                "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                'soldDate' => $value->fields->sold_on,
                'ProjectName' => $value->fields->project,
                'salesPrice'  => number_format($value->fields->sales_price_tl, 2) .' '.$value->fields->currency,
                'salesStatus' => $value->fields->payment_status,
                'agent_name' => $value->fields->agent,
                'customer_name' => $value->fields->customer_name,
                'currency' => $value->fields->currency,
                'agent_commission_type' => $value->fields->agent_commission_type,
                'discount' => $value->fields->discount,
                'grand_total' => number_format($value->fields->grand_total, 2).' '.$value->fields->currency,
                'agent_commission_usd' => number_format($value->fields->agent_commission_usd, 2),
                'NetSalesPrice'  => number_format($value->fields->net_sales_price_usd, 2) .' '.$value->fields->currency,
                ];
            }
            
            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardNotificationsList(Request $request){
        $user = $request->user();
        $inputs = $request->all();
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($inputs);exit;
        $totalSalesCountsMonth = $this->getMiniAppointmentsCurrentMonthList($user,$inputs,2);
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($totalSalesCountsMonth);exit;

        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalSalesCountsMonth
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function appointmentsMiniList(Request $request){
        $user = $request->user();
        $inputs = $request->all();
        
        $totalSalesCountsMonth = $this->getMiniAppointmentsCurrentMonthList($user,$inputs,5);
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($totalSalesCountsMonth);exit;

        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalSalesCountsMonth
        ], 200);
    }

    /* getTotalCountOfAppointmentsCurrentMonthList */
    private function getMiniAppointmentsCurrentMonthList($user,$inputs,$dataLimit){
        if($dataLimit == ''){$dataLimit = 3;}
        $curl = curl_init();
        $StartDate = date('Y-m-d', strtotime($inputs['start_date']));
        $EndDate = date('Y-m-d', strtotime($inputs['end_date']));
        $ftype = $inputs['ftype'] ? $inputs['ftype'] : 'thisyear';
        
        curl_setopt_array($curl, array(
                CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=".$dataLimit,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
                                    "dataform": "fa7v9e4go6",
                                    "filters": [
                                                    {
                                                        "field": "first_email",
                                                        "op": "equal",
                                                        "values": [
                                                            "'.$user->email.'"
                                                        ]
                                                    },
                                                    {
                                                        "field": "due_date",
                                                        "op": "'.$ftype.'",
                                                        "values": []
                                                    }
                                                ],
                                    "getfieldvalues": false,
                                    "use_field_slug": true
                                }',
                CURLOPT_HTTPHEADER => array(
                    "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
                ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<BR>DATA REQUEST<BR><pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                    'id' => $value->fields->id,
                    'createdDate' => $value->fields->due_date,
                    'createdTime' => $value->fields->appointment_time ? $value->fields->appointment_time : '00:00',
                    'source' => $value->fields->project_name,
                    'stage' => $value->fields->activity_status
                ];
            }
            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }




/**
 * 
 * 
 * ALL LIST
 * 
 */

    public function appointmentsList(Request $request){
        $user = $request->user();
        $inputs = $request->all();
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($inputs);exit;
        $totalSalesCountsMonth = $this->getTotalCountOfAppointmentsCurrentMonthList($user,$inputs);

        //echo '<BR>SALES MONTHS<BR><pre>';print_r($totalSalesCountsMonth);exit;

        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalSalesCountsMonth
        ], 200);
    }

    

    /* getTotalCountOfAppointmentsCurrentMonthList */
    private function getTotalCountOfAppointmentsCurrentMonthList($user,$inputs){
        $curl = curl_init();
        $StartDate = date('Y-m-d', strtotime($inputs['start_date']));
        $EndDate = date('Y-m-d', strtotime($inputs['end_date']));
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=10",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                                    "dataform": "fa7v9e4go6",
                                    "filters": [
                                                    {
                                                        "field": "first_email",
                                                        "op": "equal",
                                                        "values": [
                                                            "'.$user->email.'"
                                                        ]
                                                    },
                                                    {
                                                        "field": "due_date",
                                                        "op": "gte",
                                                        "values": [
                                                            "'.$StartDate.'"
                                                        ]
                                                    },
                                                    {
                                                        "field": "due_date",
                                                        "op": "lte",
                                                        "values": [
                                                            "'.$EndDate.'"
                                                        ]
                                                    }
                                                ],
                                    "getfieldvalues": false,
                                    "use_field_slug": true
                                }',
            CURLOPT_HTTPHEADER => array(
                "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
            ),
        ));        

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<BR>DATA REQUEST<BR><pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                'id' => $value->fields->id,
                'createdDate' => $value->fields->due_date,
                'createdTime' => $value->fields->appointment_time ? $value->fields->appointment_time  : ' - ',
                'source' => $value->fields->project_name,
                'stage' => $value->fields->activity_status
                ];
            }
            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }

    /**
     * Display a listing of the appointments
     *
     * @return \Illuminate\Http\Response
     */
    public function allMeetingList(Request $request){
        $user = $request->user();
        $inputs = $request->all();
        $totalSalesCountsMonth = $this->getAllMeetingsList($user,$inputs);
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($totalSalesCountsMonth);exit;
        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalSalesCountsMonth
        ], 200);
    }

    private function getAllMeetingsList($user,$inputs){
        $StartDate = date('Y-m-d', strtotime($inputs['start_date']));
        $EndDate = date('Y-m-d', strtotime($inputs['end_date']));

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "sm8kikp4yt",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "past_today",
                                                  "values": []
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                'id' => $value->fields->id,
                'createdDate' => $value->fields->actual_start_date,
                'createdTime' => ($value->fields->actual_start_time) ? $value->fields->actual_start_time : ' - ' ,
                'MeetingWithCustomer' => $value->fields->meeting_with_customer,
                'MeetingLocation' => $value->fields->project_name,
                'MeetingType' => $value->fields->meeting_type,
                'MeetingTitle' => $value->fields->_title
                ];
            }
            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }



    /**
     * 
     * 
     * 
     * 
     * 
     * 
     */


    public function meetingList(Request $request){
        $user = $request->user();
        $inputs = $request->all();
        $totalSalesCountsMonth = $this->getTotalMeetingCurrentMonthList($user,$inputs);
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($totalSalesCountsMonth);exit;
        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalSalesCountsMonth
        ], 200);
    }

    private function getTotalMeetingCurrentMonthList($user,$inputs){
        $StartDate = date('Y-m-d', strtotime($inputs['start_date']));
        $EndDate = date('Y-m-d', strtotime($inputs['end_date']));

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "sm8kikp4yt",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "gte",
                                                  "values": [
                                                    "'.$StartDate.'"
                                                  ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "lte",
                                                  "values": [
                                                    "'.$EndDate.'"
                                                  ]
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                'id' => $value->fields->id,
                'createdDate' => $value->fields->actual_start_date,
                'createdTime' => $value->fields->actual_start_time ? $value->fields->actual_start_time : ' - ',
                'MeetingWithCustomer' => $value->fields->meeting_with_customer,
                'MeetingLocation' => $value->fields->project_name,
                'MeetingType' => $value->fields->meeting_type,
                'MeetingTitle' => $value->fields->_title,
                //'interested_apartment_type_1' => $value->fields->interested_apartment_type_1,
                //'opportunity_name' => $value->fields->opportunity_name,
                //'project' => $value->fields->project_name,
                //'created_date' => $value->fields->created_date
                ];
            }//$JsonToArrayObj;//$JsonToArrayObj->objects;

            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }


    /**
     *
     * Payment Plans Listing API
     * knyo6mtmk6 -> Payment plan table
     * */

    public function paymentPlanList(Request $request){
        $user = $request->user();
        $inputs = $request->all();
        $totalSalesCountsMonth = $this->getTotalPaymentPlansList($user,$inputs);
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($totalSalesCountsMonth);exit;
        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalSalesCountsMonth
        ], 200);
    }


    private function getTotalPaymentPlansList($user,$inputs){

        $StartDate = date('Y-m-d', strtotime($inputs['start_date']));
        $EndDate = date('Y-m-d', strtotime($inputs['end_date']));

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "knyo6mtmk6",
                                "filters": [
                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "gte",
                                                  "values": [
                                                    "'.$StartDate.'"
                                                  ]
                                                },
                                                {
                                                  "field": "created_date",
                                                  "op": "lte",
                                                  "values": [
                                                    "'.$EndDate.'"
                                                  ]
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                'id' => $value->fields->id,
                'SalesPerson' => $value->fields->salesperson_1,
                'PaymentType' => $value->fields->payment_type,
                'PaymentStatus' => $value->fields->payment_status,
                'PaymentCurrency' => $value->fields->currency,
                'ExpectedPaymentAmount' => number_format($value->fields->expected_payment_amount, 2).' '.$value->fields->currency,
                'ExpectedPaymentDate' => $value->fields->expected_payment_date,
                'ProjectName' => $value->fields->project,
                //'opportunity_name' => $value->fields->opportunity_name,
                //'project' => $value->fields->project_name,
                //'created_date' => $value->fields->created_date
                ];
            }//$JsonToArrayObj;//$JsonToArrayObj->objects;

            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }



    /********************************************************************************************************************* */



    public function projectEnquireRequest(Request $request)
    {
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'project_interest' => 'required|max:175',
            'first_name' => 'required|max:75',
            'last_name'  => 'required|max:75',
            'email'      => 'required|email|max:190',
            'occupation' => 'required|max:75',
            'country'    => 'required|max:75',
            'dial_code'  => 'nullable|max:75',
            'mobile'     => 'required|numeric|digits_between:10,15',
            'appointment_date' => 'required|max:75',
            'appointment_time' => 'required|max:75',
            'message'    => 'nullable|max:900',

        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation errors', 'errors' => $validation->errors()], 422);
        }

        $inputs = $request->all();

        $inputs['mobile'] = $inputs['dial_code'].$inputs['mobile'];
        $message = "Enquire request for ".$request->input('project_interest'). " project on " . date('Y-m-d');
        $post_data = [
            'dataform_id' => 'pbynssdk2f',
            'dataform' => '/api/1/dataform/pbynssdk2f/',
            'fields' => [
                'name'      => $inputs['first_name']. ' '.$inputs['last_name'],
                'email'     => $inputs['email'],
                'phone'     => $inputs['mobile'],
                'country'   => $inputs['country'],
                'message'   => $inputs['message'] ? $inputs['message'] : $message,
                'company'   => null,
                'appointment_date'   => $inputs['appointment_date'],
                'appointment_time'   => $inputs['appointment_time'],
                'project_interest'        => $inputs['project_interest'],
                'source'    => 'CuEngine Portal'
            ],
            'use_field_slug' => true
        ];

        $payload = json_encode($post_data);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26'
        ])->post('https://cuengine.orgzit.com/api/1/record/',$post_data);

         if($response->successful()){

            try {
                \Illuminate\Support\Facades\Mail::send([], [], function ($message) use ($inputs) {
    
                    $email_body = "Hi " . $inputs['first_name'] ." " . $inputs['last_name'] . ",<br><br> Thank you for submitting enrollment form. We have your information and will be in touch very soon.<br>If you have any questioned about our projects, please contact us via whatsapp. https://web.whatsapp.com/send?phone=90-544-382-51-21&text=Hii <br><br> ---<br>Best Regards<br>CubeDots";

                    $message->to($inputs['email']);
    
                    // $message->to('jagdish@cubedots.com'); 
                    $message->subject("Cubedots Enrollment Appointment" );
                    $message->setBody($email_body, 'text/html');
                });
    
                return response()->json(['status' => true, 'message' => 'Request form submitted successfully, after confirming your account we will be sending you confirmation mail in 24 hours.'], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Enrolment request form submission failed.'], 200);
            }

        }else{
            return response()->json([
                'status'        => false,
                'status_code'   => $response->status(),
                'message'       => 'Request form submission failed.',
                'errors'        => $response->json()
            ], 200);
        }

        
    }

    public function unitEnquireRequest(Request $request)
    {
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'project_interest' => 'required|max:175',
            'apartment_id' => 'required|max:75',
            'first_name' => 'required|max:75',
            'last_name'  => 'required|max:75',
            'dial_code'  => 'nullable|max:75',
            'mobile'     => 'required|numeric|digits_between:10,15',
            'appointment_date' => 'required|max:75',
            'appointment_time' => 'required|max:75',
            'message'    => 'nullable|max:900',

        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation errors', 'errors' => $validation->errors()], 422);
        }

        $inputs = $request->all();

        $inputs['mobile'] = $inputs['dial_code'].$inputs['mobile'];
        $message = "Unit Enquire request for ".$request->input('apartment_id'). " on " . date('Y-m-d');
        $post_data = [
            'dataform_id' => 'pbynssdk2f',
            'dataform' => '/api/1/dataform/pbynssdk2f/',
            'fields' => [
                'name'      => $inputs['first_name']. ' '.$inputs['last_name'],
                'email'     => $inputs['email'],
                'phone'     => $inputs['mobile'],
                'country'   => $inputs['country'],
                'message'   => $inputs['message'] ? $inputs['message'] : $message,
                'company'   => null,
                'occupation'         => $inputs['occupation'] ? $inputs['occupation'] : 'NA',
                'appointment_date'   => $inputs['appointment_date'],
                'appointment_time'   => $inputs['appointment_time'],
                'project_interest'   => $inputs['project_interest'],
                'source'    => 'CuEngine Portal'
            ],
            'use_field_slug' => true
        ];

        $payload = json_encode($post_data);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26'
        ])->post('https://cuengine.orgzit.com/api/1/record/',$post_data);

         if($response->successful()){

            try {
                \Illuminate\Support\Facades\Mail::send([], [], function ($message) use ($inputs) {
                
                    $email_body = "Hi " . $inputs['first_name'] ." " . $inputs['last_name'] . ",<br><br> Thank you for submitting enrollment form. We have your information and will be in touch very soon.<br>If you have any questioned about our projects, please contact us via whatsapp. https://web.whatsapp.com/send?phone=90-544-382-51-21&text=Hii <br><br> ---<br>Best Regards<br>CubeDots";

                    $message->to($inputs['email']);
    
                    // $message->to('jagdish@cubedots.com');
                    
                    $message->subject("Cubedots Enrollment Appointment");
                    $message->setBody($email_body, 'text/html');
                });
    
                return response()->json(['status' => true, 'message' => 'Request form submitted successfully, after confirming your account we will be sending you confirmation mail in 24 hours.'], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Enrolment request form submission failed.'], 200);
            }

        }else{
            return response()->json([
                'status'        => false,
                'status_code'   => $response->status(),
                'message'       => 'Request form submission failed.',
                'errors'        => $response->json()
            ], 200);
        }

    }

    public function requestEnrollment(Request $request)
    {
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            //'project_interest' => 'nullable|max:175',
            'first_name' => 'required|max:75',
            'last_name'  => 'required|max:75',
            'email'      => 'required|email|max:190',
            'occupation' => 'required|max:75',
            'country'    => 'required|max:75',
            'dial_code'  => 'nullable|max:75',
            'mobile'     => 'required|numeric|digits_between:10,15',
            'message'    => 'nullable|max:900',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation errors', 'errors' => $validation->errors()], 422);
        }



        $inputs = $request->all();
        $inputs['mobile'] = $inputs['dial_code'].$inputs['mobile'];
        $email = trim($inputs['email']);
        $user = DB::table('become_our_partner')->where('email',$email)->first();

        if($user){
            return response()->json(['status' => false, 'message' => 'You are already sent request for same. Our team will contact you soon. Thanks for contacting us again.', 'errors' => ''], 422);
        }

        $post_data = [
            'dataform_id' => 'pbynssdk2f',
            'dataform' => '/api/1/dataform/pbynssdk2f/',
            'fields' => [
                'name'      => $inputs['first_name']. ' '.$inputs['last_name'],
                'email'     => $inputs['email'],
                'phone'     => $inputs['mobile'],
                'country'   => $inputs['country'],
                'message'   => $request->input('message') ? $request->input('message') : "Cuengine - Schedule a Enrolment request - " . date('Y-m-d'),
                'company'   => null,                
                'occupation' => $inputs['occupation'] ,
                'source'    => 'CuEngine Portal'
            ],
            'use_field_slug' => true
        ];

        $payload = json_encode($post_data);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26'
        ])->post('https://cuengine.orgzit.com/api/1/record/',$post_data);
         if($response->successful()){

            try {
                
                \Illuminate\Support\Facades\Mail::send([], [], function ($message) use ($inputs) {

                    $email_body = "Hi ". $inputs['first_name']." " . $inputs['last_name'].",<br><br>Thank you for submitting enrollment form. We have your information and will be in touch very soon.<br><br>If you have any questioned about our projects, please contact us via whatsapp. https://web.whatsapp.com/send?phone=90-544-382-51-21&text=Hii <br><br> ---<br>Best Regards<br>CubeDots";
                    $message->to($inputs['email']);                    
                    $message->subject("Cubedots Enrollment Appointment");
                    $message->setBody($email_body, 'text/html');
                });
                /* CREATE ENTRY ON BECOME OUR PARTNER TBL */
                    $fname = $inputs['first_name'];
                    $lname = $inputs['last_name'];                
                    $mobile = $inputs['mobile'];
                    $country = $inputs['country'];                
                    DB::insert('insert into become_our_partner (first_name, last_name, email, mobile, country, status) values(?,?,?,?,?,?)',[$fname,$fname,$email,$mobile,$country,'1']);
                /* END CREATE QRY */
                return response()->json(['status' => true, 'message' => 'Request form submitted successfully, after confirming your account we will be sending you confirmation mail in 24 hours.'], 200);

            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Enrolment request form submission failed.'], 200);
            }
        }else{
            return response()->json([
                'status'        => false,
                'status_code'   => $response->status(),
                'message'       => 'Request form submission failed.',
                'errors'        => $response->json()
            ], 200);
        }
    }



    /*

	*  Create New Appointment from Agent Dashboard

    */

    public function createAppointment(Request $request){

        $user = $request->user();       
        
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'location' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'country'    => 'required|max:75',
            'email'  => 'nullable',
            'mobile'     => 'required|numeric|digits_between:10,15'
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation errors', 'errors' => $validation->errors()], 422);
        }
        
        $inputs = $request->all();
        //echo '<BR>SESSION<BR><pre>';print_r($user);
        //echo '<BR>FORM POST<BR><pre>';print_r($inputs);        
        $inputs['mobile'] = $inputs['dial_code'].$inputs['mobile'];
        //$message = "Unit Enquire request for ".$request->input('apartment_id'). " on " . date('Y-m-d');
        $createDate = date("Y-m-d");
        $createdTime = time();

        /** Project Manager Based Array **/
        $AssignToManagerArray = array(
            'i0p1az8p61' => 'baefyfd88u', //Skyland baefyfd88u
            'townntm6uk' => 'townntm6uk', //Belikdugu townntm6uk
            'dziqa633pp' => 'g4b27h8u5k', //Acar        g4b27h8u5k
            'utbqsaqd5t' => 'r80bnbjmcj', //Yamanyevler
            'e61uaunghz' => 'orxoqnvnhv', //Nisantasi
        );

        $projectName = trim($inputs['location']);

        if (array_key_exists($projectName, $AssignToManagerArray)) {
            $AssignToManagerVal = $AssignToManagerArray[$projectName];
        }else{
            $AssignToManagerVal = '';
        }
        
        $AgentEmail = trim($inputs['email']);
        $AgentName = trim($inputs['first_name']);
        $CustomerRecordId = $user->orgzit_customer_record_id;
        $appointment_date = date('Y-m-d', strtotime($inputs['appointment_date']));
        $appointment_time = $inputs['appointment_time'];

        $post_data = [
            'dataform_id' => 'fa7v9e4go6',
            'fields' => [
                'created_date' => $createDate, 
                'created_time' => $createdTime,                    
                'notes'  =>  "New appointment created from Cuengine Portal Agent Dashboard",
                'due_date' => $appointment_date,
                'appointment_time' => $appointment_time,                
                //'assign_to_2' => $AssignToManagerVal,
                'project_name' => $projectName,
            ],
            'dbvalues' => [
                'activity_owner' => '5739',                
                'project_name' => $projectName,
                'first_email' => $AgentEmail,
                //$AssignToManagerVal,
                'agent_name' => $CustomerRecordId
            ],
            'use_field_slug' => true
        ];

        //echo '<BR>POSTED DATA<BR><pre>';print_r($post_data);exit;
        $payload = json_encode($post_data);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Content-Length: ' . strlen($payload),
            'Authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26'
        ])->post('https://cuengine.orgzit.com/api/1/record/',$post_data);
        
        if($response->status() === 201){

            return response()->json([
                'status'        => true,
                'status_code'   => $response->status(),
                'message'       => 'Appointment created successfully.',
                'data'          => $response->json()
            ], 200);
        }else{
            return response()->json([
                'status'        => false,
                'status_code'   => $response->status(),
                'message'       => 'Request form submission failed.',
                'errors'        => $response->json()
            ], 422);
        }
    }


    /*
	*  GET ALL ACTIVE PROJECTS NAMES
    */
    public function getActiveProjects(Request $request){
        $user = $request->user();
        $inputs = $request->all();        
        $totalActiveProjects = $this->getAllActiveProjects($user,$inputs);
        //echo '<BR>SALES MONTHS<BR><pre>';print_r($totalSalesCountsMonth);exit;
        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $totalActiveProjects
        ], 200);
    }


    private function getAllActiveProjects ($user,$inputs){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "wthdnib9ci",
                                "filters": [
                                                {
                                                    "field": "active_status",
                                                    "op": "equal",
                                                    "values": ["Yes"]
                                                }
                                            ],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            $salesList = array();
            //echo '<pre>';print_r($JsonToArrayObj);exit;
            foreach ($JsonToArrayObj->objects as $key => $value) {
                $salesList[] =[
                    'id' => $value->fields->id,
                    'ProjectName' => $value->fields->project_name,
                    'OrgzitRecordId' => $value->id
                ];
            }//$JsonToArrayObj;//$JsonToArrayObj->objects;

            //echo '<pre>';print_r($salesList);exit;
            return $salesList;
        }
    }    
    // END CONTROLLER CLASS

    /** welcome agent details on agent dashboard page */
    public function getAgentWelcomePageDetails(Request $request){
        //
        $user = $request->user();
        $totalMeetingCounts = $this->getTotalMeetingsOfTheMonth($user);
        $TotalMeetingsOfThisMonth =  $this->TotalMeetingsOfThisMonth($user,2); // 2 - Week 
        

        $totalAppointmentOfMonth = $this->getTotalCountOfAppoints($user,1); // 1 - Month

        $totalAppointmentOfWeek = $this->getTotalCountOfAppoints($user,2); // 2 - Week
        

        $arrayOrgzitCounts = array(            
            'totalAppointmentOfWeek' => $totalAppointmentOfWeek,
            'TotalMeetingsOfMonth' => $totalMeetingCounts,            
            'totalAppointmentOfMonth' => $totalAppointmentOfMonth,
            'TotalMeetingsOfThisMonth' =>  $TotalMeetingsOfThisMonth
        );

        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $arrayOrgzitCounts
        ], 200);
    }

    /* get total Count of appoints */ 
    public function getTotalCountOfAppoints($user, $dayType){
        $curl = curl_init();
        if($dayType == 1){
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                                    "dataform": "fa7v9e4go6",
                                    "filters": [
                                                    {
                                                        "field": "first_email",
                                                        "op": "equal",
                                                        "values": [
                                                            "'.$user->email.'"
                                                        ]
                                                    },
                                                    {
                                                    "field": "due_date",
                                                    "op": "thismonth",
                                                    "values": [
                                                        "Today"
                                                    ]
                                                    }
                                                ],
                                    "getfieldvalues": false,
                                    "use_field_slug": true
                                }',
                CURLOPT_HTTPHEADER => array(
                    "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
                ),
            ));
        }else{
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=5",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
                                        "dataform": "fa7v9e4go6",
                                        "filters": [
                                                        {
                                                            "field": "first_email",
                                                            "op": "equal",
                                                            "values": [
                                                                "'.$user->email.'"
                                                            ]
                                                        },
                                                        {
                                                        "field": "due_date",
                                                        "op": "thisweek",
                                                        "values": [
                                                            "Today"
                                                        ]
                                                        }
                                                    ],
                                        "getfieldvalues": false,
                                        "use_field_slug": true
                                    }',
                    CURLOPT_HTTPHEADER => array(
                        "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
                        "cache-control: no-cache",
                        "content-type: application/json",
                        "postman-token: 7f0eb150-eb6f-96c3-f99f-bef31fa83241"
                    ),
                ));
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            return $JsonToArrayObj->meta->total_count;
        }
    }

    public function getform()
    {
        return \Alkhachatryan\LaravelWebConsole\LaravelWebConsole::show();
    }


    /** Send Help & Support Email  */
    public function helpSupportEmail(Request $request)
    {

        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [          
            'name' => 'required|max:75',
            'email'      => 'required|email|max:190',
            'country'    => 'required|max:75',
            'dial_code'  => 'nullable|max:75',
            'mobile'     => 'required|numeric|digits_between:10,15',
            'message'    => 'nullable|max:900',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation errors', 'errors' => $validation->errors()], 422);
        }

        $inputs = $request->all();
        $inputsMobile = $inputs['dial_code'].$inputs['mobile'];
        \Illuminate\Support\Facades\Mail::send([], [], function($message) use($inputs){
            $email_body = "Hello Support Team, <BR><BR>  ".ucfirst($inputs['name'])." send message from help and support form Cubedots Portal System. <br><br>Please find the help & support form details as follows.<br><br><strong>Full Name:</strong>".$inputs['name']."<br><br><strong>Email:</strong> ".$inputs['email']."<br><br><strong>Country:</strong> ".$inputs['country']."<br><br><strong>Mobile:</strong> ".$inputs['mobile']."<br><br><strong>Message:</strong> ".$inputs['message']."<br><br> ---<br>Thanks & Regards<br><br>".ucfirst($inputs['name']);
            $message->to('support@cubedots.com');
            $message->cc('sanjeev@cubedots.com');
            $message->subject('Cuengine - Help & Support request');
            $message->setBody($email_body, 'text/html');
        });

        return response()->json([
            'status'  => true, 
            'message' => 'Help & Support request form submitted successfully.',
        ], 200);
        
    }

    /* Get Agent Profile Details for display on Agent Dashboard */
    public function getAgentProfileDetails($user,$inputs){

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cuengine.orgzit.com/api/1/record/filter/?limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
                                "dataform": "tpx6a1p7l9",
                                "filters": [

                                                {
                                                    "field": "first_email",
                                                    "op": "equal",
                                                    "values": [
                                                        "'.$user->email.'"
                                                    ]
                                                }],
                                "getfieldvalues": false,
                                "use_field_slug": true
                            }',
        CURLOPT_HTTPHEADER => array(
            "authorization: ApiKey portalapi:5f4ae731a177237058b30f00408512a1e58c7f26",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 7b619f1f-5ab6-48f1-fe76-80973c04d400"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $JsonToArrayObj = json_decode($response);
            //echo '<BR><BR><pre>';print_r($JsonToArrayObj);exit;
            return $JsonToArrayObj;

        }
    }

}
