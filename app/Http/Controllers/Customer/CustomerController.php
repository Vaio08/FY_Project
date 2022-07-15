<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function insurance()
    {
        $data['insurances'] = Insurance::where('customer_id',auth()->user()->id )->get();
        return view('customer.insurances',$data);
    }

    public function payments()
    {
//        $data['payments'] = Payment::with([
//            'insurance' => function($query){
//                $query->where('customer_id',auth()->user()->id)->get();
//            }
//        ])->get();
        $customerID = auth()->user()->id;
        $data['payments'] = DB::select("SELECT * FROM `payments`
                    JOIN insurances ON payments.insurance_id = insurances.id
                    WHERE insurances.customer_id = '$customerID' ");

        return view('customer.payment-history',$data);
    }
}
