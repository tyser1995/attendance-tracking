<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'idnumber',
        'name',
        'time_in',
        'time_out',
        'created_date',
        'status',
    ];

    /**
     * Quick helper to log attendance
     *
     * @param string $idnumber
     * @param string $name
     * @param int $status (1 = In AM, 2 = Out AM, 3 = In PM, 4 = Out PM)
     * @return \App\Models\Attendance
     */
    public static function logAttendance($idnumber, $name, $status)
    {
        return self::create([
            'idnumber'     => $idnumber,
            'name'         => $name,
            'time_in'      => in_array($status, [1, 3]) ? now()->format('H:i:s') : null,
            'time_out'     => in_array($status, [2, 4]) ? now()->format('H:i:s') : null,
            'status'       => $status,
            'created_date' => today(),
        ]);
    }
}
