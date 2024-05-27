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
    public function attendance($type)
    {
        $isCheckIn = $type === 'checkIn';

        $userId = Auth::id();
        $attendance = [
            'user_id' => $userId,
            'date' => now()->toDateString(),
        ];
        if($isCheckIn){
            $attendance['check_in'] = now();
        }else{
            $attendance['check_out'] = now();
        }
        Attendance::create($attendance);

        return response()->json(['message' => 'Check in success'], 200);
    }

}
