@extends('layout.app')

@section('page_title','Edit Alumni')
@section('page_heading', 'Edit Alumni')

@section('body')
	
	{{$alumni->first_name}} {{$alumni->last_name}}
	
@endsection