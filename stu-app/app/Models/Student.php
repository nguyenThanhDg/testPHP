<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';
    protected $fillable = [
        'name',
        'class',
        'gender'
    ];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Class_S::class,'class');
    }
}
