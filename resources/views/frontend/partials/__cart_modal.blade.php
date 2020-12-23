<!-- Cart Modal  -->
<div class="modal fade" id="centralModalSm-{{ $product->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog w-100 modal-lg " role="document">
        <div class="modal-content modal_content">
            <div class="modal-header cart_heading">
                <h3 class="modal-title w-100 my-auto" id="myModalLabel">{{ $product->title }}</h3>
                <button class="btn btn-danger custom_button cart_close_button text-white" type="button" class="close"
                    data-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
            <div v-if="!loading">
                <div class="modal-body">
                    <!-- <table class="table">
                    <tbody>
                        <tr>
                            <td> 
                                <div class="card cart_image_card">
                                    <img src="images/paint-1.png" alt="" srcset="" class="cart_image my-auto mx-auto">
                                </div>
                            </td>
                            <td class="align-middle bg-danger pr-5">
                                <h3> Dulux Pentalite </h3>
                            </td>
                            <td>
                            <div class="row">
                                <a class="btn cart-sm-button">
                                -
                                </a>
                            <input
                              type="text"
                              class="form-control ml-1 mr-1 input-qty-value"
                              name=""
                              id=""
                              aria-describedby="helpId"
                              placeholder=""
                              :value="item.qty"
                              style=""
                            />
                            <a class="btn cart-sm-button">
                              +
                            </a>
                          </div>
                            </td>
                            <td class="bg-info">
                                <a class="btn change-color-button"> Change </a>
                            </td>
                            <td class="bg-primary align-middle">
                                <a class="btn border-1  cart_product_price"> $12.00 </a>
                            </td>
                            <td class= "">
                                <button name="" id="" class="btn" href="#" role="button"> <i class="fa cart_delete_button fa-trash-o" aria-hidden="true"></i>  </button>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
                    <div class="row" v-for="cart in carts" style="margin-bottom:10px !important;">
                        <div class="col-md-2 bg-">
                            <div class="card cart_image_card">
                                {{-- <img src="images/dulux_images/paint-1.png" alt="" srcset="" class="cart_image my-auto mx-auto"> --}}
                                <img :src="'assets/front/img/product/featured/'+ cart.feature_image" alt="menu">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p v-text="cart.product_name"></p>
                        </div>

                        <div class="col-md-3 minus-qty-plus d-flex justify-content-center my-auto">
                            <div class="row mx-auto">
                                <a class="btn cart-sm-button text-white" @click.prevent="decrementQty(cart.id)">
                                    -
                                </a>
                                <input type="text" class="form-control ml-1 mr-1 input-qty-value" name="" id=""
                                    aria-describedby="helpId" placeholder="" :value="cart.product_quantity" style="" />
                                <a class="btn cart-sm-button text-white" @click.prevent="incrementQty(cart.id)">
                                    +
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 text-white my-auto">
                            <a class="btn change-color-button "> <i class="fa fa-exchange" aria-hidden="true"></i>
                                Change
                            </a>
                        </div>

                        <div class="col-md-2 my-auto">
                            <a class="btn border-1  cart_product_price" v-text="'$'+cart.product_price"></a>
                        </div>

                        <div class="col-md-1 text-white bg- my-auto">
                            <a  @click="removeCartItem(cart.id)" name="" id="" style="margin-right:20px !important;" class="" role="button"> <i
                                    class="fa cart_delete_button fa-trash-o" aria-hidden="true"></i> </a>
                        </div>
                        {{-- <hr> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-10 d-flex justify-content-end" style="float:right !important">
                            <p style="font-size:18px !important"><b style=""> Total Price:</b> $@{{ cartSubtotal() }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm custom_button clear-button" @click.prevent="clearCartItems()">Clear</button>
                    <button type="button" class="btn btn-sm custom_button checkout-button" data-dismiss="modal"
                        aria-label="Close" data-toggle="modal" data-target="#centralModalSm3">Checkout</button>
                </div>
            </div>
            <div v-else>
                <p align="center">Loading...</p>
            </div>
        </div>
    </div>
</div>
<!-- end cart Modal-->
