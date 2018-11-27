{{--@extends('layouts.app')--}}

{{--@section('content')--}}

{{--<div id="page_content">--}}
{{--<div id="page_content_inner">--}}
{{--<div id="app"></div>--}}
<div class="md-card">
    <div class="md-card-content">
        <div class="uk-grid" data-uk-grid-margin>
			<?php use Illuminate\Support\Facades\DB;
            $vip = getVipStatus();
			?>
            <div class="uk-width-1-1">
                <h4 class="d-inline-block heading_a uk-margin-bottom m-l-10"> امتیاز شما : </h4>
                <h2 class="d-inline-block current_point" > {{(int)Auth::user()->total_point}} </h2>
            </div>
            @foreach($prizes as $prize)
                {{--@dd(getVipStatus())--}}
                <div class="uk-width-1-3">
                    <div class="uk-text-center"><img src="{{url($prize->pic)}}" style="height: 100px;width: 100px;"></div>
                    <div class="uk-text-center m-t-10 m-b-10">{{$prize->name}}</div>
                    <div class="uk-text-center m-t-10 m-b-10">{{$prize->point*((100-$vip['discount'])/100)}} امتیاز </div>
                    <div class="uk-text-center"><?php
//						$disable = 0;
//						if ( DB::table( 'user_prize' )->where( [
//							'user_id'  => Auth::user()->id,
//							'prize_id' => $prize->id
//						] )->first() ) {
//							$disable = 1;
//						}; ?>
                        <button class="md-btn md-btn-success get-prize-btn"
                                data-prize-id="{{$prize->id}}"
                                type="button" data-uk-button>
                            دریافت
                        </button>

                        {{--</form>--}}
                    </div>
                </div>
            @endforeach

        </div>
        {{--</div>--}}

    </div>
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}
