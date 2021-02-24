<template>


<section
  class="html not-front not-logged-in no-sidebars page-colors-listing region-content i18n-en fl-en fl-colour-palettes fl-asgdlx jquery-once-1-processed jquery-once-2-processed flSearchClick-processed">
  <div id="overlay"></div>
  <div id="zone-content" class="zone-content focus-outline" v-if="!loading">
    <div class="main-container container focus-outline">

      <!-- /#page-header -->
      <div class="row">
        <section class="col-sm-12 focus-outline">
          <!--   -->
          <a id="main-content"></a>
          <!-- <h1 class="page-header">Find a colour</h1> -->
          <div class="region region-content focus-outline">
            <div id="full-form-wrapper" class="focus-outline">
              <section id="block-system-main" class="block block-system block--system-main clearfix focus-outline"
                role="navigation">


                <form class="flourish-colors-listing form-counter focus-outline" id="flourish-colors-listing-solr-form">
                  <div class="focus-outline"><button style="display:none" id="edit-filters-reset-link"
                      name="filters_reset_link" value="Reset Filters" type="button"
                      class="btn btn-default form-submit ajax-processed" tabindex="25">Reset Filters</button>
                    <button style="display:none" id="edit-finish-filters-reset-link" name="finish_filters_reset_link"
                      value="Reset Finish Filters" type="button" class="btn btn-default form-submit ajax-processed"
                      tabindex="26">Reset Finish Filters</button>
                    <button style="display:none" id="edit-surface-usage-filters-reset-link"
                      name="surface_usage_filters_reset_link" value="Reset Surface Type Filters" type="button"
                      class="btn btn-default form-submit ajax-processed" tabindex="27">Reset Surface Type
                      Filters</button>
                    <button style="display:none" id="edit-room-type-filters-reset-link"
                      name="room_type_filters_reset_link" value="Reset Room Type Filters" type="button"
                      class="btn btn-default form-submit ajax-processed" tabindex="28">Reset Room Type Filters</button>
                    <button style="display:none" id="edit-product-type-filters-reset-link"
                      name="finish_filters_reset_link" value="Reset Finish Filters" type="button"
                      class="btn btn-default form-submit ajax-processed" tabindex="29">Reset Finish Filters</button>
                    <div class="colour-palette-wrapper focus-outline">
                      <div id="block-views-color-display-block" class="colors_fieldset">
                        <h2 class="block__title block-title block-title text-center">Pick your colour palette</h2>
                      </div>
                      <div class="row">
                        

                      </div>
                      <div id="hue-selector" class="colors-hue-selectors clearfix">
                        
                         <div class="no-gutter col-xs-1" v-for="(cpalette, index) in cpalettes" :key="index" >
                          <!-- <div class="cid-white  product-available color-box colors-hue-selector col-sm-12 col-xs-12 selected hue-selected-processed"
                            tabindex="30">
                            <div class="color-box-inner text-center">
                              <svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg>
                              <span>
                                <button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="White" id="edit-palette-white" name="color" value="white"
                                  type="button" tabindex="31">white</button>
                              </span>
                              </div>
                          </div> -->
                          <!-- {{ cpalette.palette_name }} -->
                          <div :class="['cid-' + cpalette.palette_name, selectedName == cpalette.palette_name ? 'selected':null]" class=" product-available color-box colors-hue-selector  col-sm-12 col-xs-12 hue-selected-processed"
                            tabindex="32" style="background-color:blue !important" >
                            <div class="color-box-inner text-center">
                              <svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg>
                              <span>
                                <button @click="fetchCategories(cpalette, $event)"
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" :title="cpalette.palette_name " id="" name="color" :value="cpalette.palette_name"
                                  type="button" tabindex="33">{{ cpalette.palette_name }}
                                  </button>
                              </span>
                            </div>
                          </div>
                        </div>
                        <!--<div class="no-gutter col-xs-2">
                          <div
                            class="cid-orange  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="34">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Orange" id="edit-palette-orange" name="color" value="orange"
                                  type="button" tabindex="35">orange</button>
                              </span></div>
                          </div>
                          <div
                            class="cid-yellow  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="36">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Yellow" id="edit-palette-yellow" name="color" value="yellow"
                                  type="button" tabindex="37">yellow</button>
                              </span></div>
                          </div>
                        </div>
                        <div class="no-gutter col-xs-2">
                          <div
                            class="cid-teal  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="38">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Teal" id="edit-palette-teal" name="color" value="teal"
                                  type="button" tabindex="39">teal</button>
                              </span></div>
                          </div>
                          <div
                            class="cid-violet  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="40">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Violet" id="edit-palette-violet" name="color" value="violet"
                                  type="button" tabindex="41">violet</button>
                              </span></div>
                          </div>
                        </div>
                        <div class="no-gutter col-xs-2">
                          <div
                            class="cid-cool neutral  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="42">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Cool neutral" id="edit-palette-cool-neutral" name="color"
                                  value="cool neutral" type="button" tabindex="43">cool neutral</button>
                              </span></div>
                          </div>
                          <div
                            class="cid-warm neutral  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="44">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Warm neutral" id="edit-palette-warm-neutral" name="color"
                                  value="warm neutral" type="button" tabindex="45">warm neutral</button>
                              </span></div>
                          </div>
                        </div>
                        <div class="no-gutter col-xs-2">
                          <div
                            class="cid-gold  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="46">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Gold" id="edit-palette-gold" name="color" value="gold"
                                  type="button" tabindex="47">gold</button>
                              </span></div>
                          </div>
                          <div
                            class="cid-lime  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="48">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Lime" id="edit-palette-lime" name="color" value="lime"
                                  type="button" tabindex="49">lime</button>
                              </span></div>
                          </div>
                        </div>
                        <div class="no-gutter col-xs-2">
                          <div
                            class="cid-green  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="50">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Green" id="edit-palette-green" name="color" value="green"
                                  type="button" tabindex="51">green</button>
                              </span></div>
                          </div>
                          <div
                            class="cid-blue  product-available color-box colors-hue-selector col-sm-6 col-xs-12 hue-selected-processed"
                            tabindex="52">
                            <div class="color-box-inner text-center"><svg class="icon icon-checkmark">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                  xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/defs/icons-symbol-defs.svg#icon-checkmark">
                                </use>
                              </svg><span><button
                                  class="use-ajax-submit solr-color-box-button btn btn-default form-submit ajax-processed colorHue-processed flourish_google_tag_manager-processed"
                                  style="opacity:0" title="Blue" id="edit-palette-blue" name="color" value="blue"
                                  type="button" tabindex="53">blue</button>
                              </span></div>
                          </div>
                        </div> -->
                        


                        
                        <br><br><br><br>
                        <div class="row mt-5 justify-content-md-center d-none d-sm-none d-md-flex" style="">
                          <div class="">
                            <div class="col-sm-4" v-for="(filterItem, index) in filterItems" :key="index">
                            <dropdown  :close-on-click="true" ref="dropdown" :class="dropdown" :class-name="'my-class'" :unscroll="'main'" :before-open="callback">
                            <template slot="btn">{{ filterItem.name.toLowerCase() == "Product Type".toLowerCase() ? "Location" : filterItem.name }}</template>
                            <!-- <div v-for="(sub, index) in filterItem.subcategory" :key="index"> -->
                            <template slot="body">
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

                              
                            </template>
                            <!-- </div> -->
                          </dropdown>

                          </div>

                          <!-- <div class="col-sm-4">
                            <dropdown :class="dropdown" :class-name="'my-class'" :unscroll="'main'" :before-open="callback">
                            <template slot="btn">Surface</template>
                            <template slot="body">Callback called!</template>
                          </dropdown>

                          </div>

                          <div class="col-sm-4">
                            <dropdown :class="dropdown" :class-name="'my-class'" :unscroll="'main'" :before-open="callback">
                            <template slot="btn">Finish</template>
                            <template slot="body">Callback called!</template>
                          </dropdown>

                          </div> -->
                          </div>
                        </div>

                      </div>
                      <ColourFilterModal :filterItems="filterItems" :filterProductColour="filterProductColour" :modalClose="modalClose" />

                      
                      <!-- gggggggggggggggggg -->
                      <div class="filter-section bar-desktop">
                        <div class="bar-title">My filters</div>
                        <div id="filter-selections" class="filter-labels"></div>
                          <a href="https://www.dulux.com.sg/en/colour-palettes#"
                            class="filter-reset inline-text-link primary btn-clear" tabindex="83"
                            style="display: none;">Clear all</a>
                        </div>
                      <div class="results-bar">
                        <a href="https://www.dulux.com.sg/en/colour-palettes#"
                          class="filter-reset inline-text-link primary btn-clear" tabindex="84"
                          style="display: none;">Clear all</a>
                        <button id="filter_results_btn" class="bttn primary bttn-auto-width pull-right"
                          tabindex="85">Show
                          144 results</button>
                      </div>

                      <section class="filtering focus-outline">
                          <div class="row focus-outline filter-zone" style="display: block;">
                            <div class=" focus-outline">
                              <section id="color-box-container" class="col-sm-12 focus-outline color-box-type-grid">
                                <div class="color-travels no-padding focus-outline">
                                  <ul class="color-travels-options focus-outline">
                                    <li class="first travel-list focus-outline">
                                      <a href="#" data-type="list" title="List View" class="travel-list-view travel-option"  :class="color_box_type == 'list' ? 'on' : '' " @click="listView()">List View</a>
                                    </li>
                                    <li class="first travel-grid focus-outline">
                                      <a href="#" data-type="grid" title="Grid View" class="travel-grid-view travel-option" :class="color_box_type == 'grid' ? 'on' : '' " @click="gridView()">Grid View</a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="icon-plus-text ipt-icon-settings right focus-outline" @click="showPopUp()">Filters
                                  <!-- <svg class="icon icon-settings"> -->
                                    <svg class="icon icon-settings" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="80" height="80"
                                        viewBox="0 0 172 172"
                                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#2fc48d"><path d="M10.32,24.08c-1.89469,0 -3.44,1.54531 -3.44,3.44v13.76c0,1.89469 1.54531,3.44 3.44,3.44h13.76c1.89469,0 3.44,-1.54531 3.44,-3.44v-13.76c0,-1.89469 -1.54531,-3.44 -3.44,-3.44zM40.635,27.52c-3.80281,0.17469 -6.73219,3.39969 -6.5575,7.2025c0.17469,3.80281 3.39969,6.73219 7.2025,6.5575h116.96c2.48594,0.04031 4.78375,-1.26312 6.03344,-3.41312c1.26313,-2.13656 1.26313,-4.79719 0,-6.93375c-1.24969,-2.15 -3.5475,-3.45344 -6.03344,-3.41313h-116.96c-0.215,-0.01344 -0.43,-0.01344 -0.645,0zM10.32,58.48c-1.89469,0 -3.44,1.54531 -3.44,3.44v13.76c0,1.89469 1.54531,3.44 3.44,3.44h13.76c1.89469,0 3.44,-1.54531 3.44,-3.44v-13.76c0,-1.89469 -1.54531,-3.44 -3.44,-3.44zM40.635,61.92c-3.80281,0.17469 -6.73219,3.39969 -6.5575,7.2025c0.17469,3.80281 3.39969,6.73219 7.2025,6.5575h116.96c2.48594,0.04031 4.78375,-1.26312 6.03344,-3.41312c1.26313,-2.13656 1.26313,-4.79719 0,-6.93375c-1.24969,-2.15 -3.5475,-3.45344 -6.03344,-3.41313h-116.96c-0.215,-0.01344 -0.43,-0.01344 -0.645,0zM10.32,92.88c-1.89469,0 -3.44,1.53188 -3.44,3.44v13.76c0,1.90813 1.54531,3.44 3.44,3.44h13.76c1.89469,0 3.44,-1.53187 3.44,-3.44v-13.76c0,-1.90812 -1.54531,-3.44 -3.44,-3.44zM40.635,96.32c-3.80281,0.17469 -6.73219,3.39969 -6.5575,7.2025c0.17469,3.80281 3.39969,6.73219 7.2025,6.5575h116.96c2.48594,0.04031 4.78375,-1.26312 6.03344,-3.41312c1.26313,-2.13656 1.26313,-4.79719 0,-6.93375c-1.24969,-2.15 -3.5475,-3.45344 -6.03344,-3.41313h-116.96c-0.215,-0.01344 -0.43,-0.01344 -0.645,0zM10.32,127.28c-1.89469,0 -3.44,1.53188 -3.44,3.44v13.76c0,1.90813 1.54531,3.44 3.44,3.44h13.76c1.89469,0 3.44,-1.53187 3.44,-3.44v-13.76c0,-1.90812 -1.54531,-3.44 -3.44,-3.44zM40.635,130.72c-3.80281,0.17469 -6.73219,3.39969 -6.5575,7.2025c0.17469,3.80281 3.39969,6.73219 7.2025,6.5575h116.96c2.48594,0.04031 4.78375,-1.26312 6.03344,-3.41312c1.26313,-2.13656 1.26313,-4.79719 0,-6.93375c-1.24969,-2.15 -3.5475,-3.45344 -6.03344,-3.41313h-116.96c-0.215,-0.01344 -0.43,-0.01344 -0.645,0z"></path></g></g></svg>
                                </div>
                                <span class="count-label totalInputCount">0</span>
                              </section>
                            </div>
                        <br>
                        </div>
                        <div class="sharktooth small white visible-xs"></div>

                      </section>

                    </div>
                    <div class="sharktooth brand-grey hidden-xs"></div>
                    <div class="row colors-content focus-outline">
                    <div class="store-links-solr tabs col-xs-12"><span
                          class="store-links tab-link col-lg-6 col-md-6 col-sm-6 col-xs-6 boxshadow-class"
                          style="float:left">
                          <button @click="clickStage1(palette_id)" :class="toggleStage1 ? 'btn_toggle active' : ''"
                            class="colors-ready-to-buy use-ajax  btn btn-default form-submit ajax-processed flourish_google_tag_manager-processed"
                            :style="{opacity: '1', height: '58px'}" 
                            id="edit-colors-ready-to-buy" name="colors_ready_to_buy"
                            value="Colours ready to buy" type="button" :disabled="isActive1">Colours ready to buy
                          </button>
                        </span><span class="store-links tab-link col-lg-6 col-md-6 col-sm-6 col-xs-6 boxshadow-class"
                          style="float:left" >
                          <button
                            class="colors-ready-to-mix btn btn-default" @click="clickStage2(palette_id)" :class="toggleStage2 ? 'btn_toggle active' : ''"
                            :style="{opacity: '4', height: '58px'}" 
                            id="edit-colors-ready-to-mix" name="colors_ready_to_mix"
                            value="Colours to be mixed in store" type="button" :disabled="isActive2">Colours to be mixed in
                            store</button>
                        </span>
                    </div>

                    <!-- <div class="container-fluid colors-listing-box color-box-type-list focus-outline" id="color-box-container" style="">	<div id="hue-container" class="col-md-12 colors clearfix fl-overflow-visible focus-outline"><p class="h1 focus-outline"><span class="main-color-tab">Popular colours(33)</span><span class="link-gray pull-right hidden-xs sub-color-tab main"><button data-link="all" class="use-ajax btn btn-default form-submit ajax-processed flourish_google_tag_manager-processed" style="opacity:4" id="edit-show-colors-link" name="show_colors_link" value="See all colours (223)" type="button">See all colours (223)</button>
</span></p><div id="popular-colors-list" class="focus-outline"><div class="solr-pure-color-list focus-outline"><div class="solr-pure-color-name focus-outline"><h2 class="color-type focus-outline">Orange</h2></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1035832 colorBox-processed flourish_google_tag_manager-processed" style="background:#FEC68D" data-title="Apricot Nectar 36yy 66/349" data-id="FEC68D" data-colorid="1035832" alt="Apricot Nectar 36yy 66/349"><p class="cnme color-text" data-rgb="FEC68D" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Apricot Nectar 36yy 66/349</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1035025 colorBox-processed flourish_google_tag_manager-processed" style="background:#F8D6B3" data-title="Peach Sorbet 06yy 75/218" data-id="F8D6B3" data-colorid="1035025" alt="Peach Sorbet 06yy 75/218"><p class="cnme color-text" data-rgb="F8D6B3" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Peach Sorbet 06yy 75/218</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036170 colorBox-processed flourish_google_tag_manager-processed" style="background:#F5DFC4" data-title="Taffy Pull 20yy 78/146" data-id="F5DFC4" data-colorid="1036170" alt="Taffy Pull 20yy 78/146"><p class="cnme color-text" data-rgb="F5DFC4" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Taffy Pull 20yy 78/146</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036461 colorBox-processed flourish_google_tag_manager-processed" style="background:#F5A265" data-title="Sea Fan 86yr 49/493" data-id="F5A265" data-colorid="1036461" alt="Sea Fan 86yr 49/493"><p class="cnme color-text" data-rgb="F5A265" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Sea Fan 86yr 49/493</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190545 colorBox-processed flourish_google_tag_manager-processed" style="background:#F4E8DA" data-title="White Peach 10yy 83/071" data-id="F4E8DA" data-colorid="1190545" alt="White Peach 10yy 83/071"><p class="cnme color-text" data-rgb="F4E8DA" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">White Peach 10yy 83/071</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190620 colorBox-processed flourish_google_tag_manager-processed" style="background:#F4E5D9" data-title="Cotton Field 90yr 83/070" data-id="F4E5D9" data-colorid="1190620" alt="Cotton Field 90yr 83/070"><p class="cnme color-text" data-rgb="F4E5D9" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Cotton Field 90yr 83/070</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2 focus-outline"><a class="color-box-child color-box-child-1190546 colorBox-processed flourish_google_tag_manager-processed focus-outline" style="background:#F4E4D2" data-title="Peach Orchid 10yy 83/100" data-id="F4E4D2" data-colorid="1190546" alt="Peach Orchid 10yy 83/100"><p class="cnme color-text focus-outline" data-rgb="F4E4D2" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Peach Orchid 10yy 83/100</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190617 colorBox-processed flourish_google_tag_manager-processed" style="background:#F3D4BD" data-title="Bali Sand 90yr 72/159" data-id="F3D4BD" data-colorid="1190617" alt="Bali Sand 90yr 72/159"><p class="cnme color-text" data-rgb="F3D4BD" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Bali Sand 90yr 72/159</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036601 colorBox-processed flourish_google_tag_manager-processed" style="background:#F2B895" data-title="Peach Swirl 80yr 57/293" data-id="F2B895" data-colorid="1036601" alt="Peach Swirl 80yr 57/293"><p class="cnme color-text" data-rgb="F2B895" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Peach Swirl 80yr 57/293</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190612 colorBox-processed flourish_google_tag_manager-processed" style="background:#F0C8B0" data-title="Antelope Tan 80yr 65/185" data-id="F0C8B0" data-colorid="1190612" alt="Antelope Tan 80yr 65/185"><p class="cnme color-text" data-rgb="F0C8B0" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Antelope Tan 80yr 65/185</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190611 colorBox-processed flourish_google_tag_manager-processed" style="background:#ECA779" data-title="Ripe Peach 80yr 49/382" data-id="ECA779" data-colorid="1190611" alt="Ripe Peach 80yr 49/382"><p class="cnme color-text" data-rgb="ECA779" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Ripe Peach 80yr 49/382</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036710 colorBox-processed flourish_google_tag_manager-processed" style="background:#E2712B" data-title="Orangery 70yr 30/651" data-id="E2712B" data-colorid="1036710" alt="Orangery 70yr 30/651"><p class="cnme color-text" data-rgb="E2712B" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Orangery 70yr 30/651</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036178 colorBox-processed flourish_google_tag_manager-processed" style="background:#E16553" data-title="Bongo Jazz 28yr 29/561" data-id="E16553" data-colorid="1036178" alt="Bongo Jazz 28yr 29/561"><p class="cnme color-text" data-rgb="E16553" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Bongo Jazz 28yr 29/561</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036078 colorBox-processed flourish_google_tag_manager-processed" style="background:#D4623C" data-title="Bonnie Belle 50yr 25/556" data-id="D4623C" data-colorid="1036078" alt="Bonnie Belle 50yr 25/556"><p class="cnme color-text" data-rgb="D4623C" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Bonnie Belle 50yr 25/556</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1035964 colorBox-processed flourish_google_tag_manager-processed" style="background:#C8402F" data-title="Party Place 31yr 18/648" data-id="C8402F" data-colorid="1035964" alt="Party Place 31yr 18/648"><p class="cnme color-text" data-rgb="C8402F" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Party Place 31yr 18/648</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1035117 colorBox-processed flourish_google_tag_manager-processed" style="background:#A34140" data-title="Old Flame 10yr 13/437" data-id="A34140" data-colorid="1035117" alt="Old Flame 10yr 13/437"><p class="cnme color-text" data-rgb="A34140" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Old Flame 10yr 13/437</p></a></div></div><div class="solr-muted-color-list"><div class="solr-muted-color-name"><h2 class="color-type muted_clrs">Soft Orange</h2></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1034851 colorBox-processed flourish_google_tag_manager-processed" style="background:#F3DDC9" data-title="Peachtree 00yy 77/124" data-id="F3DDC9" data-colorid="1034851" alt="Peachtree 00yy 77/124"><p class="cnme color-text" data-rgb="F3DDC9" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Peachtree 00yy 77/124</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190531 colorBox-processed flourish_google_tag_manager-processed" style="background:#F0E8DF" data-title="Spanish White 00yy 83/034" data-id="F0E8DF" data-colorid="1190531" alt="Spanish White 00yy 83/034"><p class="cnme color-text" data-rgb="F0E8DF" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Spanish White 00yy 83/034</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036169 colorBox-processed flourish_google_tag_manager-processed" style="background:#EFDFCB" data-title="Rice Flakes 20yy 77/110" data-id="EFDFCB" data-colorid="1036169" alt="Rice Flakes 20yy 77/110"><p class="cnme color-text" data-rgb="EFDFCB" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Rice Flakes 20yy 77/110</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1035091 colorBox-processed flourish_google_tag_manager-processed" style="background:#EFCCAB" data-title="Orange Pekoe 00yy 67/212" data-id="EFCCAB" data-colorid="1035091" alt="Orange Pekoe 00yy 67/212"><p class="cnme color-text" data-rgb="EFCCAB" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Orange Pekoe 00yy 67/212</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036230 colorBox-processed flourish_google_tag_manager-processed" style="background:#EED0AC" data-title="Just Peachy 20yy 67/216" data-id="EED0AC" data-colorid="1036230" alt="Just Peachy 20yy 67/216"><p class="cnme color-text" data-rgb="EED0AC" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Just Peachy 20yy 67/216</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190530 colorBox-processed flourish_google_tag_manager-processed" style="background:#E8DBCE" data-title="Little Linda 00yy 75/071" data-id="E8DBCE" data-colorid="1190530" alt="Little Linda 00yy 75/071"><p class="cnme color-text" data-rgb="E8DBCE" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Little Linda 00yy 75/071</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1035128 colorBox-processed flourish_google_tag_manager-processed" style="background:#E6B580" data-title="Golden Wheat 10yy 53/337" data-id="E6B580" data-colorid="1035128" alt="Golden Wheat 10yy 53/337"><p class="cnme color-text" data-rgb="E6B580" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Golden Wheat 10yy 53/337</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036694 colorBox-processed flourish_google_tag_manager-processed" style="background:#D99F7A" data-title="Whole Wheat 80yr 44/311" data-id="D99F7A" data-colorid="1036694" alt="Whole Wheat 80yr 44/311"><p class="cnme color-text" data-rgb="D99F7A" style="color: rgb(102,102,102); stroke: rgb(102,102,102)">Whole Wheat 80yr 44/311</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190529 colorBox-processed flourish_google_tag_manager-processed" style="background:#D2A074" data-title="Corsican Treasure 00yy 43/304" data-id="D2A074" data-colorid="1190529" alt="Corsican Treasure 00yy 43/304"><p class="cnme color-text" data-rgb="D2A074" style="color: rgb(102, 102, 102); stroke: rgb(255, 255, 255);">Corsican Treasure 00yy 43/304</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036731 colorBox-processed flourish_google_tag_manager-processed" style="background:#C49A7A" data-title="Rolling Hills 90yr 38/239" data-id="C49A7A" data-colorid="1036731" alt="Rolling Hills 90yr 38/239"><p class="cnme color-text" data-rgb="C49A7A" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Rolling Hills 90yr 38/239</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1036709 colorBox-processed flourish_google_tag_manager-processed" style="background:#C2794F" data-title="Southern Tip 70yr 27/404" data-id="C2794F" data-colorid="1036709" alt="Southern Tip 70yr 27/404"><p class="cnme color-text" data-rgb="C2794F" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Southern Tip 70yr 27/404</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190605 colorBox-processed flourish_google_tag_manager-processed" style="background:#AE6335" data-title="Copper Coin 70yr 19/432" data-id="AE6335" data-colorid="1190605" alt="Copper Coin 70yr 19/432"><p class="cnme color-text" data-rgb="AE6335" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Copper Coin 70yr 19/432</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-2121778 colorBox-processed flourish_google_tag_manager-processed" style="background:#9E7043" data-title="Bitter Creek 00yy 21/321" data-id="9E7043" data-colorid="2121778" alt="Bitter Creek 00yy 21/321"><p class="cnme color-text" data-rgb="9E7043" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Bitter Creek 00yy 21/321</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1034738 colorBox-processed flourish_google_tag_manager-processed" style="background:#9E7043" data-title="Bitter Creek 00yy 21/321" data-id="9E7043" data-colorid="1034738" alt="Bitter Creek 00yy 21/321"><p class="cnme color-text" data-rgb="9E7043" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Bitter Creek 00yy 21/321</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-2121770 colorBox-processed flourish_google_tag_manager-processed" style="background:#976856" data-title="Soft Copper 50yr 18/223" data-id="976856" data-colorid="2121770" alt="Soft Copper 50yr 18/223"><p class="cnme color-text" data-rgb="976856" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Soft Copper 50yr 18/223</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1190604 colorBox-processed flourish_google_tag_manager-processed" style="background:#84563C" data-title="Gingerbread House 70yr 13/259" data-id="84563C" data-colorid="1190604" alt="Gingerbread House 70yr 13/259"><p class="cnme color-text" data-rgb="84563C" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Gingerbread House 70yr 13/259</p></a></div><div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2"><a class="color-box-child color-box-child-1034768 colorBox-processed flourish_google_tag_manager-processed" style="background:#70563E" data-title="Brown Study 00yy 12/173" data-id="70563E" data-colorid="1034768" alt="Brown Study 00yy 12/173"><p class="cnme color-text" data-rgb="70563E" style="color: rgb(255,255,255); stroke: rgb(255,255,255)">Brown Study 00yy 12/173</p></a></div></div></div><div class="color-lister-bottom-new colors-listing-box-bottom"><h2>I can't find the right colour</h2><button data-link="all" class="btn-normal-curve sub-color-tab use-ajax btn btn-default form-submit ajax-processed flourish_google_tag_manager-processed" style="opacity:4" id="edit-show-right-colors" name="show_right_colors" value="See all colours (223)" type="button">See all colours (223)</button>
</div></div></div> -->

                    <div :class="color_box_type == 'list' ? 'color-box-type-list' : ''" class="container-fluid focus-outline" id="color-box-container">
                      
                        <div v-if="!loadCategories">
                            <div id="hue-container" class="col-md-12 colors clearfix fl-overflow-visible focus-outline" v-if="!loadFilterColour">
                            <p v-if="!hidePopular" class="h1"><span class="main-color-tab">Popular colours({{ popularColorCount }})</span><span
                                class="link-gray pull-right hidden-xs sub-color-tab main">
                                <button v-if="isSeeAll" class=" btn btn-default"
                                  style="opacity:4" id="edit-show-colors-link" name="show_colors_link"
                                  value="See all colours (144)" type="button" @click="seeAllColours(palette_id)">See all colours({{ countAllcolour }})</button>
                                  <button v-else class=" btn btn-default"
                                  style="opacity:4" id="edit-show-colors-link" name="show_colors_link"
                                  :value="selectedName" type="button" @click="fetchCategories(cpalette, $event)">See only popular colours({{ popularColorCount }})</button>
                              </span></p>
                            <div id="popular-colors-list" class="focus-outline">
                              <div class="solr-pure-color-list" v-for="(ccategory, ind) in ccategories" :key="ind">
                                <div class="solr-pure-color-name">
                                 
                                  <h2 style="margin-top:15px !important;margin-bottom:10px !important;" class="color-type">{{ ccategory.category_name }}</h2>
                                  <!-- {width: local_products.length == 1 ? '250px !important' : '100%'}" -->
                                </div>
                                <div v-if="ccategory.product_colours.length > 0">
                                  <div class="rowBox col-xs-3 col-sm-2 col-md-2 col-lg-2" v-for="(ccolor, index) in ccategory.product_colours" :key="index">
                                    <a class="color-box-child  color-box-child-1190594 colorBox-processed flourish_google_tag_manager-processed" data-toggle="modal" :data-target="'#colorModal'+ccolor.id"
                                            :style="{background:ccolor.colour_code}" :data-title="ccolor.colour_name" :alt="ccolor.colour_name">
                                      <p class="cnme color-text" >{{ ccolor.colour_name }}</p>
                                    </a>
                                    <div>
                                    <ColorModal :ccolor="ccolor" :ccategory="ccategory" :cpalette="cpalette"/>
                                  </div>
                                  </div>
                                  
                                </div>
                                <div v-else>
                                  <h4 align="center">No Colour is found </h4>
                                  <br><br><br><br>

                                </div>
                                
                              </div>
                            </div>
                            <div v-if="!hidePopular" class="color-lister-bottom-new colors-listing-box-bottom focus-outline"><h2>I can't find the right colour</h2>
                              <button v-if="isSeeAll" data-link="popular" class="btn-normal-curve sub-color-tab use-ajax btn btn-default form-submit ajax-processed flourish_google_tag_manager-processed" style="opacity:4" id="edit-show-right-colors--2" @click="seeAllColours(palette_id)" type="button" tabindex="316">See all colours ({{ countAllcolour }})</button> 
                              <button v-else data-link="popular" class="btn-normal-curve sub-color-tab use-ajax btn btn-default form-submit ajax-processed flourish_google_tag_manager-processed" style="opacity:4" id="edit-show-right-colors--2" name="show_right_colors" @click="fetchCategories(cpalette, selectedName)" type="button" tabindex="316">See only Popular colours ({{ popularColorCount }})</button>                        
                            </div>
                            </div>
                            
                            <div v-else>
                                <div class="spinner-image" role="status"></div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="spinner-image" role="status"></div>
                        </div>
                      </div>
                </div>
                </div>
            </form>

          
        </section>        
    </div>
</div>


        



        </section>
      </div>
    </div>
    
  </div>

  <div class="" v-else>
    <div class="spinner-image" role="status"></div>
  </div>
</section>

<!-- end of modal -->
</template>
<!-- <div
        class="spinner-image"
        style="width: 10rem; height: 10rem;position:fixed;top:50%;left:50%"
        role="status"
      >
      </div> -->
<style>
#modal-center:last-of-type{
  /* display: none !important; */
}
.bp-dropdown__body{
  top: 65px;
  width: 15rem;
    padding: 2rem;
    font-size: 12px;
      position: fixed !important;
      /* display: none; */

}
.btn-normal-curve {
    border: 2px solid #2FC48D !important;
    border-radius: 0 10px !important;
}
.my-class-bp__btn{
  font-family: 'open_sans_regular',arial,sans-serif;
  font-weight: 600;
  font-size: 14px;
  background: #fff;
  /* display: block; */
  border-width: 0px 0px 1px 0px;
  border-style:solid;
  border-color: #e1e1e1;
  cursor: pointer;
  padding: 10px 5px 10px 20px;
  margin:auto;
  text-align: center;

}

.svg.bp-dropdown__icon.bp-dropdown__icon--bottom {
    /* padding-left: 60px; */
}
.bp-dropdown__icon {
    display: inline-block;
    width: 80px;
    height: 25px;
    overflow: visible;
    transition: transform .1s ease;

}

.my-class-bp__btn--active {
  background: #fff;
}

.my-class-bp__body {
  width: 15rem; 
  padding: 2rem; 
  font-size: 12px;
  font-weight: 500;
}

</style>


<style scoped>

    @import 'style_c_1.css';
    @import'style_c_4.css';

</style>
<script>
import Vue from 'vue';
import Dropdown from 'bp-vuejs-dropdown';
import ColorModal from '../frontend/modals/ColorModal'
import ColourFilterModal from '../frontend/modals/ColourFilterModal'

export default {
    components: { Dropdown, ColorModal, ColourFilterModal},

  data() {
    return {
      white:{
        id: 4,
      },
      isActive1: false,
      isActive2: true,
      color_box_type:'grid',
      hidePopular:false,
      toggleStage1: false,
      toggleStage2: true,
      modalClose:false,
      selectedName: 'white',
      loading:true,
      palette_id : null,
      subId:null,
      cpalettes:[],
      cpalette:null,
      pcolours:[],
      ccategories:[],
      popularColorCount:null,
      countAllcolour: null,
      loadCategories:false,
      allColours : [],
      isSeeAll:true,
      filterItems:[],
      clicked:[],
      loadFilterColour:false,
      filterColour: null,
      // categories:[],

     
    };
  },
  
  methods: {
    listView(){
      return this.color_box_type = 'list'
    },
    gridView(){
      return this.color_box_type = 'grid'
    },
    clickStageCallback(paletteId){
      this.ccategories =[]

      axios.get('/api/colour-stage-2/'+paletteId)
      .then((response) => {
        this.hidePopular = false;
        this.toggleStage2 = true
        this.toggleStage1 = false
        this.isActive1 = false,
        this.isActive2 = true,
        this.ccategories = response.data.ccategories
      })
      .catch((error)=>{

      })

    },
    clickStage2(paletteId){
      this.ccategories =[]
      this.loadCategories = true;

      if(this.loadCategories == true){
          document.getElementById("overlay").style.display = "block";
        } 
      
      axios.get('/api/colour-stage-2/'+paletteId)
      .then((response) => {
        this.hidePopular = false;
        this.toggleStage2 = true
        this.toggleStage1 = false
        this.loadCategories = false;

        this.isActive1 = false,
        this.isActive2 = true,

        this.ccategories = response.data.ccategories
      })
      .catch((error)=>{

      })
  },
  clickStage1(paletteId){
    this.ccategories =[]
    this.loadCategories = true;

    if(this.loadCategories == true){
        document.getElementById("overlay").style.display = "block";
      } 
    axios.get('/api/colour-stage-1/'+paletteId)
    .then((response) => {
      this.hidePopular = true;
      this.toggleStage1 = true
      this.toggleStage2 = false
      this.isActive1 = true,
      this.isActive2 = false,
      this.loadCategories = false;
      this.ccategories = response.data.ccategories
      
    })
    .catch((error)=>{

    })
    },
    showPopUp(){
      document.getElementsByClassName("filter-wrapper")[0].style.display = "block"
    },
    filterProductColour(pcat_id, evt) {
      this.ccategories =[]

      this.loadFilterColour = true
      
      if(this.loadFilterColour == true){
          document.getElementById("overlay").style.display = "block";
        } 
      this.filterColour = evt.target.value
        axios
        .post("/api/filter-product-colour/"+this.palette_id +"/"+ pcat_id, evt.target.value)
        .then((response) => {
              this.ccategories = response.data
              this.loadFilterColour =false
              this.popularCount(this.palette_id)
              document.getElementsByClassName("filter-wrapper")[0].style.display = "none"
        })
    },
    loadFilterCategory(id){
      axios.get('/api/category-lists/'+id)
      .then((response)=>{
        this.filterItems = response.data
      })
        .catch((error) => {});

    },
    seeAllColours(id){
      this.ccategories = []
      this.loadCategories = true;
      if(this.loadCategories == true){
        document.getElementById("overlay").style.display = "block";
      }
      setTimeout(() => { 
        axios.get('/api/see-all-colour/'+id)
        .then((response) => {
          this.ccategories = response.data.ccategories
          this.isSeeAll = !this.isSeeAll
          this.loadCategories = false;
          this.loading = false;
        })
        .catch((error)=>{
        })
      }, 2000)

    },
    countColours(id){
      axios.get('/api/count-all/'+id)
      .then((response) => {
        this.countAllcolour = response.data
      })
      .catch((error)=>{

      })
    },
    popularCount(id){
      // alert(this.filterColour)
      this.popularColorCount = null
      axios.post('/api/count-popular/'+id, {
        subId: this.filterColour
      })
      .then((response) => {
        this.popularColorCount = response.data
      })
      .catch((error)=>{
      })
    },
  fetchCategories(cpalette, evt=null){  
      // this.palette_id = typeof cpalette === 'object' ? cpalette : this.white.id
      this.cpalette = cpalette === null ? this.white : cpalette
      if(this.isSeeAll != false)
      {
        var alreadyExist = this.clicked.indexOf(cpalette.id) == -1 ? true : false
          if(!alreadyExist){
            return
          }
      }

      this.clicked = []
      this.filterColour = null
      this.palette_id = this.cpalette.id
      this.white.id = this.palette_id

      this.selectedName = evt.target ? evt.target.value  : this.selectedName
      // alert(this.selectedName)
      this.ccategories = []
      this.loadCategories = true;
      this.clicked.push(this.palette_id)
      if(this.loadCategories == true){
        document.getElementById("overlay").style.display = "block";
      } 

      setTimeout(() => {
        axios.post('/api/colour-categories/'+this.palette_id)
          .then((response) => {
            this.ccategories = response.data.ccategories
        
            // this.countColours(this.palette_id)
            this.popularCount(this.palette_id)
            this.countColours(this.palette_id)
            this.loadFilterCategory(this.palette_id)
            // this.clickStage2(this.palette_id)
            this.clickStageCallback(this.palette_id)
            this.loadCategories = false;
            this.loading = false;
            this.isSeeAll =true
          })
          .catch((error)=>{
        })
      }, 1000);
    },
    
    callback: resolve => {
      setTimeout(() => {
        console.log('I\'m called!');
        resolve(); // don't forget call resolve!
      }, 1000);
    },
    listPalettes(){
      setTimeout(() => {
      axios.get('/api/colour-palette/')
      .then((response) => {
        this.cpalettes = response.data
        this.loading = false;
      })
      .catch((error)=>{

      })
      }, 2000);
    },

    getWhite(){

      var alreadyExist = this.clicked.indexOf(this.white.id) == -1 ? true : false
      if(!alreadyExist){
        return
      }
      this.palette_id = this.white.id
      // this.white.id = id
      
      this.clicked.push(this.white.id)
      axios.post('/api/colour-categories/'+this.palette_id)
      .then((response) => {
        this.ccategories = response.data.ccategories
        // Fire.$emit('AfterCreated');
        this.popularCount(this.palette_id)
        this.countColours(this.palette_id)
        this.loadFilterCategory(this.palette_id)

      })
      .catch((error)=>{

      })
    },
  },
  watch:{
    loadFilterColour(){
      if(this.loadFilterColour==false){
        document.getElementById("overlay").style.display = "none"
      }
    },


    loading(){
      if(this.loading==false){
        document.getElementById("overlay").style.display = "none"
      }
    },

    loadCategories(){
      if(this.loadCategories==false){
        document.getElementById("overlay").style.display = "none"
      }
    },

  },
  mounted(){
// $root.$emit('bp-dropdown:hide')
  // alert(this.cpalette)
    this.listPalettes() 
    this.getWhite()
    this.loadCategories = false;
    if(this.loading==true){
      document.getElementById("overlay").style.display = "block";
    }
    this.selectedName='white'
  },
  computed: {
      changeProjectType: function () {
        return this.filterItems.filter(item => item.name)
      }
    }
};

</script>

<style scoped>


.container {
    background-color: #fcfafa;
}
.filter-wrappr  {
  height: 100vh;
  background: #fff;
  width: 100%;
  padding-top: 60px;
}

.colour-palette-wrapper {
    /* padding: 45px 20px 45px;
    background: #f4f4f4;
    margin-top: 20px; */
}

</style>