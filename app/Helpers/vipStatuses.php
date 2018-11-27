<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists('haaa')) {
    function getVipStatus($isDashboard=false)
    {
        $targetVip = [];
        if (Auth::check()) {


            $vip = App\VipStatus::all();
            $cond = '';
            $user_vip_point = Auth::user()->vip_point;
            $b = 0;
            $discount = [];
            foreach ($vip as $k => $value) {
                $discount[$value->id] = $value->point;
            }
            asort($discount);
            $nextVip=null;
            foreach ($discount as $k => $value) {
                if ($user_vip_point < $value) {
                    $nextVip = $k;
                    break;
                } else {
                    $currentVip = $k;
                }
            }
            $nextVip!==null?:$nextVip=$currentVip;
//            dd($user_vip_point,$nextVip);
            $targetVip = \App\VipStatus::find($currentVip)->toArray();
            if($isDashboard){
                $targetVip['next']= \App\VipStatus::find($nextVip)->toArray();
                $user_point  = Auth::user()->vip_point;
                $targetVip['currentPoint']= $user_point;
//                $vipStatus['next']['req']=$vipStatus['next']['req']
            }
        }
//        dd($targetVip);

        return $targetVip;

    }
}