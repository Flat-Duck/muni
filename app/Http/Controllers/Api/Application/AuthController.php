<?php
namespace App\Http\Controllers\Api\Application;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Str;
class AuthController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->merge(['identity' => $request->phone]);

        $credentials = $request->validate([
            'identity' => 'required',
            'password' => 'required',
        ]);

        // $credentials = $request->validate([
        //     'phone' => 'required',
        //     'password' => 'required',
        // ]);

        if (!Auth::guard('web')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'phone' => [trans('auth.failed')],
            ]);
        }

        $token = Auth::guard()->user()->createToken('AuthToken');
        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }


    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'municipality_id' => 'required|numeric',
            'phone' => 'required|numeric',
            'birth_date' => 'required|date',
            'gender' => ['required', 'in:أنثى,ذكر'],
            'nationality' => 'required|string',
            'Identity' => 'required|string',
        ]);

        $data['Identity'] = str_replace("'", '',$data['Identity'] );
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return response()->json([
            'user' => $user,
        ]);
    }
}
