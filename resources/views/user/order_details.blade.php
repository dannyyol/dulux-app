@extends('front.layout')

@section('content')
@section('content')
<section class="page-title-area d-flex align-items-center" style="background-image: url('{{asset('assets/front/img/' . $bs->breadcrumb)}}');background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">{{__('Order Details')}}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">{{('Order Details')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

    <!--====== CHECKOUT PART START ======-->
    <section class="user-dashbord">
        <div class="container">
            <div class="row">
                @include('user.inc.site_bar')
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="user-profile-details">
                                <div class="order-details">
                                    <div class="progress-area-step">
                                        <ul class="progress-steps">
                                            <li class="{{$data->order_status == 'pending' ? 'active' : ''}}">
                                                <div class="icon"></div>
                                                <div class="progress-title">{{__('Pending')}}</div>
                                            </li>
                                            <li class="{{$data->order_status == 'received' ? 'active' : ''}}">
                                                <div class="icon"></div>
                                                <div class="progress-title">{{__('Received')}}</div>
                                            </li>
                                            <li class="{{$data->order_status == 'preparing' ? 'active' : ''}}">
                                                <div class="icon"></div>
                                                <div class="progress-title">{{__('Preparing')}}</div>
                                            </li>
                                            <li class="{{$data->order_status == 'ready_to_pick_up' ? 'active' : ''}}">
                                                <div class="icon"></div>
                                                <div class="progress-title">{{__('Ready to pick up')}}</div>
                                            </li>
                                            <li class="{{$data->order_status == 'picked_up' ? 'active' : ''}}">
                                                <div class="icon"></div>
                                                <div class="progress-title">{{__('Picked up')}}</div>
                                            </li>
                                            <li class="{{$data->order_status == 'delivered' ? 'active' : ''}}">
                                                <div class="icon"></div>
                                                <div class="progress-title">{{__('Delivered')}}</div>
                                            </li>
                                            <li class="{{$data->order_status == 'cancelled' ? 'active' : ''}}">
                                                <div class="icon"></div>
                                                <div class="progress-title">{{__('Cancelled')}}</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="title">
                                        <h4>{{__('My Order Details')}}</h4>
                                    </div>
                                    <div id="print">
                                    <div class="view-order-page">
                                        <div class="order-info-area">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8">
                                                   <div class="order-info">
                                                       <h3 class="text-capitalize">{{__('Order')}} {{$data->order_id}} [{{str_replace("_", " ", $data->order_status)}}]</h3>
                                                   <p>{{__('Order Date')}} {{$data->created_at->format('d-m-Y')}}</p>
                                                   </div>
                                                </div>
                                                <div class="col-lg-4 print-btn">
                                                    <div class="prinit">
                                                        <a href="{{asset('assets/front/invoices/product/' . $data->invoice_number)}}" download="invoice" id="print-click" class="btn"><i class="fas fa-print"></i>{{__('Download Invoice')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="billing-add-area">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="main-info">
                                                    <h5>{{__('Shipping Details')}}</h5>
                                                    <ul class="list">
                                                        <li><p><span>{{__('Email Address')}}:</span>{{convertUtf8($data->shpping_email)}}</p></li>
                                                        <li><p><span>{{__('Phone')}}:</span>{{convertUtf8($data->shpping_number)}}</p></li>
                                                        <li><p><span>{{__('City')}}:</span>{{convertUtf8($data->shpping_city)}}</p></li>
                                                        <li><p><span>{{__('Address')}}:</span>{{convertUtf8($data->shpping_address)}}</p></li>
                                                        <li><p><span>{{__('Country')}}:</span>{{convertUtf8($data->shpping_country)}}</p></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="main-info">
                                                    <h5>{{__('Billing Details')}}</h5>
                                                    <ul class="list">
                                                        <li><p><span>{{__('Email Address')}}:</span>{{convertUtf8($data->billing_email)}}</p></li>
                                                        <li><p><span>{{__('Phone')}}:</span>{{convertUtf8($data->billing_number)}}</p></li>
                                                        <li><p><span>{{__('City')}}:</span>{{convertUtf8($data->billing_city)}}</p></li>
                                                        <li><p><span>{{__('Address')}}:</span>{{convertUtf8($data->billing_address)}}</p></li>
                                                        <li><p><span>{{__('Country')}}:</span>{{convertUtf8($data->billing_country)}}</p></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-md-4 ">
                                                <div class="payment-information">
                                                    <h5>{{__('Payment Status')}} : </h5>
                                                    <p>{{__('Payment Status')}} :
                                                        @if($data->payment_status =='Pending' || $data->payment_status == 'pending')
                                                        <span class="badge badge-danger">{{$data->payment_status}}  </span>
                                                        @else
                                                        <span class="badge badge-success">{{$data->payment_status}}  </span>
                                                        @endif
                                                    </p>
                                                    @if (!empty($data->shipping_method))
                                                    <p>{{__('Shipping Method')}} : <span> {{$data->shipping_method}} </span></p>
                                                    @endif
                                                    <p>{{__('Shipping Charge')}} : <span class="amount">{{$data->currency_symbol_position == 'left' ? $data->currency_symbol : ''}} {{$data->shipping_charge}} {{$data->currency_symbol_position == 'right' ? $data->currency_symbol : ''}}</span></p>
                                                    <p>{{__('Paid Amount')}} : <span class="amount">{{$data->currency_symbol_position == 'left' ? $data->currency_symbol : ''}} {{$data->total}} {{$data->currency_symbol_position == 'right' ? $data->currency_symbol : ''}}</span></p>
                                                <p>{{__('Payment Method')}} : {{convertUtf8($data->method)}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive product-list">
                                        <h5>{{__('Ordered Products')}}</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>{{__('Product')}}</th>
                                                   <th>{{__('Product Title')}}</th>
                                                   <th>{{__('Price')}}</th>
                                                   <th>{{__('Quantity')}}</th>
                                                   <th>{{__('Total')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->orderitems as $key => $item)
                                                @php
                                                    $product = App\Models\Product::findOrFail($item->product_id);
                                                @endphp
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        <img src="{{asset('assets/front/img/product/featured/'.$item->image)}}" alt="image" width="100">
                                                    </td>
                                                    <td>
                                                        <a href="{{route('front.product.details',[$product->slug,$product->id])}}">{{convertUtf8($item->title)}}</a>
                                                        <br>
                                                        @php
                                                            $variations = json_decode($item->variations, true);
                                                        @endphp
                                                        @if (!empty($variations))
                                                          <strong class="mr-1">Variation:</strong> {{$variations["name"]}}
                                                          <br>
                                                        @endif
                                                        @php
                                                            $addons = json_decode($item->addons, true);
                                                        @endphp
                                                        @if (!empty($addons))
                                                          <strong class="mr-1">Add On's:</strong>

                                                          @foreach ($addons as $addon)
                                                              {{$addon["name"]}}
                                                              @if (!$loop->last)
                                                              ,
                                                              @endif
                                                          @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong class="mr-1">{{__("Product")}}:</strong>
                                                        {{$data->currency_code_position == 'left' ? $data->currency_code : ''}}
                                                        <span>{{(float)$item->product_price}}</span>
                                                        {{$data->currency_code_position == 'right' ? $data->currency_code : ''}}
                                                        <br>
                                                        @if (is_array($variations))
                                                            <strong class="mr-1">{{__("Variation")}}: </strong>
                                                            {{$data->currency_code_position == 'left' ? $data->currency_code : ''}}
                                                            <span>{{(float)$item->variations_price}}</span>
                                                            {{$data->currency_code_position == 'right' ? $data->currency_code : ''}}
                                                            <br>
                                                        @endif
                                                        @if (is_array($addons))
                                                            <strong class="mr-1">{{__("Add On's")}}: </strong>
                                                            {{$data->currency_code_position == 'left' ? $data->currency_code : ''}}
                                                            <span>{{(float)$item->addons_price}}</span>
                                                            {{$data->currency_code_position == 'right' ? $data->currency_code : ''}}
                                                        @endif
                                                    </td>
                                                    <td>{{$item->qty}}</td>
                                                    <td><span>{{$data->currency_code_position == 'left' ? $data->currency_code : ''}}</span> {{$item->total}} <span>{{$data->currency_code_position == 'right' ? $data->currency_code : ''}}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    <div class="edit-account-info">
                                        <a href="{{ URL::previous() }}" class="btn btn-primary">{{__('back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

