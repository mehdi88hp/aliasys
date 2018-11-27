<!doctype html>
<!--[if lte IE 9]>
<html class="lte-ie9" lang="en" dir="rtl"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="fa" dir="rtl"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-16x16.png')}}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-32x32.png')}}" sizes="32x32">

    <title>ALIASYS</title>


    <!-- uikit rtl -->
    <link rel="stylesheet" href="{{ asset('css/uikit.rtl.css') }}" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('icons/flags/flags.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('css/themes/themes_combined.min.css') }}" media="all">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="{{ asset('bower_components/matchMedia/matchMedia.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/ie.css') }}" media="all">
    <![endif]-->
<style>
    @font-face {
        font-family: iranyekan;
        font-style: normal;
        font-weight: bold;
        src: url("{{url('fonts/iranyekanwebbold.eot')}}");
        src: url("{{url('fonts/iranyekanwebbold.eot?#iefix')}}") format('embedded-opentype'), /* IE6-8 */
        url("{{url('fonts/iranyekanwebbold.woff2')}}") format('woff2'), /* FF39+,Chrome36+, Opera24+*/
        url("{{url('fonts/iranyekanwebbold.woff')}}") format('woff'), /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
        url("{{url('fonts/iranyekanwebbold.ttf')}}") format('truetype');
    }
</style>
</head>
<body class=" sidebar_main_open sidebar_main_swipe">
<!-- main header -->
<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">

            <!-- main sidebar switch -->
			<?php
                if(Auth::check()){
//
//
//            $point = Auth::user()->total_point;
//            $vip = App\VipStatus::all();
//            $cond = '';
//            $a=Auth::user()->total_point;
//            $b= 0;
//            foreach ($vip as $k=>$value){
//            	if($a > $value->point && $value->point >= $b){
//                    $b = $value->point;
//                    $cond=  $value->name;
//                    $dis=  $value->discount;
//                }
//            }
                    $vip = getVipStatus();

                }
////            if($point>)
			?>
            @if(Auth::check())
                <span class="user-score-tag">{{Auth::user()->name}}</span> <span class="user-score-tag"> -  کاربر {{$vip['name']}}</span>
            @endif
        <!-- secondary sidebar switch -->
            {{--<a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">--}}
            {{--<span class="sSwitchIcon"></span>--}}
            {{--</a>--}}

            {{--<div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">--}}
            {{--<div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">--}}
            {{--<a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>--}}
            {{--<div class="uk-dropdown uk-dropdown-width-3">--}}
            {{--<div class="uk-grid uk-dropdown-grid">--}}
            {{--<div class="uk-width-2-3">--}}
            {{--<div class="uk-grid uk-grid-width-medium-1-3 uk-margin-bottom uk-text-center">--}}
            {{--<a href="page_mailbox.html" class="uk-margin-top">--}}
            {{--<i class="material-icons md-36 md-color-light-green-600">&#xE158;</i>--}}
            {{--<span class="uk-text-muted uk-display-block">Mailbox</span>--}}
            {{--</a>--}}
            {{--<a href="page_invoices.html" class="uk-margin-top">--}}
            {{--<i class="material-icons md-36 md-color-purple-600">&#xE53E;</i>--}}
            {{--<span class="uk-text-muted uk-display-block">Invoices</span>--}}
            {{--</a>--}}
            {{--<a href="page_chat.html" class="uk-margin-top">--}}
            {{--<i class="material-icons md-36 md-color-cyan-600">&#xE0B9;</i>--}}
            {{--<span class="uk-text-muted uk-display-block">Chat</span>--}}
            {{--</a>--}}
            {{--<a href="page_scrum_board.html" class="uk-margin-top">--}}
            {{--<i class="material-icons md-36 md-color-red-600">&#xE85C;</i>--}}
            {{--<span class="uk-text-muted uk-display-block">Scrum Board</span>--}}
            {{--</a>--}}
            {{--<a href="page_snippets.html" class="uk-margin-top">--}}
            {{--<i class="material-icons md-36 md-color-blue-600">&#xE86F;</i>--}}
            {{--<span class="uk-text-muted uk-display-block">Snippets</span>--}}
            {{--</a>--}}
            {{--<a href="page_user_profile.html" class="uk-margin-top">--}}
            {{--<i class="material-icons md-36 md-color-orange-600">&#xE87C;</i>--}}
            {{--<span class="uk-text-muted uk-display-block">User profile</span>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="uk-width-1-3">--}}
            {{--<ul class="uk-nav uk-nav-dropdown uk-panel">--}}
            {{--<li class="uk-nav-header">Components</li>--}}
            {{--<li><a href="components_accordion.html">Accordions</a></li>--}}
            {{--<li><a href="components_buttons.html">Buttons</a></li>--}}
            {{--<li><a href="components_notifications.html">Notifications</a></li>--}}
            {{--<li><a href="components_sortable.html">Sortable</a></li>--}}
            {{--<li><a href="components_tabs.html">Tabs</a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    {{--<li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i--}}
                    {{--class="material-icons md-24 md-light">&#xE5D0;</i></a></li>--}}
                    {{--<li><a href="#" id="main_search_btn" class="user_action_icon"><i--}}
                    {{--class="material-icons md-24 md-light">&#xE8B6;</i></a></li>--}}
                    @if(Auth::check())
						<?php
						$messages = App\Message::where( [
							'user_id' => Auth::user()->id,
							'seen'    => null
						] )->orderBy('id','DESC')->get()->take( 10 );
						$msgCount = count( $messages->toArray() );
						if ( $msgCount == 0 ) {
							$messages = App\Message::where( [ 'user_id' => Auth::user()->id ] )->orderBy('id','DESC')->get()->take( 10 );
						}
						?>
                        <li class="user-score-tag">امتیاز شما : <span class="current_point">{{(int)Auth::user()->total_point}}</span></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_icon notification_bell"><i
                                        class="material-icons md-24 md-light">&#xE7F4;</i><span
                                        class="uk-badge">{{$msgCount}}</span></a>
                            <div class="uk-dropdown uk-dropdown-xlarge">
                                <div class="md-card-content">
                                    <ul class="uk-tab uk-tab-grid"
                                        data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                        <li class="uk-width-1-1 uk-active">
                                            <a href="#" class="js-uk-prevent uk-text-small">پیام ها ({{$msgCount}})</a>
                                        </li>
                                        {{--<li class="uk-width-1-2"><a href="#" class="js-uk-prevent uk-text-small">Alerts--}}
                                        {{--(4)</a></li>--}}
                                    </ul>
                                    <ul id="header_alerts" class="uk-switcher uk-margin">
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                @isset($messages)
                                                    @foreach($messages as $message)
                                                        <li>
                                                            {{--<div class="md-list-addon-element">--}}
                                                            {{--<span class="md-user-letters md-bg-cyan">ld</span>--}}
                                                            {{--</div>--}}
                                                            <div class="md-list-content">
                                                                <span class="md-list-heading"><a
                                                                            href="javascript:void(0)">{{$message->subject}}</a></span>
                                                                <span class="uk-text-small uk-text-muted">{{$message->content}}</span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endisset
                                            </ul>
                                            {{--<div class="uk-text-center uk-margin-top uk-margin-small-bottom">--}}
                                            {{--<a href="page_mailbox.html"--}}
                                            {{--class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Show--}}
                                            {{--All</a>--}}
                                            {{--</div>--}}
                                        </li>
                                        {{--<li>--}}
                                        {{--<ul class="md-list md-list-addon">--}}
                                        {{--<li>--}}
                                        {{--<div class="md-list-addon-element">--}}
                                        {{--<i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>--}}
                                        {{--</div>--}}
                                        {{--<div class="md-list-content">--}}
                                        {{--<span class="md-list-heading">Doloribus dolor.</span>--}}
                                        {{--<span class="uk-text-small uk-text-muted uk-text-truncate">Quaerat eos et voluptates accusantium doloribus molestias quia debitis.</span>--}}
                                        {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                        {{--<div class="md-list-addon-element">--}}
                                        {{--<i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>--}}
                                        {{--</div>--}}
                                        {{--<div class="md-list-content">--}}
                                        {{--<span class="md-list-heading">Ratione eos.</span>--}}
                                        {{--<span class="uk-text-small uk-text-muted uk-text-truncate">Ut hic sed totam.</span>--}}
                                        {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                        {{--<div class="md-list-addon-element">--}}
                                        {{--<i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>--}}
                                        {{--</div>--}}
                                        {{--<div class="md-list-content">--}}
                                        {{--<span class="md-list-heading">Eveniet suscipit.</span>--}}
                                        {{--<span class="uk-text-small uk-text-muted uk-text-truncate">Enim et nesciunt in cumque sint ut.</span>--}}
                                        {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                        {{--<div class="md-list-addon-element">--}}
                                        {{--<i class="md-list-addon-icon material-icons uk-text-primary">&#xE8FD;</i>--}}
                                        {{--</div>--}}
                                        {{--<div class="md-list-content">--}}
                                        {{--<span class="md-list-heading">Sit distinctio tenetur.</span>--}}
                                        {{--<span class="uk-text-small uk-text-muted uk-text-truncate">Autem ipsa necessitatibus voluptas et eligendi voluptatem quia quas.</span>--}}
                                        {{--</div>--}}
                                        {{--</li>--}}
                                        {{--</ul>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_image">
                            {{--<img class="md-user-image" src="/img/avatars/avatar_11_tn.png" alt=""/>--}}
                            <i class="md-list-addon-icon material-icons md-24 md-light">menu</i>

                        </a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                {{--<li><a href="page_user_profile.html">My profile</a></li>--}}
                                {{--<li><a href="page_settings.html">Settings</a></li>--}}
                                @if(Auth::check())
                                    <li><a href="{{url('logout')}}">خروج</a></li>
                                @else
                                    <li><a href="{{url('login')}}">ورود</a></li>
                                    <li><a href="{{url('register')}}">ثبت نام</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="header_main_search_form">
        <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
        <form class="uk-form uk-autocomplete" data-uk-autocomplete="{source:'data/search_data.json'}">
            <input type="text" class="header_main_search_input"/>
            <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i>
            </button>
            {{--<script type="text/autocomplete">--}}
            {{--<ul class="uk-nav uk-nav-autocomplete uk-autocomplete-results">--}}
            {{--{{~items}}--}}
            {{--<li data-value="{{ $item.value }}">--}}
            {{--<a href="{{ $item.url }}">--}}
            {{--{{ $item.value }}<br>--}}
            {{--<span class="uk-text-muted uk-text-small">{{{ $item.text }}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--                            {{/items}}--}}
            {{--</ul>--}}
            {{--</script>--}}
        </form>
    </div>
</header><!-- main header end -->
<!-- main sidebar -->
@include('sidebar')
@yield('content')
@include('layouts.footer')

</body>
</html>
