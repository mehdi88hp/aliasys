@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-5-5">
                            {{--<h4 class="d-inline-block heading_a uk-margin-bottom m-l-10"> امتیاز شما : </h4>--}}
                            <div class="uk-overflow-container  m-t-40">
                                <h3 class="d-inline-block heading_a uk-margin-bottom m-l-10"> کاربرانی که جایزه {{$prize_user->name}} را دریافت کرده اند </h3>
                                <br><h4 class="d-inline-block" id="current_point">امتیاز لازم : {{$prize_user->point}} </h4>

                            <table class="uk-table uk-table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="user_prize_acquired">
                                @foreach($prize_user->user as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td></td>
                                        <td class="uk-text-center">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
        };
    </script>
@endsection
