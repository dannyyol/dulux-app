<template>
    <div class="modal animate__animated animate__fadeInBottomRight modal fade" id="centralModalSm2" tabindex="-1"
      role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content modal_content">
              <div class="modal-header border-1 cart_heading">
                  <h3 class="modal-title w-100 my-auto" style="padding-top: 7px">
                      Shopping List
                  </h3>

                  <button
                    class="mr-3 btn btn-info cart-modal-counterdown"
                    style=""
                    v-if="!hideTimer"
                  >
                    <span class="">{{
                      timer
                        | minutesAndSeconds
                    }}</span>
                  </button>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="font-size:28px">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- small Screen -->
                  <div class="cart_sm-row">
                      <div class="card-container shadow-sm mb-4" v-for="(cart, index) in cartItems" :key="index">
                          <div class="row">
                              <div class="col-sm-4 col-4 ">
                                  <div class="sm_cart_image">
                                    <img :src="'/assets/front/img/product/featured/' + cart.feature_image" alt="" srcset="">
                                  </div>
                              </div>
                              <div class="col-sm-8 pt-3 col-8 float-left">
                                  <div class="sm_cart_title">
                                    {{ cart.product_name }}
                                  </div>
                                  <p class="" style="font-size:14px !important">${{ cart.product_price }}</p>
                                  <div class="float-right  pr-2  mt-n5">
                                      <h4 style="font-size:18px !important"><b>Total: ${{ cartSubtotal() }}</b></h4>
                                  </div>

                                  <div class="addon_detail" v-for="(variation, index) in cartVariations" :key="index">
                                      Size: {{ variation.name }} |  {{ variation.qty }} Quantities | ${{ variation.price }}                          
                                  </div>

                                  <div class="addon_detail" v-for="(addon, index) in cartAddons" :key="index">
                                      Addon: {{ addon.name }} | 1 Quantity | {{ addon.qty }} | ${{ addon.price}} 
                                  </div>

                                  <div class="cart_plux_minus pb-3 ">
                                      <table>
                                          <tr>
                                              <td>
                                                  <button type="button"
                                                      class="mr-1 btn btn-lg btn-danger btn_qty_increment" style="
                                                      width: 30px;
                                                      height: 30px;
                                                  "
                                                  >
                                                      -
                                                  </button>
                                              </td>
                                              <td>
                                                  <input type="text" name="" id="" class="form-control mr-1" style="
                                                    width: 35px;
                                                    height: 30px;
                                                    padding: 0px !important;
                                                    text-align: center;
                                              "  :value="cart.product_quantity"
                                              />
                                              </td>
                                              <td>
                                                  <button type="button" class="btn btn-danger" style="
                                              width: 30px;
                                              height: 30px;
                                              " 
                                              >
                                                      +
                                                  </button>
                                              </td>
                                              <td>
                                                  <a href="" style="text-decoration:underline;font-size:14px"
                                                      class="pl-3 text-dark"> Remove</a>
                                              </td>

                                              <!-- <td>
                                                  <a href="" style="text-decoration:underline;font-size:14px"
                                                      class="pl-3 text-dark"> Remove</a>
                                              </td> -->
                                          </tr>
                                      </table>
                                  </div>


                              </div>

                          </div>

                      </div>
                      <br>
                  </div>

                  <!-- Large screen  -->
                  <!-- cart heading -->
                  <div class="cart_lg_row d-sm-none d-md-block">
                      <div class="row cart_row">
                          <div class="col-md-2 col-sm-2">
                              <div class="cart_heading_title">
                                  Colour
                              </div>
                          </div>
                          <div class="col-md-6 col-sm-7 responsive_container">
                              <div class="product_heading cart_heading_title">
                                  Product
                              </div>
                          </div>
                      </div>
                      <!-- end of cart heading -->

                      <div class="cart_row" v-for="(cart, index) in carts" :key="index">
                        <hr>
                        <div class="row mt-n4 mb-4">

                          <div class="col-md-2 col-sm-2">
                              
                              <div class="cart_color" :style="{'background-color':cart.product_colour.colour_code }">
                                  <p class="text-white" style="font-size:12px;text-align:center;position:relative !important;top:50% !important;">Crisp Linen 61yy 89/040</p>
                              </div>
                              <a class="" style="text-decoration:underline;font-size:14px;">Change</a>
                          </div>

                          <div class="col-md-10 col-sm-7 responsive_container">
                              <div class="row" >
                                  <div class="col-md-2 col-sm-6 cart_image ">
                                      <img :src="'/assets/front/img/product/featured/' + cart.feature_image" alt="" srcset="" width="100px">
                                  </div>
                                  <div class="col-md-10 col-sm-6 mt-1">
                                      <div class="cart_title">
                                          {{ cart.product_name }}
                                      </div>
                                      <div>
                                      
                                      <!-- <div class="container"> -->
                                          



                                      <div id="accordion7401210" role="tablist" aria-multiselectable="false">
                                        <div class="card card_accordion">
                                            <div class="card-header addon-header" role="tab" id="heading-1">
                                                <a role="button" style="font-weight:500"  data-toggle="collapse" class="card-title addon-card-title accordion-plus-toggle collapsed" data-parent="#accordion7401210" :href="'#collapse8122873'+cart.id" aria-expanded="false" aria-controls="collapse8122873">
                                                  Litres
                                                  <span class="badge btn-info" style="font-size:13px">3</span>
                                                  <span class="badge badge-pill btn-info" style="position:relative;left:300px;font-size:13px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                      width="14" height="14"
                                                      viewBox="0 0 172 172"
                                                      style=" fill:#000000;padding-bottom:2px;">
                                                      <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#fff"><path d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg>
                                                    5000
                                                  </span>
                                                </a>
                                            </div>
                                            <div :id="'collapse8122873'+cart.id" class="collapse" role="tabpanel" aria-labelledby="heading-1">
                                              <div class="card-body card_font" style="">


                                                <table class="table">
                                                    <thead>
                                                      <tr class="table_heading">
                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td> 1Litre</td>
                                                          <td class="d-flex">
                                                            <button type="button"
                                                            class="mr-1 btn btn-lg btn_green btn_qty_increment" style="
                                                            width: 30px;
                                                            height: 30px;
                                                            " >
                                                                -
                                                            </button>
                                                        
                                                            <input type="text" name="" id="" class="form-control mr-1" style="
                                                            width: 35px;
                                                            height: 30px;
                                                            padding: 0px !important;
                                                            text-align: center;
                                                            " :value="cart.product_quantity"/>
                                                        
                                                            <button type="button" class="btn btn_green" style="
                                                            width: 30px;
                                                            height: 30px;">
                                                                +
                                                            </button>
                                                          </td>
                                                          <td>

                                                            <div class="form-group menu_page_price" style="padding-bottom: 1px !important;">
                                                              <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                  <span id="basic-addon1" class="input-group-text  btn_green" style="font-size: 14px; border-radius: 5px 0px 0px 5px;">
                                                                    <svg data-v-3bd11521="" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15" viewBox="0 0 172 172" style="fill: rgb(0, 0, 0);"><g data-v-3bd11521="" fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal;">
                                                                      <path data-v-3bd11521="" d="M0,172v-172h172v172z" fill="none">
                                                                      </path><g data-v-3bd11521="" fill="#fff">
                                                                      <path data-v-3bd11521="" d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg></span>
                                                                      </div>
                                                                      <input type="text" name="" class="form-control" style="border-radius: 0px 5px 5px 0px;">
                                                                      </div>
                                                                  </div>
                                                          </td>
                                                          <td>
                                                            <button type="button" class="btn btn-danger" style="
                                                            width: 30px;
                                                            height: 30px;">
                                                              <span class="fa fa-trash" aria-hidden="true"></span>
                                                            </button>
                                                          </td>
                                                        </tr>
                                                        
                                                      </tbody>
                                                  </table>

                                                
                                              </div>
                                            </div>


                                            <div class="card-header addon-header" role="tab" id="heading411391">
                                              <!-- <h5 class="card-title"> -->
                                                  <a style="font-weight:500" role="button" data-toggle="collapse" class="card-title addon-card-title accordion-plus-toggle collapsed" data-parent="#accordion7401210" :href="'#collapse411391'+cart.id" aria-expanded="false" aria-controls="collapse411391">
                                                    Add On
                                                    <span class="badge btn-info"  style="font-size:13px">3</span>
                                                    <span class="badge badge-pill btn-info" style="position:relative;left:285px;font-size:13px;">
                                                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                        width="14" height="14"
                                                        viewBox="0 0 172 172"
                                                        style=" fill:#000000;padding-bottom:2px;">
                                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#fff"><path d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg>
                                                      5000
                                                    </span>
                                                      
                                                  </a>


                                            </div>
                                            <div :id="'collapse411391'+cart.id" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading411391">
                                              <div class="card-body card_font">

                                                  <table class="table">
                                                    <thead>
                                                      <tr class="table_heading">
                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td> 1Litre</td>
                                                          <td class="d-flex">
                                                            <button type="button"
                                                            class="mr-1 btn btn-lg btn_green btn_qty_increment" style="
                                                            width: 30px;
                                                            height: 30px;
                                                            ">
                                                                -
                                                            </button>
                                                        
                                                            <input type="text" name="" id="" class="form-control mr-1" style="
                                                            width: 35px;
                                                            height: 30px;
                                                            padding: 0px !important;
                                                            text-align: center;
                                                            " :value="cart.product_quantity"/>
                                                        
                                                            <button type="button" class="btn btn_green" style="
                                                            width: 30px;
                                                            height: 30px;">
                                                                +
                                                            </button>
                                                          </td>
                                                          <td>

                                                            <div class="form-group menu_page_price" style="padding-bottom: 1px !important;">
                                                              <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                  <span id="basic-addon1" class="input-group-text  btn_green" style="font-size: 14px; border-radius: 5px 0px 0px 5px;">
                                                                    <svg data-v-3bd11521="" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15" viewBox="0 0 172 172" style="fill: rgb(0, 0, 0);"><g data-v-3bd11521="" fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal;">
                                                                      <path data-v-3bd11521="" d="M0,172v-172h172v172z" fill="none">
                                                                      </path><g data-v-3bd11521="" fill="#fff">
                                                                      <path data-v-3bd11521="" d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg></span>
                                                                      </div>
                                                                      <input type="text" name="" class="form-control" style="border-radius: 0px 5px 5px 0px;">
                                                                      </div>
                                                                  </div>
                                                          </td>
                                                          <td>
                                                            <button type="button" class="btn btn-danger" style="
                                                            width: 30px;
                                                            height: 30px;">
                                                              <span class="fa fa-trash" aria-hidden="true"></span>
                                                            </button>
                                                          </td>
                                                        </tr>
                                                        
                                                      </tbody>
                                                  </table>
                                              </div>
                                            </div>
                                        </div>
                                        <!-- <div class="card"> --> 
                                        <!-- </div> -->
                                      </div>
                                      <!-- </div> -->
                                      </div>
                                  </div>
                                  <!-- Check --> 
                              </div>
                          </div>

                          <!-- <div class="col-md-2 col-sm-3">
                              <div class="cart_plux_minus">
                                  <table>
                                      <tr>
                                          <td>
                                              <button type="button"
                                                  class="mr-1 btn btn-lg btn-danger btn_qty_increment" style="
                                              width: 30px;
                                              height: 30px;
                                              " @click.prevent="
                                                  decrementQty(
                                                    cart.id
                                                  )
                                                ">
                                                  -
                                              </button>
                                          </td>
                                          <td>
                                              <input type="text" name="" id="" class="form-control mr-1" style="
                                              width: 35px;
                                              height: 30px;
                                              padding: 0px !important;
                                              text-align: center;
                                              " :value="cart.product_quantity"/>
                                          </td>
                                          <td>
                                              <button type="button" class="btn btn-danger" style="
                                              width: 30px;
                                              height: 30px;" @click.prevent="incrementQty(cart.id)">
                                                  +
                                              </button>
                                          </td>
                                      </tr>
                                  </table>
                              </div>
                          </div> -->

                          <!-- <div class="col-md-2">
                              <div class="form-group" style="padding-top:20px">
                                  <input type="text" class="form-control bg-white" name="" id="" aria-describedby="emailHelpId" :value="'$' +cart.product_price" disabled>
                              </div>
                              <div class="remove_cart_product pt-3">
                                  <a class=" text-danger float-right" style="text-decoration:underline" @click="
                                      removeCartItem(
                                        cart.id
                                      )
                                    ">Remove</a>

                                    <a class="float-right" style="text-decoration:underline">Change</a>
                              </div>
                          </div> -->
                          
                        </div>

                      </div>

                      <div class="total" style="margin-top:0px" v-show="carts.length  > 0">
                          <h3 class="float-right" style=""><b> Total: ${{cartSubtotal() }}</b></h3>
                          <input type="hidden" :value="cartSubtotal()">
                      </div>
                  </div>
              </div>
              <div class="modal-footer" v-show="carts.length  > 0" style="margin-top:0px">
                <button
                type="button"
                class="btn btn-sm custom_button clear-button"
                >
                Clear
              </button>
              <router-link
                :to="{
                  name: 'checkout',
                  params: {
                    id: product.product_id,
                    cartTotal,
                    AddOnTotal,
                    variationTotal

                  },
                }"
                class="btn btn-sm custom_button checkout-button"
                data-dismiss="modal"
                aria-label="Close"
              >
                Checkout
              </router-link>
              </div>
              
          </div>
      </div>
  </div>    
</template>

<script>
    import $ from "jquery";
    export default {
        
  data() {
    return {
      
      carts: [],
      currentCart: null,
      
    };
  },
  
  methods: {

      

  },
  mounted() {
      
  },
};

</script>
