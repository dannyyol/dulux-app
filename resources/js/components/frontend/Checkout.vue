<template>
<div>
    <div class="container" style="margin-top:5vh;margin-bottom:5vh;padding:5vh;">
        <div class="row">
            <div class="col-md-8 details-input">
                <div class="container overflow-auto">
                    <div class="columns is-multiline" v-for="(poption, index) in payment_options" :key="index">
                        <!-- <Accordion :title="poption.name" @expand="expandAll">
                            <form @submit.prevent="saveByCashOrder">
                                <div v-if="poption.name.toLowerCase() == 'pay by cash'">
                                    <div class="form-group pr-2 pl-2 pt-3">
                                        <input type="text" name="billing_fname" id="" class="form-control"
                                            placeholder="First Name" v-model="form.billing_fname"
                                            aria-describedby="helpId" />
                                        <small class="text-danger" v-if="errors.billing_fname">
                                            {{ errors.billing_fname[0] }}
                                        </small>
                                    </div>

                                    <div class="form-group pr-2 pl-2 pt-3">
                                        <input type="text" name="" id="" class="form-control" placeholder="Last Name"
                                            v-model="form.billing_lname" aria-describedby="helpId" />
                                        <small class="text-danger" v-if="errors.billing_lname">
                                            {{ errors.billing_lname[0] }}
                                        </small>
                                    </div>

                                    <div class="form-group pr-2 pl-2">
                                        <input type="text" name="" id="" class="form-control" placeholder="Phone No"
                                            aria-describedby="helpId" v-model="form.billing_number" />
                                        <small class="text-danger" v-if="errors.billing_number">
                                            {{ errors.billing_number[0] }}
                                        </small>
                                    </div>

                                    <div class="form-group pr-2 pl-2">
                                        <input type="text" name="" id="" class="form-control" placeholder="Email"
                                            aria-describedby="helpId" v-model="form.billing_email" />
                                        <small class="text-danger" v-if="errors.billing_email">
                                            {{ errors.billing_email[0] }}
                                        </small>
                                    </div>

                                    <div class="form-group pr-2 pl-2">
                                        <textarea id="my-textarea" class="form-control" name="" rows="3"
                                            v-model="form.order_notes"
                                            placeholder="How is your experience ?"></textarea>
                                        <small class="text-danger" v-if="errors.order_notes">
                                            {{ errors.order_notes[0] }}
                                        </small>
                                    </div>

                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-sm custom_button clear-button">
                                            Clear
                                        </button>
                                        <button type="submit" v-if="errors"
                                            class="btn btn-sm custom_button checkout-button"
                                            style="padding-top: 7px !important">
                                            Confirm & Pay
                                        </button>
                                        <button type="submit" v-if="!errors"
                                            class="btn btn-sm custom_button checkout-button" data-dismiss="modal"
                                            aria-label="Close" style="padding-top: 7px !important">
                                            Confirm & Pay
                                        </button>
                                    </div>
                                </div>
                            </form>


                            <form @submit.prevent="saveByDeliveryOrder">
                                <div v-if="poption.name.toLowerCase() == 'pay and we deliver'">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="pl-2 pt-2">Billing Address</h3>
                                            <div class="form-group pl-2 pt-3">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Country" v-model="form2.billing_country"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_country">
                                                    {{ errors2.billing_country[0] }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="pl-2 pt-2">Shipping Address</h3>
                                            <div class="form-group pr-2 pt-3">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Country" aria-describedby="helpId"
                                                    v-model="form2.shpping_country" />
                                                <small class="text-danger" v-if="errors2.shpping_country">
                                                    {{ errors2.shpping_country[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="First Name" v-model="form2.billing_fname"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_fname">
                                                    {{ errors2.billing_fname[0] }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Last Name" aria-describedby="helpId"
                                                    v-model="form2.billing_lname" />
                                                <small class="text-danger" v-if="errors2.billing_lname">
                                                    {{ errors2.billing_lname[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="First Name" v-model="form2.shpping_fname"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.shpping_fname">
                                                    {{ errors2.shpping_fname[0] }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Last Name" aria-describedby="helpId"
                                                    v-model="form2.shpping_lname" />
                                                <small class="text-danger" v-if="errors2.shpping_lname">
                                                    {{ errors2.shpping_lname[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Address" aria-describedby="helpId"
                                                    v-model="form2.billing_address" />
                                                <small class="text-danger" v-if="errors2.billing_address">
                                                    {{ errors2.billing_address[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Address" aria-describedby="helpId"
                                                    v-model="form2.shpping_address" />
                                                <small class="text-danger" v-if="errors2.shpping_address">
                                                    {{ errors2.shpping_address[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Town/City" v-model="form2.billing_city"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_city">
                                                    {{ errors2.billing_city[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Town/City" aria-describedby="helpId"
                                                    v-model="form2.shpping_city" />
                                                <small class="text-danger" v-if="errors2.shpping_city">
                                                    {{ errors2.shpping_city[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Contact Email" v-model="form2.billing_email"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_email">
                                                    {{ errors2.billing_email[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Contact Email" aria-describedby="helpId"
                                                    v-model="form2.shpping_email" />
                                                <small class="text-danger" v-if="errors2.shpping_email">
                                                    {{ errors2.shpping_email[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Phone Number" v-model="form2.billing_number"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_number">
                                                    {{ errors2.billing_number[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Phone Number" v-model="form2.shpping_number"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.shpping_number">
                                                    {{ errors2.shpping_number[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>






                                    <div class="form-group pr-2 pl-2">
                                        <textarea id="my-textarea" class="form-control" name="" rows="3"
                                            v-model="form2.order_notes"
                                            placeholder="How is your experience ?"></textarea>
                                        <small class="text-danger" v-if="errors2.order_notes">
                                            {{ errors2.order_notes[0] }}
                                        </small>
                                    </div>

                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-sm custom_button clear-button">
                                            Clear
                                        </button>
                                        <button type="submit" class="btn btn-sm custom_button checkout-button"
                                            style="padding-top: 7px !important">
                                            Confirm & Pay
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </Accordion> -->
                    </div>
                
                
                <div class="container">
                    <div id="accordion" class="accordion">
                        <div class="card mb-0" v-for="(poption, index) in payment_options" :key="index">
                            <div class="card-header accordion-checkout-order-header collapsed" data-toggle="collapse" :href="'#collapseOne'+poption.id">
                                <a class="card-title"> {{ poption.name }}</a>
                            </div>
                            <div :id="'collapseOne'+poption.id" class="card-body collapse" data-parent="#accordion">

                                <form @submit.prevent="saveByCashOrder">
                                <div v-if="poption.name.toLowerCase() == 'pay by cash'">
                                    <div class="form-group pr-2 pl-2 pt-3">
                                        <input type="text" name="billing_fname" id="" class="form-control"
                                            placeholder="First Name" v-model="form.billing_fname"
                                            aria-describedby="helpId" />
                                        <small class="text-danger" v-if="errors.billing_fname">
                                            {{ errors.billing_fname[0] }}
                                        </small>
                                    </div>

                                    <div class="form-group pr-2 pl-2 pt-3">
                                        <input type="text" name="" id="" class="form-control" placeholder="Last Name"
                                            v-model="form.billing_lname" aria-describedby="helpId" />
                                        <small class="text-danger" v-if="errors.billing_lname">
                                            {{ errors.billing_lname[0] }}
                                        </small>
                                    </div>

                                    <div class="form-group pr-2 pl-2">
                                        <input type="text" name="" id="" class="form-control" placeholder="Phone No"
                                            aria-describedby="helpId" v-model="form.billing_number" />
                                        <small class="text-danger" v-if="errors.billing_number">
                                            {{ errors.billing_number[0] }}
                                        </small>
                                    </div>

                                    <div class="form-group pr-2 pl-2">
                                        <input type="text" name="" id="" class="form-control" placeholder="Email"
                                            aria-describedby="helpId" v-model="form.billing_email" />
                                        <small class="text-danger" v-if="errors.billing_email">
                                            {{ errors.billing_email[0] }}
                                        </small>
                                    </div>


                                    <!-- <input type="hidden" name="" id="" class="form-control" placeholder="Email"
                                            aria-describedby="helpId" :value="cartTotal"/> -->

                                    <div class="form-group pr-2 pl-2">
                                        <textarea id="my-textarea" class="form-control" name="" rows="3"
                                            v-model="form.order_notes"
                                            placeholder="How is your experience ?"></textarea>
                                        <small class="text-danger" v-if="errors.order_notes">
                                            {{ errors.order_notes[0] }}
                                        </small>
                                    </div>

                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-sm custom_button clear-button">
                                            Clear
                                        </button>
                                        <button type="submit" v-if="errors"
                                            class="btn btn-sm custom_button checkout-button">
                                            Confirm & Pay
                                        </button>
                                        <button type="submit" v-if="!errors"
                                            class="btn btn-sm custom_button checkout-button" data-dismiss="modal"
                                            aria-label="Close">
                                            Confirm & Pay
                                        </button>
                                    </div>
                                </div>
                            </form>


                            <form @submit.prevent="saveByDeliveryOrder">
                                <div v-if="poption.name.toLowerCase() == 'pay and we deliver'">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="pl-2 pt-2">Billing Address</h3>
                                            <div class="form-group pl-2 pt-3">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Country" v-model="form2.billing_country"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_country">
                                                    {{ errors2.billing_country[0] }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="pl-2 pt-2">Shipping Address</h3>
                                            <div class="form-group pr-2 pt-3">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Country" aria-describedby="helpId"
                                                    v-model="form2.shpping_country" />
                                                <small class="text-danger" v-if="errors2.shpping_country">
                                                    {{ errors2.shpping_country[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="First Name" v-model="form2.billing_fname"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_fname">
                                                    {{ errors2.billing_fname[0] }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Last Name" aria-describedby="helpId"
                                                    v-model="form2.billing_lname" />
                                                <small class="text-danger" v-if="errors2.billing_lname">
                                                    {{ errors2.billing_lname[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="First Name" v-model="form2.shpping_fname"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.shpping_fname">
                                                    {{ errors2.shpping_fname[0] }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Last Name" aria-describedby="helpId"
                                                    v-model="form2.shpping_lname" />
                                                <small class="text-danger" v-if="errors2.shpping_lname">
                                                    {{ errors2.shpping_lname[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Address" aria-describedby="helpId"
                                                    v-model="form2.billing_address" />
                                                <small class="text-danger" v-if="errors2.billing_address">
                                                    {{ errors2.billing_address[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Address" aria-describedby="helpId"
                                                    v-model="form2.shpping_address" />
                                                <small class="text-danger" v-if="errors2.shpping_address">
                                                    {{ errors2.shpping_address[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Town/City" v-model="form2.billing_city"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_city">
                                                    {{ errors2.billing_city[0] }}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Town/City" aria-describedby="helpId"
                                                    v-model="form2.shpping_city" />
                                                <small class="text-danger" v-if="errors2.shpping_city">
                                                    {{ errors2.shpping_city[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Contact Email" v-model="form2.billing_email"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_email">
                                                    {{ errors2.billing_email[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Contact Email" aria-describedby="helpId"
                                                    v-model="form2.shpping_email" />
                                                <small class="text-danger" v-if="errors2.shpping_email">
                                                    {{ errors2.shpping_email[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pl-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Phone Number" v-model="form2.billing_number"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.billing_number">
                                                    {{ errors2.billing_number[0] }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group pr-2">
                                                <input type="text" name="" id="" class="form-control"
                                                    placeholder="Phone Number" v-model="form2.shpping_number"
                                                    aria-describedby="helpId" />
                                                <small class="text-danger" v-if="errors2.shpping_number">
                                                    {{ errors2.shpping_number[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group pr-2 pl-2">
                                        <textarea id="my-textarea" class="form-control" name="" rows="3"
                                            v-model="form2.order_notes"
                                            placeholder="How is your experience ?"></textarea>
                                        <small class="text-danger" v-if="errors2.order_notes">
                                            {{ errors2.order_notes[0] }}
                                        </small>
                                    </div>

                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-sm custom_button clear-button">
                                            Clear
                                        </button>
                                        <button type="submit" class="btn btn-sm custom_button checkout-button">
                                            Confirm & Pay
                                        </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-md-4 my-auto enter_detail_total_price" style="text-align: center !important">
                <h2>Total Price:</h2>
                <h1>${{ cartTotal }}</h1>
            </div>
        </div>
    </div>
</div>
    
</template>
<style scoped>
    .modal-body {
        overflow-y: scroll !important;
    }

</style>
<script>
    import $ from "jquery";
    // import Accordion from "../Accordion";
    import Accordion from "../frontend/accordion/Accordion"
    export default {
        
        components: {
            Accordion,
        },
        props:{
            cartTotal:{
                type:String
            },
            AddOnTotal:{
                type:String
            },
            variationTotal:{
                type:String
            },

        },

        data() {
            return {
                items:{

                },
                carts:[],
                payment_options: [],
                form: {
                    billing_fname: null,
                    billing_lname: null,
                    billing_email: null,
                    billing_number: null,
                    order_notes: null,
                },
                form2: {
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
                    shpping_email: null
                },
                errors: {},
                errors2: {},
            };
        },
        methods: {
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

                this.message = this.message.split("").reverse().join("");
            },
            saveByCashOrder() {
                axios
                    .post("/api/save-bycash-order/"+this.$route.params.id,{
                        form:this.form,
                        cartTotal : this.cartTotal,
                        AddOnTotal: this.AddOnTotal,
                        variationTotal:this.variationTotal
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
                        }else if(response.data["status_code"] == "AC"){
                            this.errorMessage(response.data["message"]);
                        }
                    })
                    .catch((error)=>{
                        swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error submitting order, try again !",
                            showConfirmButton: true,
                            timer: 2500,
                        });
                    })
            },

            saveByDeliveryOrder() {
                axios.post("/api/save-bydelivery-order",{
                        form:this.form2,
                        cartTotal : this.cartTotal
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
                        }else if(response.data["status_code"] == "AC"){
                            this.errorMessage(response.data["message"]);
                        }
                    })
                    .catch((error)=>{
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
        },
        mounted() {
            //
            // this.accordion()
            this.paymentOptions();
            console.log(this.payment_options);
            // this.method();

        },
    };

</script>


<style scoped>
.accordion .card-header{
    font-size: 16px;
    display: block;
    cursor: pointer;
    padding: 15px 20px;
}

.accordion .card-header:after {
    font-family: 'FontAwesome';  
    content: "\f068";
    float: right; 
}
.accordion .card-header.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\f067"; 
}
</style>