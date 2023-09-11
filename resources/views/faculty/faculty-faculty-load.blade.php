@extends('layouts.faculty-layout')

@section('content')

<section class="section">

    <div class="columns is-centered">
        <div class="column is-10">
            <div class="box">
                <faculty-faculty-load
                    prop-acad-years='@json($acadYears)'></faculty-faculty-load>
            </div>
        </div>
    </div>
</section>


@endsection
