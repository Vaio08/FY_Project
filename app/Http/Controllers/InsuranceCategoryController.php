<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InsuranceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['insuranceCategory'] = InsuranceCategory::latest()->get();

        return view('insuranceCategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insuranceCategory.create');
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
            'name' => 'required|max:40|unique:insurance_categories',
        ]);

        $insurance       = new InsuranceCategory();
        $insurance->name = $request['name'];

        if ($insurance->save()) {
            Alert::success('Success', 'New Insurance Category added successfully');
            return redirect()->route('insuranceCategory.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(InsuranceCategory $insuranceCategory)
    {
        return view('insuranceCategory.edit', compact('insuranceCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsuranceCategory $insuranceCategory)
    {
        $request->validate([
            'name' => 'required|max:40|unique:insurance_categories,name,' . $insuranceCategory->id,
        ]);

        $insuranceCategory       = InsuranceCategory::findOrFail($insuranceCategory->id);
        $insuranceCategory->name = $request['name'];

        if ($insuranceCategory->save()) {
            Alert::success('Success', 'Insurance Category Updated successfully');
            return redirect()->route('insuranceCategory.index');
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
        InsuranceCategory::destroy($id);

        Alert::success('Success', 'Insurance Category deleted successfully');

        return redirect()->route('insuranceCategory.index');
    }
}
