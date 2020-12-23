<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$bs->website_title}}</title>

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/qr-menu.css')}}">
    @if ($defaultLang->rtl == 1)
    <link rel="stylesheet" href="{{asset('assets/front/css/qr-rtl.css')}}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/front/css/qr-styles.php?color='.str_replace('#','',$bs->base_color)) }}">
    <!--====== jquery js ======-->
    <script src="{{asset('assets/front/js/vendor/jquery.3.2.1.min.js')}}"></script>
</head>
<body class="qr-menu">
    <div class="header">
        <div class="container">
            <div class="col-lg-2">
                <div class="logo-wrapper">
                    <img src="{{asset('assets/front/img/'.$bs->logo)}}" alt="Logo">
                </div>
            </div>
            <div class="col-lg-10">

            </div>
        </div>
    </div>

    <div class="container">
        <div class="title">
            <h2>{{$bs->website_title}}</h2>
            <small>{{__('Working Hours')}}: {{$bs->office_time}}</small>
        </div>
        <h4 class="menu-title">{{__('Menu')}}</h4>
    </div>


    <section class="food-menu-area food-menu-2-area food-menu-3-area">
        <div class="container">
            <div class="categories-tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-btn pb-20">
                            <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                @foreach ($categories as $keys => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{$keys == 0 ? 'active' : ''}}" id="{{$category->slug}}-tab" data-toggle="pill" href="#{{$category->slug}}" role="tab" aria-controls="{{$category->slug}}" aria-selected="true">
                                        <p>{{convertUtf8($category->name)}}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($categories as $key => $category)
                        <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}"  id="{{$category->slug}}" role="tabpanel" aria-labelledby="{{$category->slug}}-tab">
                            <div class="row justify-content-center">
                                @if($category->products()->where('status', 1)->count() > 0)
                                @foreach ($category->products()->where('status', 1)->get() as $product)
                                <div class="col-lg-6">
                                    <div class="food-menu-items">
                                        <div class="single-menu-item mt-30">
                                            <div class="menu-thumb">
                                                <img src="{{asset('assets/front/img/product/featured/'.$product->feature_image)}}" alt="menu">
                                                <div class="thumb-overlay">
                                                    <a href="#"><i class="flaticon-add"></i></a>
                                                </div>
                                            </div>
                                            <div class="menu-content ml-30">
                                                <a class="title" href="#">{{convertUtf8($product->title)}}</a>
                                                <p>{{convertUtf8($product->summary)}} </p>
                                            </div>
                                            <div class="menu-price-btn">
                                                @if (!empty($product->variations) || !empty($product->addons))
                                                    <a class="cart-link" data-product="{{$product}}" data-href="{{route('add.cart',$product->id)}}">{{__('Details')}}</a>
                                                @endif

                                                <span>{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{convertUtf8($product->current_price)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                </span>
                                                @if($product->previous_price)
                                                <del>  {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{convertUtf8($product->previous_price)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</del>
                                                @endif
                                            </div>
                                            @if ($product->is_special == 1)
                                                <div class="flag flag-2"><span>{{__('Special')}}</span></div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-lg-12 bg-light py-5 mt-4">
                                    <h4 class="text-center">{{__('Product Not Found')}}</h4>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Variation Modal Starts --}}
    @includeIf('front.partials.qr-variation-modal')
    {{-- Variation Modal Ends --}}

    <!--====== Bootstrap js ======-->
    <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
    <script>
        var textPosition = "{{$be->base_currency_text_position}}";
        var currText = "{{$be->base_currency_text}}";
    </script>
    <script src="{{asset('assets/front/js/qr-cart.js')}}"></script>
</body>
</html>
