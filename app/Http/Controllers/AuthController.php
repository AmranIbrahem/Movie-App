<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\CheckCodePasswordRequest;
use App\Http\Requests\Auth\EmailVerifiedRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\updatePasswordRequest;
use App\Mail\PasswordEmail;
use App\Models\User;
//use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\EmailVerification;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Responses\Response;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "recovery_code"=> mt_rand(5000,500000)
        ]);

        $token =JWTAuth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

//        try {
//            Mail::to($user->email)->send(new EmailVerification("$user->recovery_code",$user->name,
//                "{url}/api/EmailVerified/$user->id",$user->photo)
//                );
//        } catch (\Exception $e) {
//            $user->delete();
//            return Response::Failure("There is a problem sending the email confirmation code or the email does not exist..!",401);
//        }

        if ($user) {
            return Response::registerSuccess("Registration successfully", $user, $token,200);
        } else {
            return Response::Message("Registration failed..!",401);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user){
            $token = JWTAuth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            if($token){
                return Response::loginSuccess("User Login successfully", $user, $token,200);
            }
            else{
                return Response::Message("Password does not match.",401);
            }
        }else{
            return Response::Message("The email dose not match .",401);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            // invalidate token
            JWTAuth::invalidate(JWTAuth::getToken());
            return Response::logoutSuccess(200);
        } catch (JWTException $e) {
            return Response::logoutFailed(500);
        }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function EmailVerified(EmailVerifiedRequest $request,$id){

        $user=User::where('id',$id)->first();
        if($user->email_verified_at==true){
            return Response::Message(" The account is already confirmed ",200);
        }else{
            if($user) {
                $check=User::where('id',$id)->where('recovery_code',$request->recovery_code)->first();
                if($check){
                    $check->email_verified_at = \Carbon\Carbon::now();
                    $check->save();
                    return Response::Message("The email has been confirmed successfully ",200);
                }else{
                    return Response::Message("Recovery Code don't match.! ",401);
                }
            }else{
                return Response::Message('ID User Not Found.!',422);
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->recovery_code=mt_rand(5000, 5000000);
            Mail::to($user->email)->queue(new PasswordEmail ($user->recovery_code,$user->full_name));

            $user->update();
            return Response::PasswordSuccess($user->id,202);
        } else {
            return Response::Message("The email dose not match ..!",401);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public  function CheckCodePassword(CheckCodePasswordRequest $request,$id){
        $user=User::find($id);
        if($user){
            $check=User::where('id',$id)->where('recovery_code',$request->recovery_code)->first();
            if($check){
                return Response::Message('recovery code match .',200);
            }else{
                return Response::Message('recovery code dose not match .',401);
            }
        }else{
            return Response::Message('ID User dose not match .',401);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updatePassword(updatePasswordRequest $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            $token = auth()->attempt([
                'email' => $user->email,
                'password' => $request->password,
            ]);

            return Response::registerSuccess("User login successfully", $user, $token,200);
        } else {
            return Response::Message('id failed..!',422);
        }
    }

}
