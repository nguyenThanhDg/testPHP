<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Class_S extends Model
{
    use HasFactory;
    protected $table = 'class';
    protected $fillable = [
        'name'
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
