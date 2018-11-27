@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-5-5">
                    <div class="md-card">
                        <div class="md-card-content">
                            <form method="POST" action="{{ route('register') }}" data-parsley-validate>
                                @csrf
                                <div class="uk-grid uk-grid-medium form_section form_section_separator"
                                     id="d_form_section" data-uk-grid-match>
                                    <div class="uk-width-9-10">
                                        <div class="uk-grid">
                                            <div class="uk-width-1-1">
                                                <div class="parsley-row">
                                                    <label>نام</label>
                                                    <input type="text" class="md-input" name="name"
                                                           value="{{ old('name') }}" required>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-grid">
                                            <div class="uk-width-1-1">
                                                <div class="parsley-row">
                                                    <label>ایمیل</label>
                                                    <input type="email" class="md-input" name="email"
                                                           value="{{ old('email') }}" required>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-grid">
                                            <div class="uk-width-1-1">
                                                <div class="parsley-row">
                                                    <label>رمز عبور</label>
                                                    <input type="password" class="md-input" name="password"
                                                           value="{{ old('password') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-grid">
                                            <div class="uk-width-1-1">
                                                <div class="parsley-row">
                                                    <label>تکرار رمز عبور</label>
                                                    <input type="password" class="md-input" name="password_confirmation"
                                                           value="{{ old('password_confirmation') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        </div>
    </div>

@endsection
