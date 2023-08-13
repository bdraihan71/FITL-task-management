<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function createdFor()
    {
        return $this->hasOne(User::class, 'id', 'created_for');
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_by' => $this->createdBy->name,
            'created_for' => $this->created_for ? $this->createdFor->name : 'not assigned',
            'status' => $this->status,
            'deadline' => $this->deadline ? Carbon::createFromFormat('Y-m-d H:i:s', $this->deadline)->format('Y-m-d g:i a') : 'not assigned',
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
