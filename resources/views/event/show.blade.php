@extends('layout.app')

@section('page_title', "View $event->name")

@section('styles')

    <!-- Datatables -->
    <link href="/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <style>
        ul li {
            list-style: none;
        }

        ul li strong {
            font-weight: bold;
            text-transform: uppercase;
        }

        #search {
            width: 100%;
        }
    </style>
    <!-- JS file -->

    <!-- CSS file -->
    <link rel="stylesheet" href="/easyautocomplete/easy-autocomplete.min.css">

    <!-- Additional CSS Themes file - not required-->
    <link rel="stylesheet" href="/easyautocomplete/easy-autocomplete.themes.min.css">
@endsection

@section('scripts')
    <!-- Datatables -->
    <script src="/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="/vendors/jszip/dist/jszip.min.js"></script>
    <script src="/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="/vendors/pdfmake/build/vfs_fonts.js"></script>


    <script src="/easyautocomplete/jquery.easy-autocomplete.min.js"></script>


    <script type="text/javascript">

        $(document).ready(function () {

            $('.dataTable').DataTable();


            var options = {
                url: function (phrase) {
                    return "/api/search?q=" + phrase;
                },
                getValue: "formatted",
                requestDelay: 500,
                list: {
                    onSelectItemEvent: function () {
                        var id = $("#search").getSelectedItemData().id;
                        $.getJSON('/api/alumni/' + id + '&event_id={{ $event->id }}')
                            .done(function (data) {
                                if (data.status === 'success') {

                                    $('#search-data').empty();

                                    if (data.alumnus) {
                                        var id = data.alumnus.id;

                                        for (key in data.alumnus) {
                                            /**
                                             * Output:
                                             *  tr
                                             *      td strong $x
                                             *      td $y
                                             */
                                            var $tr = $('<tr>')
                                                .append('<td><strong>' + key + ' </strong></td>')
                                                .append('<td>' + data.alumnus[key] + ' </td>');
                                            $('#search-data').append($tr);
                                        }

                                    }
                                } else if (data.status === 'error') {
                                    alert("Alumni id not found..");
                                }
                                console.log(data);
                            })
                            .fail(function () {
                                alert("There was an error");
                            });
                        // $("#data-holder").val(value).trigger("change");
                    }
                }
            };

            $("#provider-remote").easyAutocomplete(options);
            $("#search").easyAutocomplete(options);


        });


    </script>



    {{--<script>--}}
    {{--$(document).ready(function () {--}}

    {{--$('button.alumni-details-btn').on('click', function (e) {--}}
    {{--var id = $(e.target).data('id');--}}

    {{--alert('here');--}}
    {{--$.getJSON('/api/alumni/' + id)--}}
    {{--.done(function (data) {--}}
    {{--if (data.status === 'success') {--}}
    {{--/**--}}
    {{--* Populate and display modal--}}
    {{--*/--}}
    {{--$('#modal-details').empty();--}}

    {{--if (data.alumnus) {--}}
    {{--var id = data.alumnus.id;--}}
    {{--  $('#edit-btn').attr('href', "/alumni/" + id + "/edit?redirect_to=/event/{{$event->id}}"); --}}
    {{--for (key in data.alumnus) {--}}
    {{--$('#search-data').append(JSON.stringify(data.alumnus[key]));--}}
    {{--}--}}

    {{--}--}}
    {{--} else if (data.status === 'error') {--}}
    {{--alert("Alumni id not found..");--}}
    {{--}--}}
    {{--console.log(data);--}}
    {{--})--}}
    {{--.fail(function () {--}}
    {{--alert("There was an error");--}}
    {{--});--}}

    {{--});--}}
    {{--});--}}
    {{--</script>--}}



@endsection

@section('body')
    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Alumni Details</h4>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <a class="btn btn-primary btn-md pull-right" id="edit-btn"
                        >Edit</a>
                        <br>
                        <ul id="modal-details">
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>

            </div>
        </div>
    </div>

    <div class="x_panel">

        <div class="x_title">
            <h2><i class="fa fa-calendar"></i> {{ $event->name }} </h2>
            <div class="clearfix"></div>
        </div>
        <div class="content">
            <a href="/alumni/create?redirect_to=/event/{{$event->id}}" class="btn btn-primary btn-xs">Register
                Alumni</a>
            <a class="btn btn-primary btn-xs" href="/event/{{$event->id}}/edit">Edit</a>
            <ul class="details">
                <li><span>Event Name:</span> {{$event->name}}</li>
                <li><span>Description:</span> {{$event->description}}</li>
                <li><span>Place:</span> {{$event->place}}</li>
                <li><span>Date:</span> {{$event->date}}</li>
            </ul>
        </div>

    </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-users" aria-hidden="true"></i> Add Attendees</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="search-form">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input id="search" type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Search</button>
                         </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="clearfix"></div>
                <div class="col-xs-6">
                    <table class="table table-condensed ">
                        <tbody id="search-data">
                        <tr>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>


    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-users" aria-hidden="true"></i> Attendees List</h2>
            <a href="/reports/eventreports?event_id={{ $event->id }}" class="pull-right btn btn-success btn-xs">Download
                Excel</a>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table class="table table-hover dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $attendees as $attendee => $value )
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->first_name }}</td>
                        <td>{{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->mobile_num }}</td>
                        <td>
                            <a href="/reports/download-id/{{$value->id}}" type="button"
                               class="pull-left btn btn-info btn-xs">Id</a>
                            <form method="post" action="/event/remove" class="pull-left">
                                {{ csrf_field() }}
                                <input type="hidden" name="event_name" value="{{ $event->name }}">
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="alumni_id" value="{{ $value->id }}">
                                <button class="btn btn-danger btn-xs">Remove</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{--<div class="x_panel">--}}
    {{--<div class="x_title">--}}
    {{--<h2><i class="fa fa-users" aria-hidden="true"></i> Search Alumni</h2>--}}
    {{--<div class="clearfix"></div>--}}
    {{--</div>--}}
    {{--<div class="x_content">--}}

    {{--<table class="table table-hover dataTable">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th>ID</th>--}}
    {{--<th>Name</th>--}}
    {{--<th>Email</th>--}}
    {{--<th>Manage</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach ( $unattended as $unattend => $value )--}}
    {{--<tr>--}}
    {{--<td>{{ $value->id }}</td>--}}
    {{--<td>{{ $value->last_name }}, {{ $value->first_name }}</td>--}}
    {{--<td>{{ $value->email }}</td>--}}
    {{--<td>--}}
    {{--<!-- Large modal -->--}}
    {{--<button type="button" class="btn btn-primary btn-xs alumni-details-btn"--}}
    {{--data-id="{{ $value->id }}">Details--}}
    {{--</button>--}}
    {{--<form style="display:inline" method="post" action="/event/attend">--}}
    {{--{{ csrf_field() }}--}}
    {{--<input type="hidden" name="event_id" value="{{ $event->id }}">--}}
    {{--<input type="hidden" name="alumni_id" value="{{ $value->id }}">--}}
    {{--<button class="btn btn-danger btn-xs">Attend</button>--}}
    {{--</form>--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}

@endsection
