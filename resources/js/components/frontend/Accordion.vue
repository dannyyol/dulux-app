<template>
    <div class="column is-half">



        <div class="accordion enter_details_modal" id="accordionExample">
            <div class="card" :class="{ 'not-expanded': !this.expanded }">
                <div class="card-header" id="headingOne" @click="toggleCardState">
                    <h3 class="mb-0">
                        <button type="button" class="btn btn-link button_customize" data-toggle="collapse">
                            <!-- <span class=""> -->
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










        <!-- <div class="card" :class="{ 'not-expanded': !this.expanded }">

        <header class="card-header" @click="toggleCardState">
          <p class="card-header-title">
            {{ title }}
          </p>
          <a class="card-header-icon">
            <span class="icon">
              <i class="fa fa-angle-up"></i>
            </span>
          </a>
        </header>

        <div class="card-content">
          <div class="content">
            <slot></slot>
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
            closeAll() {
                this.expanded = false;
            }
        },
        created() {
            // EventBus.$on("closeAll", this.closeAll);
        },
    }

</script>


<style lang="scss" scoped>

    .card {
        // margin-bottom: 10px;
        width: 100%;

        .card-header {
            cursor: pointer;

            .icon {
                transform: rotate(180deg);
                transition: transform 150ms ease-out;
            }
        }

        .card_toggle {
            transition: all 150ms ease;
        }
    }

    .card.not-expanded {
        .card-header {
            .icon {
                transform: rotate(0deg);
            }
        }

        .card_toggle {
            transform: scaleY(0);
            transform-origin: top;
            opacity: 0;
            height: 0;
            padding: 0;
        }
    }

</style>
