<?php

namespace App\Http\Controllers;

use App\Message;
use App\Prize;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = null;
        $message = null;
        if (Auth::check()) {
            $user = Auth::user();
//		  		dd($user);ss
//		    $messages= Message::where(['user_id'=>430,'seen'=>null])->get()->take(5);
//		    dd($messages);
        }

        return view('home', compact('user'));
    }

    public function dashboard()
    {
        $prizes = Prize::all();
        if (Auth::check()) {
            $user_prize = Auth::user()->prize()->get();
        } else {
            return view('home', compact('user'));

        }
        return view('dashboard', compact('prizes', 'user_prize'));
    }

    public function dashboardImgEdit(Request $request)
    {
//		dd($request->allFiles());
        $file = $request->file('profile-pic-input');
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $fileName = $file->getClientOriginalName();
        $filePath = "/upload/file/{$year}/{$month}/";
        $finalPath = $this->fileFinalPath($filePath);
//        $finalPath = $_SERVER['DOCUMENT_ROOT'].'/club' .$filePath ; !!!!!!!!!!!!!!!!!!!for host use this
        $t = time();
        $file = $file->move($finalPath, $t . $fileName);
//		dd($file->getRealPath());
        $user = Auth::user();
        $user->profile_pic = ($filePath . $t . $fileName);
//		dd($user->profile_pic);
        $user->save();
        return back();
    }

    public function prizeImgEdit(Request $request)
    {
//		dd($request->allFiles());
        $file = $request->file('prize-pic-input');
        $id = $request->input('prize-id');
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $fileName = $file->getClientOriginalName();
        $filePath = "/upload/file/{$year}/{$month}/";
        $finalPath = $this->fileFinalPath($filePath);
//        $finalPath = $_SERVER['DOCUMENT_ROOT'].'/club' .$filePath ; !!!!!!!!!!!!!!!!!!!for host use this
        $t = time();
        $file = $file->move($finalPath, $t . $fileName);

        $prize = Prize::find($id);
        if (file_exists($prize->pic)) {
            unlink($prize->pic);
        }
//		$user = Auth::user();
        $prize->pic = ($filePath . $t . $fileName);
//		dd($user->profile_pic);
        $prize->save();
        return back();
    }
}
