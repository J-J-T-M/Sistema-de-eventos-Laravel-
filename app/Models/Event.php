<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

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

    protected $guarded = [
        // td enviado pelo post pode ser atualizado
        // posso colocar campos onde não pode ser atualizados aqui
    ];

    public function user()
    {
        return $this->BelongsTo('App\Models\User');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
