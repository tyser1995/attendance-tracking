<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use App\Models\Attendance;
use App\Models\IdPattern;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::query();

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_date', [$request->date_from, $request->date_to]);
        } elseif ($request->filled('date_from')) {
            $query->whereDate('created_date', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->whereDate('created_date', '<=', $request->date_to);
        }

        $attendances = $query->orderBy('created_date', 'desc')->get();

        return view('attendance.index', compact('attendances'));
    }


    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('attendance.create', [
            'roles' => $roles
        ]);
    }
    /**
     * Store a new attendance record (time in/out).
     */
    public function store(Request $request)
    {
        $request->validate([
            'idnumber' => 'required|string',
        ]);

        $idnumber = $request->idnumber;

        // $patterns = IdPattern::all();
        // $isValid = false;

        // foreach ($patterns as $pattern) {
        //     if (preg_match($pattern->regex, $idnumber)) {
        //         $isValid = true;
        //         break;
        //     }
        // }

        // if (! $isValid) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => "❌ ID '{$idnumber}' does not match any allowed pattern.",
        //     ]);
        // }

        // Verify if student exists
        $student = Student::where('idnumber', $idnumber)->first();

        if (! $student) {
            return response()->json([
                'success' => false,
                'message' => "❌ No student account found with ID '{$idnumber}'.",
            ]);
        }

        if (! $student) {
            return response()->json([
                'success' => false,
                'message' => "❌ No student account found with ID '{$idnumber}'.",
            ]);
        }

        $today = today();

        // Get last attendance for today
        $lastLog = Attendance::where('idnumber', $idnumber)
            ->where('created_date', $today)
            ->latest('id')
            ->first();

        $nextStatus = $lastLog ? $lastLog->status + 1 : 1;

        if ($nextStatus > 4) {
            return response()->json([
                'success' => false,
                'message' => '⚠ Already completed 4 logs for today',
            ]);
        }

        $statusText = match($nextStatus) {
            1 => "AM Time In",
            2 => "AM Time Out",
            3 => "PM Time In",
            4 => "PM Time Out",
        };

        if (in_array($nextStatus, [1, 3])) {
            // Create new row for AM In or PM In
            $attendance = Attendance::create([
                'idnumber'     => $idnumber,
                'name'         => $student->fn . ' ' . $student->ln,
                'created_date' => $today,
                'status'       => $nextStatus,
                'time_in'      => now()->format('H:i:s'),
            ]);
        } else {
            // Update the last row (for AM Out or PM Out)
            if ($lastLog) {
                $lastLog->update([
                    'status'   => $nextStatus,
                    'time_out' => now()->format('H:i:s'),
                ]);
                $attendance = $lastLog;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "✅ {$statusText} recorded successfully!",
            'data'    => $attendance,
        ]);
    }

    public function edit($id)
    {
       $attendance = Attendance::findOrFail($id);
        return view('attendance.edit', compact('attendance'));
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

    public function delete($id){
        $attendance = Attendance::findOrfail($id);
        $attendance->delete();
        return redirect()->route('attendance_managements')->withError('Deleted Successfully ' .$attendance->name);
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
