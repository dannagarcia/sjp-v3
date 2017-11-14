@extends ('layout.app')

@section('page_title', 'Event')

@section('page_heading', 'Event')

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
		<div class="x_content">
			<a href="/event/create" class="btn btn-primary btn-lg">Create Event</a>

		</div>
	</div>

	<div class="x_panel">
	    <div class="x_title">
	        <h2>Event List</h2>
	        <ul class="nav navbar-right panel_toolbox">
	            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
	        </ul>
	        <div class="clearfix"></div>
	    </div> <!-- end of x_title -->
	    <div class="x_content">
	        <table class="table table-hover dataTable">
	            <thead>
		            <tr>
		            	<th>ID</th>
		                <th>Event Name</th>
						{{--<th>Description</th>--}}
		                <th>Place</th>
		                <th>Date</th>
		                <th>Manage</th>
		            </tr>
	            </thead>
	            <tbody>
				    @foreach ($events as $event)
			            <tr>
			                <td>{{$event->id}}</td>
			                <td>{{$event->name}}</td>
							{{--<td>{{$event->description}}</td>--}}
							<td>{{$event->place}}</td>
			                <td>{{$event->date}}</td>
			                <td>
			                    <a href="/event/{{$event->id}}/edit" type="button" class="btn btn-primary btn-xs">Edit</a>
			                    <a href="/event/{{$event->id}}" type="button" class="btn btn-success btn-xs">View details</a>
			                </td>
			            </tr>
				    @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>

@endsection