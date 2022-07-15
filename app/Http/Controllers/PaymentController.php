<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['payments'] = Payment::orderBy('id', 'desc')->get();
        return view('payment.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'policy_no'      => 'required|numeric',
            'amount'         => 'required|numeric',
            'payment_method' => 'required',
            'payer_name'     => 'required',
            'payer_phone'    => 'required',
        ]);

        //get insurance id by policy no
        $insurance = Insurance::select('id', 'deposited_money')->where('policy_no', '=', $request['policy_no'])->first();

        DB::beginTransaction();
        try {
        $payment                   = new Payment();
        $payment['insurance_id']   = $insurance->id;
        $payment['amount']         = $request['amount'];
        $payment['payment_method'] = $request['payment_method'];
        $payment['payer_name']     = $request['payer_name'];
        $payment['payer_phone']    = $request['payer_phone'];
        $payment->save();

        //update deposited money on insurances table
        $depositedMoney                   = $insurance->deposited_money + $request['amount'];
        $insuranceUpdate                  = Insurance::findOrFail($insurance->id);
        $insuranceUpdate->deposited_money = $depositedMoney;

        $insuranceUpdate->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            Alert::error('Error', 'Something went wrong please try again some thing later');
            return redirect()->back();
        }

        Alert::success('Congrats', 'Payment successful');
        return redirect()->route('payment.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Payment $payment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Payment $payment
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payment      $payment
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Payment $payment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
