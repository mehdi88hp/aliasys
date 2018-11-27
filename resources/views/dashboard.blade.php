@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-5">
                    {{--<div class="md-card">--}}
                    {{--<div class="md-card-content">--}}
                    {{--Voluptatum a laboriosam eum quisquam illo possimus non rerum architecto numquam iure tempore iste ea nihil enim iusto sed aspernatur itaque id optio error aut impedit ab nemo nemo est repudiandae voluptatum et asperiores eaque et voluptatum nam velit et ad ea consequuntur facere eos maxime expedita veniam non ut pariatur odio blanditiis non quod molestiae inventore.--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="md-card md-card-hover" style="width: 200px;height: 200px">
                        <div class="gallery_grid_item md-card-content">
                            <form action="{{url('dashboard-img-edit')}}" id="change-profile-form" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <a href="javascript:void(0)" id="change-profile-pic">
                                    <label for="profile-pic-input">
                                        <input type="file" style="display: none" name="profile-pic-input"
                                               id="profile-pic-input">
                                        <div style="position:relative;" id="profile-pic-preview-div">
                                            <img src="{{url(Auth::user()->profile_pic??'/img/unknown-big.png')}}"
                                                 id="profile-pic-preview" width="200"
                                                 style="max-height: 200px" height="200">
                                            <span
                                                style="position:absolute;top: 50%;left: 50%;transform: translate(-50%)"
                                                id="profile-pic-preview-span">
                                                ویرایش
                                        </span>
                                        </div>
                                    </label>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if (Auth::check()) {
//					$point       = Auth::user()->total_point;
                    $vip = App\VipStatus::all();
                    $cond = '';
                    $user_point = Auth::user()->vip_point;
                    $b = 0;
                    $next_set = false;
                    $max_vip = false;
                    $chart_empty = true;
                    $last_val = null;
                    $vip_color = '#ccc';
                    $vipStatus = getVipStatus(true);

                    foreach ($vip as $k => $value) {
                        $last_val = $value;
                        $a = $value->point;
                        if (($user_point > $value->point && $value->point >= $b)) {
                            $b = $value->point;
                            $cond = $value->name;
                            $vip_color = $value->color;
                            $vip_discount = $value->discount;
                        }

                        if ($user_point <= $value->point) {
                            if ($next_set === false || ($value->point < $a)) {
                                $chart_empty = false;
                                $next_set = true;
                                $next_point = $value->point - $user_point;
                                $next_vip = $value->name;
                                if ($value->point == 0) {
                                    $chart_percent = 0;
                                } else {
                                    $chart_percent = floatval((int)$user_point / (int)$value->point) * 100;
                                }
                            }
                        }
                    }
                    if ($chart_empty) {
                        $max_vip = true;
                        $chart_empty = false;
                        $next_set = true;
                        $next_point = $last_val->point - $user_point;
                        $next_vip = $value->name;
                        if ($last_val->point == 0) {
                            $chart_percent = 0;
                        } else {
                            $chart_percent = floatval((int)$user_point / (int)$last_val->point) * 100;
                        }
                    }
                }
                ?>
                <div class="uk-width-medium-4-5">
                    <div
                        class="uk-grid uk-grid-width-small-1-1 uk-grid-width-large-1-1 uk-grid-width-xlarge-1-1 uk-text-center"
                        data-uk-grid-margin>
                        <div>
                            <div class="md-card md-card-overlay" style=" height: 145px;">
                                @isset($chart_percent)
                                    <div class="md-card-content">

                                        <div class="epc_chart" data-percent="{{$chart_percent}}"
                                             data-bar-color="{{$vipStatus['color']}}">
                                        <span class="epc_chart_text"><span
                                                class="countUpMe">{{$user_point}}</span></span>
                                        </div>

                                    </div>
                                    <div class="md-card-overlay-content">
                                        <div class="uk-clearfix md-card-overlay-header">
                                            <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                            {{--<div id="ct-chart" class="chartist"></div>--}}

                                            <h3>کاربر
                                                {{$vipStatus['name']}}
                                            </h3>
                                        </div>
                                        @if($max_vip)<span>شما در بالاترین سطح کاربری قرار دارید.</span>
                                        @else
                                            <span>تا سطح بعدی که کاربر</span>
                                            <span>{{$vipStatus['next']['name']}}</span>
                                            <span> می باشد ، شما به </span>
                                            <span>{{$vipStatus['next']['point']-$vipStatus['currentPoint']}}</span>
                                            <span>امتیاز نیاز دارید.</span>
                                        @endif
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('prize.get-prize')
        </div>
    </div>
    <!-- chartist (charts) -->

    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                $('#change-profile-form').submit();

                reader.onload = function (e) {
                    $('#profile-pic-preview').attr('src', e.target.result);
                }
                console.log('e.target.result');
                reader.readAsDataURL(input.files[0]);
            }
        }

        // window.onload = function () {
        // repeat_stopper = 0;
        // alert(3434)


        // };
    </script>

@endsection
@section('dashboard')
    <script src="{{url('bower_components/d3/d3.min.js')}}"></script>
    <!-- metrics graphics (charts) -->
    <script src="{{url('bower_components/metrics-graphics/dist/metricsgraphics.min.js')}}"></script>
    <!-- chartist (charts) -->
    <script src="{{url('bower_components/chartist/dist/chartist.min.js')}}"></script>
    <!-- maplace (google maps) -->
    {{--<script src="http://maps.google.com/maps/api/js"></script>--}}
    <script src="{{url('bower_components/maplace-js/dist/maplace.min.js')}}"></script>
    <!-- peity (small charts) -->
    <script src="{{url('bower_components/peity/jquery.peity.min.js')}}"></script>
    <!-- easy-pie-chart (circular statistics) -->
    <script src="{{url('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
    <!-- countUp -->
    <script src="{{url('bower_components/countUp.js/dist/countUp.min.js')}}"></script>
    <script src="{{url('js/pages/dashboard.min.js')}}"></script>



    <script>
        window.onload = function () {
            repeat_stopper = 0;
            $(".get-prize-btn").click(function (e) {
                repeat_stopper++;
                if (repeat_stopper > 1) {
                    return;
                }
                if (confirm('اطمینان دارید?')) {


                    var a = $(this).data('prize-id');
                    // alert(a);
                    e.preventDefault();
                    // alert(22);
                    // return;
                    var t = $(this);
                    axios.post('{{url('/set-user-prize')}}', {
                        prizeID: a
                    }).then(function (res) {
                        console.log(res)
                        repeat_stopper = 0;
                        if (res.data.error == 1)
                            var status = 'danger'
                        else {
                            var status = 'success'
                            $('.current_point').html(res.data.currentPoint)
                            // $('#user_prize_acquired').html(res.data.currentPrizeTable)
                            // t.addClass('disabled');
                            t.removeClass('uk-active');
                            // t.html('دریافت شده');
                        }
                        UIkit.notify({
                            message: res.data.msg,
                            pos: 'top-right',
                            status: status,
                            timeout: 3000,
                        });
                    }).catch(function (err) {
                        console.log(err)
                        repeat_stopper = 0;
                    })
                    return;
                } else {
                    setTimeout(function () {
                        repeat_stopper = 0;
                    }, 1000)
                }
            });
            jQuery(document).ready(function () {
                $('#profile-pic-input').change(function (e) {
                    console.log($(this).val(), e)
                    readURL(this);
                });
                $('#profile-pic-preview-div').mouseenter(function (e) {
                    e.stopPropagation();
                    $('#profile-pic-preview-span').show()
                    $('#profile-pic-preview').css({'opacity': 0.3, 'cursor': 'pointer'})
                })

                $('#profile-pic-preview-div').mouseleave(function (e) {
                    e.stopPropagation();
                    $('#profile-pic-preview-span').hide()
                    $('#profile-pic-preview').css('opacity', 'inherit')
                })
            })
        };
    </script>

@endsection
