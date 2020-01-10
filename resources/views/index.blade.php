@extends('layouts.master')

@section('content')
	<transition :name="transitionName" mode="out-in">
		<router-view></router-view>
	</transition>
@endsection