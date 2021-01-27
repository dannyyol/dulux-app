<template>
<div>
  <!-- <div class="container"> -->
 <div class=" container-fluid filter-modal-container">


<!-- ==================================================== -->

<div class="modal full fade animate__animated animate__bounceInUp" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content filter-modal-content">
      <div class="modal-header filter-modal-header">
        <h2 align="center"> Filter </h2>
        <button type="button" class="close filter-modal-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  p-0">

        <!-- <div class="container"> -->
    <div id="accordion" class="accordion filter-accordion-sm" v-for="(category, index) in categories" :key='index'>
        <div class="card filter-card-sm mb-0" style=" border-right-width:0px !important;border-left-width:0px !important;">
            <div class="card-header collapsed" data-toggle="collapse" :href="'#collapseOne'+category.id">
                <a class="card-title"> {{ category.name }} </a>
            </div>
            <div :id="'collapseOne'+category.id" class="card-body collapse" data-parent="#accordion">
              <form>
                <div v-for="(sub, index) in category.subcategory" :key="index">
                <p>
                  <input
                    type="radio"
                    :id="'radio_form_'+sub.id"
                    name="q"
                    :value="sub.name"
                    @click="filterProduct(category.id, $event)"
                    :data-dismiss="'modal'"
                  />
                  <label :for="'radio_form_'+sub.id"
                    >{{ sub.name }}</label
                  >
                </p>
                </div>
              </form>


            </div>
            <!-- <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                <a class="card-title"> Item 2 </a>
            </div> -->
            <!-- <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
            </div>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                <a class="card-title"> Item 3 </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
                <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS. </div>
            </div> -->
        </div>
    </div>
</div>
       
       
      </div>
      <div class="modal-footer modal-footer-fixed d-none">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>

</template>


<script>
import $ from "jquery";

export default {
  props:{
    categories:{
      type:Array
    },
    filterProduct:{
      type:Function
    }
  } 
}
</script>

<style scoped>

.filter-card-sm .card-body{
background: #e1e1e123;
}
.card-header.collapsed {
  border-bottom-color: #EDEFF0;
  background: transparent;

}
.card-header:not(.collapsed) {
    background-color:#e1e1e123;
}
.accordion .card-header{
    font-weight: 600;
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


.filter-modal-content .modal-header{
  background-color: #2fc48d;
}

.filter-modal-header h2{
  /* text-align:center !important; */
  margin-top:auto;
  margin-bottom:auto;
  /* font-size:px; */
  color:#fff;

}
.filter-modal-button{
  font-size:45px;
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

a.has-sub:after { font-family: "FontAwesome"; }
a.has-sub:after { content: "\f107"; margin-left: 1rem; }
a.has-sub[aria-expanded="true"]:after { content: "\f106"; }


</style>