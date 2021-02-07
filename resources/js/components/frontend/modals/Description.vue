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
        <div class="modal-dialog " role="document" >
          <div class="modal-content">
            <div class="modal-body">




              
              <!-- <div class="container-fluid"> -->



  <div class="bg-white rounded">
    <!-- Lined tabs-->
    <ul id="myTab2" role="tablist" class=" nav nav-tabs nav-pills with-arrow lined flex-column flex-sm-row text-center">
      <li class="nav-item flex-sm-fill">
        <a id="home2-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true" class="nav-link text-uppercase font-weight-bold rounded-0 active">Key Information</a>
      </li>
      <li class="nav-item flex-sm-fill">
        <a id="profile2-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0">Product Feature</a>
      </li>
      <li class="nav-item flex-sm-fill">
        <a id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0">Documentation</a>
      </li>

      <li class="nav-item flex-sm-fill">
        <a id="contact2-tab" data-toggle="tab" href="#tips_advice" role="tab" aria-controls="contact2" aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0">Tip & Advice</a>
      </li>


      <li class="nav-item flex-sm-fill">
        <a id="calculator-tab" data-toggle="tab" href="#calculator" role="tab" aria-controls="calculator" aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0">Calculator</a>
      </li>
    </ul>
    <div id="myTab2Content" class="tab-content">
      <div id="home2" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
        
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
                <div v-html="current_product.product_key_info"></div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="profile2" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
        <p class="leade font-italic"> ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="leade font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <div v-html="current_product.product_product_feature"></div> 
      </div>
      <div id="contact2" role="tabpanel" aria-labelledby="contact-tab" class="tab-pane fade px-4 py-5">
        <p class="leade font-italic">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="leade font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

      <div id="contact2" role="tabpanel" aria-labelledby="contact-tab" class="tab-pane fade px-4 py-5">
        <p class="leade font-italic">Lorem dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="leade font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <div v-html="current_product.product_documentation"></div> 
      </div>


      <div id="tips_advice" role="tabpanel" aria-labelledby="contact-tab" class="tab-pane fade px-4 py-5">
        <p class="leade font-italic">Lorem dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="leade font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <div v-html="current_product.key_info"></div> 
      </div>


      <div id="calculator" role="tabpanel" aria-labelledby="calculator-tab" class="tab-pane fade px-4 py-5">
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
                            <!-- <button
                              class="btn btn-danger custom_button text-white"
                              type="button"
                              data-dismiss="modal"
                              aria-label="Close"
                            >
                              Cancel
                            </button> -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- </div> -->
                  </div>
      </div>
    </div>
    <!-- End lined tabs -->
  </div>

<!-- </div> -->

              


            </div>

            <div class="card-footer bg-white">
                <div
                  class="col-md-12 row d-flex justify-content-end" 
                >
                  <button
                    type="button"
                    class="btn btn-sm btn-primary custom_button mr-3" style=""
                  >
                    Send Brochure
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
        
      </div>
</div>
     
</template>

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