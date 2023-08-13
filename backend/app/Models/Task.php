<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'created_for',
        'title',
        'description',
        'deadline',
        'status'
    ];
}
