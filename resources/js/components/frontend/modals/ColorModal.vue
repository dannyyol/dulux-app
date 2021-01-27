<template>
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade animate__animated animate__fadeInBottomLeft" :id="'colorModal'+ccolor.id" tabindex="-1" role="dialog" aria-labelledby="colorModalTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"  :style="{'background-color': ccolor.colour_code}">
      <div class="modal-body">
        <div class="" style="margin-bottom:50px !important;">
            <p class="float-left">{{ ccolor.colour_name }}</p>
            <p class="float-right" data-dismiss="modal">
                <img src="https://img.icons8.com/ios/24/000000/delete-sign--v1.png"/>
            </p>
        </div>
        <div class="" style="float: right !important;">
            <small class="d-flex justify-content-end">
                <!-- <a href="#" class="pb-2 more_about_this_color" style="">More about this colour</a> -->
            </small>
            <router-link :to="{name: 'menu', params: {cId:ccategory.id, id: ccolor.id}}" class="btn btn-light" style="font-size:14px !important;" data-dismiss="modal">I'd like to find a product in this colour</router-link>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
    props:{
        ccolor:{
            type:Object
        },

        ccategory:{
            type:Object
        },
        cpalette:{
            type:Object
        },


    },
    data(){
        return{

        }
    },
    methods:{
        
    }
}
</script>