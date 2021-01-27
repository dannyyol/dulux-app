<template>
    <div>
        
    <div class="column is-half">
        <div class="accordion enter_details_modal" id="accordionExample">
            <div class="card" :class="{ 'not-expanded': !this.expanded }">
                <div class="card-header" id="headingOne" @click="toggleCardState">
                    <h3 class="mb-0">
                        <button type="button" class="btn btn-link button_customize" data-toggle="collapse">
                            <i class="icon fa fa-angle-up"></i>
                            {{ title }}
                        </button>
                    </h3>
                </div>
                <div id="" class="">
                    <div class="card-content card_toggle">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- <div class="container">
        <div id="accordion" class="accordion">
            <div class="card mb-0">
                <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                    <a class="card-title"> Item 1 </a>
                </div>
                <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
                </div>
                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    <a class="card-title"> Item 2 </a>
                </div>
                <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
                </div>
                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    <a class="card-title"> Item 3 </a>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS. </div>
                </div>
            </div>
        </div>
    </div> -->
    </div>













    
</template>

<script>
    export default {
        props: ["title", "expandAll"],
        data() {
            return {
                "expanded": false
            }
        },
        methods: {
            toggleCardState() {
                this.expanded = !this.expanded;
            },
            // closeAll() {
            //     this.expanded = false;
            // }
        },
        created() {
            // EventBus.$on("closeAll", this.closeAll);
        },
    }

</script>


<style lang="scss" scoped>

    .card {
	width: 100%;
}

.card .card-header {
	cursor: pointer;
}

.card .card-header .icon {
	transform: rotate(180deg);
	transition: transform 150ms ease-out;
}

.card .card_toggle {
	transition: all 150ms ease;
}

.card.not-expanded .card-header .icon {
	transform: rotate(0deg);
}

.card.not-expanded .card_toggle {
	transform: scaleY(0);
	transform-origin: top;
	opacity: 0;
	height: 0;
	padding: 0;
}
</style>
