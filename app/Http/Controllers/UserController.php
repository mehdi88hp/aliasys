<?php

namespace App\Http\Controllers;

use App\ActivationCode;
use App\Mail\UpdateUserPoints;
use App\Message;
use App\Opt;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

//use MyExcelReader;

class UserController extends Controller
{
    public function activation($token)
    {
        $activationCode = ActivationCode::whereCode($token)->first();

        if (!$activationCode) {
            dd('not exist');

            return redirect('/');
        }

        if ($activationCode->expire < Carbon::now()) {
            dd('expire');

            return redirect('/');
        }

        if ($activationCode->used == true) {
            dd('used');

            return redirect('/');
        }
        $user = $activationCode->user();
//		dd( $user );
        $activationCode->user()->update([
            'active' => 1
        ]);

        $activationCode->update([
            'used' => true
        ]);

        auth()->loginUsingId($activationCode->user->id);

        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);

        return view('users.all-users', compact('users'));
    }


    public function showExcelView(Request $request)
    {
        return view('users.excel');
    }

    public function xaddFromExcel(Request $request)
    {
//		dd( $request->file( 'excel-file' ) );
        ini_set('memory_limit', '-1');
        $file = $request->file('excel-file');
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $fileName = $file->getClientOriginalName();
        $filePath = "/upload/file/{$year}/{$month}/";
        $finalPath = public_path($filePath);
        $t = time();
        $file = $file->move($finalPath, $t . $fileName);
//		$spreadsheet = IOFactory::load( $file );
//		    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//		$reader = StringTable();
//		$spreadsheet =$reader->load($file)->getStringTable();
        /**  Create an Instance of our Read Filter  **/
        $MyExcelReader = new MyExcelReader(1, 79, range('A', 'J'));

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader('Xlsx');
        /**  Tell the Reader that we want to use the Read Filter  **/
        $reader->setReadFilter($MyExcelReader);
        /**  Load only the rows and columns that match our filter to Spreadsheet  **/
        $spreadsheet = $reader->load($file);
        dd($spreadsheet);
    }

    public function addFromExcel(Request $request)
    {
//		dd( $request->file( 'excel-file' ) );
        $admin_id = Auth::user()->id;
        ini_set('memory_limit', '-1');
        ini_set('max_input_time', '-1');
        ini_set('max_execution_time', '6000');
        $file = $request->file('excel-file');
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $fileName = $file->getClientOriginalName();
        $filePath = "/upload/file/{$year}/{$month}/";
        $finalPath = $this->fileFinalPath($filePath);
        $t = time();
        $file = $file->move($finalPath, $t . $fileName);
        $spreadsheet = IOFactory::load($file)->getActiveSheet()->toArray();
        $head = $spreadsheet[0];
        unset($spreadsheet[0]);
//		$spreadsheet = $spreadsheet->load($file);
        $sendEmailWhenPointIsUp = Opt::whereName('sendEmailWhenPointIsUp')->first();
        foreach ($spreadsheet as $k => $v) {
            if ($k == 0 && filter_var($v[4], FILTER_VALIDATE_EMAIL) === false) { //its header
                continue;
            }
            $v[2] = intval($v[2]);
//			dd($v,intval($v[2]));
//			$email = filter_var( $v[4], FILTER_VALIDATE_EMAIL ) ?? 'aliasys_' . intval($v[2]) . '@gmail.com';
            if (filter_var($v[4], FILTER_VALIDATE_EMAIL)) {
                $email = $v[4];
            } else {
                $email = 'aliasys_' . ($v[2]) . '@gmail.com';
            }
            $user = User::where('code', $v[2])->first();
            if (empty($user)) {
                $user = new User;
            } else {
                if ($user->email != $email) {
                    Session::flash('message', 'خطا پیش آمد');
                    dd('کاربر با ایمیل ' . "\n" . $user->email . "\n" . 'دو بار با دو کد کاربری متفاوت ثبت شده است که این امر امکان پذیر نیست.');
//					return back();
                }
            }
//			$user = User::firstOrNew( [ 'code' => $v[2] ] );
            $user->email = $email;
            if (empty($v[0])) {
                dd('فیلد نام خالی است');
            }
            $user->name = $v[0];
            $user->code = $v[2];
            $user->phone = $v[3];
            $user->password = bcrypt($v[2] . $v[2]);
            $user->active = 1;
            $user->level = 'user';
            $user->save();

            if ($user->total_point != $v[1]) {
                $msg = ' به امتیاز کل شما ' . (intval($v[1]) - $user->total_point) . ' امتیاز اضافه شد';
                Message::create([
                    'user_id' => $user->id,
                    'content' => $msg,
                    'sender_user_id' => $admin_id,
                    'subject' => 'افزایش امتیاز'
                ]);
                if ((intval($v[1]) > intval($user->total_point)) || intval($v[5]) > intval($user->vip_point)) {
                    if ( $request->send_mail==='on') {
                        Mail::to($user)->send(new UpdateUserPoints($user, intval($v[1])));
                    }
                }
            }
            $user->total_point = intval($v[1]);
            $user->vip_point = intval($v[5]);
            $user->save();
        }
        unlink($file);
        Session::flash('message', 'با موفقیت ثبت شدند');

        return back();
//		dd( $spreadsheet, $head );
    }

    public function profileComplete(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->code = $request->code;
        $user->save();

        return back();

    }

    public function resetUserNotification()
    {
        Message::where(['seen' => null, 'user_id' => Auth::user()->id])->update(['seen' => 1]);
    }

    public function searchAllUser(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->val . '%')->get();
        $o = '';
        if ($request->val) {
            foreach ($users as $user) {
                $o .= "<tr>
                    <td>$user->name</td>
                    <td>$user->email</td>
                    <td>" . (int)$user->total_point . "</td>
                    <td class='uk-text-center'>
                    <a href='".url("/login-a-user/$user->id")."'>Login</a>
                    </td>
                    </tr>";
            }
        }
        return $o;
    }

    public function loginAUser(Request $request, User $user)
    {
        auth()->loginUsingId($user->id);
        return redirect('/');
    }

}
