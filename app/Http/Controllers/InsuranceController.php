<?php

namespace App\Http\Controllers;

use App\Models\CarInsuranceDetail;
use App\Models\HealthInsuranceDetail;
use App\Models\Insurance;
use App\Models\InsuranceCategory;
use App\Models\InsuranceType;
use App\Models\LifeInsuranceDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['insurances'] = Insurance::latest()->get();
        return view('insurance.index', $data);
    }

    public function selectInsuranceType()
    {
        $data['insuranceCategories'] = InsuranceCategory::orderBy('id')->get();
        return view('insurance.selectInsurance', $data);
    }

    public function checkInsurance(Request $request)
    {
        $data['insuranceTypes'] = InsuranceType::where('insurance_category_id', $request['insuranceType'])->get();
        $data['users']          = User::where('role',3)->get();

        if ($request['insuranceType'] == 3) {
            return view('insurance.carInsuranceCreate', $data);
        }
        if ($request['insuranceType'] == 2) {
            return view('insurance.healthInsuranceCreate', $data);
        }
        if ($request['insuranceType'] == 1) {
            return view('insurance.lifeInsuranceCreate', $data);
        }
    }

    public function lifeInsuranceCreate(Request $request)
    {

        if ($request['insuranceType'] != null) {
            $insuranceType = $request['insuranceType'];

            //checking insurance amount for particular insurance type
            $insuranceAmount = InsuranceType::select('min_amount', 'max_amount')
                                            ->where('id', '=', $insuranceType)
                                            ->first();

            if ($request['insurance_amount'] < $insuranceAmount['min_amount']) {
                return redirect()->back()->with('min_error', 'fulfill min amount!');
            } else if ($request['insurance_amount'] > $insuranceAmount->max_amount) {
                return redirect()->back()->with('max_amount_error', 'fulfill max amount!');
            }

            //get age from date of birth
            $dateOfBirth = $request->dob;
            $age         = Carbon::parse($dateOfBirth)->age;

            // query for find-out the minimum age from database
            $minimumAgeQuery = DB::select("SELECT value FROM `insurance_rules`
                        JOIN rules ON insurance_rules.rule_id = rules.id
                        WHERE rules.name = 'Min_age'
                        AND insurance_rules.insurance_type_id = '$insuranceType'");

            if ($minimumAgeQuery != null) {
                $min_age = $minimumAgeQuery[0]->value;
                if ($age < $min_age) {
                    return redirect()->back()->with('min_age_error', "The age must be at least $min_age years old!");
                }
            }

            // query for find-out the maximum age from database
            $maximumAgeQuery = DB::select("SELECT value FROM `insurance_rules`
                        JOIN rules ON insurance_rules.rule_id = rules.id
                        WHERE rules.name = 'Max_age'
                        AND insurance_rules.insurance_type_id = '$insuranceType'");
            if ($maximumAgeQuery != null) {
                $max_age = $maximumAgeQuery[0]->value;
                if ($age > $max_age) {
                    return redirect()->back()->with('max_age_error', "The age must no more then $max_age!");
                }
            }


            $request->validate([
                //insurance info
                'insuranceType'       => 'required|numeric',
                'insurance_amount'    => 'required|numeric',
                'insurance_date'      => 'required|date',
                'mature_date'         => 'required|numeric',
                'agent_id'            => 'required|numeric',

                //customer info
                'name'                => 'required|max:50',
                'email'               => 'required|max:80|unique:users,email',
                'phone'               => 'required|numeric|unique:users,phone',
                'address'             => 'required',
                'customer_identity'   => 'required|numeric',
                'dob'                 => 'required|date',
                'gender'              => 'required',
                'photo'               => 'required|image',

                //nominee info
                'nominee_name'        => 'required|max:50',
                'nominee_relation'    => 'required|max:50',
                'nominee_father'      => 'required|max:50',
                'nominee_mother'      => 'required|max:50',
                'nominee_identity'    => 'required|numeric',
                'insured_person_name' => 'required|max:50',
                'insured_person_nid'  => 'required|numeric',
                'details'             => 'required',
            ]);

            //generate serial number
            $lastPolicyNumberQuery = Insurance::select('policy_no')->orderBy('id', 'desc')->first(); //get last inserted policy number

            if ($lastPolicyNumberQuery == null) {
                $policyNumber = 4001; //check if table is empty then add default one
            } else {
                $policyNumber = $lastPolicyNumberQuery['policy_no'] + 1;
            }

            DB::beginTransaction();
            try {
                $customer_identity = User::where('user_identity', '=', $request['customer_identity'])
                                         ->where('role',4)->first();
                if (!empty($customer_identity)) {
                    $customer = User::findOrFail($customer_identity->id);
                } else {
                    $customer = new User();
                }
                $customer->name              = $request['name'];
                $customer->email             = $request['email'];
                $customer->phone             = $request['phone'];
                $customer->address           = $request['address'];
                $customer->password          = Hash::make(123456);
                $customer->user_identity     = $request['customer_identity'];
                $customer->dob               = $request['dob'];
                $customer->gender            = $request['gender'];
                $customer->role              = 4;

                //save image on public folder
                $file      = $request->file('photo');
                $file_name = base64_encode($request['customer_identity']) . '.' . $file->getClientOriginalExtension();
                $path      = 'images/customer';
                $file->move($path, $file_name);
                $customer->image = $path . '/' . $file_name;

                $customer->save();

                //insurance
                $insurance                    = new Insurance();
                $insurance->customer_id       = $customer->id;
                $insurance->insurance_type_id = $request['insuranceType'];
                $insurance->policy_no         = $policyNumber;
                $insurance->insurance_amount  = $request['insurance_amount'];
                $insurance->insurance_date    = $request['insurance_date'];
                $insurance->mature_date       = date("Y-m-d", strtotime("+$request->mature_date year", strtotime($request->insurance_date)));;
                $insurance->agent_id = $request['agent_id'];

                $insurance->save();

                //insurance details
                $LInsuranceDetails                      = new LifeInsuranceDetail();
                $LInsuranceDetails->insurance_id        = $insurance->id;
                $LInsuranceDetails->nominee_name        = $request['nominee_name'];
                $LInsuranceDetails->nominee_relation    = $request['nominee_relation'];
                $LInsuranceDetails->nominee_father      = $request['nominee_father'];
                $LInsuranceDetails->nominee_mother      = $request['nominee_mother'];
                $LInsuranceDetails->nominee_identity    = $request['nominee_identity'];
                $LInsuranceDetails->ensured_person_name = $request['insured_person_name'];
                $LInsuranceDetails->ensured_person_nid  = $request['insured_person_nid'];
                $LInsuranceDetails->details             = $request['details'];

                $LInsuranceDetails->save();
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error($exception->getMessage());
                Alert::error('Error', $exception->getMessage());
                return redirect()->back();
            }

            Alert::success('Congrats', 'New Life Insurance Successfully Created');
            return redirect()->route('insurance.index');
        } else {
            return redirect()->back()->with('insurance_type_select_error', "You must have to select insurance type");
        }
    }

    public function carInsuranceCreate(Request $request)
    {
        if ($request['insuranceType'] != null) {
            $insuranceType = $request['insuranceType'];

            //checking insurance amount for particular insurance type
            $insuranceAmount = InsuranceType::select('min_amount', 'max_amount')
                                            ->where('id', '=', $insuranceType)
                                            ->first();

            if ($request['insurance_amount'] < $insuranceAmount['min_amount']) {
                return redirect()->back()->with('min_error', 'fulfill min amount!');
            } else if ($request['insurance_amount'] > $insuranceAmount->max_amount) {
                return redirect()->back()->with('max_amount_error', 'fulfill max amount!');
            }

            //generate serial number
            $lastPolicyNumberQuery = Insurance::select('policy_no')->orderBy('id', 'desc')->first(); //get last inserted policy number

            if ($lastPolicyNumberQuery == null) {
                $policyNumber = 4001; //check if table is empty then add default one
            } else {
                $policyNumber = $lastPolicyNumberQuery['policy_no'] + 1;
            }

            $request->validate([
                //insurance info
                'insuranceType'     => 'required|numeric',
                'insurance_amount'  => 'required|numeric',
                'insurance_date'    => 'required|date',
                'mature_date'       => 'required|numeric',
                'agent_id'          => 'required|numeric',

                //customer info
                'name'              => 'required|max:50',
                'email'             => 'required|max:80',
                'phone'             => 'required|numeric',
                'address'           => 'required',
                'customer_identity' => 'required|numeric',
                'dob'               => 'required|date',
                'gender'            => 'required',
                'photo'             => 'required|image',

                //vehicle info
                'vehicle_model'     => 'required|max:50',
                'year'              => 'required|max:50',
                'licence_number'    => 'required|max:50',
                'details'           => 'required',
            ]);

            DB::beginTransaction();
            try {
                $customer_identity = User::where('user_identity', '=', $request['customer_identity'])
                                         ->where('role',4)->first();
                if (!empty($customer_identity)) {
                    $customer = User::findOrFail($customer_identity->id);
                } else {
                    $customer = new User();
                }
                $customer->name              = $request['name'];
                $customer->email             = $request['email'];
                $customer->phone             = $request['phone'];
                $customer->address           = $request['address'];
                $customer->password          = bcrypt(123456);
                $customer->user_identity     = $request['customer_identity'];
                $customer->dob               = $request['dob'];
                $customer->gender            = $request['gender'];
                $customer->role              = 4;

                //save image on public folder
                $file      = $request->file('photo');
                $file_name = base64_encode($request['customer_identity']) . '.' . $file->getClientOriginalExtension();
                $path      = 'images/customer';
                $file->move($path, $file_name);
                $customer->image = $path . '/' . $file_name;

                $customer->save();

                //insurance
                $insurance                    = new Insurance();
                $insurance->customer_id       = $customer->id;
                $insurance->insurance_type_id = $request['insuranceType'];
                $insurance->policy_no         = $policyNumber;
                $insurance->insurance_amount  = $request['insurance_amount'];
                $insurance->insurance_date    = $request['insurance_date'];
                $insurance->mature_date       = date("Y-m-d", strtotime("+$request->mature_date month", strtotime($request['insurance_date'])));
                $insurance->agent_id          = $request['agent_id'];

                $insurance->save();

                //insurance details
                $CInsuranceDetails                 = new CarInsuranceDetail();
                $CInsuranceDetails->insurance_id   = $insurance->id;
                $CInsuranceDetails->vehicle_model  = $request['vehicle_model'];
                $CInsuranceDetails->year           = $request['year'];
                $CInsuranceDetails->licence_number = $request['licence_number'];
                $CInsuranceDetails->details        = $request['details'];

                $CInsuranceDetails->save();
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error($exception->getMessage());
                Alert::error('Error', 'Something went wrong please try again some thing later');
                return redirect()->back();
            }

            Alert::success('Congrats', 'New Car Insurance Successfully Created');
            return redirect()->route('insurance.index');
        } else {
            return redirect()->back()->with('insurance_type_select_error', "You must have to select insurance type");
        }
    }

    public function healthInsuranceCreate(Request $request)
    {
        if ($request['insuranceType'] != null) {
            $insuranceType = $request['insuranceType'];

            //checking insurance amount for particular insurance type
            $insuranceAmount = InsuranceType::select('min_amount', 'max_amount')
                                            ->where('id', '=', $insuranceType)
                                            ->first();

            if ($request['insurance_amount'] < $insuranceAmount['min_amount']) {
                return redirect()->back()->with('min_error', 'fulfill min amount!');
            } else if ($request['insurance_amount'] > $insuranceAmount->max_amount) {
                return redirect()->back()->with('max_amount_error', 'fulfill max amount!');
            }

            //get age from date of birth
            $dateOfBirth = $request->dob;
            $age         = Carbon::parse($dateOfBirth)->age;

            // query for find-out the minimum age from database
            $minimumAgeQuery = DB::select("SELECT value FROM `insurance_rules`
                        JOIN rules ON insurance_rules.rule_id = rules.id
                        WHERE rules.name = 'Min_age'
                        AND insurance_rules.insurance_type_id = '$insuranceType'");

            if ($minimumAgeQuery != null) {
                $min_age = $minimumAgeQuery[0]->value;
                if ($age < $min_age) {
                    return redirect()->back()->with('min_age_error', "The age must be at least $min_age years old!");
                }
            }

            // query for find-out the maximum age from database
            $maximumAgeQuery = DB::select("SELECT value FROM `insurance_rules`
                        JOIN rules ON insurance_rules.rule_id = rules.id
                        WHERE rules.name = 'Max_age'
                        AND insurance_rules.insurance_type_id = '$insuranceType'");
            if ($maximumAgeQuery != null) {
                $max_age = $maximumAgeQuery[0]->value;
                if ($age > $max_age) {
                    return redirect()->back()->with('max_age_error', "The age must no more then $max_age!");
                }
            }

            // query for find-out the maximum time for insurance from database
            $maximumTimeQuery = DB::select("SELECT value FROM `insurance_rules`
                        JOIN rules ON insurance_rules.rule_id = rules.id
                        WHERE rules.name = 'Max_time'
                        AND insurance_rules.insurance_type_id = '$insuranceType'");
            if ($maximumTimeQuery != null) {
                $max_time = $maximumTimeQuery[0]->value;
                if ($request['mature_date'] > $max_time) {
                    return redirect()->back()->with('max_time_error', "The time must no more then $max_time!");
                }
            }

            //occupation check
            if ($request['occupation'] != null) {
                $occupationQuery = DB::select("SELECT value FROM `insurance_rules`
                        JOIN rules ON insurance_rules.rule_id = rules.id
                        WHERE rules.name = 'Occupation'
                        AND insurance_rules.insurance_type_id = '$insuranceType'");
                $occupations     = explode(",", $occupationQuery[0]->value);

                if (in_array(strtolower($request['occupation']), $occupations)) {
                    return redirect()->back()->with('occupation_error', "Sorry This occupation not allowed!");
                }
            }

            //generate serial number
            $lastPolicyNumberQuery = Insurance::select('policy_no')->orderBy('id', 'desc')->first(); //get last inserted policy number

            if ($lastPolicyNumberQuery == null) {
                $policyNumber = 4001; //check if table is empty then add default one
            } else {
                $policyNumber = $lastPolicyNumberQuery['policy_no'] + 1;
            }

            $request->validate([
                //insurance info
                'insuranceType'     => 'required|numeric',
                'insurance_amount'  => 'required|numeric',
                'insurance_date'    => 'required|date',
                'mature_date'       => 'required|numeric',
                'agent_id'          => 'required|numeric',

                //customer info
                'name'              => 'required|max:50',
                'email'             => 'required|max:80',
                'phone'             => 'required|numeric',
                'address'           => 'required',
                'customer_identity' => 'required|numeric',
                'occupation'        => 'required',
                'dob'               => 'required|date',
                'gender'            => 'required',
                'photo'             => 'required|mimes:jpg,png,jpeg',

                'insured_person_name' => 'required|max:50',
                'insured_person_nid'  => 'required|numeric',
                'details'             => 'required',
            ]);

            DB::beginTransaction();
            try {
                $customer_identity = User::where('user_identity', '=', $request['customer_identity'])
                    ->where('role',4)->first();

                if (!empty($customer_identity)) {
                    $customer = User::findOrFail($customer_identity->id);
                } else {
                    $customer = new User();
                }
                $customer->name              = $request['name'];
                $customer->email             = $request['email'];
                $customer->phone             = $request['phone'];
                $customer->address           = $request['address'];
                $customer->password          = bcrypt(123456);
                $customer->user_identity     = $request['customer_identity'];
                $customer->dob               = $request['dob'];
                $customer->gender            = $request['gender'];
                $customer->role              = 4;

                //save image on public folder
                $file      = $request->file('photo');
                $file_name = base64_encode($request['customer_identity']) . '.' . $file->getClientOriginalExtension();
                $path      = 'images/customer';
                $file->move($path, $file_name);
                $customer->image = $path . '/' . $file_name;

                $customer->save();

                //insurance
                $insurance                    = new Insurance();
                $insurance->customer_id       = $customer->id;
                $insurance->insurance_type_id = $request['insuranceType'];
                $insurance->policy_no         = $policyNumber;
                $insurance->insurance_amount  = $request['insurance_amount'];
                $insurance->insurance_date    = $request['insurance_date'];
                $insurance->mature_date       = date("Y-m-d", strtotime("+$request->mature_date month", strtotime($request['insurance_date'])));
                $insurance->agent_id          = $request['agent_id'];

                $insurance->save();

                //insurance details
                $HInsuranceDetails                      = new HealthInsuranceDetail();
                $HInsuranceDetails->insurance_id        = $insurance->id;
                $HInsuranceDetails->ensured_person_name = $request['insured_person_name'];
                $HInsuranceDetails->ensured_person_nid  = $request['insured_person_nid'];
                $HInsuranceDetails->details             = $request['details'];

                $HInsuranceDetails->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error($exception->getMessage());
                Alert::error('Error', 'Something went wrong please try again some time later');
                return redirect()->back();
            }

            Alert::success('Congrats', 'New Health Insurance Successfully Created');
            return redirect()->route('insurance.index');
        } else {
            return redirect()->back()->with('insurance_type_select_error', "You must have to select insurance type");
        }
    }

    public function insuranceDeedPrint($id)
    {
        $insurance         = Insurance::findOrFail($id);
        $insuranceCategory = $insurance->insuranceType->insuranceCategory->name;
        if ($insuranceCategory == 'Life') {
            $insuranceDetails = LifeInsuranceDetail::where('insurance_id', '=', $id)->first();
            return view('insurance.insurancePrint', compact(['insurance', 'insuranceDetails', 'insuranceCategory']));
        } elseif ($insuranceCategory == 'Car') {
            $insuranceDetails = CarInsuranceDetail::where('insurance_id', '=', $id)->first();
            return view('insurance.insurancePrint', compact(['insurance', 'insuranceDetails', 'insuranceCategory']));
        } elseif ($insuranceCategory == 'Health') {
            $insuranceDetails = HealthInsuranceDetail::where('insurance_id', '=', $id)->first();
            return view('insurance.insurancePrint', compact(['insurance', 'insuranceDetails', 'insuranceCategory']));
        }
    }

    public function insuranceWithdraw()
    {
        $data['insurances'] = Insurance::where('withdraw_status', 0)->get();
        return view('insurance.withdraw.index', $data);
    }

    public function withdraw($id)
    {
        $insurance         = Insurance::findOrFail($id);
        $insuranceCategory = $insurance->insuranceType->insuranceCategory->name;

        if ($insuranceCategory == 'Life') {
            $insuranceDetails = LifeInsuranceDetail::where('insurance_id', '=', $id)->first();
            return view('insurance.withdraw.withdrawInsurance', compact([
                'insurance', 'insuranceDetails', 'insuranceCategory'
            ]));
        } elseif ($insuranceCategory == 'Car') {
            Alert::error('Error', 'Car Insurance cannot withdraw');
            return redirect()->back();
        } elseif ($insuranceCategory == 'Health') {
            $insuranceDetails = HealthInsuranceDetail::where('insurance_id', '=', $id)->first();
            return view('insurance.withdraw.withdrawInsurance', compact([
                'insurance', 'insuranceDetails', 'insuranceCategory'
            ]));
        }
    }

    public function withdrawUpdate(Request $request, $id)
    {
        $request->validate([
            'withdraw_reason' => 'required',
        ]);
        $currentDate = date('Y-m-d');

        $insurance                  = Insurance::findOrFail($id);
        $insurance->withdraw_status = true;
        $insurance->withdraw_reason = $request['withdraw_reason'];
        $insurance->withdraw_date   = $currentDate;

        if ($insurance->save()) {
            Alert::success('Success', 'Insurance withdrawn successfully. Please print the document');
            return redirect()->route('insurance.withdraw.print', $insurance->id);
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    public function insuranceWithdrawPrint($id)
    {
        $insurance         = Insurance::findOrFail($id);
        $insuranceCategory = $insurance->insuranceType->insuranceCategory->name;
        if ($insuranceCategory == 'Life') {
            $insuranceDetails = LifeInsuranceDetail::where('insurance_id', '=', $id)->first();
            return view('insurance.withdraw.withdrawPrint', compact([
                'insurance', 'insuranceDetails', 'insuranceCategory'
            ]));
        } elseif ($insuranceCategory == 'Health') {
            $insuranceDetails = HealthInsuranceDetail::where('insurance_id', '=', $id)->first();
            return view('insurance.withdraw.withdrawPrint', compact([
                'insurance', 'insuranceDetails', 'insuranceCategory'
            ]));
        }
    }

}
