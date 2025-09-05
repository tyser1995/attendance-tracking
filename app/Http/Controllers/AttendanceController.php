<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\IdPattern;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Store a new attendance record (time in/out).
     */
    public function store(Request $request)
    {
        $request->validate([
            'idnumber' => 'required|string',
        ]);

        $idnumber = $request->idnumber;

        // ✅ Step 1: Validate ID against saved patterns
        $patterns = IdPattern::all();
        $isValid = false;

        foreach ($patterns as $pattern) {
            if (preg_match($pattern->regex, $idnumber)) {
                $isValid = true;
                break;
            }
        }

        if (! $isValid) {
            return response()->json([
                'success' => false,
                'message' => "❌ ID '{$idnumber}' does not match any allowed pattern.",
            ]);
        }

        // ✅ Step 2: Proceed with attendance logging
        $name = "Employee " . $idnumber;

        $logsToday = Attendance::where('idnumber', $idnumber)
            ->where('created_date', today())
            ->count();

        $nextStatus = $logsToday + 1;

        if ($nextStatus > 4) {
            return response()->json([
                'success' => false,
                'message' => '⚠ Already completed 4 logs for today',
            ], 400);
        }

        $attendance = Attendance::logAttendance(
            $idnumber,
            $name,
            $nextStatus
        );

        return response()->json([
            'success' => true,
            'message' => '✅ Attendance logged successfully!',
            'data'    => $attendance,
        ]);
    }



    /**
     * Get today’s attendance logs.
     */
    public function today()
    {
        $logs = Attendance::where('created_date', today())->get();

        return response()->json($logs);
    }

    /**
     * Get attendance logs by employee ID.
     */
    public function byEmployee($idnumber)
    {
        $logs = Attendance::where('idnumber', $idnumber)
                          ->orderBy('created_date', 'desc')
                          ->get();

        return response()->json($logs);
    }
}
