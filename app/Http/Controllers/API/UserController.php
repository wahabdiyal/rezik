<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobRegister;
use App\Models\Company;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
          
            'password' => 'required',
             
           ]);
         $user = User::where('email',$request->email)->with('experiences','skills','education')->first();

         if($user){
            if (\Hash::check($request->password, $user->password)) {
                 return response()->json([
                'status' => true,
                'message' => 'User detail .',
                'data'=> $user,
            ]);
        }else{
                 return response()->json([
                'status' => false,
                'message' => 'Password not found.',
                 
               ]);
                 }
            }else{
                 return response()->json([
                'status' => false,
                'message' => 'User not found .',
                 
               ]);
            }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $request)
    {
           $request->validate([
            'email'=>'unique:users,email',
            'password'=>'required|min:6'
        ]);
           if(!$request->name){
        $parts = explode("@", $request->email);
        $username = $parts[0];
    }else{
         $usernam=$request->input('name');
    }
        $user=User::create(['name'=>$username,'email'=>$request->email,'password'=>\Hash::make($request->password)]);
        if ($user){
            return response()->json([
                'status' => true,
                'message' => 'User detail .',
                 'data'=>$user
               ]);

                
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User Create .',
                 
               ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchJob(Request $request)
    {

       if (!empty($request->location) && !empty($request->job) && !empty($request->jt)) {
     
           $searchs = JobRegister::where('city',$request->location)
                    ->where('employment_type',$request->jt)
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
                    
     
                 
         }elseif (!empty($request->job) && !empty($request->jt)) {
     
           $searchs = JobRegister::where('employment_type',$request->jt)
                    
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
              
     
                 
         }elseif (!empty($request->location) && !empty($request->jt)) {
     
           $searchs = JobRegister::where('employment_type',$request->jt)
                     
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
                    
     
                 
         }elseif (!empty($request->jt)) {
     
           $searchs = JobRegister::where('employment_type',$request->jt)
                     
                    ->with('company')
                    ->get();
                    
     
                 
         }

         elseif (!empty($request->location) && !empty($request->job) && !empty($request->company)) {
    
           $searchs = JobRegister::where('city',$request->location)
                    ->where('company_id',$request->company)
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
                    
     
              
         }



         elseif (!empty($request->location) && !empty($request->job) && !empty($request->education)) {
    
            $searchs = JobRegister::where('city',$request->location)
                    ->where('education',$request->education)
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
                    
     
                 
          }elseif (!empty($request->job) && !empty($request->education)) {
     
           $searchs = JobRegister::where('education',$request->education)
                    
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
              
     
                 
         }elseif (!empty($request->location) && !empty($request->education)) {
     
           $searchs = JobRegister::where('education',$request->education)
                     
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
                    
     
                 
         }elseif (!empty($request->education)) {
     
           $searchs = JobRegister::where('education',$request->education)
                     
                    ->with('company')
                    ->get();
              
         }
         elseif (!empty($request->location) && !empty($request->job) && !empty($request->company)) {
            
            $searchs = JobRegister::where('city',$request->location)
                    ->where('company_id',$request->company)
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
                    
     
                 
          }




         elseif (!empty($request->job) && !empty($request->company)) {
     
           $searchs = JobRegister::where('company_id',$request->company)
                    
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
              
     
                 
         }elseif (!empty($request->location) && !empty($request->company)) {
     
           $searchs = JobRegister::where('company_id',$request->company)
                     
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')
                    ->get();
                    
     
                 
         }elseif (!empty($request->company)) {
     
           $searchs = JobRegister::where('company_id',$request->company)
                     
                    ->with('company')
                    ->get();
              
         }




         elseif (!empty($request->location) && !empty($request->job)) {

             $searchs = JobRegister::where('city',$request->location)
                    ->where('job_skill','like',$request->job. '%')
                    ->with('company')->get();
        
                
         }elseif (!empty($request->location) || !empty($request->job)) {

              $searchs = JobRegister::where('job_skill','like',$request->job. '%')
              ->OrWhere('city',$request->location)
                    
                    ->with('company')->get();
       
            
         }else{
             
               $searchs = JobRegister::where('city',$request->location)
                      ->OrWhere('job_skill','like',$request->job. '%')
                      ->with('company')->get();
                  } 
                  return response()->json([
                'status' => true,
                'message' => 'Main search.',
                'data'=>$searchs,
                'companies'=>Company::select('id','name')->get()
                 
               ]);
            
        
             
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
