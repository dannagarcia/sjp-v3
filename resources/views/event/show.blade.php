@extends('layout.app')

@section('page_title', "View $event->id" ) 

@section('page_heading', 'View Event')

@section('styles')

	 <!-- Datatables -->
    <link href="{{ URL::asset('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

@endsection

@section('scripts')
	<!-- Datatables -->
    <script src="{{URL::asset('/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{URL::asset('/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

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
	    	<ul class="list">
	    		<li>Event Name: <span>{{$event->name}}</span></li>
	    		<li>Place: <span>{{$event->place}}</span></li>
	    		<li>Date: <span>{{$event->date}}</span></li>
	    	</ul>
	    </div>
	
	</div>


	<div class="x_panel">
		<div class="x_title">
			<h2><i class="fa fa-users" aria-hidden="true"></i> Attendees List</h2> 
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
							<td>{{ $value->phone_num }}</td>
							<td>
								<a href="#" class="btn btn-danger btn-xs">Remove</a>
							</td>
						</tr> 
					@endforeach
	            </tbody>
	        </table>
		</div>
	</div>
@endsection
