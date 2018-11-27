@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">
 آپلود فرم excel اطلاعات کاربران
                        <span class="sub-heading">ستون 1 : نام کاربر</span>
                        <span class="sub-heading">ستون 2 : امتیاز کاربر برای خرید جایزه</span>
                        <span class="sub-heading">ستون 3 : کد یکتا از طرف آلیاسیس</span>
                        <span class="sub-heading">ستون 4 : شماره موبایل</span>
                        <span class="sub-heading">ستون 5 : ایمیل یکتا</span>
                        <span class="sub-heading">ستون 6 : امتیاز کاربر برای تعیین حالت vip</span>
                    </h3>
                    <form action="{{url('/add-user-excel')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="uk-grid m-t-20" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" data-switchery id="switch_demo_1" name="send_mail"/>
                                <label for="switch_demo_1" class="inline-label">فعال بودن ارسال ایمیل</label>
                                <span class="uk-form-help-block"></span>
                            </div>
                        </div>
                        {{--<div class="uk-grid">--}}
                            {{--<div class="uk-width-1-1">--}}
                                {{--<div id="file_upload-drop" class="uk-file-upload">--}}
                                    {{--<p class="uk-text">می توانید فایلتان را اینجا بکشید</p>--}}
                                    {{--<p class="uk-text-muted uk-text-small uk-margin-small-bottom">یا</p>--}}
                                    {{--<a class="uk-form-file md-btn">انتخاب کنید<input id="file_upload-select"--}}
                                                                                     {{--type="file"></a>--}}
                                {{--</div>--}}
                                {{--<div id="file_upload-progressbar" class="uk-progress uk-hidden">--}}
                                    {{--<div class="uk-progress-bar" style="width:0">0%</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="md-card-content">--}}
                            {{--<h3 class="heading_a">--}}
                                {{--Form file--}}
                                {{--<span class="sub-heading">Replace the default file input with your own HTML content, like a button.</span>--}}
                            {{--</h3>--}}
                            {{--<div class="uk-grid">--}}
                                <div class="uk-width-1-1" style="margin: 30px 0">
                                    <div class="uk-form-file md-btn md-btn-primary">
                                        انتخاب کنید
                                        <input id="form-file" type="file" name="excel-file">
                                    </div>
                                    <div class="uk-form-file uk-text-primary hidden"><input name="form-file2" id="form-file" type="file"></div>.
                                </div>
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <button type="submit" href="#" class="md-btn md-btn-primary">ثبت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('jsFileUpload')
    <script src="{{url('js/pages/forms_file_upload.min.js')}}"></script>
@endsection
@endsection
