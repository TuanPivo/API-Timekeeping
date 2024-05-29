<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    //lấy danh sách check của tất cả user
    public function index(){
        return Attendance::all();
    }

    //lấy danh sách check của user cụ thể
    public function show($id){
        return Attendance::findOrFail($id);
    }
    
    // check in và check out
    public function attendance( $type)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $isCheckIn = $type === 'checkIn';

        $attendance = [
            'user_id' => $user->id,
            'date' => now()->toDateString(),
        ];
        if($isCheckIn){
            $attendance['check_in'] = now();
            $message = 'check in success';
        }else{
            $attendance['check_out'] = now();
            $message = 'check out success';
        }
        Attendance::create($attendance);

        return response()->json(['message' => $message], 200);
    }

}
