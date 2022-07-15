<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceRule extends Model
{
    use HasFactory;

    public function insuranceType(){
        return $this->belongsTo(InsuranceType::class, 'insurance_type_id');
    }

    public function rule(){
        return $this->belongsTo(Rule::class, 'rule_id');
    }
}
