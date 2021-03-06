@extends('layout.app')

@section('page_title', 'Create Event')

@section('styles')

    <link href="/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <style type="text/css">
        .datePicker {
            padding: 0 10px !important;
        }
    </style>

@endsection

@section('scripts')
    <script src="/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
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

            <form class="form-horizontal form-label-left" action="/event" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="Event Name" class="control-label col-md-3 col-sm-3 col-xs-12">Event Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="event_name" type="text" class="form-control" value="{{ old('event_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Name" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{--<input name="event_desciption" type="text" class="form-control">--}}
                        <textarea name="event_description" class="form-control" rows="3">{{ old('event_description') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Place" class="control-label col-md-3 col-sm-3 col-xs-12">Place</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input name="event_place" type="text" class="form-control" value="{{ old('event_place') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Date" class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input name="event_date" type='date' class="form-control" value="{{ old('event_date') }}"/>
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <a href="/event/" type="button" class="btn btn-primary">Cancel</a>
                      <button type="reset" class="btn btn-primary">Reset</button>
                      <button type="submit" class="btn btn-success" value="Submit">Submit</button>
                    </div>
                </div>
            </form>
        </div> <!-- end of x_content -->
    </div> <!-- end of x_panel -->    


@endsection