@extends('front.layout')

@section('content')
<!--   hero area start   -->
<section class="page-title-area d-flex align-items-center" style="background-image:url('{{asset('assets/front/img/'.$bs->breadcrumb)}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">{{convertUtf8($bs->checkout_title)}}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{convertUtf8($bs->checkout_title)}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== PAGE TITLE PART ENDS ======-->
<!--   hero area end    -->
    <!--====== CHECKOUT PART START ======-->
    <section class="checkout-area">
        <form action="{{route('product.paypal.submit')}}" method="POST" id="payment" enctype="multipart/form-data">
            @csrf
            @if(Session::has('stock_error'))
            <p class="text-danger text-center my-3">{{Session::get('stock_error')}}</p>
            @endif
        <div class="container">

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form billing-info">
                        <div class="shop-title-box">
                            <h3>{{__('Billing Address')}}</h3>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="field-label">{{__('Country')}} *</div>
                                    <div class="field-input">
                                        <input type="text" name="billing_country" value="{{$user->billing_country}}">
                                    </div>
                                    @error('billing_country')
                                        <p class="text-danger">{{convertUtf8($message)}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="field-label">{{__('First Name')}} *</div>
                                    <div class="field-input">
                                        <input type="text" name="billing_fname" value="{{$user->billing_fname}}">
                                    </div>
                                    @error('billing_fname')
                                        <p class="text-danger">{{convertUtf8($message)}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="field-label">{{__('Last Name')}} *</div>
                                    <div class="field-input">
                                        <input type="text" name="billing_lname" value="{{$user->billing_lname}}">
                                    </div>
                                    @error('billing_lname')
                                        <p class="text-danger">{{convertUtf8($message)}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="field-label">{{__('Address')}} *</div>
                                    <div class="field-input">
                                        <input type="text" name="billing_address" value="{{$user->billing_address}}">
                                    </div>
                                    @error('billing_address')
                                        <p class="text-danger">{{convertUtf8($message)}}</p>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="field-label">{{__('Town / City')}} *</div>
                                    <div class="field-input">
                                        <input type="text" name="billing_city" value="{{$user->billing_city}}">
                                    </div>
                                    @error('billing_city')
                                    <p class="text-danger">{{convertUtf8($message)}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="field-label">{{__('Contact Email')}} *</div>
                                    <div class="field-input">
                                        <input type="text" name="billing_email" value="{{$user->billing_email}}">
                                    </div>
                                    @error('billing_email')
                                    <p class="text-danger">{{convertUtf8($message)}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="field-label">{{__('Phone')}} *</div>
                                    <div class="field-input">
                                        <input type="text" name="billing_number" value="{{$user->billing_number}}">
                                    </div>
                                    @error('billing_number')
                                    <p class="text-danger">{{convertUtf8($message)}}</p>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form shipping-info">
                        <div class="shop-title-box">
                            <h3>{{__('Shipping Address')}}</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field-label">{{__('Country')}} *</div>
                                <div class="field-input">
                                    <input type="text" name="shpping_country" value="{{$user->shpping_country}}">
                                </div>
                                @error('shpping_country')
                                    <p class="text-danger">{{convertUtf8($message)}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="field-label">{{__('First Name')}} *</div>
                                <div class="field-input">
                                    <input type="text" name="shpping_fname" value="{{$user->shpping_fname}}">
                                </div>
                                @error('shpping_fname')
                                <p class="text-danger">{{convertUtf8($message)}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="field-label">{{__('Last Name')}} *</div>
                                <div class="field-input">
                                    <input type="text" name="shpping_lname" value="{{$user->shpping_lname}}">
                                </div>
                                @error('shpping_lname')
                                <p class="text-danger">{{convertUtf8($message)}}</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="field-label">{{__('Address')}} *</div>
                                <div class="field-input">
                                    <input type="text" name="shpping_address" value="{{$user->shpping_address}}">
                                </div>
                                @error('shpping_address')
                                <p class="text-danger">{{convertUtf8($message)}}</p>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="field-label">{{__('Town / City')}} *</div>
                                <div class="field-input">
                                    <input type="text" name="shpping_city" value="{{$user->shpping_city}}">
                                </div>
                                @error('shpping_city')
                                <p class="text-danger">{{convertUtf8($message)}}</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="field-label">{{__('Contact Email')}} *</div>
                                <div class="field-input">
                                    <input type="text" name="shpping_email" value="{{$user->shpping_email}}">
                                </div>
                                @error('shpping_email')
                                <p class="text-danger">{{convertUtf8($message)}}</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="field-label">{{__('Phone')}} *</div>
                                <div class="field-input">
                                    <input type="text" name="shpping_number" value="{{$user->shpping_number}}">
                                </div>
                                @error('shpping_number')
                                <p class="text-danger">{{convertUtf8($message)}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="field-label">{{__('Order Notes')}} </div>
                    <div class="field-input">
                        <textarea name="order_notes" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="container">
                <div class="row">
                    @if($shippings->count() > 0)
                    <div class="col-12 mb-5">
                        <div class="table">
                            <div class="shop-title-box">
                                <h3>{{__('Shipping Methods')}}</h3>
                            </div>
                            <table class="cart-table shipping-method">
                                <thead class="cart-header">
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Method')}}</th>
                                        <th class="price">{{__('Cost')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if($shippings)
                                        @foreach ($shippings as $key => $charge)
                                        <tr>
                                            <td>
                                                <input type="radio" {{$key == 0 ? 'checked' : ''}} name="shipping_charge" {{$cart == null ? 'disabled' : ''}} data="{{$charge->charge}}"   class="shipping-charge"  value="{{$charge->id}}">
                                            </td>
                                            <td>
                                            <p class="mb-2"><strong>{{convertUtf8($charge->title)}}</strong></p>
                                                <p><small>{{convertUtf8($charge->text)}}</small></p>
                                            </td>
                                            <td>{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} <span>{{$charge->charge}}</span> {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="table">
                            <div class="shop-title-box">
                                <h3>{{__('Order Summary')}}</h3>
                            </div>
                            <table class="cart-table">
                                <thead class="cart-header">
                                    <tr>
                                        <th class="prod-column" width="10%">{{__('Product')}}</th>
                                        <th width="70%">{{__('Product Title')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart as $key => $item)
                                    @php
                                        $id = $item["id"];
                                        $product = App\Models\Product::findOrFail($id);
                                        $total += $item['total'];
                                    @endphp
                                    <tr class="remove{{$id}}">

                                        <td class="prod-column" width="10%">
                                            <div class="column-box">
                                                <div class="prod-thumb">
                                                    <a href="{{route('front.product.details',[$product->slug,$product->id])}}">
                                                        <img src="{{asset('assets/front/img/product/featured/'.$item['photo'])}}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="70%">
                                            <div class="title">
                                                <a target="_blank" href="{{route('front.product.details',[$product->slug,$product->id])}}">
                                                    <h5 class="prod-title">{{convertUtf8($item['name'])}}</h5>
                                                </a>
                                                @if (!empty($item["variations"]))
                                                    <p><strong>{{__('Variations')}}:</strong> {{$item["variations"]["name"]}}</p>
                                                @endif
                                                @if (!empty($item["addons"]))
                                                    <p>
                                                        <strong>{{__("Add On's")}}:</strong>
                                                        @php
                                                            $addons = $item["addons"];
                                                        @endphp
                                                        @foreach ($addons as $addon)
                                                            {{$addon["name"]}}
                                                            @if (!$loop->last)
                                                            ,
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="qty">
                                            {{$item['qty']}}
                                        </td>
                                        <input type="hidden" value="{{$id}}" class="product_id">
                                        <td class="sub-total">
                                            {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}
                                            {{$item['total']}}
                                            {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="cart-total">
                            <div class="shop-title-box">
                                <h3>{{__('Cart Totals')}}</h3>
                            </div>
                            <ul class="cart-total-table">
                                <li class="clearfix">
                                    <span class="col col-title">{{__('Cart Subtotal')}}</span>
                                    <span class="col">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} <span data="{{round($total,2)}}" class="subtotal">{{round($total,2)}}</span> {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</span>
                                </li>
                                <li class="clearfix">
                                    <span class="col col-title">{{__('Shipping Charge')}}</span>
                                    <span class="col">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} <span data="{{$shippings->count() > 0 ? round($shippings[0]->charge,2) : 0}}" class="shipping">{{$shippings->count() > 0 ? round($shippings[0]->charge,2) : 0}}</span> {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</span>
                                </li>
                                <li class="clearfix">
                                    <span class="col col-title">{{__('Order Total')}}</span>
                                    <span class="col">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} <span data="{{$shippings->count() > 0 ? round($total + $shippings[0]->charge,2) : $total }}" class="grandTotal">{{$shippings->count() > 0 ? round($total + $shippings[0]->charge,2) : $total }}</span> {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</span>
                                </li>
                            </ul>

                            <div class="payment-options">
                                <h4 class="mb-4">{{__('Pay Via')}}</h4>

                                @includeIf('front.product.payment-gateways')

                                <div class="placeorder-button text-left mt-4">
                                    <button {{$cart ? '' : 'disabled' }}  class="main-btn" type="submit"><span class="btn-title">{{__('Place Order')}}</span></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>

    <!--====== CHECKOUT PART ENDS ======-->
@endsection


@section('script')
<script src="https://js.stripe.com/v2/"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    $('.shipping-charge').on('click','',function(){
        let total = 0;
        let subtotal  = 0;
        let grantotal  = 0;
        let shipping  = 0;

        subtotal = parseFloat($('.subtotal').attr('data'));
        grantotal = parseFloat($('.grandTotal').attr('data'));
        shipping = parseFloat($('.shipping').attr('data'));

        let shipCharge = parseFloat($(this).attr('data'));

        shipping = parseFloat(shipCharge);
        total = parseFloat(parseFloat(grantotal) + parseFloat(shipCharge));
        $('.shipping').text(shipping);
        $('.grandTotal').text(total);


    })

    $(document).ready(function() {
        $(".input-check").first().attr('checked', true);

        let tabid = $(".input-check:checked").data('tabid');
        if(tabid == 'paystack'){
            $('#payment').prop('id','paystack');
            $('#paystack').attr('action', $(".input-check:checked").data('action'));
        } else {
            $('#payment').attr('action', $(".input-check:checked").data('action'));
        }


        showDetails(tabid);
    });

    // this function will decide which form to show...
    function showDetails(tabid) {

        $(".gateway-details").removeClass("d-flex");
        $(".gateway-details").addClass("d-none");

        if ($("#tab-"+tabid).length > 0) {
            $("#tab-"+tabid).addClass("d-flex");
        }

    }

    // on gateway change...
    $(document).on('click','.input-check',function(){
        // change form action

        let tabid = $(this).data('tabid');
        if(tabid == 'paystack'){
            $('#payment').prop('id','paystack');
            $('#paystack').attr('action', $(this).data('action'));
        } else {
            $('#paystack').prop('id','payment');
            $('#payment').attr('action', $(this).data('action'));
        }
        // show relevant form (if any)
        showDetails(tabid);
    });

    // after paystack form is submitted
    $(document).on('submit','#paystack',function(){
        var val = $('#sub').val();
        if(val == 0){
            var total = $(".grandTotal").text();
            var curr =  "{{$be->base_currency_text}}";
            total = Math.round(total);
            var handler = PaystackPop.setup({
            key: "{{ $paystack['key']}}",
            email: "{{ $paystack['email']}}",
            amount: total * 100,
            currency: curr,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                callback: function(response){
                    $('#ref_id').val(response.reference);
                    $('#sub').val('1');
                    $('#paystack button[type="submit"]').click();
                },
                onClose: function(){
                    window.location.reload();
                }
            });
            handler.openIframe();
            return false;

        } else {
            return true;
        }
    });


    var cnstatus = false;
    var dateStatus = false;
    var cvcStatus = false;

    function validateCard(cn) {
    cnstatus = Stripe.card.validateCardNumber(cn);
    if (!cnstatus) {
        $("#errCard").html('Card number not valid<br>');
    } else {
        $("#errCard").html('');
    }
    //   btnStatusChange();


    }

    function validateCVC(cvc) {
        cvcStatus = Stripe.card.validateCVC(cvc);
        if (!cvcStatus) {
            $("#errCVC").html('CVC number not valid');
        } else {
            $("#errCVC").html('');
        }
        //   btnStatusChange();
    }
</script>
@endsection
