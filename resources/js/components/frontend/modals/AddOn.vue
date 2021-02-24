<template>

    <div
        class="modal animate__animated animate__fadeInBottomRight fade"
        id="add-on-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="add-on-modal"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLongTitle">
                <b>{{
                  productDetail.title + " ($" + productDetail.current_price + ")"
                }}</b>
              </h4>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form
              @submit.prevent="addAddOn(productDetail.id, index)"
              method="post"
            > -->
              <div class="modal-body">
                  <!-- {{ productAddons }} -->
                <div v-if="productAddons">
                  <div v-for="(addon, index) in productAddons" :key="index">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-5 col-5">
                          <div class="form-check">
                            <div>
                              <input type="hidden" name="" v-model="productDetail.id">
                              <input
                                class="form-check-input"
                                type="checkbox"
                                :true-value="addon.name"
                                :id="'defaultCheck1' + index"
                                v-model="form.productAddons.name[index]"
                              />
                              <label
                                class="form-check-label"
                                :for="'defaultCheck1' + index"
                                style="font-size: 14px; font-weight: 500"
                              >
                                {{ addon.name }}
                              </label>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4 col-4">
                          <table>
                            <tr>
                              <td>
                                <button
                                  type="button"
                                  class="mr-1 btn btn-lg btn-danger btn_qty_increment"
                                  style="
                                    width: 30px;
                                    font-size: 14px;
                                    height: 30px;
                                  "
                                  @click="decrementAddOnQty(addon.name)"
                                  :disabled="isDisabled(productDetail, index)"
                                >
                                  -
                                </button>
                              </td>
                              <td>
                                <input
                                  type="text"
                                  name=""
                                  id=""
                                  class="form-control mr-1"
                                  style="
                                    width: 30px;
                                    height: 30px !important;
                                    padding: 0px !important;
                                    font-size: 14px;
                                    text-align: center;
                                  "
                                  v-model="addon.qty"
                                  :disabled="
                                    form.productAddons.name[index] == '' ||
                                    form.productAddons.name[index] == null
                                  "
                                  required
                                />
                              </td>
                              <td>
                                <button
                                  type="button"
                                  class="btn btn-danger btn_qty_increment"
                                  style="
                                    width: 30px;
                                    font-size: 14px;
                                    height: 30px;
                                  "
                                  @click="incrementAddOnQty(addon.name)"
                                  :disabled="
                                    form.productAddons.name[index] == '' ||
                                    form.productAddons.name[index] == null
                                  "
                                >
                                  +
                                </button>
                              </td>
                            </tr>
                          </table>
                        </div>

                        <div class="col-md-3 col-3">
                          <div class="form-group menu_page_price">
                            <!-- <input v-if="form.productAddons.price[index] == null"
                              class="form-control price_input"
                              style="
                                background-color: #fff !important;
                                font-size: 14px !important;
                              "
                              type="text"
                              name=""
                              v-model="addon.price"
                              disabled
                            /> -->

                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1" style="font-size:14px;border-radius:5px 0px 0px 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                      width="15" height="15"
                                      viewBox="0 0 172 172"
                                      style=" fill:#000000;">
                                      <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#666666"><path d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg>
                                  </span>
                                </div>
                                <input v-if="form.productAddons.price[index] == null"
                                    class="form-control "
                                    style="
                                      background-color: #fff !important;
                                      font-size: 14px !important;
                                    "
                                    type="text"
                                    name=""
                                    v-model="addon.price"
                                    disabled
                                  />
                              <input v-else
                                class="form-control "
                                style="
                                  background-color: #fff !important;padding:0px !important;
                                  font-size: 14px !important;
                                "
                                type="text"
                                name=""
                                v-model="form.productAddons.price[index]"
                                disabled
                              />
                            </div>

                            
                            <!-- {{ currentProduct.id }} -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else>
                  <div class="row">
                    <div
                      class="col-md-12"
                      style="text-align: center; margin: auto"
                    >
                      <h4 class="">No Addon Available for this Product</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-lg btn-secondary"
                  @click ="cancel(productDetail)"
                >
                  Close
                </button>
                <button type="button" class="btn btn-lg btn_save" @click="save(productDetail)">
                  Add
                </button>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    
</template>

<script>
import $ from "jquery";

export default {
    props:{
        currentAddon:{
            type: Array
        },

        productDetail:{
            type: Object
        },
        productAddons:{
            type: Array
        },
        currentProduct:{
            type: Object
        },
        local_products:{
          type: Array
        },
        form:{
          type:Object
        },
        save:{
          type: Function
        },
        errorMessage:{
          type: Function
        }
    },
    data(){
        return{
            

        }
    },
    methods:{
      // checkButon(index, addon){
      //   if(this.form.productAddons.name[index] !=false){
      //     alert(this.form.productAddons.name[index] )
      //     this.form.productAddons.qty[index] = 0
      //     this.form.productAddons.price[index] = addon.price

      //   }
      // },
    cancel(product, index){
      this.form.productAddons.id = []
      this.form.productAddons.name = []
      this.form.productAddons.price = []
      this.form.productAddons.qty = []
      $('#add-on-modal').modal('hide');
    },
        isDisabled(product, index){
            this.local_products.forEach((p, ind)=>{
                if((product.id == p.product_id) &&  (this.form.productAddons.name[ind] != '' || this.form.productAddons.name[ind] == null) ){
                   return true
                    // this.form.productAddons.name[ind] == null                
                } else {
                    return false
                }

            })
            
        },
    
        incrementAddOnQty(name) {
        // this.form.productAddons =[]
        this.currentAddon.forEach((addon, index) => {
            if (addon.name == name) {
              this.form.productAddons.id[index] = index
              this.form.productAddons.qty[index] = addon.qty;
              this.form.productAddons.qty[index] = ++addon.qty;
              this.form.productAddons.oldPrice[index] = addon.price
              this.form.productAddons.price[index] = parseFloat(this.form.productAddons.qty[index] * addon.price).toFixed(2);
            }
        });
        // alert(countit)
        },
        

        decrementAddOnQty(name) {
        // this.form.productAddons =[]

        this.currentAddon.forEach((addon, index) => {
            if (addon.name == name) {
            this.form.productAddons.qty[index] = addon.qty;
            if (this.form.productAddons.qty[index] > 0) {
                this.form.productAddons.qty[index] = --addon.qty;
                // this.form.productAddons.price[index] = addon.price;
                this.form.productAddons.price[index] = parseFloat(this.form.productAddons.qty[index] * addon.price).toFixed(2);
                this.form.productAddons.oldPrice[index] = addon.price
                

            }
            }
        });
        // alert(countit)
        },
        addAddOn(id, index) {
          // this.form.productAddons.id[index] = null
          // this.form.productAddons.name[index] = null
          // this.form.productAddons.price[index] = null
          // this.form.productAddons.qty[index] = null

        axios
            .post("/api/addon/" + id, this.form)
            .then((response) => {
            if (response.data["status_code"] == "AC") {
                this.errorMessage(response.data["message"]);
            } else if (response.data["status_code"] == "AB") {
                this.errorMessage(response.data["message"]);
            } else {
                this.form.productAddons.name = [];
                this.form.productAddons.qty = [];
                this.form.productAddons.price = [];

                // $('#exampleModalLongTitle').modal('hide');
                    // $('#exampleModalLongTitle').modal('hide');


                toast.fire({
                icon: "success",
                title: "Cart successfully added",
                });
                Fire.$emit("AfterCreated");
            }
            })
            .catch((error) => {
            swal.fire({
                position: "center",
                icon: "error",
                title: "Error Adding cart",
                showConfirmButton: true,
                timer: 2500,
            });
            });


        this.startTimer();
        },
    }
    
}
</script>