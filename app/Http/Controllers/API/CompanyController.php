<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
         $request->validate(['email'=>'required','password'=>'required']);
         
          $emply=Company::where('email',$request->email)->where('password',md5($request->password))->first();

       if($emply){
                
                return response()->json([
                'status' => true,
                'message' => 'Company detail.',
                'data'=>$emply
                 
               ]);

       }else{
         return response()->json([
                'status' => false,
                'message' => 'Company not found.',
                 
               ]);
        
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerCompany(Request $request)
    {
          $request->validate([
            "name" => 'required',
            "company_type" => 'required',
            "company_website" => 'required',
            "email" => 'unique:App\Models\Company,email',
            "password" => 'required',
            "address" => 'required',
            "mobile_number" => 'required',
            "company_country" => 'required',
            "company_number" => 'required',
            "detail" => 'required',
             
        ]);
        
            $emply=Company::create([
            "name" => $request->input('name'),
            "company_type" => $request->input('company_type'),
            "company_website" => $request->input('company_website'),
            "email" => $request->input('email'),
            "company_size" => $request->input('company_size'),
            "password" => md5($request->input('password')),
            "address" => $request->input('address'),
            "mobile_number" => $request->input('area_code').$request->input('mobile_number'),
            "company_country" => $request->input('company_country'),
            "company_number" => $request->input('company_number'),
            "detail" => $request->input('detail'),
            "active_deactive" => 'active',
            "registration_date" => now(),
            ]);
         
       if($emply){
              return response()->json([
                'status' => true,
                'message' => 'Company.',
                'data'=>$emply
                 
               ]);

       }else{
         return response()->json([
                'status' => false,
                'message' => 'Company Create Error.',
                 
               ]);
       }
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
