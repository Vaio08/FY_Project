<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCategory extends Model
{
    use HasFactory;

    public function insuranceType(){
        return $this->hasMany(InsuranceType::class,'insurance_category_id');
    }
}
