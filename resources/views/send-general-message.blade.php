@extends('layouts.app')
@section('content')
    {{--<div id="page_content">--}}
    {{--<div id="page_content_inner">--}}
    {{--<div id="app"></div>--}}
    {{--<h3 class="heading_b uk-margin-bottom">Blank Page</h3>--}}
    {{--<div class="md-card">--}}
    {{--<div class="md-card-content">--}}
    {{--<div class="uk-grid" data-uk-grid-margin>--}}
    {{----}}
    {{--<div class="uk-width-1-1">--}}
    {{--Voluptas facilis sapiente iusto magnam dolor sapiente numquam ipsum quo maxime qui provident--}}
    {{--dolorem soluta sunt eos expedita eum sed aut optio dolorem consequuntur voluptatem aut--}}
    {{--delectus recusandae voluptatum fugiat ullam eaque aut officiis aut quo illum quos ex odio--}}
    {{--eum et provident eos delectus ipsum et adipisci odit recusandae ullam qui corrupti ipsam--}}
    {{--esse omnis sit soluta enim consequatur fuga ut rerum aspernatur odit voluptatem autem eaque--}}
    {{--est esse veritatis a omnis corporis repellat quo odio sint voluptatem voluptas veniam--}}
    {{--eveniet nihil qui est est fugiat magnam illum recusandae est aut et necessitatibus eius--}}
    {{--veniam accusamus ex dolorem voluptatem fugit eveniet consequuntur rerum vitae voluptas quod--}}
    {{--est fugiat maiores eos necessitatibus facere dolores repellendus praesentium suscipit est--}}
    {{--non pariatur quia accusamus et non veniam enim eos est doloremque sit iusto voluptas quas--}}
    {{--nemo nam ut quibusdam ratione aliquid vero ut nesciunt facilis perferendis asperiores atque--}}
    {{--incidunt eligendi quis ullam ut aut quam repudiandae minus aut soluta facilis nam quia--}}
    {{--inventore qui deserunt optio voluptatum quos voluptatem accusantium eum rerum magni sit modi--}}
    {{--quia perspiciatis nemo aut adipisci quis tenetur tempora rem nam.--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    @if(Session::has('message'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            {{--<h3>Notice</h3>--}}
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        </div>
    @endif
    <div id="app"></div>
    <div id="page_content">
        <div id="page_content_inner">

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-5-5">
                    <form method="POST" action="{{url('/send-general-message')}}" data-parsley-validate>
                        @csrf
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="parsley-row">
                                            <label>عنوان</label>
                                            <input type="text" class="md-input" name="subject"
                                                   value="" required>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="parsley-row">
                                            <h3 class="heading_a uk-margin-bottom">متن</h3>
                                            <textarea name="text" style="width: 100%;
                                min-height: 200px;
                                padding: 10px;
                                box-sizing: border-box;
                                direction: rtl;"></textarea></div>
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <button type="submit" href="#" class="md-btn md-btn-primary">ثبت</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('generalMessage')
    <script src="{{url('bower_components/ion.rangeslider/js/ion.rangeSlider.min.js')}}"></script>

    <script src="{{url('js/uikit_htmleditor_custom.min.js')}}"></script>
    <!-- inputmask-->
    <script src="{{url('bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{url('js/pages/forms_advanced.min.js')}}"></script>
@endsection
