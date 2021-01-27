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

            <form
              @submit.prevent="addAddOn(productDetail.id, index)"
              method="post"
            >
              <div class="modal-body">
                  <!-- {{ productAddons }} -->
                <div v-if="productAddons">
                  <div v-for="(addon, index) in productAddons" :key="index">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-5 col-5">
                          <div class="form-check">
                            <div>
                              <input
                                class="form-check-input"
                                type="checkbox"
                                :true-value="addon.name"
                                :false-value="null"
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
                          <div class="form-goup">
                            <input
                              class="form-control price_input"
                              style="
                                background-color: #fff !important;
                                font-size: 14px !important;
                              "
                              type="text"
                              name=""
                              v-model="addon.price"
                              disabled
                            />
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
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button type="submit" class="btn btn-lg btn_save">
                  Save changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    
</template>

<script>
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

        }
    },
    data(){
        return{
            form: {
                productAddons: {
                    name: [],
                    qty: [],
                    price: [],
                },
            },
            // productAddons: "{}",

        }
    },
    methods:{
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
        // boxCheck(addon, index) {
        // // this.currentAddon.forEach((addon, index) => {
        // if (this.form.productAddons.name[index] == null) {
        //     // alert(this.form.productAddons.name[index])
        //     this.form.productAddons.qty[index] = addon.qty;
        //     this.form.productAddons.price[index] = addon.price;
        // } else {
        //     this.form.productAddons.qty[index] = null;
        //     this.form.productAddons.price[index] = null;
        // }
        // },
    
        incrementAddOnQty(name) {
        // this.form.productAddons =[]
        this.currentAddon.forEach((addon, index) => {
            if (addon.name == name) {
            this.form.productAddons.qty[index] = addon.qty;
            this.form.productAddons.qty[index] = ++addon.qty;
            this.form.productAddons.price[index] = addon.price;
            }
        });
        // alert(countit)
        },
        errorMessage(message) {
        swal.fire({
            position: "center",
            icon: "error",
            title: message,
            showConfirmButton: true,
            timer: 2500,
        });
        },

        decrementAddOnQty(name) {
        // this.form.productAddons =[]
        this.currentAddon.forEach((addon, index) => {
            if (addon.name == name) {
            this.form.productAddons.qty[index] = addon.qty;
            if (this.form.productAddons.qty[index] > 0) {
                this.form.productAddons.qty[index] = --addon.qty;
                this.form.productAddons.price[index] = addon.price;
            }
            }
        });
        // alert(countit)
        },
        addAddOn(id, index) {
        axios
            .post("/api/addon/" + id, this.form)
            .then((response) => {
            if (response.data["status_code"] == "AC") {
                this.errorMessage(response.data["message"]);
            } else if (response.data["status_code"] == "AB") {
                this.errorMessage(response.data["message"]);
            } else {
                this.form.productAddons.name[index] = null;
                this.form.productAddons.qty[index] = null;
                this.form.productAddons.price[index] = null;

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