<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $primaryKey = 'subject_id';

    protected $fillable = [
        'code',
        'title',
        'unit',
    ];

    public $timestamps = true;
}
