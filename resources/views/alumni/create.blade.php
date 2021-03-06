@extends('layout.app')

@section('page_title', 'Regsiter Alumni')

@section('page_heading', 'Register Alumni')

@section('styles')

    <link href="/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <style type="text/css">
        .datePicker {
            padding: 0 10px !important;
        }

        .for-ordained {
            display: none;
        }
    </style>

@endsection

@section('scripts')
    <script src="/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            /**
             * Event handlers on Nav Tab
             */

            /**
             * Ordained
             */
            $("#alumni_type > label.ord-lbl").click(function (e) {

                e.preventDefault();
                $(".for-ordained").show();
                $(".for-lay").hide();
            });

            /**
             * Lay
             */
            $("#alumni_type > label.lay-lbl").click(function (e) {
                e.preventDefault();
                $(".for-lay").show();
                $(".for-ordained").hide();
            });

            /**
             * Current
             */
            $("#alumni_type > label.current-lbl").click(function (e) {
                e.preventDefault();
                $(".for-lay").show();
                $(".for-ordained").hide();
            });

            /**
             * Event Handler for Diocese type buttons
             */
            $('#diocese-btn').click(function () {
                $('#diocese').val("Diocese of ").focus();
            });

            $('#archdiocese-btn').click(function () {
                $('#diocese').val("Archdiocese of ").focus();
            });

            $('#others-btn').click(function () {
                $('#diocese').val("").focus();
            });

            var oldType = '{{old('alumni_type', 'lay')}}';
            if (oldType === 'current') {
                $('.current-lbl').click();
            } else if (oldType === 'ordained') {
                $('.ord-lbl').click();

            }


        });

    </script>
@endsection


@section('body')
    <div class="x_panel">
        <div class="x_title">
            <h2>Register Alumni</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div> <!-- end of x_title -->

        <div class="x_content">

            <form class="form-horizontal form-label-left" action="/alumni" method="POST">
                <input type="hidden" name="redirect_to" value="{{ $redirect_to }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="alumni_type" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default active lay-lbl" data-toggle-class="btn-primary"
                                   data-toggle-passive-class="btn-default">
                                <input checked type="radio" name="alumni_type" value="lay"> &nbsp; Lay &nbsp;
                            </label>
                            <label class="btn btn-default ord-lbl" data-toggle-class="btn-primary"
                                   data-toggle-passive-class="btn-default">
                                <input type="radio" name="alumni_type" value="ordained"> Ordained
                            </label>
                            <label class="btn btn-default current-lbl" data-toggle-class="btn-primary"
                                   data-toggle-passive-class="btn-default">
                                <input type="radio" name="alumni_type" value="current"> Current
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="First Name" class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input required name="fName" type="text" class="form-control" value="{{ old('fName') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Last Name" class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input required name="lName" type="text" class="form-control" value="{{ old('lName') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Middle Initial" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Initial</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input placeholder="A." name="middle_initial" type="text" class="form-control"
                               value="{{ old('middle_initial') }}">
                    </div>
                </div>
                <div class="form-group for-ordained">
                    <label for="Title" class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="title" type="text" class="form-control" value="{{ old('title') }}"
                               placeholder='"Monsignor", "Father", "Bishop","Cardinal", ...'>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Nickname" class="control-label col-md-3 col-sm-3 col-xs-12">Nickname</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input required name="nickname" type="text" class="form-control" value="{{ old('nickname') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bec" class="control-label col-md-3 col-sm-3 col-xs-12">BEC</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="bec" type="text" class="form-control" value="{{ old('bec') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="batch_year" class="control-label col-md-3 col-sm-3 col-xs-12">Batch Year</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="batch_year" type="text" class="form-control" value="{{ old('batch_year') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Ordination" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input name="birthdate" type='date' class="form-control" value="{{ old('birthdate') }}"
                               placeholder="mm-dd-yyyy"/>
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Diocese Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12" data-toggle="buttons">
                        <label id="diocese-btn" class="btn btn-primary">
                            <input type="radio" class="sr-only" id="viewMode0" value="0" checked="">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="View Mode 0">
                            Diocese
                          </span>
                        </label>
                        <label id="archdiocese-btn" class="btn btn-primary">
                            <input type="radio" class="sr-only" id="viewMode1" value="1">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="View Mode 1">
                            Archdiocese
                          </span>
                        </label>
                        <label id="others-btn" class="btn btn-primary">
                            <input type="radio" class="sr-only" id="viewMode2" value="2">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="View Mode 2">
                            Others
                          </span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Diocese" class="control-label col-md-3 col-sm-3 col-xs-12">Diocese</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="diocese" name="diocese" type="text" class="form-control" value="{{ old('diocese') }}"
                               placeholder="">
                    </div>
                </div>
                <div class="form-group for-ordained">
                    <label for="Ordination" class="control-label col-md-3 col-sm-3 col-xs-12">Ordination Date</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input type='text' class="form-control" name="ordination" value="{{ old('ordination') }}"
                               placeholder="mm/dd/yyyy"
                               />
                        <span class="input-group-addon">
                           <span name="ordination" class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group for-lay">
                    <label for="Years in San Jose" class="control-label col-md-3 col-sm-3 col-xs-12">Years in San
                        Jose</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="yrs_sj" type="text" class="form-control" value="{{ old('yrs_sj') }}">
                    </div>
                </div>
                <div class="form-group for-lay">
                    <label for="occupation" class="control-label col-md-3 col-sm-3 col-xs-12">Occupation</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="occupation" name="occupation" type="text" class="form-control" value="{{ old('occupation') }}"
                               placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="address" type="text" class="form-control" value="{{ old('address') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Telephone" class="control-label col-md-3 col-sm-3 col-xs-12">Telephone</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="telephone" type="text" class="form-control" value="{{ old('telephone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Fax" class="control-label col-md-3 col-sm-3 col-xs-12">Fax</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="fax" type="text" class="form-control" value="{{ old('fax') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Mobile" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="mobile" type="text" class="form-control" value="{{ old('mobile') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>

                @foreach($alumni_custom_fields as $alcf)

                    @if($alcf->type === 'textarea')
                        <div class="form-group">
                            <label for="{{ $alcf->id }}"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">{{ $alcf->key }}</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="{{ $alcf->id }}" id="{{ $alcf->id }}"
                                          class="form-control">{{ old($alcf->id) }}</textarea>
                            </div>
                        </div>

                    @else
                        <div class="form-group">
                            <label for="{{ $alcf->id }}"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">{{ $alcf->key }}</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="{{ $alcf->id }}" type="text" class="form-control"
                                       value="{{ old($alcf->id) }}">
                            </div>
                        </div>
                    @endif

                @endforeach
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="/alumni/" type="button" class="btn btn-primary">Cancel</a>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-success" value="Submit">Submit</button>
                    </div>
                </div>
            </form>
        </div> <!-- end of x_content -->
    </div> <!-- end of x_panel -->


@endsection