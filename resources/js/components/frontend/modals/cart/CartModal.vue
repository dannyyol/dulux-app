<template>
    <div class="modal animate__animated animate__fadeInBottomRight modal fade" id="centralModalSm2" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog w-100 modal-lg" role="document">
            <div class="modal-content modal_content">
                <div class="modal-header border-1 cart_heading">
                    <h3 class="modal-title w-100 my-auto" style="padding-top: 7px">
                        Shopping List
                    </h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size:21px">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- small Screen -->
                    <div class="cart_sm-row">
                        <div class="card-container shadow-sm">
                            <div class="row">
                                <div class="col-sm-4 col-4">
                                    <div class="sm_cart_image">
                                        <img src="/images/dulux_images/paint-1.png" alt="" srcset="">
                                    </div>
                                </div>
                                <div class="col-sm-8 col-8">
                                    <div class="sm_cart_title">
                                        Dulux Pentalite
                                    </div>
                                    <div class="float-right">
                                        <h4><b>$45</b></h4>
                                    </div>

                                    <div class="addon_detail">
                                        Size: 5 Litres | 3 Quantities
                                    </div>

                                    <div class="addon_detail">
                                        Addon: Brush | 1 Quantity | $20
                                    </div>

                                    <div class="cart_plux_minus">
                                        <table>
                                            <tr>
                                                <td>
                                                    <button type="button"
                                                        class="mr-1 btn btn-lg btn-danger btn_qty_increment" style="
                                                        width: 30px;
                                                        height: 30px;
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
                                                " />
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" style="
                                                width: 30px;
                                                height: 30px;
                                                ">
                                                        +
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="" style="text-decoration:underline;font-size:14px"
                                                        class="pl-3 text-dark"> Remove</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Large screen  -->
                    <div class="cart_lg_row" v-for="(cart, index) in carts" :key="index">
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
                            <div class="col-md-2 col-sm-3">
                                <div class="quantity_heading cart_heading_title">
                                    Quantity
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="price_heading cart_heading_title">
                                    Price
                                </div>
                            </div>
                        </div>






                        <div class="row cart_row">
                            <div class="col-md-2 col-sm-2">
                                
                                <div class="cart_color" style="background-color:blue">
                                    <p class="text-white" style="font-size:12px;text-align:center;position:relative !important;top:50% !important;">Crisp Linen 61yy 89/040</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-7 responsive_container">
                                <div class="row" >
                                    <div class="col-md-4 col-sm-6 cart_image ">
                                        <img src="/images/dulux_images/paint-1.png" alt="" srcset="">
                                    </div>
                                    <div class="col-md-8 col-sm-6">
                                        <div class="cart_title">
                                            Dulux Pentalite
                                        </div>
                                        <div>
                                            <div id="accordion" class="accordion cart_accordion">
                                                <div class="addon_container mb-0">
                                                    <div class="addon-header collapsed" data-toggle="collapse"
                                                        href="#collapseOne">
                                                        <a class="" style="text-decoration:underline">
                                                            Litres
                                                        </a>
                                                    </div>
                                                    <div id="collapseOne" class="card-body collapse addon_background"
                                                        data-parent="#accordion">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Litres</th>
                                                                    <th>Quantities</th>
                                                                    <th>Price($)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td scope="row">2</td>
                                                                    <td>12</td>
                                                                    <td>45</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="addon_container mb-0">
                                                    <div class="addon-header collapsed" data-toggle="collapse"
                                                        href="#collapseTwo">
                                                        <a class="" style="text-decoration:underline">
                                                            Add On
                                                        </a>
                                                    </div>
                                                    <div id="collapseTwo" class="card-body collapse addon_background"
                                                        data-parent="#accordion">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Litres</th>
                                                                    <th>Quantities</th>
                                                                    <th>Price($)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td scope="row">2</td>
                                                                    <td>12</td>
                                                                    <td>45</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <hr> -->

                                        </div>
                                    </div>
                                    <!-- Check -->
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-3">
                                <div class="cart_plux_minus">
                                    <table>
                                        <tr>
                                            <td>
                                                <button type="button"
                                                    class="mr-1 btn btn-lg btn-danger btn_qty_increment" style="
                                                width: 30px;
                                                height: 30px;
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
                                                " />
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" style="
                                                width: 30px;
                                                height: 30px;
                                                ">
                                                    +
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group" style="padding-top:20px">
                                    <input type="text" class="form-control" name="" id="" aria-describedby="emailHelpId" value="$20">
                                </div>
                                <div class="total">
                                    <h4><b> Total: $200</b></h4>
                                </div>

                                <div class="remove_cart_product pt-3">
                                    <a href="" class=" text-danger">Remove</a>
                                </div>
                            </div>

                            <hr>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                </div>
                
            </div>
        </div>
    </div>
</template>
<style scoped>
    .cart_accordion .addon-header:after {
        font-family: 'FontAwesome';
        content: "\f068";
        float: right;
    }

    .cart_accordion .addon-header.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f067";
    }

</style>
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

      cartProducts() {
        axios
            .get("/api/cart-lists/")
            .then((response) => {
            this.carts = response.data;
            this.currentCart = response.data;
            })
            .catch((error) => {});

        },

  },
  mounted() {
      Fire.$on("AfterCreated", () => {
        this.cartProducts();
    });
    // this.$root.$on('AfterCreated', (args) => {
    //     this.cartProducts();
    // });
  },
};

</script>
