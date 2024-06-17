<?php

namespace App\Http\Controllers;


//use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\movies;
use App\Models\series;
use App\Models\Actor;
use App\Models\category;
use App\Models\Series_episodes;
use App\Models\User;
use App\Mail\EmailVerification;
use App\Mail\AddAdmin;
use App\Mail\DeleteAdmin;
use App\Http\Responses\Response;

use Illuminate\Support\Facades\Mail;

use Validator;

class OwnerController extends Controller
{
    //
    public function AddAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            "email" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Validation failed..!",
                "errors" => $validator->errors()->all()
            ], 422);
        }
        $email=$request->email;
        $checkForUser=User::where('email',$email)->first();
        if($checkForUser){
            $role=$checkForUser->role;
            $nameUser=$checkForUser->name;

            if($role == "owner"){
                return Response::Message("This Account $nameUser Is Owner",401);
            }
            if($role == "admin"){
                return Response::Message("Add $nameUser To Admin Before",401);
            }else{
                $checkForUser->role="admin";
                $reslut=$checkForUser->save();
                if($reslut){
                    try {
                        Mail::to($checkForUser->email)->send(new AddAdmin("$nameUser"
                                ,'http://{url}/api/login')
                        );
                    } catch (\Exception $e) {
                        return Response::Message('There is a problem sending the email Add Admin',404);
                    }
                    return Response::Message("Add $nameUser To Admin successfully",400);
                }else{
                    return Response::Message("Error In Add",400);
                }
            }
        }else{
            return Response::Message("Not Found User",400);
        }
    }

    //////////////////////////////////////////////////////////////

    public function DeleteAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            "email" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Validation failed..!",
                "errors" => $validator->errors()->all()
            ], 422);
        }
        $email=$request->email;
        $checkForUser=User::where('email',$email)->first();
        if($checkForUser){
                $role=$checkForUser->role;
                $nameUser=$checkForUser->name;

                if($role == "owner"){
                    return Response::Message("This Account $nameUser Is Owner",401);
                }
                if($role == "admin"){
                    $checkForUser->role="user";
                    $reslut=$checkForUser->save();
                    if($reslut){
                        try {
                            Mail::to($checkForUser->email)->send(new DeleteAdmin("$nameUser"
                                    ,'http://{url}/api/login')
                            );
                        } catch (\Exception $e) {
                            return Response::Message('There is a problem sending the email Add Admin',404);
                        }
                        return Response::Message("Delete $nameUser From Admin successfully",200);
                    }else{
                        return Response::Message("Error In Delete",400);
                    }
                }else{
                    return Response::Message("This User $nameUser Is Not Admin",400);
                }
        }else{
            return Response::Message("Not Found User",400);
        }
    }

    //////////////////////////////////////////////////////////////

    public function ShowAllAdmin(){
        $admin=User::where('role',"admin")->get();
        if(count($admin) >=1 ){
            return response()->json([
                "message"=>"this All Admin In application",
                "Admins"=>$admin
            ],200);

        }else{
            return Response::Message("There is no admins in the application",400);
        }
    }
}
