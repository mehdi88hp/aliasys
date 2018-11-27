@extends('layouts.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div id="app"></div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-5-5">
                            <h4 class="heading_a uk-margin-bottom">جوایز دریافت شده</h4>
                            <div class="md-card uk-margin-medium-bottom">
                                <div class="md-card-content">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table uk-table-hover">
                                            <thead>
                                            <tr>
                                                <th>نام شخص</th>
                                                <th>نام جایزه</th>
                                                <th>امتیاز</th>
                                                <th>تاریخ ثبت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($UserPrizes as $v)
{{--                                                @foreach($user->prize as $prize)--}}
{{--@dd($v->prize->user)--}}
                                                    <tr>
                                                        <td>{{$v->user->name}}</td>
                                                        <td>{{$v->prize->name}}</td>
                                                        <td>{{$v->prize->point}}</td>
                                                        <td>{{jdate($v->created_at)->format('%d %B %Y H:i:s')}}</td>
                                                        <td class="uk-text-center">
                                                        </td>
                                                    </tr>
                                                {{--@endforeach--}}
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {!! $UserPrizes->render() !!}

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
                axios.post('/set-user-prize', {
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
