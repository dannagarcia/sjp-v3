@extends('layout.app')

@section('page_title', "View $event->name")

@section('styles')

    <!-- Datatables -->
    <link href="/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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

    <script type="text/javascript">
        $('.dataTable').DataTable();
    </script>

@endsection

@section('body')

    <div class="x_panel">

        <div class="x_title">
            <h2><i class="fa fa-calendar"></i> {{ $event->name }} </h2>
            <div class="clearfix"></div>
        </div>
        <div class="content">
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

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-users" aria-hidden="true"></i> Search Alumni</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table class="table table-hover dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $unattended as $unattend => $value )
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->last_name }}, {{ $value->first_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                    data-target="#modal-md-{{ $value->id }}">Details
                            </button>

                            <div class="modal fade" id="modal-md-{{ $value->id }}" tabindex="-1" role="dialog"
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
                                            <?php
                                            $alumni = \App\Alumni::find($value->id);
                                            ?>
                                            <div class="content">
                                                <a class="btn btn-primary btn-md"
                                                   href="/alumni/{{$alumni->id}}/edit?redirect_to=/event/{{$event->id}}">Edit</a>
                                                <br>
                                                <ul class="details">
                                                    <li><span>First Name:</span> {{$alumni->first_name}}</li>
                                                    <li><span>Last Name:</span> {{$alumni->last_name}}</li>
                                                    <li><span>Alumni Type:</span> {{$alumni->alumni_type}} </li>
                                                    @if($alumni->alumni_type === 'ordained')
                                                        <li><span>Diocese:</span> {{$alumni->diocese}}</li>
                                                        <li>
                                                            <span>Ordination: </span>{{ date_format(date_create($alumni->ordination), 'm-d-Y')}}
                                                        </li>
                                                    @else
                                                        <li><span>Years in San Jose:</span> {{ $alumni->years_in_sj }}
                                                        </li>
                                                    @endif
                                                    <li><span>BEC: </span>{{$alumni->bec }}</li>
                                                    <li><span>Batch Year: </span>{{$alumni->batch_year}}</li>
                                                    <li>
                                                        <span>Birthdate: </span>{{ date_format(date_create($alumni->birthdate), 'm-d-Y')}}
                                                    </li>
                                                    <li><span>Address: </span>{{$alumni->address}}</li>
                                                    <li><span>Telephone:</span> {{$alumni->telephone_num}}</li>
                                                    <li><span>Fax:</span> {{$alumni->fax_num}}</li>
                                                    <li><span>Mobile:</span> {{$alumni->mobile_num}}</li>
                                                    <li><span>Email:</span> <a href="mailto:{{$alumni->email}}"><strong><em>{{$alumni->email}}</em></strong></a>
                                                    </li>
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
                            <form style="display:inline" method="post" action="/event/attend">
                                {{ csrf_field() }}
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="alumni_id" value="{{ $value->id }}">
                                <button class="btn btn-danger btn-xs">Attend</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
