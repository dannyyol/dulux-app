<template>
    <div>
        <div class="container bg-white" style="margin-top:5vh;margin-bottom:5vh;padding:5vh;">
            <div class="row total_section">
                <div class="col-md-8 bg-white  details-input">
                    <div class="container bg-white overflow-auto">
                        <!-- <div class="container"> -->
                        <section class="container">
                            <div id="accordion" class="accordion-container shadow">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Review Order
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">


                                            <div class="bg-pay">
                                                <div class="col-md-12 mb-3">
                                                    <div class="d-flex justify-content-between mt-2 mb-2"> <span class="fw-500"><label for="">Products</label></span> <span>
                                                    <!-- <button class="btn btn-success" type="button" > -->
                                                        <i class="fa fa-pencil-square-o text-success fw-800" style="cursor:pointer" aria-hidden="true" @click="editOrder()"> Edit</i>
                                                    <!-- </button>     -->
                                                    </span>
                                                </div>

                                            <!-- <br>
                                            <label for="">Litres</label> --> 

                                            
                                                    <table class="table ">
                                                        <thead class="bg-light table-bordered" style="font-weight:500;padding:20px !important;">
                                                            <tr class="">
                                                                <td style="width:25%">Name</td>
                                                                <td style="width:25%">Litre</td>
                                                                <td style="width:25%">Quantity</td>
                                                                <td style="width:25%"><span style="margin-right:-5px">Price(</span>
                                                                    <span style="margin-right:-5px">
                                                                        <svg  xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                                                  width="14" height="14"
                                                                                                  viewBox="0 0 172 172"
                                                                                                  style=" fill:#000000;padding-bottom:2px;">
                                                                                                  <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#000000"><path d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg>
                                                                   </span> )
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbody" v-for="(cart, index) in carts" :key="cart.id">
                                                            <tr>
                                                                <td  class="fw-500" style="padding-left:0.7rem;!important">{{ cart.product_name }}</td>
                                                                <td>
                                                                    <table v-for="(variation, ind) in JSON.parse(cart.variations)" :key="ind">
                                                                        <tr>
                                                                            <td style="padding-left:0.7rem;!important">{{ variation.name }} </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td >
                                                                   
                                                                    <table v-for="(variation, ind) in JSON.parse(cart.variations)" :key="ind">
                                                                        <tr>
                                                                            <td style="padding-left:0.7rem;!important">{{ variation.qty }} </td>
                                                                        </tr>
                                                                    </table>
                                                                    
                                                                </td>
                                                                <td >
                                                                    <table v-for="(variation, ind) in JSON.parse(cart.variations)" :key="ind">
                                                                        <tr>
                                                                            <td style="padding-left:0.7rem;!important">{{ variation.price }} </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <th></th>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <th class="fw-500" style="padding-top:10px;padding-left:0.7rem">Addons</th>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                            </tr>


                                                            <tr>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <th></th>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td >
                                                                    <table v-for="(addon, ind) in JSON.parse(cart.addons)" :key="ind">
                                                                        <tr>
                                                                            <td style="padding-left:0.7rem;!important">{{ addon.name }} </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td >
                                                                    <table v-for="(addon, ind) in JSON.parse(cart.addons)" :key="ind">
                                                                        <tr>
                                                                            <td style="padding-left:0.7rem;!important">{{ addon.qty }} </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td >
                                                                    <table v-for="(addon, ind) in JSON.parse(cart.addons)" :key="ind">
                                                                        <tr>
                                                                            <td style="padding-left:0.7rem;!important">{{ addon.price }} </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <hr>

                                                  
                                                    <div class="d-flex justify-content-between mt-2" style="font-weight:600"> <span
                                                            class="" >Total </span>
                                                             <span  class="text-success">
                                                            <svg  xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                width="14" height="14"
                                                                viewBox="0 0 172 172"
                                                                style=" fill:#000000;padding-bottom:2px;">
                                                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="600" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#28a745"><path d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg>
                                                                <span  style="margin-left:-3px;">{{ cartTotal }}   </span></span> </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                Pay In Store
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <form>
                                                <div>
                                                    <div class="container">
                                                        <div class="row" style="padding-left:20px;padding-right:20px;">


                                                            <div class="form-group col-md-6 pr-2 pl-2">
                                                                <input type="text" name="billing_fname" id=""
                                                                    class="form-control" placeholder="First Name" :class="errors.fname ? 'is-invalid' : ''"
                                                                    v-model="form.fname" aria-describedby="helpId" />
      
                                                            </div>

                                                            <div class="form-group col-md-6 pr-2 pl-2">
                                                                <input type="text" name="" id="" class="form-control"
                                                                    placeholder="Last Name" v-model="form.lname" :class="errors.lname ? 'is-invalid' : ''"
                                                                    aria-describedby="helpId" />

                                                            </div>

                                                            <div class="form-group col-md-6 pr-2 pl-2">
                                                                <input type="text" name="" id="" class="form-control"
                                                                    placeholder="Phone No" aria-describedby="helpId" :class="errors.number ? 'is-invalid' : ''"
                                                                    v-model="form.number" />
       
                                                            </div>

                                                            <div class="form-group col-md-6 pr-2 pl-2">
                                                                <input type="email" name="" id="" class="form-control" :class="errors.email ? 'is-invalid' : ''"
                                                                    placeholder="Email" aria-describedby="helpId"
                                                                    v-model="form.email" />
                                                          
                                                            </div>


                                                            <!-- <input type="hidden" name="" id="" class="form-control" placeholder="Email"
                                                        aria-describedby="helpId" :value="cartTotal"/> -->

                                                            <div class="form-group  col-md-12 pr-2 pl-2">
                                                                <textarea id="my-textarea" class="form-control" name="" rows="3"
                                                                    v-model="form.order_notes"
                                                                    placeholder="How is your experience ?"></textarea>
                                                                <small class="text-danger" v-if="errors.order_notes">
                                                                    {{ errors.order_notes[0] }}
                                                                </small>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mr-3 ml-3">
                                                        <hr>
                                                    </div>

                                                    <div class=" ">
                                                    <div class="tabs bg-light d-flex justify-content-center ml-3 mr-3" v-cloak>
                                                        
                                                        <div class="form-check form-check-inline">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="inlineRadioOptions"
                                                                id="inlineRadio1"
                                                                value="1"
                                                                v-model="pickNow"
                                                            />
                                                            <label class="form-check-label"
                                                                @click="show = 0" for="inlineRadio1">Pick Now</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="inlineRadioOptions"
                                                                id="inlineRadio2"
                                                            />
                                                            <label class="form-check-label"
                                                                @click="show = 1"  for="inlineRadio2">Pick Later</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="inlineRadioOptions"
                                                                id="inlineRadio3"
                                                                
                                                            />
                                                            <label class="form-check-label"
                                                                @click="show = 2"  for="inlineRadio3">Deliver to you</label>
                                                            </div>
                                                    </div>
                                                    <div class="texts" v-cloak>
                                                        <transition-group name="fade-up" target="div" appear>
                                                        <!-- <div v-for="(tab, index) in tabs"  v-if="show == index" :key="index" v-html="tab.content"></div> -->
                                                        <div v-if="show == 0" :key="0">
                                                            <div class="mt-3" style="margin;text-align:center" v-if="!hideForPickNow">
                                                                <p>Click the button below to submit your details and get your order number</p>

                                                                <button type="button" @click="offlinePayment($event)" value="pickNow"
                                                                    class="mt-2 btn btn-sm custom_button checkout-button">
                                                                    Submit
                                                                </button>
                                                                <!-- <h3 class="m-auto pt-5"> Your Number is 400, Wait at the counter</h3> -->
                                                            </div>
                                                            <div class="mt-3 w-75" style="margin:auto;text-align:center" v-else>
                                                                <p class=" pt-3" style="text-align:center;margin:auto;"> Your order number is <i> <b>{{ orderNumber }}</b></i>, kindly wait at the counter to receive your product</p>
                                                            </div>
                                                        </div>
                                                        <div v-else-if="show == 1" :key="1">
                                                            <div class=" d-flex justify-content-center">
                                                                <div class="card w-75 p-4 mt-4">
                                                                    <datetime type="datetime" v-model="form.date" input-id="startDate" class="mt-3 d-flex justify-content-center">
                                                                        <!-- <label for="startDate" slot="before">Field Label</label> -->
                                                                        <span class="description" slot="after">Select date to pick order</span>
                                                                        <template slot="button-cancel">
                                                                            <fa :icon="['far', 'times']"></fa>
                                                                            Cancel
                                                                        </template>
                                                                        <template slot="button-confirm">
                                                                            <fa :icon="['fas', 'check-circle']"></fa>
                                                                            Confirm
                                                                        </template>
                                                                    </datetime>
                                                                    <small class="text-danger" v-if="errors.date">
                                                                        {{ errors.date[0] }}
                                                                    </small>

                                                                    <div class=" mt-3">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="form-check form-check-inline">
                                                                                <input
                                                                                    class="form-check-input"
                                                                                    type="radio"
                                                                                    name="youOrSomeone"
                                                                                    id="youOrSomeone1"
                                                                                    value="you" 
                                                                                    v-model="pickLater"

                                                                                />
                                                                                <label @click="youOrSomeone = 0" class="form-check-label" for="youOrSomeone1">You</label>
                                                                            </div>

                                                                            <div class="form-check form-check-inline">
                                                                            <input
                                                                                class="form-check-input"
                                                                                type="radio"
                                                                                name="youOrSomeone"
                                                                                id="youOrSomeone2"
                                                                                value="option2"
                                                                            />
                                                                            <label @click="youOrSomeone = 1" class="form-check-label" for="youOrSomeone2">Someone</label>
                                                                            </div>

                                                                        </div>


                                                                            <div v-if="youOrSomeone == 0" :key="0">
                                                                                
                                                                                <div class="animate__animated animate__fadeInBottomRight" style="margin:auto; text-align:center;" v-if="!hideForPickLater">
                                                                                    <div>
                                                                                    <p>Click 
                                                                                        <a >here to submit your details and get your order number</a></p>
                                                                                </div>
                                                                                    <button type="button" @click="offlinePayment($event)" value="pickLater"
                                                                                        class="btn mt-3 mb-3 btn-sm custom_button checkout-button">
                                                                                        Submit
                                                                                    </button>
                                                                                </div>
                                                                                <div class="" style="margin:auto;text-align:center" v-else>
                                                                                    <p class="m-auto pt-3"> Your order number is <i><b>{{ orderNumber }}</b></i>, kindly wait at the counter to receive your product</p>
                                                                                </div>
                                                                            </div>

                                                                            <div v-if="youOrSomeone == 1" :key="1">

                                                                                <div class="row animate__animated animate__fadeInBottomRight">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <div class="form-group pr-2 pl-2 pt-3">
                                                                                                <input type="text" name="billing_fname" id=""
                                                                                                    class="form-control" placeholder="First Name" :class="errors.someone_fname ? 'is-invalid' : ''"
                                                                                                    v-model="form.someone_fname" aria-describedby="helpId" />
                                                                                                <!-- <small class="text-danger" v-if="errors.someone_fname">
                                                                                                    {{ errors.someone_fname[0] }}
                                                                                                </small> -->
                                                                                            </div>

                                                                                            <div class="form-group pr-2 pl-2">
                                                                                                <input type="text" name="" id="" class="form-control"
                                                                                                    placeholder="Last Name" v-model="form.someone_lname" :class="errors.someone_lname ? 'is-invalid' : ''"
                                                                                                    aria-describedby="helpId" />
                                                                                                <!-- <small class="text-danger" v-if="errors.someone_lname">
                                                                                                    {{ errors.someone_lname[0] }}
                                                                                                </small> -->
                                                                                            </div>

                                                                                            <div class="form-group pr-2 pl-2">
                                                                                                <input type="text" name="" id="" class="form-control" :class="errors.someone_number ? 'is-invalid' : ''"
                                                                                                    placeholder="Phone No" aria-describedby="helpId"
                                                                                                    v-model="form.someone_number" />
                                                                                                <!-- <small class="text-danger" v-if="errors.someone_number">
                                                                                                    {{ errors.someone_number[0] }}
                                                                                                </small> -->
                                                                                            </div>
                                                                                            <div class="form-group d-flex justify-content-center">
                                                                                                <button type="button" @click="offlinePayment($event)" value="someone"
                                                                                                    class="btn btn-sm custom_button checkout-button">
                                                                                                    Submit
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>



                                                                                    

                                                                                        
                                                                                        
                                                                                    
                                                                                </div>
                                                                            </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            
                                                        </div>
                                                        <div v-else :key="2">
                                                            
                                                                <div class="container">
                                                                    <h3 class="pt-3" style="padding-left:10px;padding-right:10px;">Shipping Address</h3>
                                                                    <div class="row" style="padding-left:20px;padding-right:20px;">

                                                                            <div class="col-md-4 col-12 form-group pl-2 pr-2">
                                                                                <input type="text" name="" id="" class="form-control" :class="errors.shpping_fname ? 'is-invalid' : ''"
                                                                                    placeholder="First Name"
                                                                                    v-model="form.shpping_fname"
                                                                                    aria-describedby="helpId" />
                                                                            </div>
                                                                            <div class="col-md-4 col-12 form-group pl-2 pr-2">
                                                                                <input type="text" name="" id="" class="form-control" :class="errors.shpping_lname ? 'is-invalid' : ''"
                                                                                    placeholder="Last Name" aria-describedby="helpId"
                                                                                    v-model="form.shpping_lname" />
                                                                            </div>



                                                                            <div class="col-md-4 col-12 form-group pl-2 pr-2">
                                                                                <input type="text" name="" id="" class="form-control" :class="errors.shpping_country ? 'is-invalid' : ''"
                                                                                    placeholder="Country" aria-describedby="helpId"
                                                                                    v-model="form.shpping_country" />
                                                                            </div>


                                                                            <div class="col-md-6 col-12 form-group pl-2 pr-2">
                                                                                <input type="text" name="" id="" class="form-control" :class="errors.shpping_address ? 'is-invalid' : ''"
                                                                                    placeholder="Address" aria-describedby="helpId"
                                                                                    v-model="form.shpping_address" />
                                                                            </div>



                                                                            <div class="col-md-6 col-12 form-group pr-2 pl-2">
                                                                                <input type="text" name="" id="" class="form-control" :class="errors.shpping_city ? 'is-invalid' : ''"
                                                                                    placeholder="Town/City" aria-describedby="helpId"
                                                                                    v-model="form.shpping_city" />
                                                                            </div>


                                                                            <div class="col-md-6 col-12 pl-2 pr-2 form-group">
                                                                                <input type="email" name="" id="" class="form-control" :class="errors.shpping_email ? 'is-invalid' : ''"
                                                                                    placeholder="Contact Email"
                                                                                    aria-describedby="helpId"
                                                                                    v-model="form.shpping_email" />
                                                                            </div>


                                                                            <div class="col-md-6 col-12 form-group pr-2 pl-2">
                                                                                <input type="text" name="" id="" class="form-control" :class="errors.shpping_number ? 'is-invalid' : ''"
                                                                                    placeholder="Phone Number"
                                                                                    v-model="form.shpping_number"
                                                                                    aria-describedby="helpId" />
                                                                            </div>
                                                                        </div>

                                                                    <!-- </div> -->
                                                                </div>







                                                         

                                                                    <div class="modal-footer border-0">
                                                                        <button type="button"
                                                                            class="btn btn-sm custom_button clear-button">
                                                                            Clear
                                                                        </button>
                                                                        <button type="button" @click="offlinePayment($event)" value="deliverToYou" 
                                                                            class="btn btn-sm custom_button checkout-button">
                                                                            Confirm & Pay
                                                                        </button>
                                                                    <!-- </div> -->
                                                                </div>
                                                            <!-- </form> -->
                                                        </div>
                                                        </transition-group>
                                                    </div>
                                                </div>

                                            <div>
                                                        



                                                



                                                    </div>
                                                    <!-- <div class="modal-footer border-0">
                                                        <button type="button"
                                                            class="btn btn-sm custom_button clear-button">
                                                            Clear
                                                        </button>
                                                        <button type="submit" v-if="errors"
                                                            class="btn btn-sm custom_button checkout-button">
                                                            Confirm & Pay
                                                        </button>
                                                        <button type="submit" v-if="!errors"
                                                            class="btn btn-sm custom_button checkout-button"
                                                            data-dismiss="modal" aria-label="Close">
                                                            Confirm & Pay
                                                        </button>
                                                    </div> -->
                                                </div>
                                            </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                Pay By Card
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion">
                                        <div class="card-body">


                                        </div>
                                    </div>
                                </div>
                                
                                

                                
                            </div>
                        </section>
                        <!-- </div> -->
                    </div>
                </div>
                

                <div class="col-md-4 my-auto enter_detail_total_price" style="text-align: center !important">
                    <h2>Total Price:</h2>
                    <h1><span><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="35" height="35"
                            viewBox="0 0 172 172"
                            style="fill:#000000;padding-bottom:2px;">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#00a78e"><path d="M157.66667,78.83333v-12.54167h-21.5v-44.79167h-17.02083v44.79167h-36.49983l-29.59833,-44.79167h-17.21433v44.79167h-21.5v12.54167h21.5v16.125h-21.5v12.54167h21.5v43h17.02083v-43h37.46733l28.45167,43h17.3935v-43h21.5v-12.54167h-21.5v-16.125zM119.14583,78.83333v16.125h-17.9095l-10.4705,-16.125zM52.85417,50.46767l10.34867,15.824h-10.34867zM52.85417,78.83333h18.5115l10.57083,16.125h-29.08233zM109.49233,107.5h9.6535v14.75617z"></path></g></g></svg></span>
                            <span class="" style="margin-left:-10px;padding-top:3px !important;">{{ cartTotal }}   </span></h1>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import $ from "jquery";
    // import Accordion from "../Accordion";
    import Accordion from "../frontend/accordion/Accordion"
    import { Datetime } from 'vue-datetime';

    export default {

        components: {
            Accordion,
            datetime: Datetime
        },
        props: {
            cartTotal: {
                type: String
            },
            AddOnTotal: {
                type: String
            },
            variationTotal: {
                type: String
            },
            // totalQtyOfLitres:{
            //     type: String
            // },

        },

        data() {
            return {
                hideForPickNow:false,
                hideForPickLater:false,                
                items: {

                },
                youOrSomeone:0,
                show: 0,
                carts: [],
                payment_options: [],
                pickNow: 1,
                pickLater:'you',
                form: {
                    // pay now
                    fname: null,
                    lname: null,
                    email: null,
                    number: null,
                    order_notes: null,

                    // pay latter
                    someone_fname:null,
                    someone_lname:null,
                    someone_number:null,
                    date: null,

                    // Deliver to you
                    billing_fname: null,
                    billing_lname: null,
                    billing_address: null,
                    billing_city: null,
                    billing_country: null,
                    billing_number: null,
                    billing_email: null,
                    shpping_fname: null,
                    shpping_lname: null,
                    shpping_address: null,
                    shpping_city: null,
                    shpping_country: null,
                    shpping_number: null,
                    shpping_email: null,

                    pickNow: '',
                    pickLater:'',
                    someone:'',
                    deliverToYou:'',

                    cartTotal:null,
                    AddOnTotal: null,
                    variationTotal: null,
                    // totalQtyOfLitres :null


                },
                errors: {},
                orderNumber: null
                // errors2: {},
            };
        },
        methods: {
            editOrder(){
                this.$router.go(-1)
            },
            offlinePayment(event){
                this.form.pickNow = event.target.value
                this.form.pickLater = event.target.value
                this.form.someone = event.target.value
                this.form.deliverToYou = event.target.value
                this.form.cartTotal = this.cartTotal
                this.form.AddOnTotal = this.AddOnTotal
                this.form.variationTotal = this.variationTotal
                // this.form.totalQtyOfLitres = this.totalQtyOfLitres
                axios.post("/api/by-pick-now/"+ this.$route.params.id, this.form)
                    .then((response) => {
                        // this.$router.push({ name: 'menu'})
                        if (response.data["status_code"] == "AB") {
                            this.orderNumber = response.data.data
                            swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your Order has been submitted',
                                showConfirmButton: true,
                                timer: 2500
                            })
                            if(event.target.value == 'pickNow'){
                                this.hideForPickNow = true
                            } else if(event.target.value == 'pickLater'){
                                this.hideForPickLater = true
                            }
                        } else if (response.data["status_code"] == "AC") {
                             if(event.target.value == 'pickNow'){
                                this.hideForPickNow = false
                            }else if(event.target.value == 'pickLater'){
                                this.hideForPickLater = false
                            }
                            this.errorMessage(response.data["message"]);
                        }
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors
                        if(event.target.value == 'pickNow'){
                            this.hideForPickNow = false
                        }else if(event.target.value == 'pickLater'){
                            this.hideForPickLater = false
                            }
                        swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error submitting order, try again !",
                            showConfirmButton: true,
                            timer: 2500,
                        });
                    })

            },
            


            // pickLater(){
            //     this.form.cartTotal = this.cartTotal
            //     axios.post("/api/by-pick-now/"+ this.$route.params.id, this.form)
            //         .then((response) => {
            //             // this.$router.push({ name: 'menu'})
            //             if (response.data["status_code"] == "AB") {
            //                 swal.fire({
            //                     position: 'center',
            //                     icon: 'success',
            //                     title: 'Your Order has been submitted',
            //                     showConfirmButton: true,
            //                     timer: 2500
            //                 })
            //                 this.hideForPickNow = true
            //             } else if (response.data["status_code"] == "AC") {
            //                 this.hideForPickNow = true
            //                 this.errorMessage(response.data["message"]);
            //             }
            //         })
            //         .catch((error) => {
            //             this.errors = error.response.data.errors
            //             this.hideForPickNow = true
            //             swal.fire({
            //                 position: "center",
            //                 icon: "error",
            //                 title: "Error submitting order, try again !",
            //                 showConfirmButton: true,
            //                 timer: 2500,
            //             });
            //         })

            // },
            
            errorMessage(message) {
                swal.fire({
                    position: "center",
                    icon: "error",
                    title: message,
                    showConfirmButton: true,
                    timer: 2500,
                });
            },
            cartSubtotal() {
                return this.$route.params.total
            },
            cartProducts() {
                axios
                    .get("/api/cart-lists/")
                    .then((response) => {
                        this.carts = response.data;
                        this.currentCart = response.data;
                    })
                    .catch((error) => {});

                // this.message = this.message.split("").reverse().join("");
            },
            saveByCashOrder() {
                axios
                    .post("/api/save-bycash-order/" + this.$route.params.id, {
                        form: this.form,
                        cartTotal: this.cartTotal,
                        AddOnTotal: this.AddOnTotal,
                        variationTotal: this.variationTotal
                    })
                    .then((response) => {
                        // this.$router.push({ name: 'menu'})
                        if (response.data["status_code"] == "AB") {
                            swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your Order has been submitted',
                                showConfirmButton: true,
                                timer: 2500
                            })
                            this.$router.back();
                        } else if (response.data["status_code"] == "AC") {
                            this.errorMessage(response.data["message"]);
                        }
                    })
                    .catch((error) => {
                        swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error submitting order, try again !",
                            showConfirmButton: true,
                            timer: 2500,
                        });
                    })
            },

            showButton(){
                this.hideForPickLater = true
            },

            saveByDeliveryOrder() {
                // alert('check')
                this.hideForPickNow = true
                axios.post("/api/save-bydelivery-order", {
                        form: this.form2,
                        cartTotal: this.cartTotal
                    })
                    .then((response) => {
                        // this.$router.push({ name: 'menu'})
                        if (response.data["status_code"] == "AB") {
                            swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your Order has been submitted',
                                showConfirmButton: true,
                                timer: 2500
                            })
                        } else if (response.data["status_code"] == "AC") {
                            this.errorMessage(response.data["message"]);
                        }
                    })
                    .catch((error) => {
                        swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error submitting order, try again !",
                            showConfirmButton: true,
                            timer: 2500,
                        });
                    })
            },
            paymentOptions() {
                axios
                    .get("/api/checkout/")
                    .then(({
                        data
                    }) => (this.payment_options = data.ogateways))
                    .catch((error) => {});
            },
            expandAll() {
                // EventBus.$emit("closeAll");
            },
            defaultDate(){
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); 
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;
                console.log('date',today)
                this.form.date = today
                return this.form.date
            }
        },
        activated(){
            this.cartProducts()

        },
        mounted() {
            //
            this.paymentOptions();
            console.log(this.payment_options);
            this.defaultDate()
        },
    };

</script>



<style scoped>

.section {
	 padding: 2em 0;
}
 .fade-up-enter-active, .fade-up-leave-active {
	 transition: all 0.3s ease-in-out;
}
 .fade-up-enter, .fade-up-leave-to {
	 height: 0;
	 transform: translateY(30px);
	 opacity: 0;
}
 
  
    .table th {
        border-top: none;
        padding: 0.1rem;
        vertical-align: top;
        line-height: 23px;
        font-size:14px;

        /* font-weight: 500; */
    }
    .tbody td{

        border-top: none;
        padding: 0rem;
        /* margin-left:20px; */
        /* vertical-align: top; */
        line-height: 23px;
        font-size:14px;


    }

    .accordion-container .card .card-header button.btn:after {
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }

    .accordion-container .card .card-header {
        position: relative;
        background-color: rgba(128, 128, 128, 0.068);
    }

    .enter_detail_total_price {
        /* background-color: red;
    height: 100%; */
    }

    .accordion-container .card .card-header .btn-link,
    .enter_detail_total_price h2 {
        color: rgba(36, 33, 33, 0.603);
        /* font-family: Montserrat; */
        font-size: 19px;
        font-weight: 600;
        line-height: 23px;
    }

    .accordion-container .card .card-header button.btn.collapsed:after {
        background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIyLjA2MiAyMi4wNjIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDIyLjA2MiAyMi4wNjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMjEuNDU0LDUuNTEzbC0wLjczNy0wLjczN2MtMC44MDgtMC44MS0yLjEzNC0wLjgxLTIuOTQzLDBsLTYuNzQzLDYuNzQyTDQuMjg5LDQuNzc2ICAgYy0wLjgwOS0wLjgxLTIuMTM1LTAuODEtMi45NDQsMEwwLjYwOCw1LjUxM2MtMC44MTEsMC44MDktMC44MTEsMi4xMzUsMCwyLjk0NWw4LjgzNSw4LjgzNWMwLjQzNSwwLjQzNSwxLjAxOCwwLjYyOCwxLjU4NywwLjU5NyAgIGMwLjU3MSwwLjAzMSwxLjE1NC0wLjE2MiwxLjU4OC0wLjU5N2w4LjgzNi04LjgzNUMyMi4yNjQsNy42NDksMjIuMjY0LDYuMzIzLDIxLjQ1NCw1LjUxM3oiIGZpbGw9IiMzNDM0MzQiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
    }

    .accordion-container .card .card-header button.btn:not(.collapsed):after {
        background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDIyLjA2NCAyMi4wNjQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDIyLjA2NCAyMi4wNjQ7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNMjEuNDU2LDEzLjYwNWwtOC44MzUtOC44MzVjLTAuNDM0LTAuNDM1LTEuMDE3LTAuNjI4LTEuNTg5LTAuNTk4Yy0wLjU3MS0wLjAzLTEuMTU0LDAuMTYyLTEuNTg4LDAuNTk4bC04LjgzNiw4LjgzNSAgIGMtMC44MTIsMC44MS0wLjgxMiwyLjEzNSwwLDIuOTQ0bDAuNzM5LDAuNzM3YzAuODA4LDAuODEsMi4xMzQsMC44MSwyLjk0MiwwbDYuNzQyLTYuNzQybDYuNzQyLDYuNzQyICAgYzAuODA5LDAuODEsMi4xMzUsMC44MSwyLjk0MiwwbDAuNzM3LTAuNzM3QzIyLjI2NywxNS43NDEsMjIuMjY3LDE0LjQxNSwyMS40NTYsMTMuNjA1eiIgZmlsbD0iIzg2MDAyMSIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=);
    }

    .accordion-container .card .card-header button.btn.btn-link {
        width: 100%;
        text-align: left;
    }

    .accordion-container .card .card-header button.btn:after {
        content: '';
        background-repeat: no-repeat;
        background-position: 50%;
        width: 3rem;
        height: 3rem;
        text-align: center;
        float: right;
        padding: 0.7rem;
        border: 1px solid #fff;
        border-radius: 50%;
    }

    .accordion-container .card .card-header button.btn.collapsed:after {
        background-color: rgba(0, 0, 0, .03) !important;
    }

    .accordion-container .card .card-header button.btn:not(.collapsed):after {
        background-color: #fff;
    }

    .accordion-container .card .card-header button.btn-link:not(.collapsed)::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .03);
        ;
        opacity: 0.31;
    }

    .accordion-container .card .card-body {
        background-color: #fff;
        /* color: #fff; */
        /* font-family: Montserrat; */
        font-size: 14px;
        font-weight: 300;
        line-height: 19px;
    }


    .fw-500 {
        font-weight: 400
    }

    .lh-16 {
        line-height: 16px
    }

</style>
