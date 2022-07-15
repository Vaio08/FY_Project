<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCategory;
use App\Models\InsuranceType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InsuranceTypeController extends Controller
{
    public function index()
    {
        $data['insuranceTypes'] = InsuranceType::latest()->get();

        return view('insuranceType.index', $data);
    }

    public function create()
    {
        $categories = InsuranceCategory::orderBy('name')->get();
        return view('insuranceType.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'insuranceCategory' => 'required',
            'name'              => [
                'required',
                'unique:insurance_types,type_name,' . $request['name'] . ',id,insurance_category_id,' . $request['insuranceCategory']
            ],
            'min_amount'        => 'required|numeric',
            'max_amount'        => 'required|numeric',
        ]);

        $insuranceType                        = new InsuranceType();
        $insuranceType->insurance_category_id = $request['insuranceCategory'];
        $insuranceType->type_name             = $request['name'];
        $insuranceType->min_amount            = $request['min_amount'];
        $insuranceType->max_amount            = $request['max_amount'];

        if ($insuranceType->save()) {
            Alert::success('Success', 'New Insurance Type added successfully');
            return redirect()->route('insuranceType.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    public function edit(InsuranceType $insuranceType)
    {
        $categories = InsuranceCategory::orderBy('id')->get();
        return view('insuranceType.edit', compact('insuranceType', 'categories'));
    }

    public function update(Request $request, InsuranceType $insuranceType)
    {
        $request->validate([
            'insuranceCategory' => 'required',
            'name'              => 'required|max:40',
            'min_amount'        => 'required|numeric',
            'max_amount'        => 'required|numeric',
        ]);
        $insuranceTypeName = InsuranceType::select('type_name')
                                        ->where('insurance_category_id', '=', $request->insuranceCategory)
                                        ->where('type_name', '=', $request->name)
                                        ->first();

        if ($insuranceTypeName != null) {
            return redirect()->back()->with('exits_name', 'This insurance Type already exits!');
        }

        $insuranceType                        = InsuranceType::findOrFail($insuranceType->id);
        $insuranceType->insurance_category_id = $request['insuranceCategory'];
        $insuranceType->type_name             = $request['name'];
        $insuranceType->min_amount            = $request['min_amount'];
        $insuranceType->max_amount            = $request['max_amount'];

        if ($insuranceType->save()) {
            Alert::success('Success', 'Insurance Type Updated successfully');
            return redirect()->route('insuranceType.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InsuranceType::destroy($id);

        Alert::success('Success', 'Insurance Type deleted successfully');

        return redirect()->route('insuranceType.index');
    }
}
