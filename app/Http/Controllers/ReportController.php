<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showPaymentForm()
    {
        return view('report.payment.index');
    }

    public function paymentReport(Request $request)
    {
        $request->validate([
            'toDate' => 'required',
            'fromDate' => 'required',
        ]);

        $paymentDetails = Payment::whereBetween('created_at',[$request['fromDate'], $request['toDate']])->get();
        $totalAmount = $paymentDetails->sum('amount');


        return view('report.payment.show',compact('paymentDetails','totalAmount','request'));
    }
}
