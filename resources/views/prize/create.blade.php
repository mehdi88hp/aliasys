@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-5-5">
                            <h4 class="heading_a uk-margin-bottom">اضافه کردن جوایز</h4>
                            <form method="POST" action="{{ route('add.prize') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <div class="uk-grid uk-grid-medium form_section " id="d_form_row">
                                            <div class="uk-width-1-3">
                                                <div class="uk-input-group">
                                                    <label>نام جایزه</label>
                                                    <input type="text" class="md-input" name="prize_name[]">
                                                    <span class="uk-input-group-addon">
                                                    {{--<a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-3">
                                                <div class="uk-input-group">
                                                    <label>امتیاز</label>
                                                    <input type="text" class="md-input" name="prize_point[]">
                                                    <span class="uk-input-group-addon">
                                                    {{--<a href="#" class="btnSectionClone"--}}
                                                        {{--data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>--}}
                                                </span>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-3">
                                                <div class="uk-input-group">
                                                    {{--<label>تصویر</label>--}}
                                                    {{--<input type="file" class="md-input" name="prize_pic[]">--}}
                                                    <div class="uk-width-1-1">
                                                        <div class="uk-form-file md-btn md-btn-primary">
                                                            انتخاب تصویر
                                                            <input id="form-file" type="file" name="prize_pic[]">
                                                        </div>
                                                        {{--<div class="uk-form-file uk-text-primary hidden"><input name="form-file2" id="form-file" type="file"></div>.--}}
                                                    </div>
                                                    <span class="uk-input-group-addon">
                                                        <a href="#"
                                                           class="btnSectionClone"
                                                           data-section-clone="#d_form_row"><i
                                                                class="material-icons md-24">&#xE146;</i></a>
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
                            <h4 class="heading_a uk-margin-bottom">جوایز موجود</h4>
                            <div class="md-card uk-margin-medium-bottom">
                                <div class="md-card-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table uk-table-hover">
                                            <thead>
                                            <tr>
                                                <th>نام جایزه</th>
                                                <th>امتیاز</th>
                                                <th>تعداد اختصاص یافته</th>
                                                <th>تصویر</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($prizes as $prize)
                                                <tr>
                                                    <td><input class="hollow-border prize-name" type="text"
                                                               value="{{$prize->name}}"></td>
                                                    <td><input class="hollow-border prize-point" type="text"
                                                               value="{{$prize->point}}"></td>
                                                    <td>
                                                        <a href="{{url('prize-user-detail/').$prize->id}}">{{count($prize->user)}}</a>
                                                    </td>
                                                    <td>
                                                        {{--                                                        <img src="{{url($prize->pic)}}" width="50" height="50">--}}
                                                        <form action="{{url('prize-img-edit')}}"
                                                              class="change-prize-img" method="post"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <input name="prize-id" type="hidden"
                                                                   value="{{$prize->id}}">
                                                            <a href="javascript:void(0)" id="change-prize-pic">
                                                                <label for="prize-pic-input{{$prize->id}}">
                                                                    <input type="file" style="display: none"
                                                                           name="prize-pic-input"
                                                                           class="prize-pic-input"
                                                                           id="prize-pic-input{{$prize->id}}">
                                                                    <div style="position: relative;width: 50px;height: 50px;" class="prize-pic-preview-div">

                                                                    <img src="{{url($prize->pic)}}"
                                                                         class="prize-pic-preview" width="50"
                                                                         style="max-height: 50px" height="50">
                                                                    <span
                                                                        style="position:absolute;top: 50%;left: 50%;transform: translate(-50%)">
                                                                            ویرایش
                                                                    </span>
                                                                    </div>
                                                                </label>
                                                            </a>
                                                        </form>
                                                    </td>


                                                    <td class="uk-text-center">
                                                        <a href="javascript:void(0)" data-id="{{$prize->id}}"
                                                           class="prize-status-edit"><i
                                                                class="md-icon material-icons">&#xE254;</i></a>
                                                        <a href="javascript:void(0)"><i
                                                                class="md-icon material-icons prize-status-delete"
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
    <script>
        //        function readURL(input) {
        //
        //            if (input.files && input.files[0]) {
        //                var reader = new FileReader();
        //                input.parentElement.parentElement.submit();
        //
        //                reader.onload = function (e) {
        //                    $('#prize-pic-preview').attr('src', e.target.result);
        //                }
        //                console.log('e.target.result');
        //                reader.readAsDataURL(input.files[0]);
        //            }
        //        }

        window.onload = function () {
            jQuery(document).ready(function () {
                $('.prize-pic-input').change(function (e) {
                    console.log($(this).val(), e)

                    $(this).parents('form').submit();
//
                });
                $('.prize-pic-preview-div').mouseenter(function (e) {
                    e.stopPropagation();
                    $(this).find('span').show()
                    $(this).find('img').css({'opacity': 0.3, 'cursor': 'pointer'})
                })

                $('.prize-pic-preview-div').mouseleave(function (e) {
                    e.stopPropagation();
                    $(this).find('span').hide()
                    $(this).find('img').css('opacity', 'inherit')
                })
            })
        };
    </script>

@endsection
