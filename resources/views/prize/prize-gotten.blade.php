@extends('layouts.app')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-5-5">
                            <div class="uk-overflow-container  m-t-40">
                                <h3 class="d-inline-block heading_a uk-margin-bottom m-l-10"> جوایز دریافت شده : </h3>
                                <table class="uk-table uk-table-hover">
                                    <thead>
                                    <tr>
                                        <th>نام جایزه</th>
                                        <th>امتیاز</th>
                                        <th>تاریخ ثبت</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="user_prize_acquired">
                                    @foreach($user_prize as $prize)
                                        <tr>
                                            <td>{{$prize->name}}</td>
                                            <td>{{$prize->point}}</td>
                                            <td>{{jdate($prize->created_at)->format('%d %B %Y')}}</td>
                                            <td class="uk-text-center"></td>
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
@endsection
