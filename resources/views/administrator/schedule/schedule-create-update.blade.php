@extends('layouts.admin-layout')

@section('content')

<section class="section">

    <div class="columns is-centered">
        <div class="column is-8">
            <div class="box">

               
                @if (isset($data))
                    <schedule-create-update
                        prop-acad-years='@json($acadYears)'
                        prop-rooms='@json($rooms)'
                        prop-programs='@json($programs)'
                        prop-data='@json($data)'></schedule-create-update>
                @else
                    <schedule-create-update
                        prop-acad-years='@json($acadYears)'
                        prop-rooms='@json($rooms)'
                        prop-programs='@json($programs)'></schedule-create-update>
                @endif
               
            </div>
        </div>
    </div>
</section>


@endsection
