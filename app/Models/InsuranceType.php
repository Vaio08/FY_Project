<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceType extends Model
{
    use HasFactory;

    public function insuranceCategory(){
        return $this->belongsTo(InsuranceCategory::class, 'insurance_category_id');
    }

    public function insuranceRules(){
        return $this->hasMany(InsuranceRule::class,'insurance_type_id');
    }

    public function insurances(){
        return $this->hasMany(Insurance::class,'insurance_type_id');
    }
}
