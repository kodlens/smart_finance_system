@extends('layouts.faculty-layout')

@section('content')

<section class="hero is-fullheight-with-navbar">
  <div class="hero-body">
    <div class="container has-text-centered">
        <p class="title">
            @php
                $user = Auth::user();
            @endphp
          WELCOME  {{ strtoupper($user->lname) }}, {{ strtoupper($user->fname) }}
        </p>
    </div>
  </div>
</section>


@endsection
