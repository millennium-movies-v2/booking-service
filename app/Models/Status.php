<?php

namespace App\Models;

use Database\Factories\StatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* @property string $id
* @property string $name
**/
class Status extends Model
{
    /** @use HasFactory<StatusFactory> */
    use HasFactory;
    
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'booking_statuses';

    protected $fillable = [
        'name',
    ];
}
