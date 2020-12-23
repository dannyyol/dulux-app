<template>
    <!-- centralModalSm3 -->
    <!-- Enter Details modal-->
    <div class="modal fade" id="centralModalSm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog w-100 modal-lg" role="document">
            <div class="modal-content modal_content">
                <div class="modal-header cart_heading">
                    <h3 class="modal-title w-100 my-auto" id="myModalLabel">
                        Go Paperless, Enter your Details
                    </h3>
                    <button class="btn btn-danger custom_button cart_close_button text-white" type="button"
                        data-dismiss="modal" aria-label="Close">
                        <span class="float-left">X</span> Close
                    </button>
                </div>
                <div class="modal-body h-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 details-input">
                                <div class="container">
                                    <div class="columns is-multiline" v-for="(poption, index) in payment_options"
                                        :key="index">
                                        <Accordion :title="poption.name" @expand="expandAll">
                                            <form @submit.prevent="saveByCashOrder">
                                                <div v-if="poption.name.toLowerCase() == 'pay by cash'">
                                                    <div class="form-group pr-2 pl-2 pt-3">
                                                        <input type="text" name="billing_fname" id=""
                                                            class="form-control" placeholder="First Name"
                                                            v-model="form.billing_fname" aria-describedby="helpId" />
                                                        <small class="text-danger" v-if="errors.billing_fname">
                                                            {{ errors.billing_fname[0] }}
                                                        </small>
                                                    </div>

                                                    <div class="form-group pr-2 pl-2 pt-3">
                                                        <input type="text" name="" id="" class="form-control"
                                                            placeholder="Last Name" v-model="form.billing_lname"
                                                            aria-describedby="helpId" />
                                                        <small class="text-danger" v-if="errors.billing_lname">
                                                            {{ errors.billing_lname[0] }}
                                                        </small>
                                                    </div>

                                                    <div class="form-group pr-2 pl-2">
                                                        <input type="text" name="" id="" class="form-control"
                                                            placeholder="Phone No" aria-describedby="helpId"
                                                            v-model="form.billing_number" />
                                                        <small class="text-danger" v-if="errors.billing_number">
                                                            {{ errors.billing_number[0] }}
                                                        </small>
                                                    </div>

                                                    <div class="form-group pr-2 pl-2">
                                                        <input type="text" name="" id="" class="form-control"
                                                            placeholder="Email" aria-describedby="helpId"
                                                            v-model="form.billing_email" />
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
                                                        <button type="button"
                                                            class="btn btn-sm custom_button clear-button">
                                                            Clear
                                                        </button>
                                                        <button type="submit" v-if="errors"
                                                            class="btn btn-sm custom_button checkout-button"
                                                            style="padding-top: 7px !important">
                                                            Confirm & Pay
                                                        </button>
                                                        <button type="submit" v-if="!errors"
                                                            class="btn btn-sm custom_button checkout-button" data-dismiss="modal" aria-label="Close"
                                                            style="padding-top: 7px !important">
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
                                                        <button type="button"
                                                            class="btn btn-sm custom_button clear-button">
                                                            Clear
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-sm custom_button checkout-button"
                                                            style="padding-top: 7px !important">
                                                            Confirm & Pay
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </Accordion>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 my-auto enter_detail_total_price"
                                style="text-align: center !important">
                                <h2>Total Price:</h2>
                                <h1>${{ cartsTotal() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enter details Modal -->
</template>
<style scoped>
    .modal-body {
        overflow-y: scroll !important;
    }

</style>
<script>
    import $ from "jquery";
    import Accordion from "../Accordion";
    export default {
        props: {
            cartsTotal: { type: Function },
        },

        components: {
            Accordion,
        },

        data() {
            return {
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
            
            saveByCashOrder() {
                axios
                    .post("/api/save-bycash-order", this.form)
                    .then(() => {
                        // this.$router.push({ name: 'menu'})
                        swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your Order has been submitted',
                            showConfirmButton: true,
                            timer: 2500
                        })
                    })
                    .catch((error) => (this.errors = error.response.data.errors));
            },

            saveByDeliveryOrder() {
                axios.post("/api/save-bydelivery-order", this.form2)
                    .then(() => {
                        swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your Order has been submitted',
                            showConfirmButton: true,
                            timer: 1500
                        })
                    })
                .catch((error) => (this.errors2 = error.response.data.errors));
            },
            paymentOptions() {
                axios
                    .get("/api/checkout/")
                    .then(({
                        data
                    }) => (this.payment_options = data.ogateways))
                    .catch((error) => {});
            },
            accordion() {
                $(document).ready(function () {
                    // Add minus icon for collapse element which is open by default
                    $(".collapse.show").each(function () {
                        $(this)
                            .prev(".card-header")
                            .find(".fa")
                            .addClass("fa-minus")
                            .removeClass("fa-plus");
                    });

                    // Toggle plus minus icon on show hide of collapse element
                    $(".collapse")
                        .on("show.bs.collapse", function () {
                            $(this)
                                .prev(".card-header")
                                .find(".fa")
                                .removeClass("fa-plus")
                                .addClass("fa-minus");
                        })
                        .on("hide.bs.collapse", function () {
                            $(this)
                                .prev(".card-header")
                                .find(".fa")
                                .removeClass("fa-minus")
                                .addClass("fa-plus");
                        });
                });
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
