@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-5-5">
                            <h4 class="heading_a uk-margin-bottom">همه کاربران</h4>
                            <input type="text" style="width: 100%" id="search-all-user" class="m-b-30" placeholder="جستجوی کاربران">

                            <div class="md-card uk-margin-medium-bottom">
                                <div class="md-card-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table uk-table-hover">
                                            <thead>
                                            <tr>
                                                <th>نام شخص</th>
                                                <th>ایمیل</th>
                                                <th>امتیاز</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody-js"></tbody>
                                            <tbody id="tbody-php">
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{intval($user->total_point)}}</td>
                                                    <td class="uk-text-center">
                                                        <a href="{{url('/login-a-user/'.$user->id)}}">Login</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <span id="pag">
                                        {!! $users->render() !!}
                                        </span>
                                        {{--                                        {!! $users->links('pagination') !!}--}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
            repeat_stopper = 0;
            var typingTimer;                //timer identifier

            $('#search-all-user').keyup(function (e) {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                    var val = e.target.value;
                    axios.post('{{url('/search-all-user')}}', {
                        val: val
                    }).then(function (res) {
                        console.log(res, 88)
                        if (res.data !=='') {
                            $('#tbody-js').html(res.data)
                            $('#tbody-php,#pag').hide()
                        } else {
                            $('#tbody-php,#pag').show()
                        }
                    }).catch(function (err) {
                        console.log(err)
                        // repeat_stopper = 0;
                    })
                }, 500);
            });
            $(".get-prize-btn").click(function (e) {
                repeat_stopper++;
                if (repeat_stopper > 1) {
                    return;
                }
                var a = $(this).data('prize-id');
                // alert(a);
                e.preventDefault();
                // alert(22);
                // return;
                axios.post('{{url('/set-user-prize')}}', {
                    prizeID: a
                }).then(function (res) {
                    console.log(res)
                    repeat_stopper = 0;
                    if (res.data.error == 1)
                        var status = 'danger'
                    else {
                        var status = 'success'
                        $('#current_point').html(res.data.currentPoint)
                        $('#user_prize_acquired').html(res.data.currentPrizeTable)

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

            });
        };
    </script>
@endsection
