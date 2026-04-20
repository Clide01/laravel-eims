<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User; // Make sure to add this if it's missing!

class Employee extends Model
{
    protected $fillable = [
        'user_id', // Make sure user_id is in your fillable array!
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthdate',
        'address',
        'contact_number',
        'department_id',
        'position_id',
        'employment_status'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    // Add this new relationship!
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function performances()
    {
        return $this->hasMany(Performance::class);
    }
}