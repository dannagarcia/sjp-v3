@extends('layout.app')

@section('page_heading', 'San Jose')

@section('user_name', 'My Name')

@section('body')

	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><i class="fa fa-calendar"></i> Today's Events </h2>

				<div class="clearfix"></div>
			</div>
			<div class="x_content">

                @foreach($events_today as $event_today => $et)
                {{--{{$et}}--}}
                <div class="row">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-calendar"></i> {{$et->name}} </h2>
                            <a class="pull-right btn btn-primary btn-xs" href="#">Attend</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <span><em><small>Ongoing Event</small></em></span>
                            <span class="pull-right"><em><small>{{$et->date}}</small></em></span>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">

                                    <h2 class="dashb-title page-header">Details</em></h2>
                                    <ul class="details">
                                        <li><span>Description:</span> <b>{{$et->description}}</b></li>
                                        <li><span>Place:</span> <b>{{$event->place}}</b></li>
                                    </ul>
                                    <a class="btn btn-success btn-xs" href="/event/{{$et->id}}"><em>View More Details</em></a>

                                </div>

                                <div class="col-xs-12 col-sm-6">

                                    <h2 class="dashb-title page-header">Attending Alumni</em></h2>
                                    <span class="pull-right"><em><small>Number of Attendants: {{$attendants_count}} </small></em></span>

                                    <ol>
                                        @foreach ($attendants as $attendant)
                                            <li><b>{{$attendant->last_name}}, {{$attendant->first_name}}</b></li>
                                        @endforeach
                                    </ol>
                                    <a class="btn btn-success btn-xs" href="#	"><em>View all attending alumni</em></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{--x_content--}}
			</div>
		</div>
	</div>
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

				<h2 class="dashb-title page-header">{{$event->name}}</em></h2>
				<ul class="details">
					<li><span>Description:</span> <b>{{$event->description}}</b></li>
					<li><span>Place:</span> <b>{{$event->place}}</b></li>
					<li><span>Date:</span> <b>{{$event->date}}</b></li>
				</ul>
				<a class="btn btn-success btn-xs" href="event/{{$event->id}}"><em>View More Details</em></a>
			</div>
		</div>
	</div>

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




@endsection