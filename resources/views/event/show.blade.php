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

        #search-data-actions {
            padding: 4% 0;
        }
    </style>

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

    <script src="/vendor/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            var alumniColumnMapping = {
                id: 'System Id',
                first_name: 'First Name',
                last_name: 'Last Name',
                middle_initial: 'Middle Initial',
                title: 'Title',
                nickname: 'Nickname',
                alumni_type: 'Alumni Type',
                bec: 'BEC',
                batch_year: 'Batch Year',
                diocese: 'Diocese',
                birthdate: 'Birthdate',
                ordination: 'Ordination',
                address: 'Address',
                telephone_num: 'Telephone',
                fax_num: 'Fax',
                mobile_num: 'Mobile',
                email: 'Email'
            };

            $('.dataTable').DataTable();

            var functions = {
                fetchAlumnusDetails: function (suggestion) {
                    var id = suggestion.data.id;


                    /**
                     * Called after clicking on a search element
                     */
                    $.getJSON('/api/alumni/' + id + '&event_id={{ $event->id }}')
                        .done(function (data) {
                            if (data.status === 'success') {

                                $('#search-data').empty();
                                $('#search-data').hide();

                                if (data.alumnus) {
                                    var id = data.alumnus.id;

                                    for (key in alumniColumnMapping) {
                                        console.log(key);
                                        /**
                                         * Output:
                                         *  tr
                                         *      td strong $x
                                         *      td $y
                                         */
                                        var val = "";

                                        if (data.alumnus[key]) {
                                            val = data.alumnus[key]
                                        }

                                        /**
                                         * Skip if key is ordination and alumni type is not ordained
                                         */
                                        if(key === 'ordination' && data.alumnus.alumni_type !== 'ordained'){
                                            continue; // skip to next key
                                        }

                                        var $tr = $('<tr>')
                                            .append('<td><strong>' + alumniColumnMapping[key] + ' </strong></td>')
                                            .append('<td>' + val + ' </td>');
                                        $('#search-data').append($tr);
                                    }

                                    /**
                                     * Add action buttons
                                     */
                                    var id = data.alumnus['id']
                                    $('#search-data-actions')
                                        .empty()
                                        .append($('<a class="btn btn-success pull-right" href="/event/attend?alumni_id=' + id + '&event_id={{ $event->id }}">Add as Attendee</a>'))
                                        .append($('<a class="btn btn-warning pull-right" href="/alumni/' + id + '/edit?redirect_to=/event/{{$event->id}}">Edit</a>'));



                                    $([document.documentElement, document.body]).animate({
                                        scrollTop: ($("#search-data-actions").offset().top - 200)
                                    }, 800);

                                    $('#search-data').show(300);


                                }
                            } else if (data.status === 'error') {
                                alert("Alumni id not found..");
                            }
                            console.log(data);
                        })
                        .fail(function (err) {
                            alert("There was an error");
                            console.log(err);
                        });
                    // $("#data-holder").val(value).trigger("change");

                }
            };

            $('#search').autocomplete({
                serviceUrl: '/api/search',
                onSelect: functions.fetchAlumnusDetails,
                showNoSuggestionNotice: true,
                deferRequestBy: 300,
                params: {"event_id": "{{ $event->id }}"}
            });

            /**
             * From redirectTo
             */
            var updateId = "{{ app('request')->input('alumni_id_updated')}}";
            if (updateId) {
                var suggestion = {
                    data: {
                        id: updateId
                    }
                };
                functions.fetchAlumnusDetails(suggestion);
            }

        });


    </script>

@endsection

@section('body')
    @if (Session::has('alumni'))
        <div class="alert alert-success">
            <?php $alumni = session('alumni') ?>
            <?php $name = "{$alumni->first_name} {$alumni->last_name} " ?>
            Update Success. Would you also want to add {{ $name  }} to this event?
            <a href="/event/attend?alumni_id={{ $alumni->id }}&event_id={{ $event->id }}" class="btn btn-primary">Add to
                Event</a>
        </div>

    @endif
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
            <div id="search-form">
                <div class="col-lg-6">
                    {{--<div class="input-group">--}}
                    <input id="search" type="text" class="form-control" placeholder="Search for...">
                    {{--<span class="input-group-btn">--}}
                    {{--<button class="btn btn-default" type="submit">Search</button>--}}
                    {{--</span>--}}
                    {{--</div><!-- /input-group -->--}}
                </div><!-- /.col-lg-6 -->
                <div class="clearfix"></div>
                <div class="col-xs-6">
                    <div id="search-data-actions">

                    </div>
                    <table class="table table-condensed ">
                        <tbody id="search-data">
                        <tr>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-users" aria-hidden="true"></i> Attendees List</h2>
            <a href="/reports/event_report?event_id={{ $event->id }}" class="pull-right btn btn-success btn-xs">Download
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
