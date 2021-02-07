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
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Order Summary
                                    </button>
                                    </h5>
                                </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">


                                    <div class="bg-pay">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Products</label>
                                            <!-- <div class="d-flex justify-content-between mt-2"> <span class="fw-500">Dulux PaintAir</span> <span>$186.86</span> </div>
                                            <div class="d-flex justify-content-between mt-2"> <span class="fw-500">Dulux Water-Based Gloss</span> <span>$0.0</span> </div>

                                            <br>
                                            <label for="">Litres</label> -->
                                            <table class="table ">
                                                <thead class="" style="font-weight:500">
                                                    <tr class="">
                                                        <td style="width:40%">Name</td>
                                                        <td style="width:25%">Litres</td>
                                                        <td style="width:100%">Quantity</td>
                                                        <td style="width:100%">Price</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Dulux Water-Based Gloss</td>
                                                        <td class="fw-500">1 Litres</td>
                                                        <td>3</td>
                                                        <td>$30</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Dulux PaintAir</td>
                                                        <td class="fw-500">3 Litres</td>
                                                        <td>3</td>
                                                        <td>$20</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <hr>

                                            <label for="">Addons</label>
                                            <table class="table ">
                                                <thead class="" style="font-weight:500">
                                                    <tr class="">
                                                        <td style="width:50%">Name</td>
                                                        <td style="width:100%">Quantity</td>
                                                        <td style="width:100%">Price</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-500">Brush</td>
                                                        <td>3</td>
                                                        <td>$30</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="fw-500">Rollers</td>
                                                        <td>3</td>
                                                        <td>$20</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <div class="d-flex justify-content-between mt-2"> <span class="fw-500">Total </span> <span class="text-success">$85.00</span> </div>
                                        </div>

            
                                </div>     

                                </div>
                            </div>
                            </div>
                            <div class="card"  v-for="(poption, index) in payment_options" :key="index">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" :data-target="'#collapseOne'+poption.id" aria-expanded="false" aria-controls="collapseTwo">
                                        {{ poption.name }}
                                    </button>
                                    </h5>
                                </div>
                                <div :id="'collapseOne'+poption.id" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">

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
                            <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Pay By Card
                                </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
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
                <h1>${{ cartTotal }}</h1>
            </div>
        </div>
    </div>
</div>
    
</template>

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


.table td, .table th {
    border-top: none;
    padding: 0rem;
    vertical-align: top;
	 line-height: 23px;

    /* font-weight: 500; */
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
.enter_detail_total_price{
    /* background-color: red;
    height: 100%; */
}
 .accordion-container .card .card-header .btn-link, .enter_detail_total_price h2 {
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
	 border: 1px solid #fff f;
	 border-radius: 50%;
}
 .accordion-container .card .card-header button.btn.collapsed:after {
	 background-color:rgba(0,0,0,.03) !important;
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
	 background-color: rgba(0,0,0,.03);;
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