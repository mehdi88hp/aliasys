@extends('layouts.app')
@section('content')
    @if(Session::has('message'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            {{--<h3>Notice</h3>--}}
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        </div>
    @endif
    <div id="app"></div>
    @if(!Auth::check())
    @include('reg-log')
    @else
        @include('profile')

    @endif
@endsection
@section('jsLogin')
    <script src="{{url('js/pages/login.min.js')}}"></script>
@endsection
