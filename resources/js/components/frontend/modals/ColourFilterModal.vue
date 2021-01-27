<template>
    <!-- <div class="container"> -->
    <div class=" container-fd">

        <div id="filter-wrapper-clp"
            class=" animate__animated animate__bounceInUp filter-wrapper filter-wrapper-clp filter-wrapper-fullwidth active focus-outline"  :style="{display: modalClose ? 'none' : false}">
            <div class="title-section" style="margin-top:-10vh">
                <h2 class="text-center">Filters</h2>
                <!-- <svg > -->

                <svg class="icon icon-close right" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50"
                    height="50" viewBox="0 0 172 172" style=" fill:#000000;" @click="closeModal()">
                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                        stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                        font-family="none" font-weight="none" font-size="none" text-anchor="none"
                        style="mix-blend-mode: normal">
                        <path d="M0,172v-172h172v172z" fill="none"></path>
                        <g fill="#ffffff">
                            <path
                                d="M26.5525,21.6075l-4.945,4.945l59.4475,59.4475l-59.4475,59.4475l4.945,4.945l59.4475,-59.4475l59.4475,59.4475l4.945,-4.945l-59.4475,-59.4475l59.4475,-59.4475l-4.945,-4.945l-59.4475,59.4475z">
                            </path>
                        </g>
                    </g>
                </svg>


                <!-- </svg> -->


            </div>
            <!-- LOcation -->
            <div id="accordion" class="accordion" v-for="(filterItem, index) in filterItems" :key="index">
                <div class="card mb-0" >
                    <div class="card-header collapsed" data-toggle="collapse" :href="'#collapseOne'+index">
                        <a class="card-title"> {{ filterItem.name.toLowerCase() == "Product Type".toLowerCase() ? "Location" : filterItem.name }}</a>
                    </div>
                    <div :id="'collapseOne'+index" class="card-body collapse" data-parent="#accordion">
                      <form action="#" class="filter-form">
                          <p>
                            <input
                              type="radio"
                              :id="filterItem.id"
                              name="q"
                              value="All"
                              @click="filterProductColour(filterItem.id, $event)"
                            />
                            <label :for="filterItem.id"
                              >All</label
                            >
                          </p>
                          <div v-for="(sub, index) in filterItem.items" :key="index">
                          <p>
                            <input
                              type="radio"
                              :id="sub.id"
                              name="q"
                              :value="sub.id"
                                @click="filterProductColour(filterItem.id, $event)"
                            />
                            <label :for="sub.id"
                              >{{ sub.name }}</label
                            >
                          </p>
                          </div>
                        </form>

                    </div>
                </div>
            </div>
  
        </div>

    </div>

</template>


<script>
    import $ from "jquery";

    export default {
        props: {
            categories: {
                type: Array
            },
            filterProduct: {
                type: Function
            },
            filterItems:{
                type: Array
            },

            filterProductColour:{
                type: Function
            },

            modalClose:{
              type: Boolean
            }

        },
        data(){
          return{
            // modalClose:null
          }
        },
        methods: {
          closeModal(){
          this.modalClose = !this.modalClose
          },
        },
        
        mounted(){
    // this.$root.$on('send', (text) => {
    // 	this.modalClose = text;
    // })
        }
    }

</script>

<style scoped>
    .filter-card-sm .card-body {
        background: #e1e1e123;
    }

    .card-header.collapsed {
        border-bottom-color: #EDEFF0;
        background: transparent;

    }

    .card-header:not(.collapsed) {
        background-color: #e1e1e123;
    }

    .accordion .card-header {
        font-weight: 600;
        font-size: 16px;
        display: block;
        cursor: pointer;
        padding: 15px 20px;
    }

    .accordion .card-header:after {
        font-family: 'FontAwesome';
        content: "\f106";
        float: right;
    }

    .accordion .card-header.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f107";
    }


    .filter-modal-content .modal-header {
        background-color: #2fc48d;
    }

    .filter-modal-header h2 {
        /* text-align:center !important; */
        margin-top: auto;
        margin-bottom: auto;
        /* font-size:px; */
        color: #fff;

    }

    .filter-modal-button {
        font-size: 45px;
    }



    /* Full Screen */

    .modal.full .modal-dialog {
        position: fixed;
        margin: auto;
        width: 100%;
        max-width: 100%;
        height: 100%;
        z-index: 1999;
    }

    .modal.full .modal-content {
        height: 100%;
        overflow-y: auto;
    }

    .modal.full .close-modal {
        position: fixed;
        top: 0;
        right: 3rem;
    }

    /* Footer */


    /* Full screen modal menu indicators */

    a.has-sub:after {
        font-family: "FontAwesome";
    }

    a.has-sub:after {
        content: "\f107";
        margin-left: 1rem;
    }

    a.has-sub[aria-expanded="true"]:after {
        content: "\f106";
    }

</style>
