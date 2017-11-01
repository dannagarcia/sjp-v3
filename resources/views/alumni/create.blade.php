@extends('layout.app')

@section('page_title', 'Regsiter Alumni')

@section('page_heading', 'Register Alumni')

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

        $(document).ready(function() {
            $('.datePicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $("#alumni_type > label.ord-lbl").click(function(e) {
                e.preventDefault();
                $( ".for-ordination" ).show();
                $( ".for-lay" ).hide();
            });
            $("#alumni_type > label.lay-lbl").click(function(e) {
                e.preventDefault();
                $( ".for-lay" ).show();
                $( ".for-ordination" ).hide();
            });

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
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div id="alumni_type" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default active lay-lbl" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input checked type="radio" name="alumni_type" value="Lay"> &nbsp; Lay &nbsp;
                        </label>
                        <label class="btn btn-default ord-lbl" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="alumni_type" value="Ordained"> Ordained
                        </label>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="First Name" class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="fName" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Last Name" class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="lName" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Ordination" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input name="birthdate" type='text' class="form-control" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group for-ordination">
                    <label for="Diocese" class="control-label col-md-3 col-sm-3 col-xs-12">Diocese</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="diocese" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group for-ordination">
                    <label for="Ordination" class="control-label col-md-3 col-sm-3 col-xs-12">Ordination Date</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input type='text' class="form-control" name="ordination" />
                        <span class="input-group-addon">
                           <span name="ordination" class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group for-lay">
                    <label for="Years in San Jose" class="control-label col-md-3 col-sm-3 col-xs-12">Years in San Jose</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="yrs_sj" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="address" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Telephone" class="control-label col-md-3 col-sm-3 col-xs-12">Telephone</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="telephone" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Fax" class="control-label col-md-3 col-sm-3 col-xs-12">Fax</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="fax" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Mobile" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="mobile" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="email" type="email" class="form-control">
                    </div>
                </div>
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