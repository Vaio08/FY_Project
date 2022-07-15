<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }

    public function agent(){
        return $this->belongsTo(User::class,'agent_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class,'insurance_id');
    }

    public function insuranceType(){
        return $this->belongsTo(InsuranceType::class, 'insurance_type_id');
    }
}
