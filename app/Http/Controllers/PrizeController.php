<?php

namespace App\Http\Controllers;

use App\Prize;
use App\User;
use App\UserPrize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $prizes = Prize::with('user')->get();

//		dd( $prizes[2]->user()->get() );

        return view('prize.create')->with(compact('prizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts = $request->all();
//dd($posts);
        $prizes = [];

        /*مرتب کردن آرایه ورودی*/
        foreach ($posts as $k1 => $post) {
            if ($k1 == 'prize_name') {
                foreach ($post as $k2 => $name) {
                    if (is_array($name)) {
                        $prizes[$k2]['name'] = array_values($name)[0];
                    } else {
                        $prizes[$k2]['name'] = $name;
                    }
                }
            }
            if ($k1 == 'prize_point') {
                foreach ($post as $k2 => $point) {
                    if (is_array($point)) {
                        $prizes[$k2]['point'] = array_values($point)[0];
                    } else {
                        $prizes[$k2]['point'] = $point;
                    }
                }
            }
            if ($k1 == 'prize_pic') {
                foreach ($post as $k2 => $pic) {
                    if (is_array($pic)) {
                        $file = array_values($pic)[0];
                    } else {
                        $file = $pic;
                    }
                    $year = Carbon::now()->year;
                    $month = Carbon::now()->month;
                    $fileName = $file->getClientOriginalName();
                    $filePath = "/upload/file/{$year}/{$month}/";
                    $finalPath = $this->fileFinalPath($filePath);
//                    $finalPath = $_SERVER['DOCUMENT_ROOT'] . '/club' . $filePath; //!!!!!!!!!!!!!!!!!!!for host use this
                    $t = time();
                    $file = $file->move($finalPath, $t . $fileName);
                    $prizes[$k2]['pic'] = $filePath . $t . $fileName;
//					dd( $file );
                }
            }
        }
//		dd( $prizes );
        foreach ($prizes as $prize) {
            Prize::create(['point' => $prize['point'], 'name' => $prize['name'], 'pic' => $prize['pic']]);
        }

        return back();
//		return back()->with(compact('prizes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prize $prize
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Prize $prize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prize $prize
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Prize $prize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Prize $prize
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prize $prize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prize $prize
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prize $prize)
    {
        //
    }

    public function getPrizeView()
    {
        $prizes = Prize::all();
        $user_prize = Auth::user()->prize()->get();

//dd($user_prize);
        return view('prize.get-prize')->with(compact('prizes', 'user_prize'));
    }

    public function setUserPrize(Request $request)
    {
//		return 1313;
//		if(!Auth::check()){
//			return ['error'=>1,'msg'=>'باید وارد شوید'];
//		}
        $currentUser = Auth::user();
        $prize = Prize::find($request->prizeID);

        $vip = getVipStatus();

        $reqPoint = $prize->point * ((100 - $vip['discount']) / 100);

        if (intval($currentUser->total_point) < $reqPoint) {
            return ['error' => 1, 'msg' => 'امتیاز شما کافی نیست'];
        }
//		if ( DB::table( 'user_prize' )->where( [
//			'user_id'  => $currentUser->id,
//			'prize_id' => $prize->id
//		] )->first() ) {
//			return [ 'error' => 1, 'msg' => 'قبلا این جایزه برای شما ثبت شده' ];
//		}
        $currentUser->total_point -= $reqPoint;
        $currentUser->save();
        $currentUser->prize()->attach($prize->id);
//		$user_prize = $currentUser->prize()->get();
//		$o          = '';
//		foreach ( $user_prize as $prize ) {
//			$o .= '<tr >
//          <td >' . $prize->name . '</td >
//          <td ></td >
//          <td class="uk-text-center" >
//          </td >
//      </tr >';
//		}

        return [
            'error' => 0,
            'msg' => 'این بسته با موفقیت برای شما ثبت شد',
            'currentPoint' => $currentUser->total_point,
//			'currentPrizeTable' => $o
        ];

        return [$prize, $currentUser];
    }

    public function allUserPrizesView()
    {
        $UserPrizes = UserPrize::with('prize', 'user')->latest()->paginate(20);

        return view('prize.all-user-prize')->with(compact('UserPrizes'));
    }

    public function prizeUserDetail($prize)
    {
//		dd($prize);
        $prize_user = Prize::find($prize);
        $prize_user->load('user');

//		dd($prize_user->toArray());
        return view('prize.prize-user-detail', compact('prize_user'));
    }

    public function prizeGotten()
    {
//		$prizes     = Prize::all();
        $user_prize = Auth::user()->prize()->get();

//dd($user_prize);
        return view('prize.prize-gotten')->with(compact('user_prize'));
    }

    public function prizeEdit()
    {
        $prize = Prize::find(request()->id);
        $prize->name = request()->name;
        $prize->point = request()->point;
        $prize->save();

        return 10;
    }

    public function prizeDelete()
    {
        $prize = Prize::find(request()->id);
        if (file_exists($prize->pic)) {
            unlink($prize->pic);
        }
        Prize::destroy(request()->id);

        return 'deleted';
    }

    public function presentsExplanation()
    {
        return view('presents-explanation');
    }
}
