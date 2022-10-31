<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id']; 
    
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Worker::class);
    }

}
