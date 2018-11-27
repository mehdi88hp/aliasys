@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-5-5">
                            <h4 class="heading_a uk-margin-bottom">اضافه کردن حالت های vip</h4>
                            <form method="POST" action="{{url('/add-vip-status')}}">
                                @csrf
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <div class="uk-grid uk-grid-medium form_section " id="d_form_row">
                                            <div class="uk-width-1-4">
                                                <div class="uk-input-group">
                                                    <label>عنوان</label>
                                                    <input type="text" class="md-input" name="prize_name[]">
                                                    <span class="uk-input-group-addon">
                                                    {{--<a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-4">
                                                <div class="uk-input-group">
                                                    <label>امتیاز</label>
                                                    <input type="text" class="md-input" name="prize_point[]">
                                                    <span class="uk-input-group-addon">
                                                    {{--<a href="#" class="btnSectionClone"--}}
                                                       {{--data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-4">
                                                <div class="uk-input-group">
                                                    <label>درصد تخفیف</label>
                                                    <input type="text" class="md-input" name="prize_discount[]">
                                                    <span class="uk-input-group-addon"></span>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-4">
                                                <div class="uk-input-group">
                                                    <label>رنگ</label>
                                                    <input type="text" class="md-input" name="prize_color[]">
                                                    <span class="uk-input-group-addon">
                                                    <a href="#" class="btnSectionClone"
                                                       data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-grid">
                                            <div class="uk-width-1-1">
                                                <button type="submit" href="#" class="md-btn md-btn-primary">ثبت
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-5-5">
                            <h4 class="heading_a uk-margin-bottom">حالت های موجود</h4>
                            <div class="md-card uk-margin-medium-bottom">
                                <div class="md-card-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table uk-table-hover">
                                            <thead>
                                            <tr>
                                                <th>نام حالت</th>
                                                <th>امتیاز</th>
                                                <th>درصد تخفیف</th>
                                                <th>رنگ</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($prizes as $prize)
                                                <tr>
                                                    <td><input class="hollow-border vip-name" type="text"
                                                               value="{{$prize->name}}"></td>
                                                    <td><input class="hollow-border vip-point" type="text"
                                                               value="{{$prize->point}}"></td>
                                                    <td><input class="hollow-border vip-discount" type="text"
                                                               value="{{$prize->discount}}"></td>
                                                    <td><input class="hollow-border vip-color" type="text"
                                                               value="{{$prize->color}}"></td>
                                                    <td class="uk-text-center">
                                                        <a href="javascript:void(0)" data-id="{{$prize->id}}" class="vip-status-edit"><i
                                                                    class="md-icon material-icons">&#xE254;</i></a>
                                                        <a href="javascript:void(0)"><i class="md-icon material-icons vip-status-delete"
                                                                       data-id="{{$prize->id}}"
                                                                       >delete</i></a>
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

        </div>
    </div>

@endsection
