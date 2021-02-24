@extends('admin.layout')
@section('content')
<div class="page-header">
   <h4 class="page-title">{{__('Order Details')}}</h4>
   <ul class="breadcrumbs">
      <li class="nav-home">
         <a href="{{route('admin.dashboard')}}">
         <i class="flaticon-home"></i>
         </a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="{{url()->previous()}}">{{__('Order')}}</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">{{__('Order Details')}}</a>
      </li>
   </ul>
</div>
<div class="row">
    <div class="col-md-4">
       <div class="card">
          <div class="card-header">
             <div class="card-title d-inline-block">{{__('Order')}}  [ {{ $order->order_number}} ]</div>

          </div>
          <div class="card-body pt-5 pb-5">
             <div class="payment-information">
                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Payment Status')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                         @if($order->payment_status =='Pending' || $order->payment_status == 'pending')
                         <span class="badge badge-danger">{{convertUtf8($order->payment_status)}}  </span>
                         @else
                         <span class="badge badge-success">{{convertUtf8($order->payment_status)}}  </span>
                         @endif
                     </div>
                 </div>

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Order Status')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                         @php
                             if($order->order_status == 'pending') {
                                 $badge = 'default';
                             } elseif($order->order_status == 'received') {
                                 $badge = 'secondary';
                             } elseif($order->order_status == 'preparing') {
                                 $badge = 'warning';
                             } elseif($order->order_status == 'ready_to_pick_up') {
                                 $badge = 'primary';
                             } elseif($order->order_status == 'picked_up') {
                                 $badge = 'info';
                             } elseif($order->order_status == 'delivered') {
                                 $badge = 'success';
                             } elseif($order->order_status == 'cancelled') {
                                 $badge = 'danger';
                             }
                         @endphp

                        <span class="badge badge-{{$badge}} text-capitalize">{{convertUtf8(str_replace("_", " ", $order->order_status))}}</span>
                     </div>
                 </div>

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Paid amount')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{$order->currency_symbol_position == 'left' ? $order->currency_symbol : ''}} {{$order->total}} {{$order->currency_symbol_position == 'right' ? $order->currency_symbol : ''}}
                     </div>
                 </div>

                 @if (!empty($order->shipping_method))
                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Shipping Method')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{$order->shipping_method}}
                     </div>
                 </div>
                 @endif

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Shipping Charge')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{$order->currency_symbol_position == 'left' ? $order->currency_symbol : ''}} {{$order->shipping_charge}} {{$order->currency_symbol_position == 'right' ? $order->currency_symbol : ''}}
                     </div>
                 </div>

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Payment Method')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                         {{convertUtf8($order->method)}}
                     </div>
                 </div>


                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Order Date')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{convertUtf8($order->created_at->format('d-m-Y'))}}
                     </div>
                 </div>


                 <div class="row mb-0">
                     <div class="col-lg-6">
                         <strong>{{__('Order Notes')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                         @if (!empty($order->order_notes))
                             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalNotes">Show</button>
                         @else
                            -
                         @endif
                     </div>
                 </div>

                <!-- Modal -->
                <div class="modal fade" id="modalNotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Order Notes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{$order->order_notes}}
                        </div>
                    </div>
                    </div>
                </div>

             </div>
          </div>
       </div>

    </div>

    @if (strtolower($order->method) == 'pay by delivery')
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Shipping Details</div>

                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="payment-information">
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong>{{__('Name')}} :</strong>
                            </div>
                            <div class="col-lg-6">
                                {{convertUtf8($order->shpping_fname) .' '. convertUtf8($order->shpping_lname)}}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong>{{__('Email')}} :</strong>
                            </div>
                            <div class="col-lg-6">
                                {{convertUtf8($order->shpping_email)}}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong>{{__('Phone')}} :</strong>
                            </div>
                            <div class="col-lg-6">
                                {{$order->shpping_number}}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong>{{__('City')}} :</strong>
                            </div>
                            <div class="col-lg-6">
                                {{convertUtf8($order->shpping_city)}}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong>{{__('Address')}} :</strong>
                            </div>
                            <div class="col-lg-6">
                                {{convertUtf8($order->shpping_address)}}
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-6">
                                <strong>{{__('Country')}} :</strong>
                            </div>
                            <div class="col-lg-6">
                                {{convertUtf8($order->billing_country)}}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-md-4">
       <div class="card">
          <div class="card-header">
             <div class="card-title d-inline-block">Billing Details</div>

          </div>
          <div class="card-body pt-5 pb-5">
             <div class="payment-information">
                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Name')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{convertUtf8($order->billing_fname) .' '. convertUtf8($order->billing_lname)}}
                     </div>
                 </div>

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Email')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{convertUtf8($order->billing_email)}}
                     </div>
                 </div>

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Phone')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{$order->billing_number}}
                     </div>
                 </div>

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('City')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{convertUtf8($order->billing_city)}}
                     </div>
                 </div>

                 <div class="row mb-2">
                     <div class="col-lg-6">
                         <strong>{{__('Address')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                        {{convertUtf8($order->billing_address)}}
                     </div>
                 </div>

                 <div class="row mb-0">
                     <div class="col-lg-6">
                         <strong>{{__('Country')}} :</strong>
                     </div>
                     <div class="col-lg-6">
                         {{convertUtf8($order->billing_country)}}
                     </div>
                 </div>


             </div>
          </div>
       </div>

    </div>

   <div class="col-lg-12">
    <div class="card">
       <div class="card-header">
          <h4 class="card-title">{{__('Ordered Products')}}</h4>
       </div>
       <div class="card-body">
          <div class="table-responsive product-list">
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
                   @foreach ($order->orderitems as $key => $item)
                   <tr>
                      <td>{{$key+1}}</td>
                      <td><img src="{{asset('assets/front/img/product/featured/'.$item->image)}}" alt="product" width="100"></td>
                      <td>
                          <strong class="mr-3">{{$item->title}}</strong>
                          <br>
                          @php
                              $variations = json_decode($item->variations, true);
                          @endphp
                          @if (!empty($variations))
                            <strong class="mr-3">Variation's:</strong>

                            @foreach ($variations as $variation)
                                    {{$variation['name']}} | {{$variation['qty'] }} Qty
                                @if (!$loop->last)
                                ,
                                @endif
                            @endforeach
                          @endif
                          <br>
                          @php
                              $addons = json_decode($item->addons, true);
                          @endphp
                          @if (!empty($addons))
                            <strong class="mr-3">Add On's:</strong>

                            @foreach ($addons as $addon)
                                {{$addon["name"]  }} | {{  $addon["qty"]}} Qty
                                @if (!$loop->last)
                                ,
                                @endif
                            @endforeach
                          @endif
                      </td>
                      <td>
                        <strong class="mr-2">{{__("Product")}}:</strong>
                        {{$order->currency_code_position == 'left' ? $order->currency_code : ''}}
                        <span>{{(float)$item->product_price}}</span>
                        {{$order->currency_code_position == 'right' ? $order->currency_code : ''}}
                        <br>
                        @if (is_array($variations))
                            <strong class="mr-2">{{__("Variation")}}: </strong>
                            {{$order->currency_code_position == 'left' ? $order->currency_code : ''}}
                            <span>{{(float)$item->variations_price}}</span>
                            {{$order->currency_code_position == 'right' ? $order->currency_code : ''}}
                            <br>
                        @endif
                        @if (is_array($addons))
                            <strong class="mr-2">{{__("Add On's")}}: </strong>
                            {{$order->currency_code_position == 'left' ? $order->currency_code : ''}}
                            <span>{{(float)$item->addons_price}}</span>
                            {{$order->currency_code_position == 'right' ? $order->currency_code : ''}}
                        @endif
                      </td>

                       <?php
                        $sum = 0;
                            foreach ($variations as $key=>$variation){
                                $sum += $variation['qty'];
                            }
                        ?>
                      <td>{{$sum}}</td>
                      <td>{{ $order->total }}</td>
                   </tr>

                   
                   @endforeach
                   <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td><b> Total:</b></td>
                        <td><span>{{$order->currency_code_position == 'left' ? $order->currency_code : ''}}</span> {{$item->total}} <span>{{$order->currency_code_position == 'right' ? $order->currency_code : ''}}</span></td>
                   </tr>
                </tbody>
             </table>
          </div>
       </div>
    </div>
 </div>
</div>
@endsection
