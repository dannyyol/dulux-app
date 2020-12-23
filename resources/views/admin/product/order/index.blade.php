@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">
      @if (request()->path()=='admin/product/pending/orders')
        Pending
      @elseif (request()->path()=='admin/product/all/orders')
        All
      @elseif (request()->path()=='admin/product/received/orders')
        Received
      @elseif (request()->path()=='admin/product/preparing/orders')
        Preparing
      @elseif (request()->path()=='admin/product/ready-to-pickup/orders')
        Ready to Pick up
      @elseif (request()->path()=='admin/product/picked-up/orders')
        Picked up
      @elseif (request()->path()=='admin/product/delivered/orders')
        Delivered
      @elseif (request()->path()=='admin/product/cancelled/orders')
        Cancelled
      @endif
      Orders
    </h4>
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
        <a href="#">Product Management</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">
          @if (request()->path()=='admin/product/pending/orders')
            Pending
          @elseif (request()->path()=='admin/product/all/orders')
            All
          @elseif (request()->path()=='admin/product/received/orders')
            Received
          @elseif (request()->path()=='admin/product/preparing/orders')
            Preparing
          @elseif (request()->path()=='admin/product/ready-to-pickup/orders')
            Ready to Pick up
          @elseif (request()->path()=='admin/product/picked-up/orders')
            Picked up
          @elseif (request()->path()=='admin/product/delivered/orders')
            Delivered
          @elseif (request()->path()=='admin/product/cancelled/orders')
            Cancelled
          @endif
          Orders
        </a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-title">
                        @if (request()->path()=='admin/product/pending/orders')
                        Pending
                      @elseif (request()->path()=='admin/product/all/orders')
                        All
                      @elseif (request()->path()=='admin/product/received/orders')
                        Received
                      @elseif (request()->path()=='admin/product/preparing/orders')
                        Preparing
                      @elseif (request()->path()=='admin/product/ready-to-pickup/orders')
                        Ready to Pick up
                      @elseif (request()->path()=='admin/product/picked-up/orders')
                        Picked up
                      @elseif (request()->path()=='admin/product/delivered/orders')
                        Delivered
                      @elseif (request()->path()=='admin/product/cancelled/orders')
                        Cancelled
                      @elseif (request()->path()=='admin/product/search/orders')
                        Search
                      @endif
                      Orders
                    </div>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-danger float-right btn-md ml-4 d-none bulk-delete" data-href="{{route('admin.product.order.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                    <form action="{{url()->current()}}" class="d-inline-block float-right">
                    <input class="form-control" type="text" name="search" placeholder="Search by Oder Number" value="{{request()->input('search') ? request()->input('search') : '' }}">
                  </form>
              </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($orders) == 0)
                <h3 class="text-center">NO ORDER FOUND</h3>
              @else
                <div id="refreshOrder">
                    <div class="table-responsive">
                      <table class="table table-striped mt-3">
                        <thead>
                          <tr>
                            <th scope="col">
                                <input type="checkbox" class="bulk-check" data-val="all">
                            </th>
                            <th scope="col">Order By</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Total</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Receipt</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach ($orders as $key => $order)
                            <tr>
                              <td>
                                <input type="checkbox" class="bulk-check" data-val="{{$order->id}}">
                              </td>
                              <td>{{$order->billing_fname .' '. $order->billing_lname}}</td>
                              <td>#{{$order->order_number}}</td>
                              <td>{{$order->currency_symbol_position == 'left' ? $order->currency_symbol : ''}} {{round($order->total,2)}} {{$order->currency_symbol_position == 'right' ? $order->currency_symbol : ''}}</td>
                              <td>
                                  @if ($order->payment_status == 'Pending' || $order->payment_status == 'pending')

                                  <p class="badge badge-danger">{{$order->payment_status}}</p>
                                  @else
                                    <p class="badge badge-success">{{$order->payment_status}}</p>
                                  @endif
                              </td>
                              <td>
                                <form id="statusForm{{$order->id}}" class="d-inline-block" action="{{route('admin.product.orders.status')}}" method="post">
                                  @csrf
                                  <input type="hidden" name="order_id" value="{{$order->id}}">
                                  <select class="form-control
                                  @if ($order->order_status == 'pending')

                                  @elseif ($order->order_status == 'received')
                                    bg-secondary
                                  @elseif ($order->order_status == 'preparing')
                                    bg-warning
                                  @elseif ($order->order_status == 'ready_to_pick_up')
                                    bg-primary
                                  @elseif ($order->order_status == 'picked_up')
                                    bg-info
                                  @elseif ($order->order_status == 'delivered')
                                    bg-success
                                  @elseif ($order->order_status == 'cancelled')
                                    bg-danger
                                  @endif
                                  " name="order_status" onchange="document.getElementById('statusForm{{$order->id}}').submit();">
                                    <option value="pending" {{$order->order_status == 'pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="received" {{$order->order_status == 'received' ? 'selected' : ''}}>Received</option>
                                    <option value="preparing" {{$order->order_status == 'preparing' ? 'selected' : ''}}>Preparing</option>
                                    <option value="ready_to_pick_up" {{$order->order_status == 'ready_to_pick_up' ? 'selected' : ''}}>Ready to pick up</option>
                                    <option value="picked_up" {{$order->order_status == 'picked_up' ? 'selected' : ''}}>Picked up</option>
                                    <option value="delivered" {{$order->order_status == 'delivered' ? 'selected' : ''}}>Delivered</option>
                                    <option value="cancelled" {{$order->order_status == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                                  </select>
                                </form>
                              </td>

                              <td>
                                  @if (!empty($order->receipt))
                                    <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#receiptModal{{$order->id}}">Show</a>
                                  @else
                                    -
                                  @endif
                              </td>

                              <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{route('admin.product.details',$order->id)}}">Details</a>
                                      <a class="dropdown-item" href="{{asset('assets/front/invoices/product/'.$order->invoice_number)}}">Invoice</a>
                                      <a class="dropdown-item" href="#">
                                        <form class="deleteform d-inline-block" action="{{route('admin.product.order.delete')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <button type="submit" class="deletebtn">
                                              Delete
                                            </button>
                                        </form>
                                      </a>
                                    </div>
                                </div>

                              </td>
                            </tr>


                            {{-- Receipt Modal --}}
                            <div class="modal fade" id="receiptModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Receipt Image</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{asset('assets/front/receipt/' . $order->receipt)}}" alt="Receipt" width="100%">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                            </div>

                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="d-inline-block mx-auto">
              {{$orders->appends(['search' => request()->input('search')])->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
