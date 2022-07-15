<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rules'] = Rule::latest()->get();

        return view('rule.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40|unique:rules',
        ]);

        $insurance       = new Rule();
        $insurance->name = Str::ucfirst($request['name']);

        if ($insurance->save()) {
            Alert::success('Success', 'New Rule added successfully');
            return redirect()->route('rule.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $rule)
    {
        return view('rule.edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'name' => 'required|max:40|unique:rules,name,' . $rule->id,
        ]);

        $rule       = Rule::findOrFail($rule->id);
        $rule->name = Str::ucfirst($request['name']);

        if ($rule->save()) {
            Alert::success('Success', 'Rule Updated successfully');
            return redirect()->route('rule.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rule::destroy($id);

        Alert::success('Success', 'Rule deleted successfully');
        return redirect()->route('rule.index');
    }
}
