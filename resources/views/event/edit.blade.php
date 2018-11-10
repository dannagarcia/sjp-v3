@extends('layout.app')

@section('page_title', "Edit $event->name")

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
            <h2>Edit {{$event->name}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div> <!-- end of x_title -->
        
        <div class="x_content">

            <form class="form-horizontal form-label-left" action="/event/update" method="POST">
                <input type="hidden" name="id" value="{{ $event->id }}">
                
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                
                <div class="form-group">
                    <label for="Event Name" class="control-label col-md-3 col-sm-3 col-xs-12">Event Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input value="{{$event->name}}" name="event_name" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{--<input name="event_desciption" type="text" class="form-control">--}}
                        <textarea name="event_description" class="form-control" rows="3">{{$event->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Place" class="control-label col-md-3 col-sm-3 col-xs-12">Place</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input value="{{$event->place}}" name="event_place" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Event Date" class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                    <div class='col-md-6 col-sm-6 col-xs-12 input-group date datePicker'>
                        <input value="{{$event->date}}" name="event_date" type='date' class="form-control" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <a href="/event/{{$event->id}}" type="button" class="btn btn-primary">Cancel</a>
                      <button type="submit" class="btn btn-success" value="Submit">Submit</button>
                    </div>
                </div>
            </form>
        </div> <!-- end of x_content -->
    </div> <!-- end of x_panel -->  

@endsection