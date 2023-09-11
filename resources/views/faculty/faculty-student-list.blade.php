@extends('layouts.faculty-layout')

@section('content')

<section class="section">

    <div class="columns is-centered">
        <div class="column is-6">
            <div class="box">
                <faculty-student-list 
                    prop-schedule-id="{{ $scheduleId }}"
                    prop-faculty-id="{{ $facultyId }}"
                    prop-academic-year-id="{{ $acadYearId }}"></faculty-student-list>
            </div>
        </div>
    </div>
</section>


@endsection
