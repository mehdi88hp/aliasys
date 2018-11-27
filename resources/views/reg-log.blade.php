    
<div id="page_content">
    <div id="page_content_inner">
        <div class="login_page_wrapper">
            <div class="md-card" id="login_card">
                <div class="md-card-content large-padding" id="login_form">
                    <div class="login_heading">
                        <div class="user_avatar"></div>
                    </div>
                    <form method="POST" action="{{ route('login') }}" data-parsley-validate>
                        @csrf
                        <div class="uk-form-row">
                            <label for="login_username">ایمیل</label>
                            <input class="md-input" type="text" id="login_username" name="email" value="{{ old('email') }}" >
                        </div>
                        <div class="uk-form-row">
                            <label for="login_password">رمز عبور</label>
                            <input class="md-input" type="password" id="login_password" name="password"
                                                                                       value="{{ old('password') }}">
                        </div>
                        <div class="uk-margin-medium-top">
                            {{--<a href="index.html" class="md-btn md-btn-primary md-btn-block md-btn-large">ورود</a>--}}
                            <button class="md-btn md-btn-primary md-btn-block md-btn-large">ورود</button>
                        </div>
                        <div class="uk-margin-top">
                            <span class="icheck-inline">
                        <input type="checkbox" id="login_page_stay_signed"
                               name="remember" {{ old('remember') ? 'checked' : '' }}
                               data-md-icheck/>
                        <label for="login_page_stay_signed" class="inline-label">به خاطر داشته باش</label>
                    </span>
                        </div>
                    </form>
                </div>
                <div class="md-card-content large-padding uk-position-relative" id="login_help"
                     style="display: none">
                    <button type="button"
                            class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                    <h2 class="heading_b uk-text-success">Can't log in?</h2>
                    <p>Here’s the info to get you back in to your account as quickly as possible.</p>
                    <p>First, try the easiest thing: if you remember your password but it isn’t working, make sure
                        that Caps
                        Lock is turned off, and that your username is spelled correctly, and then try again.</p>
                    <p>If your password still isn’t working, it’s time to <a href="#" id="password_reset_show">reset
                            your
                            password</a>.</p>
                </div>
                <div class="md-card-content large-padding" id="login_password_reset" style="display: none">
                    <button type="button"
                            class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                    <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
                    <form>
                        <div class="uk-form-row">
                            <label for="login_email_reset">Your email address</label>
                            <input class="md-input" type="text" id="login_email_reset" name="login_email_reset"/>
                        </div>
                        <div class="uk-margin-medium-top">
                            <a href="index.html" class="md-btn md-btn-primary md-btn-block">Reset password</a>
                        </div>
                    </form>
                </div>
                <div class="md-card-content large-padding" id="register_form" style="display: none">
                    <button type="button"
                            class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                    <h2 class="heading_a uk-margin-medium-bottom">ثبت نام کنید</h2>
                    <form method="POST" action="{{ route('register') }}" data-parsley-validate>
                        @csrf
                        <div class="uk-form-row">
                            <label for="register_username">نام</label>
                            <input class="md-input" type="text" id="register_username" name="name"
                                                                                       value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                            @endif
                        </div>
                        <div class="uk-form-row">
                            <label for="register_password">رمز عبور</label>
                            <input class="md-input" type="password" id="register_password"
                                   name="password" value="{{ old('password') }}">

                        </div>
                        <div class="uk-form-row">
                            <label for="register_password_repeat">تکرار رمز عبور</label>
                            <input class="md-input" type="password" id="register_password_repeat"
                                   name="password_confirmation" value="{{ old('password_confirmation') }}" >
                        </div>
                        <div class="uk-form-row">
                            <label for="email">ایمیل</label>
                            <input class="md-input" type="text" id="email" name="email"/>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                            @endif
                        </div>
                        <div class="uk-margin-medium-top">
                            <button class="md-btn md-btn-primary md-btn-block md-btn-large">ثبت نام</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="uk-margin-top uk-text-center">
                <a href="#" id="signup_form_show">ثبت نام کنید</a>
            </div>
        </div>
    </div>
</div>