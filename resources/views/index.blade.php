@extends('layout.app')

@section('page_heading', 'San Jose')

@section('user_name', 'My Name')


@section('body')
	
	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class="fa fa-calendar"></i> Latest Events </h2>
					<div class="pull-right">
						<a class="btn btn-primary btn-xs" href="/event/create">Create an Event</a>
						<a class="btn btn-info btn-xs" href="/event/">View All Events</a>
					</div>

					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<span><em><small>List of Latest 5 events</small></em></span>
					<table class="table tablehover">
						<thead>
				            <tr>
				            	<th>ID</th>
				                <th>Event Name</th>
				                <th>Place</th>
				                <th>Date</th>
				                <th>Number of Attendants</th>
				                <th>Manage</th>
				            </tr>
			            </thead>
			            <tbody>
			            	@foreach ($top_five as $events => $event_value)
			            		<tr>
			            			<td>{{$event_value->id}}</td>
			            			<td>{{$event_value->name}}</td>
			            			<td>{{$event_value->place}}</td>
			            			<td>{{$event_value->date}}</td>
			            			<td>{{$event_value->alumnis()->count()}}</td>
			            			<td>
			            				<a href="/event/{{$event_value->id}}" class="btn btn-success btn-xs">View Event Details</a>
			            			</td>
			            		</tr>
			            	@endforeach
			            </tbody>
					</table>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		
		@if($event)
			<div class="col-xs-12 col-sm-6 col-md-6">

				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-calendar"></i> Event </h2>
						<div class="pull-right">
							<a class="btn btn-primary btn-xs" href="/event/create">Create an Event</a>
							<a class="btn btn-info btn-xs" href="/event/">View All Events</a>
						</div>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<span><em><small>Recently created event</small></em></span>
						<span class="pull-right"><em><small>Date created: {{$event->created_at}}</small></em></span>

						<h2 class="dashb-title page-header">{{$event->name}}</h2>
						<ul class="details">
							<li><span>Description:</span> <b>{{$event->description}}</b></li>
							<li><span>Place:</span> <b>{{$event->place}}</b></li>
							<li><span>Date:</span> <b>{{$event->date}}</b></li>
						</ul>
						<a class="btn btn-success btn-xs" href="event/{{$event->id}}"><em>View More Details</em></a>
					</div>
				</div>


			</div>
		@endif

		<div class="col-xs-12 col-sm-6 col-md-6">
			
			<div class="x_panel">
			 	<div class="x_title">
			 		<h2><i class="fa fa-calendar"></i> Alumni </h2>
					<div class="pull-right">
						<a class="btn btn-primary btn-xs" href="/alumni/create">Register Alumni</a>
						<a class="btn btn-info btn-xs" href="/alumni">View All Alumni</a>
					</div>


					<div class="clearfix"></div>
			 	</div>
			 	<div class="x_content">
					<span><em><small>Recently added alumni</small></em></span>
					<span class="pull-right"><em><small>Register date: {{$alumni->created_at}}</small></em></span>

					<h2 class="dashb-title page-header">{{$alumni->first_name}} {{$alumni->last_name}}, <em>{{$alumni->alumni_type}}</em></h2>
					<ul class="details">
						<li><span>Mobile Phone:</span> <b>{{$alumni->mobile_num}}</b></li>
						<li><span>Email Address:</span> <b>{{$alumni->email}}</b></li>
						<li><span>Birthdate:</span> <b>{{$alumni->birthdate}}</b></li>
					</ul>
					<a class="btn btn-success btn-xs" href="alumni/{{$alumni->id}}"><em>View More Details</em></a>

				</div>
			</div>

		</div>

	</div>


@endsection