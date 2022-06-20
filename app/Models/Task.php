<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'is_complete',
        'user_id'
    ];

    //########################################### Relations ################################################
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
