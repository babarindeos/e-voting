<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\ElectionSuite;
use Illuminate\Support\Str;

use App\Models\College;
use App\Models\Department;

use Illuminate\Support\Facades\Auth;
use App\Models\VoterRegistration;
use Mail;

use App\Mail\NewUserEmail;
use App\Models\Student;
use App\Models\ElectionRegistration;

use Carbon\Carbon;


class RegistrationCenterController extends Controller
{
    //
    public function index($election_suite_uuid)
    {
        

        $election_suite = ElectionSuite::where('uuid', $election_suite_uuid)->first();

        if ($election_suite == null)
        {
            return redirect()->route('welcome');
        }



        $now = Carbon::now('Africa/Lagos');

        //dd($now->toDateString());
        //dd($now->toTimeString());

        $registration_status = ElectionRegistration::where('live_status', 1)
                                            ->where('election_suite_id', $election_suite->id)
                                            ->whereDate('start_date', '<=', $now)
                                            ->whereDate('end_date', '>=', $now)
                                            ->whereTime('start_time', '<=', $now)
                                            ->whereTime('end_time', '>=', $now)
                                            ->exists();


        if ($registration_status == false)
        {
            return redirect()->route('welcome');
        }


        return view('guests.registration_center.index', compact('election_suite_uuid', 'election_suite'));
    }



    public function Login(Request $request, $election_suite_uuid)
    {
            $request->validate([
                'matric_no' => 'required|string',
                'password' => 'required|string'
            ]);


            $student = Student::where('matric_no', $request->matric_no)->first();

            
            if ($student == null)
            {
                return back()->withErrors(['matric_no' => 'Invalid user credentials']);
            }

            $user_password_hash = trim(md5($request->password));
            
            
            // check if the portal password is right
            if ($student->password != $user_password_hash)
            {
                      
                    return redirect()->back()->withErrors(['matric_no' => 'Invalid user credentials']);
            }


            if  (($student->official_email == '' || $student->official_email == null) && ($student->email == '' || $student->email == null))
            {
                return redirect()->back()->withErrors(['matric_no' => 'Sorry, you have no personal or official email on your record. 
                                                                      This is required to receive the registration code.']);
            }
            else
            {
                    return $this->register_voter($request, $election_suite_uuid, $student);
            }
        
    }


    private function register_voter($request, $election_suite_uuid, $student)
    {

       
        $election_suite = ElectionSuite::where('uuid', $election_suite_uuid)->first();

        // Check if user has been registered for the election suite
        $already_registered = VoterRegistration::where('election_suite_id', $election_suite->id)
                                                ->where('matric_no', $request->matric_no)
                                                ->first();
        
        if ($already_registered)
        {
            return redirect()->back()->withErrors(['matric_no' => "You are already registered."]);
        }
        

        DB::beginTransaction();

        try
        {      
        
                // get all the values from the api call
                $access_code = $randomNumber = rand(10000, 99999);


                $user_data = [
                    'surname' => $student->surname,
                    'firstname' => $student->firstname,
                    'middlename' => $student->middlename,
                    'matric_no' => $student->matric_no,
                    'email' => $student->official_email ? $student->official_email : $student->email,
                    'password' => bcrypt($access_code),
                    'role' => 'student'
                ];

               
                // check if user record exist
                $user = User::where('matric_no', $request->matric_no)->first();

                if ($user)
                {
                    $user->update($user_data);
                    $create_user = $user;
                }
                else
                {
                    $create_user = User::create($user_data);
                }

               
                

                if ($create_user)
                {               
                    $college = College::where('code', $student->college)->first();
                    $department = Department::where('code', $student->department)->first();

                    

                    $formFields['user_id'] = $create_user->id;
                    $formFields['election_suite_id'] = $election_suite->id;
                    $formFields['uuid'] = Str::orderedUuid();
                    $formFields['matric_no'] = $student->matric_no;
                    $formFields['surname'] = $student->surname;
                    $formFields['firstname'] = $student->firstname;
                    $formFields['othernames'] = $student->middlename;
                    $formFields['phone'] = $student->phone;
                    $formFields['college_id'] = $college != null ? $college->id : null;
                    $formFields['department_id'] = $department != null ? $department->id : null;
                    $formFields['level'] = $student->level;



                    $create_voter = VoterRegistration::create($formFields);

                    if ($create_voter)
                    {
                        DB::Commit();

                        // send email
                        $fullname = $student->surname.' '.$student->firstname;
                        $username = $student->matric_no;
                        $recipient = $fullname;
                        $recipient_email = $student->official_email ? $student->official_email : $student->email;

                        

                        //$payload = array("fullname"=>$fullname, "username"=>$username, "password"=>$password);

                        $payload = array("fullname"=>$fullname, "username"=>$username, 
                                         "password"=>$access_code, "email"=>$recipient_email);

                        Mail::to($recipient_email)->send(new NewUserEmail($payload));


                        

/* 
                        
                        
                        $to = $data->official_email;  // Replace with the recipient's email address
                            $subject = "My Voter Registration for ".$election_suite->name;
                            
                            $message = "
                                <html>
                                <head>
                                    <title>Voter Registration for FUNAABSU Elections</title>
                                </head>
                                <body>
                                    <p><strong><big>Voter Registration for FUNAABSU Elections</big></strong></p>
                                   
                                    <br/>
                                    
                                    <p>Dear ".$data->surname." ".$data->firstname.",</p>
                                    <p>Congratulations on completing the registration process for the elections.</p>
                                    <p>Please find below your registration code to access the Voting Center:</p>
                                    
                                    <br/>
                                    
                                  
                                    <p><strong>Registration code: </strong>".$access_code."
                                    
                                    <br/><br/>
                                    <p>
                                        Thank you.
                                    </p>
                            ";

                            $headers = "From: FUNAABSU Election Support <funaabsu_support@funaab.edu.ng>\r\n";  // Replace with your sender email
                            $headers .= "Reply-To: funaabsu_support@funaab.edu.ng\r\n";  // Replace with your support email
                            $headers .= "Bcc: kondishiva005@gmail.com\r\n";  // Add BCC recipient
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                            
                            
                            mail($to, $subject, $message, $headers); */




                        return redirect()->route('guest.registration_center.completed',['election_suite_uuid'=> $election_suite_uuid, 'matric_no'=> $student->matric_no, 'email'=>$recipient_email]);
                    }
                    else
                    {
                        DB::rollBack();
                        return redirect()->back()->withErrors(['matric_no' => 'An error occurred processing your registration. Contact the Admin.']);

                    }           
                    

                }



        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
            DB::rollBack();
        }
          
    }






// /*     public function login(Request $request, $election_suite_uuid)
//     {
//         $request->validate([
//             'matric_no' => 'required|string',
//             'password' => 'required|string'
//         ]);


//         https://icgns.funaab.edu.ng/icgns_apps/admission/get_student_auth.php

//         $url = 'https://icgns.funaab.edu.ng/icgns_apps/admission/get_student_auth.php';
//         $response = Http::get($url, ['matric_no' => $request->matric_no, 'password'=> $request->password]);

        

//         $response = (object) $response->json();

        

//         if ($response->status == 'fail')
//         {
//             $data = [
//                 'error' => true,
//                 'status' => 'fail',
//                 'message' => 'Invalid user credentials'
//             ];

//             return redirect()->back()->withErrors(['matric_no' => 'Invalid user credentials']);
//         }
        
//         // write data into portal payment table
//         $data = (object) $response->data;

//         $user_password_hash = trim(md5($request->password));

//         // check if the portal password is right
//         if ($data->password_hash != $user_password_hash)
//         {
//                 $data = [
//                     'error' => true,
//                     'status' => 'fail',
//                     'message' => 'Invalid user credentials'
//                 ];

//                 return redirect()->back()->withErrors(['matric_no' => 'Invalid user credentials']);
//         }
        



//         $election_suite = ElectionSuite::where('uuid', $election_suite_uuid)->first();

//         // Check if user has been registered for the election suite
//         $already_registered = VoterRegistration::where('election_suite_id', $election_suite->id)
//                                                 ->where('matric_no', $request->matric_no)
//                                                 ->first();
        
//         if ($already_registered)
//         {
//             return redirect()->back()->withErrors(['matric_no' => "You are already registered."]);
//         }
        

//         DB::beginTransaction();

//         try
//         {      
        
//                 // get all the values from the api call
//                 $access_code = $randomNumber = rand(10000, 99999);


//                 $user_data = [
//                     'surname' => $data->surname,
//                     'firstname' => $data->firstname,
//                     'middlename' => $data->othername,
//                     'matric_no' => $data->matric_no,
//                     'email' => $data->official_email,
//                     'password' => bcrypt($access_code),
//                     'role' => 'student'
//                 ];


//                 // check if user record exist
//                 $user = User::where('matric_no', $request->matric_no)->first();

//                 if ($user)
//                 {
//                     $user->update($user_data);
//                     $create_user = $user;
//                 }
//                 else
//                 {
//                     $create_user = User::create($user_data);
//                 }

               
                

//                 if ($create_user)
//                 {               
//                     $college = College::where('code', $data->college)->first();
//                     $department = Department::where('code', $data->department)->first();

                    

//                     $formFields['user_id'] = $create_user->id;
//                     $formFields['election_suite_id'] = $election_suite->id;
//                     $formFields['uuid'] = Str::orderedUuid();
//                     $formFields['matric_no'] = $data->matric_no;
//                     $formFields['surname'] = $data->surname;
//                     $formFields['firstname'] = $data->firstname;
//                     $formFields['othernames'] = $data->othername;
//                     $formFields['phone'] = $data->phone;
//                     $formFields['college_id'] = $college != null ? $college->id : null;
//                     $formFields['department_id'] = $department != null ? $department->id : null;
//                     $formFields['level'] = $data->level;



//                     $create_voter = VoterRegistration::create($formFields);

//                     if ($create_voter)
//                     {
//                         DB::Commit();

//                         // send email
//                         $fullname = $data->surname.' '.$data->firstname;
//                         $username = $data->matric_no;
//                         $recipient = $fullname;
//                         $recipient_email = $data->official_email;

//                         //$payload = array("fullname"=>$fullname, "username"=>$username, "password"=>$password);

//                         $payload = array("fullname"=>$fullname, "username"=>$username, 
//                                          "password"=>$access_code, "email"=>$recipient_email);

//                         Mail::to($recipient_email)->send(new NewUserEmail($payload));

// /* 

                        
//                         $to = $data->official_email;  // Replace with the recipient's email address
//                             $subject = "My Voter Registration for ".$election_suite->name;
                            
//                             $message = "
//                                 <html>
//                                 <head>
//                                     <title>Voter Registration for FUNAABSU Elections</title>
//                                 </head>
//                                 <body>
//                                     <p><strong><big>Voter Registration for FUNAABSU Elections</big></strong></p>
                                   
//                                     <br/>
                                    
//                                     <p>Dear ".$data->surname." ".$data->firstname.",</p>
//                                     <p>Congratulations on completing the registration process for the elections.</p>
//                                     <p>Please find below your registration code to access the Voting Center:</p>
                                    
//                                     <br/>
                                    
                                  
//                                     <p><strong>Registration code: </strong>".$access_code."
                                    
//                                     <br/><br/>
//                                     <p>
//                                         Thank you.
//                                     </p>
//                             ";

//                             $headers = "From: FUNAABSU Election Support <funaabsu_support@funaab.edu.ng>\r\n";  // Replace with your sender email
//                             $headers .= "Reply-To: funaabsu_support@funaab.edu.ng\r\n";  // Replace with your support email
//                             $headers .= "Bcc: kondishiva005@gmail.com\r\n";  // Add BCC recipient
//                             $headers .= "MIME-Version: 1.0\r\n";
//                             $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                            
                            
//                             mail($to, $subject, $message, $headers); */




//                         return redirect()->route('guest.registration_center.completed',['election_suite_uuid'=> $election_suite_uuid, 'matric_no'=> $data->matric_no]);
//                     }
//                     else
//                     {
//                         DB::rollBack();
//                         return redirect()->back()->withErrors(['matric_no' => 'An error occurred processing your registration. Contact the Admin.']);

//                     }           
                    

//                 }



//         }
//         catch(\Exception $e)
//         {
//             dd($e->getMessage());
//             DB::rollBack();
//         }    
        
//     } */



    public function registration_completed($election_suite_uuid, $matric_no, $email)
    {

        // get the $election_id from the $election_uuid
        $election = ElectionSuite::where('uuid', $election_suite_uuid)->first();

        if ($election == null )
        {
            return $this->route('welcome');
        }


        return view('guests.registration_center.registration_completed', compact('email'));
    }
}
