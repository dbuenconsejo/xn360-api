<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchQueueItem extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';
    
    protected $table = 'dispatch_queue_items';
    
    protected $fillable = [
        // Add your fillable fields here
    ];
}
