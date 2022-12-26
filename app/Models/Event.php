<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'city',
    //     'description',
    //     'private'
    // ];
    protected $casts = [
        'items' => 'array'
    ];
    protected $dates = [
        'date'
    ];

    public function user()
    {
        return $this->BelongsTo('App\Models\User');
    }
}
