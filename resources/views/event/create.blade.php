@extends('layout.app')

@section('page_title', 'Create Event')

@section('page_heading', 'Create Event')

@section('styles')

    <link href="{{ URL::asset('/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <style type="text/css">
        .datePicker {
            padding: 0 10px !important;
        }
    </style>

@endsection

@section('scripts')
    <script src="{{ URL::asset('/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('.datePicker').datetimepicker({
                format: 'MM-DD-YYYY'
            });
        });

    </script>
@endsection


@section('body')
    <div class="x_panel">
        <div class="x_title">
            <h2>Create Event</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div> <!-- end of x_title -->
        
        <div class="x_content">

            <form class="form-horizontal form-label-left" action="/event/" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="Event Name" class="control-label col-md-3 col-sm-3 col-xs-12">Event Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="event_name" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Place" class="control-label col-md-3 col-sm-3 col-xs-12">Place</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="event_place" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Date" class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input name="event_date" type='text' class="form-control" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="button" class="btn btn-primary">Cancel</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
                      <button type="submit" class="btn btn-success" value="Submit">Submit</button>
                    </div>
                </div>
            </form>
        </div> <!-- end of x_content -->
    </div> <!-- end of x_panel -->    


@endsection