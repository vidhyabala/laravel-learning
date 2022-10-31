<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * Get the address associated with the user.
     */
    public function address()
    {
        return $this->hasOne(Address::class,'employee_id');
    }
}
