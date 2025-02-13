<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
    
    // app/Models/Task.php

protected $fillable = [
    'name',
    'description',
    'is_completed',
    'deadline',
    'priority',
    'list_id',
];
    

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];

    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            default => 'secondary'
        };
    }

    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}