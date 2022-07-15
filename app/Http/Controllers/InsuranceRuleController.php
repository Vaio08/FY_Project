<?php

namespace App\Http\Controllers;

use App\Models\InsuranceRule;
use App\Models\InsuranceType;
use App\Models\Rule;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InsuranceRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['insuranceRules'] = InsuranceRule::latest()->get();

        return view('insuranceRule.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['insuranceTypes'] = InsuranceType::orderBy('type_name')->get();
        $data['rules']          = Rule::orderBy('id')->get();
        return view('insuranceRule.create', $data);
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
            'insuranceType' => 'required',
            'rule_id'       => [
                'required',
                'numeric',
                'unique:insurance_rules,rule_id,' . $request['rule_id'] . ',id,insurance_type_id,' . $request['insuranceType']
            ],
            'value'         => 'required',
        ]);

        $insuranceRule                    = new InsuranceRule();
        $insuranceRule->insurance_type_id = $request['insuranceType'];
        $insuranceRule->rule_id           = $request['rule_id'];
        $insuranceRule->value             = $request['value'];

        if ($insuranceRule->save()) {
            Alert::success('Success', 'New Insurance Rule added successfully');
            return redirect()->route('insuranceRule.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\InsuranceRule $insuranceRule
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(InsuranceRule $insuranceRule)
    {
        $data['insuranceTypes'] = InsuranceType::orderBy('type_name')->get();
        $data['insuranceRule']  = $insuranceRule;
        $data['rules']          = Rule::orderBy('id')->get();
        return view('insuranceRule.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \App\Models\InsuranceRule $insuranceRule
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsuranceRule $insuranceRule)
    {
//        dd($insuranceRule->id);
        $request->validate([
            'insuranceType' => 'required',
            'rule_id'       => [
                'required', 'numeric',
                'unique:insurance_rules,rule_id,' . $request['rule_id'] . ',id,insurance_type_id,' . $request['insuranceType']
            ],
            'value'         => 'required',
        ]);

        $insRule                    = InsuranceRule::findOrFail($insuranceRule->id);
        $insRule->insurance_type_id = $request['insuranceType'];
        $insRule->rule_id           = $request['rule_id'];
        $insRule->value             = $request['value'];

        if ($insRule->save()) {
            Alert::success('Success', 'Insurance Rule Updated successfully');
            return redirect()->route('insuranceRule.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\InsuranceRule $insuranceRule
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InsuranceRule::destroy($id);

        Alert::success('Success', 'Insurance Rule deleted successfully');

        return redirect()->route('insuranceRule.index');
    }
}
