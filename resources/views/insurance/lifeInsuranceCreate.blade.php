@extends('layouts.master')
@section('title',"Life insurance Create")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('insurance.index')}}">Insurances</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li>
        <a class="parent-item" href="{{route('selectInsuranceType')}}">Select Insurances</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Life Insurance Create</li>
@endsection
@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Life Insurance Create</header>
                    <button id="panel-button1"
                            class="mdl-button mdl-js-button mdl-button--icon pull-right"
                            data-upgraded=",MaterialButton">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        data-mdl-for="panel-button1">
                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                            here
                        </li>
                    </ul>
                </div>
                <div class="card-body" id="bar-parent1">
                    <form action="{{route('insuranceCreate.life')}}" method="POST" id="form_sample_1"
                          class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group row">
                                <h4 class="control-label col-md-3">Insurance Info</h4>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Insurance Type
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <select class="form-control" name="insuranceType">
                                        <option>Select Insurance Type</option>
                                        @foreach($insuranceTypes as $IT)
                                            <option @if(old('insuranceType') == $IT->id) selected
                                                    @endif value="{{$IT->id}}"> {{$IT->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('insuranceType')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if(session()->has('insurance_type_select_error'))
                                    <div class="text-danger">
                                        {{ session()->get('insurance_type_select_error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Insurance Amount
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="number" min="0" name="insurance_amount" data-required="1"
                                           class="form-control" value="{{ old('insurance_amount') }}" placeholder="Ex:10000"/>
                                </div>
                                @error('insurance_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if(session()->has('min_error'))
                                    <div class="text-danger">
                                        {{ session()->get('min_error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Insurance Date
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="insurance_date" id="insurance_date" data-required="1"
                                           class="form-control" value="{{ old('insurance_date') }}" />
                                </div>
                                @error('insurance_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Numbers of Month for Insurance
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="number" min="0" name="mature_date" data-required="1"
                                           class="form-control" value="{{old('mature_date')}}" placeholder="Ex:5"/>
                                </div>
                                @error('mature_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Agent
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <select class="form-control" name="agent_id">
                                        <option>Select Insurance Type</option>
                                        @foreach($users as $user)
                                            <option @if(old('agent_id') == $user->id) selected
                                                    @endif  value="{{$user->id}}"> {{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('agent_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            {{-- customer Info --}}

                            <hr>
                            <div class="form-group row">
                                <h4 class="control-label col-md-3">Customer Info</h4>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="name" data-required="1"
                                           class="form-control" value="{{ old('name') }}" placeholder="Ex:John Doe"/>
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Email
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="email" name="email" data-required="1"
                                           class="form-control" value="{{old('email')}}" placeholder="Ex:john@email.com"/>
                                </div>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Phone
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="phone" data-required="1"
                                           class="form-control" value="{{old('phone')}}" placeholder="Ex:john@email.com"/>
                                </div>
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Address
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="address" data-required="1"
                                           class="form-control" value="{{old('address')}}" placeholder="Address"/>
                                </div>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">NID/Birth Certificate
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="customer_identity" data-required="1"
                                           class="form-control" value="{{old('customer_identity')}}" placeholder="751080689"/>
                                </div>
                                @error('customer_identity')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Date of Birth
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="dob" id="dob" data-required="1"
                                           class="form-control" value="{{old('dob')}}" />
                                </div>
                                @error('dob')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if(session()->has('max_age_error'))
                                    <div class="text-danger">
                                        {{ session()->get('max_age_error') }}
                                    </div>
                                @endif

                                @if(session()->has('min_age_error'))
                                    <div class="text-danger">
                                        {{ session()->get('min_age_error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Gender
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <select class="form-control" name="gender">
                                        <option value="">Gender...</option>
                                        <option @if(old('gender') == 'male')selected @endif value="male">Male</option>
                                        <option @if(old('gender') == 'female')selected @endif value="female">Female</option>
                                        <option @if(old('gender') == 'other')selected @endif value="other">Other</option>
                                    </select>
                                </div>
                                @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Photo
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="file" name="photo" data-required="1"
                                           class="form-control" value="{{old('photo')}}"/>
                                </div>
                                @error('photo')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Nominee info --}}
                            <hr>
                            <div class="form-group row">
                                <h4 class="control-label col-md-3">Nominee Info</h4>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="nominee_name" data-required="1"
                                           class="form-control" value="{{old('nominee_name')}}" placeholder="Ex:John Doe"/>
                                </div>
                                @error('nominee_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Relation with Nominee
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="nominee_relation" data-required="1"
                                           class="form-control" value="{{old('nominee_relation')}}" placeholder="Son"/>
                                </div>
                                @error('nominee_relation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Father
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="nominee_father" data-required="1"
                                           class="form-control" value="{{old('nominee_father')}}" placeholder="Ex: Jack"/>
                                </div>
                                @error('nominee_father')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Mother
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="nominee_mother" data-required="1"
                                           class="form-control" value="{{old('nominee_mother')}}" placeholder="Ex: Mimc"/>
                                </div>
                                @error('nominee_mother')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">NID/Birth Certificate
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="nominee_identity" data-required="1"
                                           class="form-control" value="{{old('nominee_identity')}}" placeholder="751080689"/>
                                </div>
                                @error('nominee_identity')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Insured Person name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="insured_person_name" data-required="1"
                                           class="form-control" value="{{old('insured_person_name')}}" placeholder="Ex: Mimc"/>
                                </div>
                                @error('insured_person_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Insured Person NID
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="text" name="insured_person_nid" data-required="1"
                                           class="form-control" value="{{old('insured_person_nid')}}" placeholder="751080689"/>
                                </div>
                                @error('insured_person_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Other Details
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <textarea type="text" name="details" data-required="1"
                                              class="form-control" >{{old('details')}}</textarea>
                                </div>
                                @error('details')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <div class="offset-md-3 col-md-9">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <link href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function (){
            let currentDate = new Date();
            $("#insurance_date").datepicker({
                showAnim: 'drop',
                numberOfMonth: 1,
                maxDate: currentDate,
                dateFormat:'yy-mm-dd',
                onClose: function(selectedDate){
                    $('#return').datepicker("option", "maxDate",selectedDate);

                }
            });

            $("#dob").datepicker({
                showAnim: 'drop',
                numberOfMonth: 1,
                maxDate: currentDate,
                dateFormat:'yy-mm-dd',
                onClose: function(selectedDate){
                    $('#return').datepicker("option", "maxDate",selectedDate);

                }
            });
        });
    </script>
@endpush

