<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'task',
        'description',
        'image_path',
        'image'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
