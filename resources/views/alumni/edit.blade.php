@extends('layout.app')

@section('page_title',"Edit")

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

            $("#alumni_type > label.ord-lbl").click(function (e) {
                e.preventDefault();

                $(".for-ordained").show();
                $(".for-lay").hide();
            });
            $("#alumni_type > label.lay-lbl").click(function (e) {
                e.preventDefault();
                $(".for-lay").show();
                $(".for-ordained").hide();
            });

            @if($alumni->alumni_type === 'ordained')
            $('label.ord-lbl').click();
            @elseif($alumni->alumni_type === 'current')
            $('label.current-lbl').click();
            @else
            $('label.lay-lbl').click();
            @endif

            $('#diocese-btn').click(function () {
                $('#diocese').val("Diocese of ").focus();
            });

            $('#archdiocese-btn').click(function () {
                $('#diocese').val("Archdiocese of ").focus();
            });

            $('#others-btn').click(function () {
                $('#diocese').val("").focus();
            });

            $('a[type=reset]').click(function () {
                $('input').val('');
                $('#diocese-types label').removeClass('active');
            });

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
                <input type="hidden" name="redirect_to" value="{{ $redirect }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="alumni_type" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default {{ $alumni->alumni_type === 'ordained' ? 'lay' :  ''}} lay-lbl"
                                   data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input checked type="radio" name="alumni_type" value="lay"> &nbsp; Lay &nbsp;
                            </label>
                            <label class="btn btn-default ord-lbl {{ $alumni->alumni_type === 'ordained' ? 'active' :  ''}}"
                                   data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
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
                        <input required value="{{ old('fName', $alumni->first_name) }}" name="fName" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Last Name" class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input required value="{{ old('lName', $alumni->last_name) }}" name="lName" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Middle Initial" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Initial</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input placeholder="A." name="middle_initial" type="text" class="form-control"
                               value="{{ old('middle_initial', $alumni->middle_initial) }}">
                    </div>
                </div>
                <div class="form-group for-ordained">
                    <label for="title" class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="title" type="text" class="form-control" value="{{ old('title', $alumni->title)  }}"
                               placeholder='"Monsignor", "Father", "Bishop","Cardinal", ...'>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Nickname" class="control-label col-md-3 col-sm-3 col-xs-12">Nickname</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input required name="nickname" type="text" class="form-control"
                               value="{{ old('nickname', $alumni->nickname)  }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bec" class="control-label col-md-3 col-sm-3 col-xs-12">BEC</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="bec" type="text" class="form-control" value="{{ old('bec', $alumni->bec) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="batch_year" class="control-label col-md-3 col-sm-3 col-xs-12">Batch Year</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="batch_year" type="text" class="form-control"
                               value="{{ old('batch_year', $alumni->batch_year) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthdate" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input value="{{ $alumni->birthdate === null ? '' : date_format(date_create($alumni->birthdate), 'm-d-Y')}}"
                               name="birthdate"
                               type='date' class="form-control" placeholder="mm-dd-yyyy"/>
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Diocese Type</label>
                    <div id="diocese-types" class="col-md-6 col-sm-6 col-xs-12" data-toggle="buttons">
                        <label id="diocese-btn"
                               class="btn btn-primary {{ starts_with(strtolower($alumni->diocese), "diocese") ? 'active':'' }}">
                            <input type="radio" class="sr-only" id="viewMode0" value="0" checked="">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="View Mode 0">
                            Diocese
                          </span>
                        </label>
                        <label id="archdiocese-btn"
                               class="btn btn-primary {{ starts_with(strtolower($alumni->diocese), "archdiocese") ? 'active':'' }}">
                            <input type="radio" class="sr-only" id="viewMode1" value="1">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="View Mode 1">
                            Archdiocese
                          </span>
                        </label>
                        <label id="others-btn"
                               class="btn btn-primary {{ !starts_with(strtolower($alumni->diocese), ["archdiocese", "diocese"]) ? 'active':'' }}">
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
                        <input id="diocese" name="diocese" type="text" class="form-control"
                               value="{{ old('diocese', $alumni->diocese) }}"
                               placeholder="">
                    </div>
                </div>
                <div class="form-group for-ordained">
                    <label for="Ordination" class="control-label col-md-3 col-sm-3 col-xs-12">Ordination Date</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input value="{{ $alumni->ordination === null ? '' : date_format(date_create($alumni->ordination), 'm-d-y')}}"
                               name="ordination"
                               type='text' class="form-control" placeholder="mm-dd-yyyy"/>
                        <span class="input-group-addon">
                           <span name="ordination" class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group for-lay">
                    <label for="Years in San Jose" class="control-label col-md-3 col-sm-3 col-xs-12">Years in San
                        Jose</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ old('yrs_sj', $alumni->years_in_sj) }}" name="yrs_sj" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ old('address', $alumni->address) }}" name="address" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Telephone" class="control-label col-md-3 col-sm-3 col-xs-12">Telephone</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ old('telephone', $alumni->telephone_num) }}" name="telephone" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Fax" class="control-label col-md-3 col-sm-3 col-xs-12">Fax</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ old('fax', $alumni->fax_num) }}" name="fax" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Mobile" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ old('mobile', $alumni->mobile_num) }}" name="mobile" type="text"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ old('email', $alumni->email) }}" name="email" type="email"
                               class="form-control">
                    </div>
                </div>
                @foreach($alumni_custom_fields as $alcf)

                    @if($alcf->type === 'textarea')
                        <div class="form-group">
                            <label for="{{ $alcf->id }}"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">{{ $alcf->key }}</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="{{ $alcf->id }}" id="{{ $alcf->id }}"
                                          class="form-control">{{ old($alcf->id, $alumni->{$alcf->id}) }}</textarea>
                            </div>
                        </div>

                    @else
                        <div class="form-group">
                            <label for="{{ $alcf->id }}"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">{{ $alcf->key }}</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="{{ $alcf->id }}" type="text" class="form-control"
                                       value="{{ old($alcf->id, $alumni->{$alcf->id}) }}">
                            </div>
                        </div>
                    @endif

                @endforeach
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