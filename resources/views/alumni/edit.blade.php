@extends('layout.app')

@section('page_title',"Edit {{ $alumni->first_name }} {{ $alumni->last_name }}")

@section('styles')

    <link href="/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <style type="text/css">
        .datePicker {
            padding: 0 10px !important;
        }

        .for-ordination {
            display: none;
        }
    </style>

@endsection

@section('scripts')
    <script src="/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            $("#alumni_type > label.ord-lbl").click(function (e) {
                e.preventDefault();
                var yes = confirm('Confirm alumni is Ordained');
                if (yes) {
                    $(".for-ordination").show();
                    $(".for-lay").hide();
                }
            });
            $("#alumni_type > label.lay-lbl").click(function (e) {
                e.preventDefault();
                var yes = confirm('Confirm alumni is Lay');
                if (yes) {
                    $(".for-lay").show();
                    $(".for-ordination").hide();
                }
            });

            @if($alumni->alumni_type === 'ordained')
            $(".for-ordination").show();
            $(".for-lay").hide();

            @else
                 $(".for-lay").show();
            $(".for-ordination").hide();
            @endif

        });

    </script>
@endsection

@section('body')

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-calendar"></i> Edit {{ $alumni->first_name }} {{ $alumni->last_name }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <form class="form-horizontal form-label-left" action="/alumni/update}" method="POST">
                <input type="hidden" name="id" value="{{ $alumni->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="alumni_type" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default {{ $alumni->alumni_type === 'ordained' ? 'lay' :  ''}} lay-lbl"
                                   data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input checked type="radio" name="alumni_type" value="Lay"> &nbsp; Lay &nbsp;
                            </label>
                            <label class="btn btn-default ord-lbl {{ $alumni->alumni_type === 'ordained' ? 'active' :  ''}}"
                                   data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="alumni_type" value="Ordained"> Ordained
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="First Name" class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->first_name}}" name="fName" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Last Name" class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->last_name}}" name="lName" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Nickname" class="control-label col-md-3 col-sm-3 col-xs-12">Nickname</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="nickname" type="text" class="form-control" value="{{ $alumni->nickname }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bec" class="control-label col-md-3 col-sm-3 col-xs-12">BEC</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="bec" type="text" class="form-control" value="{{ $alumni->bec }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="batch_year" class="control-label col-md-3 col-sm-3 col-xs-12">Batch Year</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="batch_year" type="text" class="form-control" value="{{ $alumni->batch_year }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Ordination" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input value="{{ date_format(date_create($alumni->birthdate), 'm-d-y')}}" name="birthdate"
                               type='text' class="form-control"/>
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group for-ordination">
                    <label for="Diocese" class="control-label col-md-3 col-sm-3 col-xs-12">Diocese</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->diocese}}" name="diocese" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group for-ordination">
                    <label for="Ordination" class="control-label col-md-3 col-sm-3 col-xs-12">Ordination Date</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input value="{{ date_format(date_create($alumni->ordination), 'm-d-y')}}" name="ordination"
                               type='text' class="form-control"/>
                        <span class="input-group-addon">
                           <span name="ordination" class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group for-lay">
                    <label for="Years in San Jose" class="control-label col-md-3 col-sm-3 col-xs-12">Years in San
                        Jose</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->years_in_sj}}" name="yrs_sj" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->address}}" name="address" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Telephone" class="control-label col-md-3 col-sm-3 col-xs-12">Telephone</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->telephone_num}}" name="telephone" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Fax" class="control-label col-md-3 col-sm-3 col-xs-12">Fax</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->fax_num}}" name="fax" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Mobile" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->mobile_num}}" name="mobile" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$alumni->email}}" name="email" type="email" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a type="button" class="btn btn-primary" href="/alumni/{{$alumni->id}}">Cancel</a>
                        <a type="reset" class="btn btn-primary">Reset</a>
                        <button type="submit" class="btn btn-success" value="Submit">Update Changes</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


@endsection