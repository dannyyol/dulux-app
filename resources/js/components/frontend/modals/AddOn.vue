<template>
    <!-- Add on Modal -->
    <!-- Modal -->
    <div class="modal animate__animated animate__fadeInBottomRight fade" id="add-on-modal" tabindex="-1" role="dialog"
        aria-labelledby="add-on-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"><b>{{ product_name.title }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="addAddOn(product_name.id)" method="post">

                    <div class="modal-body">
                        <div v-if="productAddons">
                            <div v-for="(addon, index) in productAddons" :key="index">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <div>
                                                    <input class="form-check-input" type="checkbox"
                                                        :true-value="addon.name" :false-value="0"
                                                        :id="'defaultCheck1'+index"
                                                        v-model="form.productAddons[0]['name'][index]">
                                                    <label class="form-check-label" :for="'defaultCheck1'+index"
                                                        style="font-size:14px;font-weight:500">
                                                        {{ addon.name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <table>
                                                <tr>
                                                    <table>
                                                        <td>
                                                            <button class="mr-1 btn btn-lg btn-danger btn_"
                                                                style="width:35px; height:35px;">-</button>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" id="" class="form-control mr-1"
                                                                style="width:35px; height:35px;padding:0px !important"
                                                                v-model="form.productAddons[0]['qty'][index]">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                style="width:35px; height:35px;">+</button>
                                                        </td>
                                                    </table>
                                                </tr>
                                            </table>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-goup">
                                                <input class="form-control price_input"
                                                    style="background-color:#fff !important;font-size:14px !important;"
                                                    type="text" name="" :value="'$'+addon.price" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div v-else>
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;margin:auto">
                                    <h4 class="">
                                        No Addon Available for this Product
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-lg btn_save">Save changes</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <!-- edn add on modal -->
</template>

<script>
    export default {
        props:{
            product_id
        },
        data() {
            return {
                form: {
                    productAddons: [{
                        "name": [],
                        "qty": [],
                        // "price": []
                    }]
                },
                productAddons: '{}',
                product_name:[],
            }
        },

        methods: {
            addAddOn(id) {
                axios.post("/api/addon/" + id, this.form)
                    .then((response) => {})
                    .catch((error) => {});
                this.message = this.message.split("").reverse().join("");
                this.startTimer()
            },


            showProductName(id) {
                axios.get("/api/product/" + id)
                    .then(({
                        data
                    }) => (this.product_name = data))
                    .catch((error) => {});
            },
            showAddOn(id) {
                axios.get("/api/product/" + id)
                    .then(({
                        data
                    }) => (this.productAddons = JSON.parse(data.addons)))
                    .catch((error) => {});
                this.showProductName(id)
            },

        },
    }

</script>
