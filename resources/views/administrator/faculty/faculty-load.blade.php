@extends('layouts.admin-layout')

@section('content')
    <faculty-load prop-user='@json($user)'
        prop-acad-years='@json($acadYears)'></faculty-load>
@endsection