<?php
namespace App\Http\Controllers\Api\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials['active'] = 1;
        //return $credentials;

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
        $token = null;
        $user = User::whereEmail($request->email)->firstOrFail();
        if(!$user->isDashboardUser())
        {
            return [
                "message"=> "You are not Authorized to login to Dashboard",
            ];
        }else{
            $token = $user->createToken('auth-token');
            return response()->json([
                'token' => $token->plainTextToken,
            ]);
        }
    }
}
