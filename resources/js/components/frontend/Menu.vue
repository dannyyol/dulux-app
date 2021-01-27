<template>
  <div
    class="page-products-listing page-products-listing-all plp-color-selected flSearchClick-processed"
  >
    <div id="overlay"></div>
    <div id="zone-content" class="zone-content focus-outline" v-if="!loading">
      <div class="main-container container focus-outline">
        <!-- /#page-header -->
        <div class="row focus-outline">
          <section class="col-sm-12 focus-outline">
            <!--   -->
            <a id="main-content"></a>
            <div class="region region-content focus-outline">
              <div id="full-form-wrapper" class="focus-outline">
                <section
                  id="block-system-main"
                  class="block block-system block--system-main clearfix focus-outline"
                  role="navigation"
                >

                
                  <form
                    class="form-counter focus-outline"
                    action="https://www.dulux.com.sg/en/products/all?id=2239&amp;color-name=Crisp%20Linen%2061yy%2089/040&amp;color-rgb=F4F0E4&amp;fl-stickey=1&amp;color-id=1190594&amp;cccid="
                    method="post"
                    id="flourish-product-listing-filters-solr-form"
                    accept-charset="UTF-8"
                  >
                    <div class="focus-outline">
                      <button
                        style="display: none"
                        id="edit-filters-reset-link"
                        name="filters_reset_link"
                        value="Reset Filters"
                        type="button"
                        class="btn btn-default form-submit ajax-processed"
                        tabindex="22"
                      >
                        Reset Filters
                      </button>
                      <button
                        style="display: none"
                        id="edit-product-type-filters-reset-link"
                        name="product_type_filters_reset_link"
                        value="Reset Product Type Filters"
                        type="button"
                        class="btn btn-default form-submit ajax-processed"
                        tabindex="23"
                      >
                        Reset Product Type Filters
                      </button>
                      <button
                        style="display: none"
                        id="edit-room-type-filters-reset-link"
                        name="room_type_filters_reset_link"
                        value="Reset Room Type Filters"
                        type="button"
                        class="btn btn-default form-submit ajax-processed"
                        tabindex="24"
                      >
                        Reset Room Type Filters
                      </button>
                      <button
                        style="display: none"
                        id="edit-surface-usage-filters-reset-link"
                        name="surface_usage_filters_reset_link"
                        value="Reset Surface Usage Filters"
                        type="button"
                        class="btn btn-default form-submit ajax-processed"
                        tabindex="25"
                      >
                        Reset Surface Usage Filters
                      </button>
                      <button
                        style="display: none"
                        id="edit-finish-filters-reset-link"
                        name="finish_filters_reset_link"
                        value="Reset Finish Filters"
                        type="button"
                        class="btn btn-default form-submit ajax-processed"
                        tabindex="26"
                      >
                        Reset Finish Filters
                      </button>

                      <div
                        id="product-listing-filters-wrapper"
                        class="focus-outline"
                      >

                        <div class="row plp-color-bar-show" v-if="hideColourbar">
                          <div class="col-sm-12" v-if="(Object.keys(productSingle).length != 0)">
                            <div class="clearfix">
                              <a
                                class="swatch-close vr-margin-top-4 right close-color"
                                @click="closeColourBar()"
                              >
                                <img src="https://img.icons8.com/ios/24/000000/delete-sign--v1.png"/>
                              </a>
                            </div>
                            <div
                              id="swatch-bar"
                              class="swatch-bar squircle vr-margin-top-1 "
                              data-rgb="F4F0E4"
                              :style="{'background-color':Object.keys(productSingle).length != 0 ? productSingle.product_colour.colour_code : null}"
                              style="color: rgb(102, 102, 102);"
                            >
                              <p class="h4 plp-color-name" style="text-shadow: -1px 1px 0 #fff,">
                                {{ Object.keys(productSingle).length != 0 ? productSingle.product_colour.colour_name : null }}
                              </p>
                              
                              <router-link
                                class="inline-text-link pick-a-colour change-color color-text"
                                to="/color"
                                style="
                                  color: rgb(102, 102, 102);
                                  stroke: rgb(102, 102, 102);
                                "
                              >
                                Change this colour
                                
                                  <img src="https://img.icons8.com/ios/30/000000/right--v1.png"/>                                
                                <!-- <i class="fa fa-arrow-right" aria-hidden="true" style="font-weight:200 !important"></i> -->
                              </router-link>
                            </div>
                          </div>
                        </div>
                        <br>

                        <div
                          class="product-listing-filters fl-equi-height-container vr-margin-top-7 focus-outline"
                        >
                          <div class="row focus-outline">
                            <div class="col-md-3 col-lg-2">
                              <div
                                id="filter-wrapper-plp"
                                class="filter-wrapper filter-wrapper-plp"
                              >
                                <div class="title-section hidden-sm-up">
                                  <h2 class="text-center">Filters</h2>
                                </div>
                                <div class="title-section hidden-sm-down">
                                  <h2 class="h5" style="">Filters</h2>
                                  <a
                                    href="javascript:void(0)"
                                    class="filter-reset inline-text-link primary btn-clear"
                                    tabindex="29"
                                    style="display: none"
                                    >Clear all</a
                                  >
                                </div>
                                <div class="clp-wrap collapse-wrap general">
                                  <div>
                    
                                     

      




                                    <div class="sidebar_accordion">
                                        <div id="accordion" class="accordion"  v-for="(category, index) in categories" :key="index" style="">
                                            <div class="card mb-0 mr-0">
                                        
                                                <div class="card-header text-dark collapsed bg-white" data-toggle="collapse" :href="'#sidebar_collapse'+index">
                                                    <a class="card-title">
                                                        <b>{{ category.name }}</b>
                                                    </a>
                                                </div>
                                                <div :id="'sidebar_collapse'+index" class="card-body collapse show" data-parent="#accordion" style="background-color: rgba(148, 144, 144, 0.048);">


                                                    <form>
                                                      <p>
                                                        <input
                                                          type="radio"
                                                          :id="category.id"
                                                          name="q"
                                                          value="All"
                                                          @click="filterProduct(category.id, $event)"
                                                        />
                                                        <label :for="category.id" style="font-weight:400 !important;">All</label
                                                        >
                                                      </p>

                                                      <div v-for="(sub, index) in category.subcategory" :key="index">
                                                      <p>
                                                        <input
                                                          type="radio"
                                                          :id="sub.id"
                                                          name="q"
                                                          :value="sub.id"
                                                           @click="filterProduct(category.id, $event)"
                                                        />
                                                        <label :for="sub.id"  style="font-weight:400 !important;"
                                                          >{{ sub.name }}</label
                                                        >
                                                      </p>
                                                      </div>
                                                    </form>
                                                </div>
                                                <!-- <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                    <a class="card-title">
                                                      Item 2
                                                    </a>
                                                </div>
                                                <div id="collapseTwo" class="card-body collapse" data-parent="#accordion" >
                                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                        craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </p>
                                                </div>
                                                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                    <a class="card-title">
                                                      Item 3
                                                    </a>
                                                </div>
                                                <div id="collapseThree" class="collapse" data-parent="#accordion" >
                                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                                        aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>


                                <!-- collapse-wrap -->
                              </div>
                              <div class="results-bar">
                                <a
                                  href="javascript:void(0)"
                                  class="filter-reset filter-reset inline-text-link primary btn-clear"
                                  tabindex="73"
                                  style="display: none"
                                  >Clear all</a
                                >
                                <button
                                  id="filter_results_btn"
                                  class="bttn primary bttn-auto-width pull-right"
                                  tabindex="74"
                                >
                                  Show <span>10</span> results
                                </button>
                              </div>
                            </div>
                            <div
                              class="product-listing-markup-wrapper col-md-9 col-lg-10 view-content focus-outline"
                              @wheel.prevent="wheel($event)"
                            >
                              <div
                                class="col-sm-12 focus-outline" v-if="!loadFilterProduct" style="display: unset"
                                
                              >
                                <div style="" @click="hideCounter()">
                                  <button type="button"
                                    class="btn cart__btn float-right border-1"
                                    data-toggle="modal"
                                    data-target="#centralModalSm2"
                                    data-backdrop="static" 
                                    data-keyboard="false"
                                    ><i
                                      class="fa fa-shopping-cart"
                                      aria-hidden="true"
                                      style="font-size: 21px !important"
                                    ></i>
                                    Cart
                                    <span
                                      class="cart_count"
                                      style="
                                        background-color: #2fc48d;
                                        padding-top: 2px;
                                        position: absolute;
                                        top: -8px !important;
                                        right:-10px;
                                        width: 25px;
                                        height: 25px;
                                        border-radius: 12.5px;
                                        color: #fff;
                                      "
                                      >{{ cartQty() }}</span
                                    >
                                  </button>
                                  <h1
                                    class="h2 vr-margin-bottom-0 focus-outline"
                                  >
                                    Find the products for your project
                                  </h1>
                                </div>

                                <div
                                  class="product-listing-information focus-outline"
                                >
                                  <div
                                    class="product-amount vr-padding-vertical-4 focus-outline"
                                  >
                                    <span>{{ products.length }} </span> Products found
                                  </div>
                                  <section class="filtering">
                                    <FilterModal :categories="categories" :filterProduct="filterProduct"/>

                                    <div class="filter-zone">
                                        <div
                                          class="icon-plus-text ipt-icon-settings right"
                                          style=""
                                          data-toggle="modal" data-target="#myModal" data-backdrop="false"
                                        >
                                                                              <!-- <router-link to="/filter"> -->
                                          Filters
                                          <i class="fa fa-sliders" aria-hidden="true">
                                            <use
                                              xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/svgsprite/sprite.svg#icon-settings"
                                            ></use>
                                          </i>
                                                                                <!-- </router-link> -->

                                        </div>
                                      <span class="count-label totalInputCount"
                                        >0</span
                                      >
                                      <div class="clearfix"></div>
                                    </div>
                                  </section>
                                </div>
                                <div
                                  class="filter-section bar-desktop vr-padding-vertical-4"
                                >
                                  <div class="bar-title">My filters</div>
                                  <div
                                    id="filter-selections"
                                    class="filter-labels"
                                  ></div>
                                  <a
                                    href="javascript:void(0)"
                                    class="filter-reset inline-text-link primary btn-clear"
                                    tabindex="75"
                                    style="display: none"
                                    >Clear all</a
                                  >
                                </div>

                                <div class="onedomain-component">
                                  <div class="row">
                                    <div
                                      class="view view-product-listing-solr view-id-product_listing_solr view-display-id-page_6 view-product-Listing view-dom-id-dbee5394231560ecc1c715efb72377e4"
                                    >
                                      <div class="view-header">
                                        <p class="h1 fl-prod-page-header">
                                          10 Products found
                                        </p>
                                      </div>

                                      <div class="view-content">
                                        <div class="row vr-margin-top-7">
                                          <div
                                            class="col-xs-12 col-md-4 col-lg-3"
                                            v-for="(
                                              product, index
                                            ) in local_products"
                                            :key="index"
                                          >
                                            <div class="product-card-container is-table-row " :class="local_products.length == 1 ? 'single_product_width' : ''">
                                              <section
                                                class="product-card js-product-card"
                                              >
                                                <div
                                                  class="product-card__underlay"
                                                ></div>

                                                <span
                                                  id="75731"
                                                  class="scrap-book-add-product focus-outline product-card__button js-notify icon-heart js-toggle-class"
                                                  data-type="product"
                                                  data-categorytype="Paint"
                                                  data-globalid="4e35006f-b542-4ceb-8815-a40a00fa4db1"
                                                  data-colorid=""
                                                  data-colorcollection=""
                                                  data-colorname=""
                                                  data-tc-class="active"
                                                >
                                                  <span
                                                    class="icon-heart-empty"
                                                  >
                                                  </span>
                                                  <span
                                                    class="icon-heart-filled"
                                                  >
                                                    ></span
                                                  >
                                                </span>
                                                <a
                                                  class="product-card__link"
                                                  title="product.title"
                                                  tabindex="76"
                                                >
                                                  <article
                                                    class="product-card__content" style=""
                                                  >
                                                    <p
                                                      class="product-card__title js-product-card-title"
                                                    >
                                                      {{ product.product_name | str_limit(22) }}
                                                    </p>
                                                    <div
                                                      class="product-card__image-wrapper"
                                                    >
                                                      <div
                                                        class="product-card__image"
                                                      >
                                                        <img
                                                          :src="
                                                            '/assets/front/img/product/featured/' +
                                                            product.product_image
                                                          "
                                                          alt=""
                                                          srcset=""
                                                        />
                                                      </div>
                                                    </div>
                                                    <ul
                                                      class="icon-list product-card__features focus-outline"
                                                    >
                                                      <li class="focus-outline" v-for="(summary, index) in product.product_summary" :key="index">
                                                        <span>
                                                          <img
                                                            src="/images/check-mark.png"
                                                            alt=""
                                                            srcset=""
                                                            width="15"
                                                          />
                                                        </span>
                                                        <span
                                                          class="focus-outline"
                                                        >
                                                          {{ summary  }}
                                                        </span>
                                                      </li>
                                                    </ul>
                                                  </article>
                                                </a>
                                                <div
                                                  class="container product-card-bottom product_btms_lg_row"
                                                  style=""
                                                >
                                                  <div class="row mb-2">
                                                    <div class="col-sm-6 mb-2">
                                                      <div class="">
                                                        <table>
                                                          <tr>
                                                            <td>
                                                              <button
                                                              type="button"
                                                                class="mr-1 btn btn-lg btn-danger"
                                                                style="
                                                                  width: 30px;
                                                                  height: 30px;
                                                                  margin:auto;
                                                                  text-align:center;
                                                                "
                                                                @click.prevent="
                                                                  decrementProductQty(product.product_id, index)
                                                                "
                                                              >
                                                                -
                                                              </button>
                                                            </td>
                                                            <td class="">
                                                              <input
                                                                type="text"
                                                                name=""
                                                                id=""
                                                                class="form-control mr-1"
                                                                v-model="
                                                                  product.product_qty
                                                                "
                                                                style="
                                                                  width: 35px;
                                                                  height: 30px;
                                                                  padding: 0px !important;
                                                                  text-align: center;
                                                                "
                                                              />
                                                            </td>
                                                            <td>
                                                              <button
                                                              type="button"
                                                                class="btn btn-danger"
                                                                style="
                                                                  width: 30px;
                                                                  height: 30px;
                                                                "
                                                                @click="incrementProductQty(product.product_id, index)"
                                                              >
                                                                +
                                                              </button>
                                                              <input type="hidden" name="" v-model="product.product_name">
                                                              <input type="hidden" name="" v-model="product.product_id">

                                                            </td>
                                                          </tr>
                                                        </table>
                                                      </div>
                                                    </div>

                                                    <div
                                                      class="col-sm-6 d-flex justify-content-end"
                                                    >
                                                      <div class="form-group menu_page_price mb-n4">
                                                        <div class="input-group">
                                                          <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1" style="font-size:14px;border-radius:5px 0px 0px 5px;">$</span>
                                                          </div>
                                                          <input
                                                            class="form-control"
                                                            type="text"
                                                            name=""
                                                            v-model="form3.product.price[index]"
                                                            disabled
                                                            style="border-radius:0px 5px 5px 0px;"
                                                        /> 
                                                      </div>

                                                        
                                                      </div>
                                                    </div>
                                                    <!-- <form > -->

                                                      <div class="col-sm-6">
                                                        <div class="">
                                                          <table>
                                                            <tr>
                                                              <td>
                                                                <button type="button" @click="decrementVarianceQty(index)"
                                                                  class="mr-1 btn btn-lg btn-danger btn_qty_increment"
                                                                  style="
                                                                    width: 30px;
                                                                    height: 30px;
                                                                  "
                                                                >
                                                                  -
                                                                </button>
                                                              </td>
                                                              <td>
                                                                <input
                                                                  type="text"
                                                                  name=""
                                                                  id=""
                                                                  class="form-control mr-1"
                                                                  style="
                                                                    width: 35px;
                                                                    height: 30px;
                                                                    padding: 0px !important;
                                                                    text-align: center;
                                                                  "
                                                                  v-model="
                                                                    product.variation_qty
                                                                  "
                                                                />
                                                              </td>
                                                              <td>
                                                                <button
                                                                  type="button"
                                                                  class="btn btn-danger"
                                                                  style="
                                                                    width: 30px;
                                                                    height: 30px;
                                                                  "
                                                                  @click="
                                                                    incrementVarianceQty(
                                                                      index
                                                                    )
                                                                  "
                                                                >
                                                                  +
                                                                </button>
                                                              </td>
                                                            </tr>
                                                          </table>
                                                          <input
                                                                  type="hidden"
                                                                  name=""
                                                                  id=""
                                                                  class="form-control mr-1"
                                                                  style="
                                                                    width: 35px;
                                                                    height: 30px;
                                                                    padding: 0px !important;
                                                                    text-align: center;
                                                                  "
                                                                  v-model="
                                                                    product.product_price
                                                                  "
                                                                />
                                                        </div>
                                                      </div>
                                                    <!-- </form> -->
                                                    <div
                                                      class="col-sm-6 d-flex justify-content-end"
                                                    >
                                                        <div class="form-goup" @click = "toggleDrop(index, product.product_id)">
                                                          <!-- <select  v-if="!toggleDropdown" class="form-control litre_dropdown p-0" style="" @change="addVariation(product.product_id, index)">
                                                              
                                                          </select> -->

                                                          <select class="form-control litre_dropdown p-0" style="" @change="addVariation(product.product_id, index, $event)" 
                                                              >
                                                              <option selected>
                                                                Litres
                                                              </option>
                                                            <option v-for="(variation, index) in JSON.parse(product.product_variation)" :key="index" >
                                                              {{ variation.name }}
                                                            </option>
                                                          </select>

                                                        </div>

                                                    </div>
                                                  </div>

                                                  <div class="col-sm-12">
                                                    <a
                                                      @click="
                                                        showAddOn(
                                                          product.product_id,
                                                          product
                                                        )
                                                      "
                                                      href=""
                                                      class="btn mb-2 btn-lg btn-add-cart btn btn-success add_to_cart_button"
                                                      data-toggle="modal"
                                                      data-target="#add-on-modal"
                                                      >Add On
                                                    </a>
                                                  </div>

                                                  <div class="col-sm-12 ">
                                                    <a
                                                      href=""
                                                      class="btn btn-success mb-2 btn-add-cart btn-lg add_to_cart_button"
                                                      data-toggle="modal"
                                                      data-target="#centralModalSm"
                                                      @click="showProductDesc(product)"
                                                      >More info
                                                    </a>
                                                  </div>

                                                  <div class="col-sm-12">
                                                    <a
                                                      class="btn-add-cart btn btn-success btn-lg add_to_cart_button"
                                                      data-toggle="modal"
                                                      :disabled = "disableAddToCart"
                                                    >
                                                      <span
                                                        class="d-block"
                                                        @click.prevent="
                                                          addToCart(
                                                            product,
                                                            product.product_id,
                                                            index,
                                                            $event
                                                          )
                                                        "
                                                        >Add to Cart</span
                                                      >
                                                    </a>
                                                    <div
                                                      class="buybox"
                                                      v-if="currentProduct"
                                                      :style="
                                                        bgcss(
                                                          currentProduct.product_image
                                                        )
                                                      "
                                                    > </div>
                                                    <!-- {{ currentProduct }} -->
                                                  </div>
                                                </div>


                                                <div class="product_btms_sm_row">
                                                  <div class="row">
                                                    <div class="col-sm-6">
                                                      
                                                    </div>
                                                    <div class="col-sm-6 mb-2 d-flex justify-content-end">
                                                      <table>
                                                          <tr>
                                                            <td>
                                                              <button
                                                              type="button"
                                                                class="mr-1 btn btn-lg btn-danger"
                                                                style="width: 30px;
                                                                  height: 30px;"
                                                                @click.prevent="decrementProductQty(product.product_id, index)">
                                                                -
                                                              </button>
                                                            </td>
                                                            <td class="">
                                                              <input
                                                                type="text"
                                                                name=""
                                                                id=""
                                                                class="form-control mr-1"
                                                                v-model="product.product_qty"
                                                                style="width: 35px;
                                                                  height: 30px;
                                                                  padding: 0px !important;
                                                                  text-align: center;" />
                                                            </td>
                                                            <td>
                                                              <button
                                                              type="button"
                                                                class="btn btn-danger mr-2"
                                                                style="
                                                                  width: 30px;
                                                                  height: 30px;
                                                                "
                                                                @click="incrementProductQty(product.product_id, index)"
                                                              >
                                                                +
                                                              </button>
                                                              <input type="hidden" name="" v-model="product.product_name">
                                                              <input type="hidden" name="" v-model="product.product_id">

                                                            </td>
                                                            <td>
                                                              <div class="input-group">
                                                                  <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1" style="font-size:14px;border-radius:5px 0px 0px 5px;">$</span>
                                                                  </div>
                                                                  <input
                                                                    class="form-control"
                                                                    type="text"
                                                                    name=""
                                                                    v-model="form3.product.price[index]"
                                                                    style="width:76px;border-radius:0px 5px 5px 0px;"
                                                                /> 
                                                              </div>
                                                            </td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-sm-6">
                                                    </div>
                                                    <div class="col-sm-6 d-flex justify-content-end">
                                                      
                                                      <table>
                                                            <tr>
                                                              <td>
                                                                <button type="button" @click="decrementVarianceQty(index)"
                                                                  class="mr-1 btn btn-lg btn-danger btn_qty_increment"
                                                                  style="
                                                                    width: 30px;
                                                                    height: 30px;
                                                                  "
                                                                >
                                                                  -
                                                                </button>
                                                              </td>
                                                              <td>
                                                                <input
                                                                  type="text"
                                                                  name=""
                                                                  id=""
                                                                  class="form-control mr-1"
                                                                  style="
                                                                    width: 35px;
                                                                    height: 30px;
                                                                    padding: 0px !important;
                                                                    text-align: center;
                                                                  "
                                                                  v-model="
                                                                    product.variation_qty
                                                                  "
                                                                />
                                                              </td>
                                                              <td>
                                                                <button
                                                                  type="button"
                                                                  class="btn btn-danger"
                                                                  style="
                                                                    width: 30px;
                                                                    height: 30px;
                                                                  "
                                                                  @click="
                                                                    incrementVarianceQty(
                                                                      index
                                                                    )
                                                                  "
                                                                >
                                                                  +
                                                                </button>
                                                              </td>
                                                            </tr>
                                                          </table>
                                                          <input
                                                            type="hidden"
                                                                  name=""
                                                                  id=""
                                                                  class="form-control mr-1"
                                                                  style="
                                                                    width: 35px;
                                                                    height: 30px;
                                                                    padding: 0px !important;
                                                                    text-align: center;
                                                                  "
                                                                  v-model="
                                                                    product.product_price
                                                                  "
                                                                />
                                                          <td>
                                                              <div class="form-goup" @click = "toggleDrop(index, product.product_id)">
                                                                <select class="ml-2 form-control litre_dropdown p-0" style="width:100px;border-radius: 5px !important;" @change="addVariation(product.product_id, index, $event)">
                                                                  <option selected>
                                                                    Litres
                                                                  </option>
                                                                  <option v-for="(variation, index) in JSON.parse(product.product_variation)" :key="index" >
                                                                    {{ variation.name }}
                                                                  </option>
                                                                </select>
                                                              </div>
                                                          </td>
                                                    </div>
                                                    <div class="col-sm-12  d-flex justify-content-center mt-4">
                                                        <table>
                                                          <tr>
                                                            <td class="pr-2">
                                                              <a class="btn btn-success btn-add-cart" data-toggle="modal" @click="
                                                          showAddOn(
                                                            product.product_id,
                                                            product
                                                          )
                                                        "
                                                        data-target="#add-on-modal">Add On</a>
                                                            </td>
                                                            <td class="pr-2">
                                                              <a class="btn btn-success btn-add-cart" data-toggle="modal" data-target="#centralModalSm" @click="showProductDesc(product)">More Info</a>
                                                            </td>
                                                            <td>
                                                              <a class="btn btn-success btn-add-cart" data-toggle="modal" data-target="#centralModalSm2"  @click.prevent="addToCart(product, product.product_id, index, $event)">Add To Cart</a>
                                                            </td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                    <!-- <div class="col-sm-2 ">
                                                      <button class="btn btn-success">Add On</button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                      <button class="btn btn-success">More Info</button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                      <button class="btn btn-success">Add To Cart</button>
                                                    </div> -->
                                                  </div>


                                                </div>
                                              </section>
                                              
                                              <!-- cart modal -->
                                              <div class="modal animate__animated animate__fadeInBottomRight modal fade" id="centralModalSm2" tabindex="-1"
                                                  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog w-100 modal-lg" role="document">
                                                      <div class="modal-content modal_content">
                                                          <div class="modal-header border-1 cart_heading">
                                                              <h3 class="modal-title w-100 my-auto" style="padding-top: 7px">
                                                                  Shopping List
                                                              </h3>

                                                              <button
                                                                class="mr-3 btn btn-info cart-modal-counterdown"
                                                                style=""
                                                                v-if="!hideTimer"
                                                              >
                                                                <span class="">{{
                                                                  timer
                                                                    | minutesAndSeconds
                                                                }}</span>
                                                              </button>

                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true" style="font-size:28px">&times;</span>
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <!-- small Screen -->
                                                              <div class="cart_sm-row">
                                                                  <div class="card-container shadow-sm mb-4" v-for="(cart, index) in carts" :key="index">
                                                                      <div class="row">
                                                                          <div class="col-sm-4 col-4">
                                                                              <div class="sm_cart_image">
                                                                                <img :src="'/assets/front/img/product/featured/' + cart.feature_image" alt="" srcset="">
                                                                              </div>
                                                                          </div>
                                                                          <div class="col-sm-8 col-8 float-left">
                                                                              <div class="sm_cart_title">
                                                                                {{ cart.product_name }}
                                                                              </div>
                                                                              <p class="" style="font-size:14px !important">${{ cart.product_price }}</p>
                                                                              <div class="float-right  mt-n5">
                                                                                  <h4 style="font-size:18px !important"><b>Total: ${{ cartSubtotal() }}</b></h4>
                                                                              </div>

                                                                              <div class="addon_detail" v-for="(variation, index) in cartVariations" :key="index">
                                                                                  Size: {{ variation.name }} |  {{ variation.qty }} Quantities | ${{ variation.price }}                          
                                                                              </div>

                                                                              <div class="addon_detail" v-for="(addon, index) in cartAddons" :key="index">
                                                                                  Addon: {{ addon.name }} | 1 Quantity | {{ addon.qty }} | ${{ addon.price}} 
                                                                              </div>

                                                                              <div class="cart_plux_minus">
                                                                                  <table>
                                                                                      <tr>
                                                                                          <td>
                                                                                              <button type="button"
                                                                                                  class="mr-1 btn btn-lg btn-danger btn_qty_increment" style="
                                                                                                  width: 30px;
                                                                                                  height: 30px;
                                                                                              "
                                                                                              @click.prevent="
                                                                                                decrementQty(
                                                                                                cart.id
                                                                                              )">
                                                                                                  -
                                                                                              </button>
                                                                                          </td>
                                                                                          <td>
                                                                                              <input type="text" name="" id="" class="form-control mr-1" style="
                                                                                                width: 35px;
                                                                                                height: 30px;
                                                                                                padding: 0px !important;
                                                                                                text-align: center;
                                                                                          "  :value="cart.product_quantity"
                                                                                          />
                                                                                          </td>
                                                                                          <td>
                                                                                              <button type="button" class="btn btn-danger" style="
                                                                                          width: 30px;
                                                                                          height: 30px;
                                                                                          " @click.prevent="incrementQty(cart.id)"
                                                                                          >
                                                                                                  +
                                                                                              </button>
                                                                                          </td>
                                                                                          <td>
                                                                                              <a href="" style="text-decoration:underline;font-size:14px"
                                                                                                  class="pl-3 text-dark"> Remove</a>
                                                                                          </td>

                                                                                          <!-- <td>
                                                                                              <a href="" style="text-decoration:underline;font-size:14px"
                                                                                                  class="pl-3 text-dark"> Remove</a>
                                                                                          </td> -->
                                                                                      </tr>
                                                                                  </table>
                                                                              </div>


                                                                          </div>

                                                                      </div>

                                                                  </div>
                                                                  <br>
                                                              </div>

                                                              <!-- Large screen  -->
                                                              <!-- cart heading -->
                                                              <div class="cart_lg_row">
                                                                  <div class="row cart_row">
                                                                      <div class="col-md-2 col-sm-2">
                                                                          <div class="cart_heading_title">
                                                                              Colour
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-7 responsive_container">
                                                                          <div class="product_heading cart_heading_title">
                                                                              Product
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-2 col-sm-3">
                                                                          <div class="quantity_heading cart_heading_title">
                                                                              Quantity
                                                                          </div>
                                                                      </div>

                                                                      <div class="col-md-2">
                                                                          <div class="price_heading cart_heading_title">
                                                                              Price
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <!-- end of cart heading -->

                                                                  <div class="cart_row" v-for="(cart, index) in carts" :key="index">
                                                                    <hr>
                                                                    <div class="row mt-n4 mb-4">

                                                                      <div class="col-md-2 col-sm-2">
                                                                          
                                                                          <div class="cart_color" :style="{'background-color':cart.product_colour.colour_code }">
                                                                              <p class="text-white" style="font-size:12px;text-align:center;position:relative !important;top:50% !important;">Crisp Linen 61yy 89/040</p>
                                                                          </div>
                                                                      </div>

                                                                      <div class="col-md-6 col-sm-7 responsive_container">
                                                                          <div class="row" >
                                                                              <div class="col-md-4 col-sm-6 cart_image ">
                                                                                  <img :src="'/assets/front/img/product/featured/' + cart.feature_image" alt="" srcset="">
                                                                              </div>
                                                                              <div class="col-md-8 col-sm-6">
                                                                                  <div class="cart_title">
                                                                                      {{ cart.product_name }}
                                                                                  </div>
                                                                                  <div>
                                                                                      <div id="accordion" class="accordion cart_accordion">
                                                                                          <div class="addon_container mb-0">
                                                                                              <div class="addon-header collapsed" data-toggle="collapse"
                                                                                                  :href="'#collapseOne-'+index">
                                                                                                  <a class="" style="text-decoration:underline">
                                                                                                      Litres
                                                                                                  </a>
                                                                                              </div>
                                                                                              <div :id="'collapseOne-'+index" class="card-body collapse"
                                                                                                  data-parent="#accordion">
                                                                                                  <table class="table">
                                                                                                      <thead>
                                                                                                          <tr>
                                                                                                              <th>Name</th>
                                                                                                              <th>Qty</th>
                                                                                                              <th>Price($)</th>
                                                                                                          </tr>
                                                                                                      </thead>
                                                                                                      <tbody v-for="(variation, index) in cartVariations" :key="index">
                                                                                                          <tr>
                                                                                                              <td scope="row">{{ variation.name }}</td>
                                                                                                              <td>{{ variation.qty }}</td>
                                                                                                              <td>{{ variation.price }}</td>
                                                                                                          </tr>
                                                                                                      </tbody>
                                                                                                      <tfoot>
                                                                                                        <tr>
                                                                                                          <td></td>
                                                                                                          <td>Total:</td>
                                                                                                          <td>{{ variationsSubtotal() }}</td>
                                                                                                        </tr>
                                                                                                      </tfoot>
                                                                                                  </table>
                                                                                              </div>


                                                                                              <hr>
                                                                                              <div class="addon-header collapsed" data-toggle="collapse"
                                                                                                  :href="'#collapseTwo-'+index">
                                                                                                  <a class="" style="text-decoration:underline">
                                                                                                      Add On
                                                                                                  </a>
                                                                                              </div>
                                                                                              <div :id="'collapseTwo-'+index" class="card-body collapse"
                                                                                                  data-parent="#accordion">
                                                                                                  <table class="table">
                                                                                                      <thead>
                                                                                                          <tr>
                                                                                                              <th>Name</th>
                                                                                                              <th>Qty</th>
                                                                                                              <th>Price($)</th>
                                                                                                          </tr>
                                                                                                      </thead>
                                                                                                      <tbody v-for="(addon, index) in cartAddons" :key="index">
                                                                                                          <tr>
                                                                                                              <td scope="row">{{ addon.name }}</td>
                                                                                                              <td>{{ addon.qty }}</td>
                                                                                                              <td>{{ addon.price}} </td>
                                                                                                          </tr>
                                                                                                      </tbody>
                                                                                                      <tfoot>
                                                                                                        <tr>
                                                                                                            <td></td>
                                                                                                            <td>Total:</td>
                                                                                                            <td>${{ AddOnSubtotal() }}</td>

                                                                                                          </tr>
                                                                                                      </tfoot>
                                                                                                  </table>
                                                                                              </div>


                                                                                          </div>
                                                                                      </div>

                                                                                  </div>
                                                                              </div>
                                                                              <!-- Check --> 
                                                                          </div>
                                                                      </div>

                                                                      <div class="col-md-2 col-sm-3">
                                                                          <div class="cart_plux_minus">
                                                                              <table>
                                                                                  <tr>
                                                                                      <td>
                                                                                          <button type="button"
                                                                                              class="mr-1 btn btn-lg btn-danger btn_qty_increment" style="
                                                                                          width: 30px;
                                                                                          height: 30px;
                                                                                          " @click.prevent="
                                                                                              decrementQty(
                                                                                                cart.id
                                                                                              )
                                                                                            ">
                                                                                              -
                                                                                          </button>
                                                                                      </td>
                                                                                      <td>
                                                                                          <input type="text" name="" id="" class="form-control mr-1" style="
                                                                                          width: 35px;
                                                                                          height: 30px;
                                                                                          padding: 0px !important;
                                                                                          text-align: center;
                                                                                          " :value="cart.product_quantity"/>
                                                                                      </td>
                                                                                      <td>
                                                                                          <button type="button" class="btn btn-danger" style="
                                                                                          width: 30px;
                                                                                          height: 30px;" @click.prevent="incrementQty(cart.id)">
                                                                                              +
                                                                                          </button>
                                                                                      </td>
                                                                                  </tr>
                                                                              </table>
                                                                          </div>
                                                                      </div>

                                                                      <div class="col-md-2">
                                                                          <div class="form-group" style="padding-top:20px">
                                                                              <input type="text" class="form-control bg-white" name="" id="" aria-describedby="emailHelpId" :value="'$' +cart.product_price" disabled>
                                                                          </div>
                                                                          <div class="remove_cart_product pt-3">
                                                                              <a class=" text-danger float-right" style="text-decoration:underline" @click="
                                                                                  removeCartItem(
                                                                                    cart.id
                                                                                  )
                                                                                ">Remove</a>

                                                                                <a class="float-right" style="text-decoration:underline">Change</a>
                                                                          </div>
                                                                      </div>
                                                                      
                                                                    </div>

                                                                  </div>

                                                                  <div class="total" style="margin-top:-20px" v-show="carts.length  > 0">
                                                                      <h3 class="float-right" style=""><b> Total: ${{cartSubtotal() }}</b></h3>
                                                                      <input type="hidden" :value="cartSubtotal()">
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer mt-n4" v-show="carts.length  > 0">
                                                            <button
                                                            type="button"
                                                            class="btn btn-sm custom_button clear-button"
                                                            @click.prevent="
                                                              clearCartItems()
                                                            "
                                                          >
                                                            Clear
                                                          </button>
                                                          <router-link
                                                            :to="{
                                                              name: 'checkout',
                                                              params: {
                                                                id: product.product_id,
                                                                cartTotal,
                                                                AddOnTotal,
                                                                variationTotal

                                                              },
                                                            }"
                                                            class="btn btn-sm custom_button checkout-button"
                                                            data-dismiss="modal"
                                                            aria-label="Close"
                                                          >
                                                            Checkout
                                                          </router-link>
                                                          </div>
                                                          
                                                      </div>
                                                  </div>
                                              </div>                                            
                                              <!--  -->
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div v-else>
                                <div
                                  class="spinner-image"
                                  role="status"
                                >
                                </div>
                              </div>

                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <input
                        type="hidden"
                        name="form_build_id"
                        value="form-AxWHMqpphH8baegmOgMNlss6JFPxe1xLU3oFp9tAEoo"
                        tabindex="97"
                      />
                      <input
                        type="hidden"
                        name="form_id"
                        value="flourish_product_listing_filters_solr_form"
                        tabindex="98"
                      />
                    </div>
                  </form>
                </section>
              </div>
            </div>
          </section>
        </div>
      </div>

      <!-- Button trigger modal -->

     
     <Description :current_product="currentProduct" />

      
      <!-- Cart Modal  -->

      <div>
        <!-- <b-button id="show-btn" @click="cartModal('bv-modal-cart')"
          >Open Modal</b-button
        > -->

    
      </div>

      <!-- Add on Modal -->
      <!-- Modal -->
      <Addon :productDetail="product_name" :currentAddon="currentAddon" :productAddons="productAddons" :currentProduct="currentProduct" :local_products="local_products"/>

      <!-- edn add on modal -->
    </div>
    <div v-else >
      <!-- <div
        class="spinner-border"
        style="width: 4rem; height: 4rem"
        role="status"
      >
      </div> -->

      <div
        class="spinner-image"
        role="status"
      >
        <!-- <span class="sr-only">Loading...</span> -->
      </div>
    </div>
  </div>
</template>


<style scoped>

.cart-modal-header {
  background-color: red !important;
}
.arrow_image img{
    /* width:30px; */
}

</style>

<script>

import "../frontend/accordion/Accordion";
import $ from "jquery";
import { TweenMax, Power1 } from "gsap";
import CartModal from "../frontend/modals/cart/CartModal";

import Description from "../frontend/modals/Description"
import Addon from "../frontend/modals/Addon"
import FilterModal from "../frontend/modals/FilterModal";

const FIVE_SECONDS = 5;
const ONE_MINUTE = 60;

$(function() {
        // $('.product-card__content').matchHeight(true);

});

export default {
  components: {
    // OrderDetails,
    FilterModal,
    CartModal,
    Description,
    Addon
  },
  data() {
    return {
      disableAddToCart:false,
      checkboxes: false,
      loading: true,
      loadFilterProduct: false,
      form2: {
        productVariations: {
          name: [],
          qty: [],
          price: [],
        },
      },

      form3: {
        product: {
          id: null,
          name: null,
          qty: null,
          price: [],
          price2:null
        },
      },
      hideColourbar:true,
      toggleDropdown:false,
      hideTimer:false,
      filterProducts: null,
      productSingle:{},
      cartQuantity: "",
      products: [],
      local_products: [],
      local_singleProduct:[],
      loadFilter: false,
      product: null,
      variations: [],
      categories: [],
      carts: [],
      cartAddons:null,
      cartVariations:null,
      cart_qty: [],
      currentProduct: null,
      currentCart: null,
      currentAddon: null,
      currentVariance: null,
      productAddons:[],
      product_name: {},
      timer: FIVE_SECONDS,
      modalShow: true,
      cartTotal:'',
      AddOnTotal:'',
      variationTotal:''
    };
  },
  filters: {
    minutesAndSeconds(value) {
      var minutes = Math.floor(parseInt(value, 10) / 60);
      var seconds = parseInt(value, 10) - minutes * 60;
      return `${seconds}`;
    },
  },
  methods: {
    closeColourBar(){
      this.hideColourbar = false
    },
    colourProducts(){

      this.loadFilter = false
        axios.get('/api/colour/products/'+this.$route.params.id)
        .then((response) => {
          // JSON responses are automatically parsed.
          this.products = response.data.data;
          this.loading = false;
          this.listCategories();
          this.products.forEach((p, index) => {
            this.productSingle = p
            this.form3.product.price[index] = p.current_price;

            this.local_products.push({
              product_id: p.id,
              product_name: p.title,
              product_image: p.feature_image,
              product_price: p.current_price,
              product_variation: p.variations,
              product_summary: p.summary,

              product_key_info: p.key_info,
      
              variation_visible:true,
              variation_qty: 1,
              product_qty : 0
            });
          });

        
        })
        .catch((error) => {
          this.loading = true;
        });
        
    },
    hideCounter(){
      this.timer = 0
      // this.hideTimer=true
    },
    categoryProducts(id){
      this.local_products = []
      // this.filterProducts = evt.target.value
      axios
        .post("/api/category-products/"+id)
        .then((response) => {
          Fire.$emit("AfterCreated");

          

          this.products = response.data
          // alert(this.products)
          
          this.products.forEach((p, index) => {

          this.local_products.push({
            product_id: p.id,
            product_name: p.title,
            product_image: p.feature_image,
            product_price: p.current_price,
            product_variation: p.variations,
            variation_visible:true,
            variation_qty: 1,
            product_qty : 0
          });
        });
          this.loadFilter = true
      })

    },
    showProductDesc(product) {
      this.currentProduct = product
    },

    filterProduct(cat_id, evt) {
      // console.log("daniel")
      // alert(this.$route.params.cId)
      this.loadFilterProduct = true;
            // alert(this.loadFilterProduct)

      if(this.loadFilterProduct == true){
          document.getElementById("overlay").style.display = "block";
        } 
      this.local_products = []
      this.filterProducts = evt.target.value
      axios
        .post("/api/filter-product/"+cat_id +"/"+ this.$route.params.cId + "/" + this.$route.params.id, this.filterProducts)
        .then((response) => {

          setTimeout(() => {
              Fire.$emit("AfterCreated");
              this.products = this.filterProducts == 'All' ? response.data : response.data.data
              // product count
              // this.products.forEach((p, index) => {
              // })

              this.products.forEach((p, index) => {


                this.local_products.push({
                  product_id: p.id,
                  product_name: p.title,
                  product_image: p.feature_image,
                  product_price: p.current_price,
                  product_variation: p.variations,
                  variation_visible:true,
                  variation_qty: 1,
                  product_qty : 0
                });
              });
              this.loadFilter = true
          }, 2000)
          
        })
    },

    toggleDrop(index, product_id){
      // axios .get("/api/product/" + product_id)
      //     .then((response) => {
      //       // this.product = response.data;
      //       this.currentProduct = response.data
              

      //         this.local_product.forEach((p)=>{
      //       // if(p.product_id == product_id){
      //         this.local_products.splice(index, 1, variation_visible)
              // this.toggleDropdown = p.variation_visible
        this.toggleDropdown = !this.toggleDropdown

            // }
        //   })
        // })
        // .catch((error) => {})
    
    },
        
    variationsSubtotal() {
      let sum = 0;
      if(this.cartVariations){
        for (let i = 0; i < this.cartVariations.length; i++) {
          sum +=
            parseFloat(this.cartVariations[i].qty) *
            parseFloat(this.cartVariations[i].price);
        }
        this.variationTotal = sum
        return sum;
      }
      return sum
    },

    AddOnSubtotal() {
      let sum = 0;
      if(this.cartAddons){
        for (let i = 0; i < this.cartAddons.length; i++) {
          sum +=
            parseFloat(this.cartAddons[i].qty) *
            parseFloat(this.cartAddons[i].price);
        }
        this.AddOnTotal = sum
              // alert(sum)

        return sum;
      }
      return sum
    },

    addVariation(id, index, evt) {
      this.form2.productVariations.name[index] = evt.target.value
      axios
        .post("/api/variation/" + id, this.form2.productVariations)
        .then((response) => {
          if (response.data["status_code"] == "AC") {
            this.errorMessage(response.data["message"]);
          } else if (response.data["status_code"] == "AB") {
            this.errorMessage(response.data["message"]);
          } else {
            this.form2.productVariations.name[index] = null;
            this.form2.productVariations.qty[index] = null;
            this.form2.productVariations.price[index] = null;

            toast.fire({
              icon: "success",
              title: "Cart successfully added",
            });
            Fire.$emit("AfterCreated");
          }
        })
        .catch((error) => {
          swal.fire({
            position: "center",
            icon: "error",
            title: "Error Adding cart",
            showConfirmButton: true,
            timer: 2500,
          });
        });
    },


    addProduct(id) {
      axios
        .post("/api/add-product/" + id, this.form3.product)
        .then((response) => {
          if (response.data["status_code"] == "AC") {
            this.errorMessage(response.data["message"]);
          } else if (response.data["status_code"] == "AB") {
            this.errorMessage(response.data["message"]);
          } else {

            toast.fire({
              icon: "success",
              title: "Cart successfully added",
            });
            Fire.$emit("AfterCreated");
          }
        })
        .catch((error) => {
          swal.fire({
            position: "center",
            icon: "error",
            title: "Error Adding cart",
            showConfirmButton: true,
            timer: 2500,
          });
        });
    },


    decrementProductQty(id, index) {
      this.form3.product.qty = --this.local_products[index].product_qty;
      this.form3.product.price[index] = parseFloat(this.local_products[index].product_price) * parseFloat(this.form3.product.qty)
      this.form3.product.price2 = parseFloat(this.local_products[index].product_price) * parseFloat(this.form3.product.qty)
      this.addProduct(id)
      this.productName(index)
      // this.form2.productVariations.price[index] = this.local_products[index].product_price * this.form2.productVariations.qty[index] ;
  },

    incrementProductQty(id, index) {
      this.form3.product.qty = ++this.local_products[index].product_qty;
      this.form3.product.price[index] = parseFloat(this.local_products[index].product_price) * parseFloat(this.form3.product.qty)
      this.form3.product.price2 = parseFloat(this.local_products[index].product_price) * parseFloat(this.form3.product.qty)

      this.addProduct(id)
      this.productName(index)
      this.productId(index);
    },
   
    productName(index){
      return this.form3.product.name = this.local_products[index].product_name;
    },

    productId(index){
      return this.form3.product.id = this.local_products[index].product_id;
    },

    decrementVarianceQty(index) {
      this.form2.productVariations.qty[index] = --this.local_products[index].variation_qty;
      this.form2.productVariations.price[index] = this.local_products[index].product_price * this.form2.productVariations.qty[index] ;

  },

    incrementVarianceQty(index) {
      this.form2.productVariations.qty[index] = ++this.local_products[index].variation_qty;
      this.form2.productVariations.price[index] = this.local_products[index].product_price * this.form2.productVariations.qty[index]

    },

    productVariation(product) {
      axios
        .get("/api/product/" + product.id)
        .then((response) => {
          // this.product = response.data;
          this.variations = JSON.parse(response.data.variations);
        })
        .catch((error) => {});
    },

    cartItemQty(id) {
      axios
        .get("/api/cart/" + id)
        .then(({ data }) => (this.cart_qty = data))
        .catch((error) => {});
    },
    modalClose() {
      this.modalShow == false;
    },
    startTimer() {
      this.timer = FIVE_SECONDS;
    },
    
    showAddOn(id, product) {
      axios
        .get("/api/product/" + id)
        // .then(({ data }) => (this.productAddons = JSON.parse(data.addons)))
        .then((response) => {
          this.productAddons = JSON.parse(response.data.addons);
          this.currentAddon = this.productAddons;
          this.currentProduct = product;

          this.currentAddon.forEach((addon, index) => {
            // if(addon.name==name){
            this.form.productAddons.qty[index] = null;
            this.form.productAddons.name[index] = null;
            this.form.productAddons.price[index] = null;
          });

        })
        .catch((error) => {});
      this.showProductName(id);
    },

    showProductName(id) {
      axios
        .get("/api/product/" + id)
        .then(({ data }) => (this.product_name = data))
        .catch((error) => {});
    },
    shown: function () {
      setTimeout(() => {
        console.log("test");
        let modal = document.getElementById("bv-modal-cart");
        modal.parentElement.parentElement.classList.remove("hidden");
        modal.classList.add("animate__fadeInBottomRight");
        modal.classList.add("animate__animated");
      }, 1000);
    },
    hidden: function (evt) {
      let modal = document.getElementById("modal1");
      evt.preventDefault();
      modal.classList.add("animate__fadeInBottomRight");
      // modal.classList.add('animate__animated');
      setTimeout(() => {
        this.$refs.myModalRef.hide();
        // modal.parentElement.parentElement.classList.add('hidden');
        console.log("test");
      }, 1000);
    },
    cartModal(id) {
      this.$bvModal.show("bv-modal-cart");
    },
    bgcss(url) {
      return {
        "background-image":
          "url(/assets/front/img/product/featured/" + url + ")",
          // '/assets/front/img/product/featured/' +
          //                                                   product.product_image
        "background-size": "cover",
        "background-position": "center center",
      };
    },
    wheel(evt) {
      console.log(evt.deltaY);
      TweenMax.to(".cards", 0.8, {
        left: "+=" + evt.deltaY * 2 + "px",
      });
    },
    
    listCategories() {
      axios
        .get("/api/category-lists/")
        .then(({ data }) => (this.categories = data))
        .catch((error) => {});
    },
    // listProducts() {
    //   this.loadFilter = false
    //   axios
    //     .get("/api/products-lists/")
    //     .then((response) => {
    //       // JSON responses are automatically parsed.
    //       this.products = response.data;
    //       this.loading = false;
    //       this.products.forEach((p, index) => {
    //         this.form3.product.price[index] = p.current_price;
    //       // this.form3.product.id[index] = p.current_price;

    //         this.local_products.push({
    //           product_id: p.id,
    //           product_name: p.title,
    //           product_image: p.feature_image,
    //           product_price: p.current_price,
    //           product_variation: p.variations,

    //           product_key_info: p.key_info,
    //           // product_: p.variations,
    //           // product_variation: p.variations,
    //           // product_variation: p.variations,

    //           variation_visible:true,
    //           variation_qty: 1,
    //           product_qty : 0
    //         });
    //         // this.cartItemQty(p.id)
    //       });

    //     this.listCategories();
    //     })
    //     .catch((error) => {
    //       this.loading = true;
    //     });
    // },
    
    
    cartQty() {
      let sum = 0;
      for (let i = 0; i < this.carts.length; i++) {
        this.cartQuantity = sum += parseFloat(this.carts[i].product_quantity);
        console.log(i++);
      }
      return sum;
    },
    cartSubtotal() {
      let sum = 0;
      for (let i = 0; i < this.carts.length; i++) {
        sum +=
          parseFloat(this.carts[i].product_quantity) *
          parseFloat(this.carts[i].product_price) + parseFloat(this.AddOnSubtotal()) + parseFloat(this.variationsSubtotal());
      }
      this.cartTotal = sum
      return sum;
    },

    cartQty() {
      let sum = 0;
      for (let i = 0; i < this.carts.length; i++) {
        sum += parseFloat(this.carts[i].product_quantity);
      }
      return sum;
    },

    isEmpty(obj) {
      for (var cart in carts) {
        if (carts.hasOwnProperty(cart)) {
          return false;
        }
      }
      return JSON.stringify(carts) === JSON.stringify({});
    },
    
    addToCart(product, id,index, evt) {
      // alert(product.feature_image)
      
      this.disableAddToCart = true
      setTimeout(function(){
            $('#centralModalSm2').modal('show');
        }, 2500);
      axios
        .post("/api/add-to-cart/" + id)
        .then((response) => {
          console.log(response);
          this.loading = false;
          this.cartItemQty(id);
          this.cartAddons
          this.cartVariations
          this.incrementProductQty(id, index)
          // animation
          this.currentProduct = product;
          this.disableAddToCart = false

          this.$nextTick(() => {
            TweenMax.from(".buybox", 1.5, {
              left: $(evt.target).offset().left,
              top: $(evt.target).offset().top,
              opacity: 1,
              ease: Power1.easeIn,
            });
            setTimeout(() => {
              // this.cart.push(product)
            }, 800);
          });
          
          // animation end
          Fire.$emit("AfterCreated");
        })
        .catch((error) => {
          this.disableAddToCart = false
        });
      this.startTimer();
    },

    cartProducts() {
      axios
        .get("/api/cart-lists/")
        .then((response) => {
          this.carts = response.data;
          this.carts.forEach((cart_addon)=>{
            this.cartAddons = JSON.parse(cart_addon.addons);
          })

          this.carts.forEach((variation_addon)=>{
            this.cartVariations = JSON.parse(variation_addon.variations);
          })
          // JSON.parse(response.data.addons);
          this.currentCart = response.data;
        })
        .catch((error) => {});

    },
    incrementQty(id) {
      axios
        .get("/api/increment-cart/" + id)
        .then(() => {
          // this.form3.product.price2 = this.currentCart.
          Fire.$emit("AfterCreated");
        })
        .catch();
    },

    decrementQty(id) {
      axios
        .get("/api/decrement-cart/" + id)
        .then(() => {
          Fire.$emit("AfterCreated");
        })
        .catch();
    },

    removeCartItem(id) {
      axios
        .get("/api/remove-cart/" + id)
        .then(() => {
          Fire.$emit("AfterCreated");
        })
        .catch();
    },
    clearCartItems() {
      axios
        .post("/api/clear-cart/")
        .then(() => {
          Fire.$emit("AfterCreated");
        })
        .catch();
    },
  },
  watch: {
    carts() {
      TweenMax.from(".cart_count", 0.3, {
        scale: 3,
      });
    },

    loading(){
      if(this.loading==false){
        document.getElementById("overlay").style.display = "none"
      }
    },
    loadFilterProduct(){
      if(this.loadFilterProduct==false){
        document.getElementById("overlay").style.display = "none"
      }
    },
    hideTimer (){
      return this.hideTimer
    }
  },

  mounted() {
    // this.cartItemQty()
          // alert(this.cartTotal )

    this.cartQty();
    console.log(this.currentProduct);
    Fire.$on("AfterCreated", () => {
      this.loading = false;
      this.loadFilterProduct = false;
      this.cartProducts();
      this.cartAddons
    });
    
    setTimeout(() => {
        this.colourProducts();
      }, 3000)
   
    // count down modal
    setInterval(() => {
        this.timer -= 1
        if(this.timer == 0){
            $("#centralModalSm2").modal('hide');
        }
        }, 1500)

        if(this.loading == true){
          document.getElementById("overlay").style.display = "block";
        } 

  },
};
</script>




<style>
.accordion .card-header:after {
    font-family: 'FontAwesome';  
    content: "\f068";
    padding-top:5px;
    float: right; 
}
.accordion .card-header.collapsed:after {
    /* symbol for "collapsed" panels */
    padding-top:5px;
    content: "\f067"; 
}

.cart_accordion .addon-header:after {
        font-family: 'FontAwesome';
        content: "\f068";
        float: right;
    }

    .cart_accordion .addon-header.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f067";
    }
    
.swal2-container {
  zoom: 1.2 !important;
}

.swal2-popup {
  font-size: 1.3rem !important;
}
.hidden {
  display: none;
}
/* Simple Accordion jQuery */
.jquery_accordion_item {
  display: inline-block;
  width: 100%;
  border-bottom: 1px solid #ccc;
}
.jquery_accordion_title {
  font-size: 14px;
  color: #333;
  display: block;
  line-height: 140%;
  padding: 15px 40px 15px 20px;
  font-weight: bold;
  position: relative;
  cursor: pointer;
}
.jquery_accordion_title:after {
  content: "";
  width: 0;
  height: 0;
  display: inline-block;
  position: absolute;
  right: 15px;
  top: 50%;
  border: 6px solid transparent;
  border-top-color: #333;
  transition: border 400ms, margin 400ms;
  margin-top: -3px; /* half of border value */
}
.jquery_accordion_item.active .jquery_accordion_title:after {
  border-color: transparent;
  border-bottom-color: #333;
  margin-top: -9px; /* fixing arrow position */
}
.jquery_accordion_content.not-expanded  {
	padding: 8px;
	display: none;
	color: rgb(173, 153, 153);
}
.jquery_accordion_content > *:first-child {
	margin-top: 0;
} 
.hidden {
  /* display: none; */
}

.bs-example {
  margin: 20px !important;
}
.accordion .fa {
  margin-right: 2rem !important;
}


.tabs-left {
  border-bottom: none;
  border-right: 1px solid #ddd;
}

.tabs-left>li {
  float: none;
 margin:0px;
  
}

.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
  background:#f90;
  border:none;
  border-radius:0px;
  margin:0px;
}
.nav-tabs>li>a:hover {
    /* margin-right: 2px; */
    line-height: 1.42857143;
    border: 1px solid transparent;
    /* border-radius: 4px 4px 0 0; */
}
.tabs-left>li.active>a::after{content: "";
    position: absolute;
    top: 10px;
    right: -10px;
    border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  
  border-left: 10px solid #f90;
    display: block;
    width: 0;}
</style>