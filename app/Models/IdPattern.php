<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdPattern extends Model
{
    use HasFactory;

    protected $fillable = ['pattern', 'regex', 'status'];

    // Helper method to set active and deactivate others
    public function setActive()
    {
        // Deactivate all
        self::query()->update(['status' => 'inactive']);

        // Activate this one
        $this->update(['status' => 'active']);
    }
}
