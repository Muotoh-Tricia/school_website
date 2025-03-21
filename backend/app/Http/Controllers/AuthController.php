<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        DB::beginTransaction();

        try {
            // Create base validation rules
            $rules = [
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'phone_number' => 'required|string|max:11',
                'department' => 'required|string',
                'gender' => 'required|in:male,female,other',
                'date_of_birth' => 'required|date',
                'userTypes_id' => 'required|exists:userTypes,id',
            ];

            // Add conditional validation for level only if userTypes_id is 1 (student)
            if ($request->userTypes_id == 1) {
                $rules['level'] = 'required|in:100,200,300,400,500,600';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed'
                ], 422);
            }

            // Create user
            $user = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'department' => $request->department,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'userTypes_id' =>  $request->userTypes_id,
            ]);

            // Create student/staff record
            if ($request->userTypes_id == 1) {
                Student::create([
                    'user_id' => $user->id,
                    'level' => $request->level
                ]);
            } else if ($request->userTypes_id == 2) {
                Staff::create([
                    'user_id' => $user->id,
                    'position' => 'New Staff'
                ]);
            }

            DB::commit();

            // Load the relationship
            $user->load($request->userTypes_id == 1 ? 'student' : 'staff');

            return response()->json([
                'message' => 'Registration successful',
                'user' => $user
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Authenticate user and generate token
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed'
                ], 422);
            }

            // Attempt authentication
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid login credentials'
                ], 401);
            }

            // Retrieve authenticated user with relationships
            $user = User::where('email', $request->email)->first();

            // Load the appropriate relationship based on user type
            if ($user->userTypes_id == 1) {
                $user->load('student');
            } else if ($user->userTypes_id == 2) {
                $user->load('staff');
            }

            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout user and revoke token
     */
    public function logout(Request $request)
    {
        try {
            // Revoke the current user's token
            $request->user()->currentAccessToken()->delete();



            return response()->json([
                'message' => 'Successfully logged out'
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
