@extends('layout.app')

@section('page_title', "View $alumni->first_name $alumni->last_name " ) 

@section('page_heading', 'View Alumni')

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
	        <h2><i class="fa fa-user" aria-hidden="true"></i> {{$alumni->first_name}} {{$alumni->last_name}} </h2> 
	        <ul class="nav navbar-right panel_toolbox">
	            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			</ul>
	        <div class="clearfix"></div>                
	    </div>
	    <div class="content">
	    	<a class="btn btn-primary btn-xs" href="/alumni/{{$alumni->id}}/edit">Edit</a>
	    	<ul class="detail-list">
	    		<li><span>First Name:</span> {{$alumni->first_name}}</li>
	    		<li><span>Last Name:</span> {{$alumni->last_name}}</li>
	    		<li><span>Alumni Type:</span> {{$alumni->alumni_type}}</li>
	    		@if($alumni->alumni_type === 'Ordained')
	    			<li><span>Diocese:</span> {{$alumni->diocese}}</li>
	    			<li><span>Ordination {{$alumni->ordination}}</li>
	    		@else 
	    			<li><span>Years in San Jose:</span> {{$alumni->years_in_sj}}</li>
	    		@endif
	    		<li><span>Birthdate :{{$alumni->birthdate}}</li>
	    		<li><span>Address :{{$alumni->address}}</li>
	    		<li><span>Telephone:</span> {{$alumni->telephone_num}}</li>
	    		<li><span>Fax:</span> {{$alumni->fax_num}}</li>
	    		<li><span>Mobile:</span> {{$alumni->mobile_num}}</li>
	    		<li><span>Email:</span> {{$alumni->email}}</li>
	    	</ul>


	    </div>
	
	</div>

	<div class="x_panel">
		<div class="x_title">
			<h2><i class="fa fa-calendar" aria-hidden="true"></i> View Events Attended</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<table class="table table-hover dataTable">
	            <thead>
		            <tr>
		            	<th>ID</th>
		                <th>Event Name</th>
		                <th>Place</th>
		                <th>Date</th>
		                <th>Manage</th>
		            </tr>
	            </thead>
	            <tbody>
					@foreach ( $events as $event => $value )
						<tr>
							<td>{{ $value->id }}</td>
							<td>{{ $value->name }}</td>
							<td>{{ $value->place }}</td>
							<td>{{ $value->date }}</td>
							<td>
								<a href="/event/{{$value->id}}" class="btn btn-success btn-xs">View Event</a>
								<a href="#" class="btn btn-danger btn-xs">Remove</a>
							</td>
						</tr> 
					@endforeach
	            </tbody>
	        </table>
		</div>
	</div>

@endsection