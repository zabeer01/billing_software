<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'url', 'bill','end_date',
    ];

    public function customers()
    {
    return $this->belongsToMany(Customer::class);
    }
}
