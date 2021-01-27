<template>
<div>

  <!-- Description modal-->
      <div
        class="modal fade"
        id="centralModalSm"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >      
        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-xl lg_screen_alone " role="document" >
          <div class="modal-content">
            <div class="modal-body justify-content-center">
              <div id="tabs" class="d-flex justify-content-center">
                <ul class="nav nav-tabs tabs-heading" role="tablist">
                  <li class="nav-item" style="border-left: none !important">
                    <a
                      class="nav-link active"
                      data-index="0"
                      data-toggle="tab"
                      href="#tab-0"
                      role="tab"
                      >Key Informations</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-index="1"
                      data-toggle="tab"
                      href="#tab-1"
                      role="tab"
                      >Product Features</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-index="2"
                      data-toggle="tab"
                      href="#tab-2"
                      role="tab"
                      >Documentation</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      data-index="3"
                      data-toggle="tab"
                      href="#tab-3"
                      role="tab"
                      >Tips & Advice</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link calculator_button"
                      data-index="4"
                      data-toggle="tab"
                      href="#tab-4"
                      role="tab"
                      >Calculator</a
                    >
                  </li>
                </ul>
              </div>
              <div class="tab-content h-100">
                <div
                  class="tab-pane fade tab-style ml-3 mt-3 active show"
                  id="tab-0"
                  role="tabpanel"
                >
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="left-color-cart" style=""></div>
                            <div class="mt-3">
                              <div class="float-left">
                                <img
                                  :src="
                                    '/assets/front/img/product/featured/' +
                                    current_product.product_image"
                                  srcset=""
                                  class="modal-before-cart-image"
                                />
                              </div>
                              <div
                                class="float-right mt-2"
                                style="width: 180px !important"
                              >
                                <h2>{{ current_product.product_name }}</h2>
                                <p>
                                  <small>
                                    Hide imperfections on walls
                                    beautifully</small>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-8">
                        <div
                          class="key-info-desc overflow-auto"
                          style="height: 400px !important"
                        >
                          <div v-html=" current_product.product_key_info"></div> 
                        </div>
                      </div>
                      <div
                        class="col-md-12 row d-flex justify-content-end mt-5"
                      >
                        <button
                          type="button"
                          class="btn btn-sm btn-primary custom_button mr-3"
                        >
                          Send Brochure
                        </button>
                        <!-- <div class="form-group"> -->
                        <select
                          id="my-select"
                          class="form-control cart-info-select-button mr-3"
                          name=""
                        >
                          <option>1 Litres</option>
                        </select>
                        <!-- </div> -->
                        <button
                          type="button"
                          class="btn btn-sm btn-success custom_button mr-3"
                          data-dismiss="modal"
                          aria-label="Close"
                          data-toggle="modal"
                          data-target="#centralModalSm2"
                        >
                          Add to Cart
                        </button>
                        <button
                          class="btn btn-danger custom_button text-white"
                          type="button"
                          data-dismiss="modal"
                          aria-label="Close"
                        >
                          Cancel
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade tab-style ml-3 mt-3"
                  id="tab-1"
                  role="tabpanel"
                >
                  Paint HappyTM Technology, "Truly odour free"* when freshly
                  paintedAirfreshTM Technology, keeps air fresh after
                  paintingWashable & easy cleaningMould & fungus
                  resistance/Anti-bacterialColourguard technology, keeps colours
                  looking fresh longerSmooth luxurious finishEnvironmentally
                  preferred paint (Singapore GreenLabel certified)
                </div>
                <div
                  class="tab-pane fade tab-style ml-3 mt-3"
                  id="tab-2"
                  role="tabpanel"
                >
                  2
                </div>
                <div
                  class="tab-pane fade tab-style ml-3 mt-3"
                  id="tab-3"
                  role="tabpanel"
                >
                  3
                </div>
                <div
                  class="tab-pane fade tab-style ml-3 mt-3"
                  id="tab-4"
                  role="tabpanel"
                >
                  <div class="container calculator-container mx-auto">
                    <!-- <div class=""> -->
                    <div class="calculator-box h-100">
                      <div class="container">
                        <div class="row">
                          <div
                            class="col-md-6 mt-5"
                            style="margin: auto; text-align: center !important" 
                          >

                          <div v-if="!active">

                              <p class="magintop-2">Do you know the Area ?</p>
                              <button class="btn no_button">No</button>
                              <button class="btn yes_button">Yes</button>
                              <p class="magintop-2">
                                Enter the height and the length of the surface you
                                want to paint
                              </p>
                            </div>

                            <div v-else class="" style="margin-top:41px;font-size:48px;">
                              {{ calculateResult }}
                          </div>

                            </div>
                            <div class="col-md-6 calculator-">
                              <p class="">How much paint do I need ?</p>
                              <div class="form-group mt-5 calculator-input">
                                <small id="helpId" class="form-text text-muted"
                                  ><b>Height</b> in metres</small
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  name=""
                                  id=""
                                  aria-describedby="helpId"
                                  v-model="calculator.height"
                                  placeholder="Enter Height"
                                />
                              </div>
                              <div class="form-group mt-5 calculator-input">
                                <small id="helpId" class="form-text text-muted"
                                  ><b>Length</b> in metres</small
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  name=""
                                  id=""
                                  aria-describedby="helpId"
                                  v-model="calculator.length"
                                  placeholder="Enter Length"
                                />
                              </div>    
                          </div>

                          <div class="col-md-12 d-flex justify-content-center">
                            <!-- </div> -->
                            <button
                              type="button"
                              class="btn btn-sm btn-success custom_button mr-3"
                              @click="calculate($event)"
                            >
                              Calculator
                            </button>
                            <button
                              class="btn btn-danger custom_button text-white"
                              type="button"
                              data-dismiss="modal"
                              aria-label="Close"
                            >
                              Cancel
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- </div> -->
                  </div>
                </div>
                <div
                  class="tab-pane fade tab-style ml-3 mt-3"
                  id="tab-5"
                  role="tabpanel"
                >
                  5
                </div>
              </div>
              <br />
            </div>
            <!-- <div class="modal-footer">
                    </div> -->
          </div>
        </div>
      </div>


      <!-- small screen -->
      <!-- <div
        class="modal fade d-sm-block"
        id="centralModalSm"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >     
      <div  class="col-sm-6">
        <h3>Left Tabs</h3>
        <hr/>
        <div class="col-xs-3"> 
          <ul class="nav nav-tabs tabs-left sideways">
            <li class="active"><a href="#home-v" data-toggle="tab">Home</a></li>
            <li><a href="#profile-v" data-toggle="tab">Profile</a></li>
            <li><a href="#messages-v" data-toggle="tab">Messages</a></li>
            <li><a href="#settings-v" data-toggle="tab">Settings</a></li>
          </ul>
        </div>

        <div class="col-xs-9">
          <div class="tab-content">
            <div class="tab-pane active" id="home-v">Home Tab.</div>
            <div class="tab-pane" id="profile-v">Profile Tab.</div>
            <div class="tab-pane" id="messages-v">Messages Tab.</div>
            <div class="tab-pane" id="settings-v">Settings Tab.</div>
          </div>
        </div>

        <div class="clearfix"></div>

      </div>
      </div> -->

</div>
     
</template>

<style scoped>
.calc_box{
  /* display: none; */
}
</style>
<script>
export default {
  props:{
    current_product:{
      type: Object
    }
  },
  data(){
    return {
      calculator:{
        height: null,
        length: null
      },
      calculateResult: null,
      active:false

    }
  },

  methods:{
    calculate(event){
      this.active = !this.active

      // evt = event.target
      // el.classList.add('show_cal')

      if(this.calculator.height != null && this.calculator.length != null){
        this.calculateResult = this.calculator.height * this.calculator.length
        // return this.calculateResult

         Fire.$on("Change", () => {
            setTimeout(() => {
              this.active = false
              }, 2000);
        });
      } else {
        return false
      }

     

      
    }

  },
  mounted(){
    Fire.$emit("Change");
  }
}
</script>