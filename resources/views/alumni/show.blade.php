@extends('layout.app')

@section('page_title', "View $alumni->first_name $alumni->last_name " ) 

@section('page_heading', 'View Alumni')

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

	    	<ul class="list">
	    		<li>First Name: <span>{{$alumni->first_name}}</span></li>
	    		<li>Last Name: <span>{{$alumni->last_name}}</span></li>
	    		<li>Alumni Type: <span>{{$alumni->alumni_type}}</span></li>
	    		@if($alumni->alumni_type === 'Ordained')
	    			<li>Diocese: <span>{{$alumni->diocese}}</span></li>
	    			<li>Ordination <span>{{$alumni->ordination}}</span></li>
	    		@else 
	    			<li>Years in San Jose: <span>{{$alumni->years_in_sj}}</span></li>
	    		@endif
	    		<li>Birthdate :<span>{{$alumni->birthdate}}</span></li>
	    		<li>Address :<span>{{$alumni->address}}</span></li>
	    		<li>Telephone: <span>{{$alumni->telephone_num}}</span></li>
	    		<li>Fax: <span>{{$alumni->fax_num}}</span></li>
	    		<li>Mobile: <span>{{$alumni->mobile_num}}</span></li>
	    		<li>Email: {{$alumni->email}}</li>
	    	</ul>
	    </div>
	
	</div>
@endsection
