@extends('frontend.layouts.master')
@section('body')
@includeIf('frontend.partials.__style1')
<div class="page-products-listing page-products-listing-all plp-color-selected flSearchClick-processed">
    <div id="zone-content" class="zone-content focus-outline">
        <div class="main-container container focus-outline">

            <!-- /#page-header -->
            <div class="row focus-outline">
                <section class="col-sm-12 focus-outline">
                    <!--   -->
                    <a id="main-content"></a>
                    <div class="region region-content focus-outline">
                        <div id="full-form-wrapper" class="focus-outline">
                            <section id="block-system-main"
                                class="block block-system block--system-main clearfix focus-outline" role="navigation">


                                    <div class="focus-outline"><button style="display:none" id="edit-filters-reset-link"
                                            name="filters_reset_link" value="Reset Filters" type="button"
                                            class="btn btn-default form-submit ajax-processed" tabindex="22">Reset
                                            Filters</button>
                                        <button style="display:none" id="edit-product-type-filters-reset-link"
                                            name="product_type_filters_reset_link" value="Reset Product Type Filters"
                                            type="button" class="btn btn-default form-submit ajax-processed"
                                            tabindex="23">Reset Product Type Filters</button>
                                        <button style="display:none" id="edit-room-type-filters-reset-link"
                                            name="room_type_filters_reset_link" value="Reset Room Type Filters"
                                            type="button" class="btn btn-default form-submit ajax-processed"
                                            tabindex="24">Reset Room Type Filters</button>
                                        <button style="display:none" id="edit-surface-usage-filters-reset-link"
                                            name="surface_usage_filters_reset_link" value="Reset Surface Usage Filters"
                                            type="button" class="btn btn-default form-submit ajax-processed"
                                            tabindex="25">Reset Surface Usage Filters</button>
                                        <button style="display:none" id="edit-finish-filters-reset-link"
                                            name="finish_filters_reset_link" value="Reset Finish Filters" type="button"
                                            class="btn btn-default form-submit ajax-processed" tabindex="26">Reset
                                            Finish Filters</button>

                                        <div id="product-listing-filters-wrapper" class="focus-outline">
                                            <div class="row plp-color-bar-show">
                                                <div class="col-sm-12">
                                                    <div class="clearfix">
                                                        <a class="swatch-close vr-margin-top-4 right close-color"
                                                            data-close="#swatch-bar"
                                                            tabindex="27">
                                                            {{-- <svg class="icon icon-close">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/svgsprite/sprite.svg#icon-close">
                                                                </use>
                                                            </svg> --}}
                                                        </a>
                                                    </div>
                                                    <div id="swatch-bar"
                                                        class="swatch-bar squircle vr-margin-top-1 color-text"
                                                        data-rgb="F4F0E4"
                                                        style="background-color: rgb(244, 240, 228); color: rgb(102, 102, 102); stroke: rgb(102, 102, 102);">
                                                        <p class="h4 plp-color-name">Crisp Linen 61yy 89/040</p>
                                                        <a class="inline-text-link pick-a-colour change-color color-text"
                                                            data-rgb="F4F0E4" tabindex="28"
                                                            style="color: rgb(102, 102, 102); stroke: rgb(102, 102, 102);">
                                                            Change this colour
                                                            {{-- <svg class="icon icon-arrow-right ">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/svgsprite/sprite.svg#icon-arrow-right">
                                                                </use>
                                                            </svg> --}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="product-listing-filters fl-equi-height-container vr-margin-top-7 focus-outline">

                                                <div class="row focus-outline">
                                                    <div class="col-md-3">
                                                        <div id="filter-wrapper-plp"
                                                            class="filter-wrapper filter-wrapper-plp">
                                                            <div class="title-section hidden-sm-up">
                                                                <h2 class="text-center">Filters</h2>
                                                                {{-- <svg class="icon icon-close right">
                                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/svgsprite/sprite.svg#icon-close">
                                                                    </use>
                                                                </svg> --}}
                                                            </div>
                                                            <div class="title-section hidden-sm-down">
                                                                <h2 class="h5">Filters</h2>
                                                                <a href="javascript:void(0)"
                                                                    class="filter-reset inline-text-link primary btn-clear"
                                                                    tabindex="29" style="display: none;">Clear all</a>
                                                            </div>
                                                            <div class="clp-wrap collapse-wrap general">
                                                                <div class="form-collapse collapse-area visible"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="collapse-trigger general-collapse-trigger-processed">
                                                                        Location <span
                                                                            class="count-label input-counter">0</span>
                                                                        {{-- <svg class="icon icon-collapse-arrow right">
                                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/svgsprite/sprite.svg#icon-collapse-arrow">
                                                                            </use>
                                                                        </svg> --}}
                                                                    </div>
                                                                    <div class="collapse-content amountCount"
                                                                        style="display: block;">
                                                                    </div>
                                                                </div>


                                                                <div class="col-sm-4 accordion" id="accordionExample">



                                                                </div>
                                                                <div class="form-collapse collapse-area visible"
                                                                    style="order:;-webkit-order:;">
                                                                    <div
                                                                        class="collapse-trigger general-collapse-trigger-processed">
                                                                        Project Type <span
                                                                            class="count-label input-counter">0</span>
                                                                        {{-- <svg class="icon icon-collapse-arrow right">
                                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                xlink:href="/profiles/flourish/themes/custom/flourish_rem/images/svg/svgsprite/sprite.svg#icon-collapse-arrow">
                                                                            </use>
                                                                        </svg> --}}
                                                                    </div>
                                                                    <div class="collapse-content amountCount"
                                                                        style="display: block;">
                                                                        <div
                                                                            class="form-type-radios form-item-product-room-type form-item form-group append-outline-processed">
                                                                            <div id="edit-product-room-type"
                                                                                class="form-radios product-room-types">
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="All" type="radio"
                                                                                        id="edit-product-room-type-all"
                                                                                        name="product_room_type"
                                                                                        value="All" checked="checked"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="39"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-all">All
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="Bathroom"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-bathroom"
                                                                                        name="product_room_type"
                                                                                        value="Bathroom"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="40"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-bathroom">Bathroom
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="Bedroom"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-bedroom"
                                                                                        name="product_room_type"
                                                                                        value="Bedroom"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="41"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-bedroom">Bedroom
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input
                                                                                        data-label="Children&#39;s room"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-childrens-room"
                                                                                        name="product_room_type"
                                                                                        value="Children&#39;s room"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="42"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-childrens-room">Children's
                                                                                        room </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="Dining room"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-dining-room"
                                                                                        name="product_room_type"
                                                                                        value="Dining room"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="43"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-dining-room">Dining
                                                                                        room </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Hallway"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-hallway"
                                                                                        name="product_room_type"
                                                                                        value="Hallway"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="44"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-hallway">Hallway
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Kitchen"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-kitchen"
                                                                                        name="product_room_type"
                                                                                        value="Kitchen"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="45"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-kitchen">Kitchen
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Living room"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-living-room"
                                                                                        name="product_room_type"
                                                                                        value="Living room"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="46"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-living-room">Living
                                                                                        room </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-room-type form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Study room"
                                                                                        type="radio"
                                                                                        id="edit-product-room-type-study-room"
                                                                                        name="product_room_type"
                                                                                        value="Study room"
                                                                                        class="form-radio ajax-processed PLPproductLocationChange-processed"
                                                                                        tabindex="47"> <label
                                                                                        class="option"
                                                                                        for="edit-product-room-type-study-room">Study
                                                                                        room </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                                                                                            </div>
                                                                </div>
                                                                <div class="form-collapse collapse-area visible"
                                                                    style="order:;-webkit-order:;">
                                                                    <div
                                                                        class="collapse-trigger general-collapse-trigger-processed">
                                                                        Surface <span
                                                                            class="count-label input-counter">0</span>
                                                                        
                                                                    </div>
                                                                    <div class="collapse-content amountCount"
                                                                        style="display: block;">
                                                                        <div
                                                                            class="form-type-checkboxes form-item-product-surface-usage form-item form-group append-outline-processed">
                                                                            <div id="edit-product-surface-usage"
                                                                                class="form-checkboxes product-surface-usage">
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Ceilings form-item checkbox append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="Ceilings"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-ceilings"
                                                                                        name="product_surface_usage[Ceilings]"
                                                                                        value="Ceilings"
                                                                                        class="form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        tabindex="50"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-ceilings">Ceilings
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Doors form-item checkbox append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="Doors"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-doors"
                                                                                        name="product_surface_usage[Doors]"
                                                                                        value="Doors"
                                                                                        class="form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        tabindex="51"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-doors">Doors
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Ferrous-metals form-disabled form-item checkbox append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input
                                                                                        class="disable-filter form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        data-label="Ferrous metals"
                                                                                        disabled="1" type="checkbox"
                                                                                        id="edit-product-surface-usage-ferrous-metals"
                                                                                        name="product_surface_usage[Ferrous metals]"
                                                                                        value="Ferrous metals"
                                                                                        tabindex="52"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-ferrous-metals">Ferrous
                                                                                        metals </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Floors form-disabled form-item checkbox append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input
                                                                                        class="disable-filter form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        data-label="Floors" disabled="1"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-floors"
                                                                                        name="product_surface_usage[Floors]"
                                                                                        value="Floors" tabindex="53">
                                                                                    <label class="option"
                                                                                        for="edit-product-surface-usage-floors">Floors
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Metal form-item checkbox append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="Metal"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-metal"
                                                                                        name="product_surface_usage[Metal]"
                                                                                        value="Metal"
                                                                                        class="form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        tabindex="54"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-metal">Metal
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Non-Ferrous-Metal form-disabled form-item checkbox append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input
                                                                                        class="disable-filter form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        data-label="Non-Ferrous Metal"
                                                                                        disabled="1" type="checkbox"
                                                                                        id="edit-product-surface-usage-non-ferrous-metal"
                                                                                        name="product_surface_usage[Non-Ferrous Metal]"
                                                                                        value="Non-Ferrous Metal"
                                                                                        tabindex="55"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-non-ferrous-metal">Non-Ferrous
                                                                                        Metal </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Roofs form-disabled form-item checkbox append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input
                                                                                        class="disable-filter form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        data-label="Roofs" disabled="1"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-roofs"
                                                                                        name="product_surface_usage[Roofs]"
                                                                                        value="Roofs" tabindex="56">
                                                                                    <label class="option"
                                                                                        for="edit-product-surface-usage-roofs">Roofs
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Walls form-item checkbox append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Walls"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-walls"
                                                                                        name="product_surface_usage[Walls]"
                                                                                        value="Walls"
                                                                                        class="form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        tabindex="57"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-walls">Walls
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Windows form-item checkbox append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Windows"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-windows"
                                                                                        name="product_surface_usage[Windows]"
                                                                                        value="Windows"
                                                                                        class="form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        tabindex="58"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-windows">Windows
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-checkbox form-item-product-surface-usage-Wood form-item checkbox append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Wood"
                                                                                        type="checkbox"
                                                                                        id="edit-product-surface-usage-wood"
                                                                                        name="product_surface_usage[Wood]"
                                                                                        value="Wood"
                                                                                        class="form-checkbox ajax-processed PLPproductSurfaceChange-processed"
                                                                                        tabindex="59"> <label
                                                                                        class="option"
                                                                                        for="edit-product-surface-usage-wood">Wood
                                                                                    </label>

                                                                                    <span
                                                                                        class="checkbox-outline"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="form-collapse collapse-area visible"
                                                                    style="order:;-webkit-order:;">
                                                                    <div
                                                                        class="collapse-trigger general-collapse-trigger-processed">
                                                                        Finish <span
                                                                            class="count-label input-counter">0</span>
                                                                        
                                                                    </div>
                                                                    <div class="collapse-content amountCount"
                                                                        style="display: block;">
                                                                        <div
                                                                            class="form-type-radios form-item-product-finish form-item form-group append-outline-processed">
                                                                            <div id="edit-product-finish"
                                                                                class="form-radios product-finish">
                                                                                <div class="form-type-radio form-item-product-finish form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="All" type="radio"
                                                                                        id="edit-product-finish-all"
                                                                                        name="product_finish"
                                                                                        value="All" checked="checked"
                                                                                        class="form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        tabindex="62"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-all">All
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-disabled form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input
                                                                                        class="disable-filter form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        data-label="Featured finishes"
                                                                                        disabled="1" type="radio"
                                                                                        id="edit-product-finish-featured-finishes"
                                                                                        name="product_finish"
                                                                                        value="Featured finishes"
                                                                                        tabindex="63"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-featured-finishes">Featured
                                                                                        finishes </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="High gloss"
                                                                                        type="radio"
                                                                                        id="edit-product-finish-high-gloss"
                                                                                        name="product_finish"
                                                                                        value="High gloss"
                                                                                        class="form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        tabindex="64"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-high-gloss">High
                                                                                        gloss </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input
                                                                                        data-label="High gloss finish"
                                                                                        type="radio"
                                                                                        id="edit-product-finish-high-gloss-finish"
                                                                                        name="product_finish"
                                                                                        value="High gloss finish"
                                                                                        class="form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        tabindex="65"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-high-gloss-finish">High
                                                                                        gloss finish </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-item radio append-outline-processed"
                                                                                    style="display: block;">
                                                                                    <input data-label="Low Sheen"
                                                                                        type="radio"
                                                                                        id="edit-product-finish-low-sheen"
                                                                                        name="product_finish"
                                                                                        value="Low Sheen"
                                                                                        class="form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        tabindex="66"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-low-sheen">Low
                                                                                        Sheen </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Matt"
                                                                                        type="radio"
                                                                                        id="edit-product-finish-matt"
                                                                                        name="product_finish"
                                                                                        value="Matt"
                                                                                        class="form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        tabindex="67"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-matt">Matt
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-disabled form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input
                                                                                        class="disable-filter form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        data-label="Satin Finish"
                                                                                        disabled="1" type="radio"
                                                                                        id="edit-product-finish-satin-finish"
                                                                                        name="product_finish"
                                                                                        value="Satin Finish"
                                                                                        tabindex="68"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-satin-finish">Satin
                                                                                        Finish </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input data-label="Semi-gloss"
                                                                                        type="radio"
                                                                                        id="edit-product-finish-semi-gloss"
                                                                                        name="product_finish"
                                                                                        value="Semi-gloss"
                                                                                        class="form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        tabindex="69"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-semi-gloss">Semi-gloss
                                                                                    </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                                <div class="form-type-radio form-item-product-finish form-disabled form-item radio append-outline-processed"
                                                                                    style="display: none;">
                                                                                    <input
                                                                                        class="disable-filter form-radio ajax-processed PLPproductFinishChange-processed"
                                                                                        data-label="Smooth Gloss"
                                                                                        disabled="1" type="radio"
                                                                                        id="edit-product-finish-smooth-gloss"
                                                                                        name="product_finish"
                                                                                        value="Smooth Gloss"
                                                                                        tabindex="70"> <label
                                                                                        class="option"
                                                                                        for="edit-product-finish-smooth-gloss">Smooth
                                                                                        Gloss </label>

                                                                                    <span class="radio-outline"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- collapse-wrap -->
                                                        </div>
                                                        <div class="results-bar">
                                                            
                                                            <button id="filter_results_btn"
                                                                class="bttn primary bttn-auto-width pull-right"
                                                                tabindex="74">Show <span>10</span> results</button>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="product-listing-markup-wrapper col-md-9 view-content focus-outline">

                                                        <div class="col-sm-12 focus-outline">
                                                            <h1 class=" h2 vr-margin-bottom-0 focus-outline">Find the
                                                                products for your project</h1>
                                                            
                                                            <div class="product-listing-information focus-outline">
                                                                <div
                                                                    class="product-amount vr-padding-vertical-4 focus-outline">
                                                                    <span>10</span> Products found</div>
                                                                <section class="filtering">
                                                                    <div class="filter-zone">
                                                                        <div
                                                                            class="icon-plus-text ipt-icon-settings right ">
                                                                            Filters 
                                                                            
                                                                        </div> <span
                                                                            class="count-label totalInputCount">0</span>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    
                                                                </section>
                                                            </div>
                                                            {{-- <div class="float-right">
                                                                <i class="fa fa-cart-arrow-down" aria-hidden="true">test</i>
                                                            </div> --}}
                                                            
                                                            <div
                                                                class="filter-section bar-desktop vr-padding-vertical-4">
                                                                <div class="bar-title">My filters</div>
                                                                <div id="filter-selections" class="filter-labels"></div>
                                                                
                                                            </div>

                                                            <div class="onedomain-component">
                                                                <div class="row">
                                                                    <div
                                                                        class="view view-product-listing-solr view-id-product_listing_solr view-display-id-page_6 view-product-Listing view-dom-id-dbee5394231560ecc1c715efb72377e4">
                                                                        <div class="view-header">
                                                                            <p class="h1 fl-prod-page-header">10
                                                                                Products found</p>
                                                                        </div>



                                                                        <div class="view-content">
                                                                            <div class="row vr-margin-top-7">
                                                                                @foreach ($data as $product)
                                                                                    {{-- @dd($product) --}}
                                                                                <div class="col-xs-12 col-md-4">
                                                                                    <div class="product-card-container">
                                                                                        <section
                                                                                            class="product-card js-product-card">
                                                                                            <div
                                                                                                class="product-card__underlay">
                                                                                            </div>


                                                                                            <span id="75731"
                                                                                                class=" scrap-book-add-product focus-outline product-card__button js-notify icon-heart js-toggle-class"
                                                                                                data-type="product"
                                                                                                data-categorytype="Paint"
                                                                                                data-globalid="4e35006f-b542-4ceb-8815-a40a00fa4db1"
                                                                                                data-colorid=""
                                                                                                data-colorcollection=""
                                                                                                data-colorname=""
                                                                                                data-tc-class="active">
                                                                                                <span
                                                                                                    class="icon-heart-empty">
                                                                                                    
                                                                                                </span>
                                                                                                <span
                                                                                                    class="icon-heart-filled">

                                                                                                    
                                                                                                </span>
                                                                                            </span>
                                                                                            <a class="product-card__link"
                                                                                                title="Dulux PureAir">

                                                                                                <article
                                                                                                    class="product-card__content ">
                                                                                                    <p class="product-card__title js-product-card-title"
                                                                                                        style="height: 24px;">
                                                                                                        {{ $product->title }}
                                                                                                    </p>
                                                                                                    <div
                                                                                                        class="product-card__image-wrapper">
                                                                                                        <div
                                                                                                            class="product-card__image">
                                                                                                            <img src="{{asset('assets/front/img/product/featured/'.$product->feature_image)}}" alt="menu">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <ul
                                                                                                        class="icon-list product-card__features">

                                                                                                        <li>
                                                                                                            <span
                                                                                                                class="check-mark">
                                                                                                            </span>
                                                                                                            <span>
                                                                                                                Paint
                                                                                                                HappyTM
                                                                                                                Technology,
                                                                                                                "Truly
                                                                                                                odour
                                                                                                                free"*
                                                                                                                when
                                                                                                                freshly
                                                                                                                painted
                                                                                                            </span>
                                                                                                        </li>

                                                                                                        <li>
                                                                                                            <span>
                                                                                                                
                                                                                                            </span>
                                                                                                            <span>
                                                                                                                AirfreshTM
                                                                                                                Technology,
                                                                                                                keeps
                                                                                                                air
                                                                                                                fresh
                                                                                                                after
                                                                                                                painting
                                                                                                            </span>
                                                                                                        </li>

                                                                                                        <li>
                                                                                                            <span>
                                                                                                                
                                                                                                            </span>
                                                                                                            <span>
                                                                                                                Washable
                                                                                                                &amp;
                                                                                                                easy
                                                                                                                cleaning
                                                                                                            </span>
                                                                                                        </li>
                                                                                                    </ul>


                                                                                                </article>
                                                                                            </a>
                                                                                            <div class="container product-card-bottom"
                                                                                                style="">

                                                                                                <div class="row mb-2">
                                                                                                    <div
                                                                                                        class="col-sm-6">
                                                                                                        <div class="">
                                                                                                            <select
                                                                                                                id="my-select"
                                                                                                                class="form-control select_dropdown"
                                                                                                                name=""
                                                                                                                style="">
                                                                                                                <option>
                                                                                                                    1
                                                                                                                    Litres
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="col-sm-6 d-flex justify-content-end">
                                                                                                        <div
                                                                                                            class="form-goup">
                                                                                                            <input
                                                                                                                class="form-control price_input"
                                                                                                                type="text"
                                                                                                                name=""
                                                                                                                value= '${{ $product->current_price }}'
                                                                                                                disabled>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-12">
                                                                                                    <a
                                                                                                        class="btn-more-info btn btn-success mb-2 btn-lg"
                                                                                                        data-toggle="modal"
                                                                                                        data-target="#centralModalSm">More
                                                                                                        info
                                                                                                    </a>
                                                                                                </div>

                                                                                                {{-- desc modal --}}
                                                                                                @includeIf('frontend.partials.__desc_modal')
                                                                                                {{-- end of desc modal --}}
                                                                                                <div class="col-sm-12">
                                                                                                      {{-- <p v-text="message"> </p> --}}
                                                                                                    <a class="btn-add-cart btn btn-success btn-lg add_to_cart_button"
                                                                                                        data-toggle="modal"
                                                                                                        data-target="#centralModalSm-{{ $product->id }}">
                                                                                                        <span class="d-block" @click.prevent="addToCart( {{ $product->id }} )">{{__('Add to Cart')}}</span>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>

                                                                                        </section>
                                                                                    </div>
                                                                                </div>
                                                                                {{-- cart modal --}}
                                                                                @includeIf('frontend.partials.__cart_modal')
                                                                                {{-- end Cart modal ends here --}}

                                                                                <!-- Enter Details modal-->
                                                                                @includeIf('frontend.partials.__enter_detail_modal')
                                                                                <!-- end of Enter details Modal -->
                                                                                @endforeach

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="form_build_id"
                                            value="form-AxWHMqpphH8baegmOgMNlss6JFPxe1xLU3oFp9tAEoo" tabindex="97">
                                        <input type="hidden" name="form_id"
                                            value="flourish_product_listing_filters_solr_form" tabindex="98">
                                    </div>
                            </section>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
</div>

@endsection

@section('vuescripts')
    <script>
        window.Fire = new Vue();
        var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!',
            carts:[],
            loading:true,
            disabledDecrement: 'disabled'
        },
        
        methods: {
            cartQty(){
                let sum = 0;
                for(let i = 0; i < this.carts.length; i++){
                    sum += (parseFloat(this.carts[i].product_quantity));
                    console.log(i++);
                }
                return sum;
            },
            cartSubtotal(){
                let sum = 0;
                for(let i = 0; i < this.carts.length; i++){
                sum += (parseFloat(this.carts[i].product_quantity) * parseFloat(this.carts[i].product_price));
                }
            return sum;
            },
             isEmpty(obj) {
                for(var cart in carts) {
                    if(carts.hasOwnProperty(cart)) {
                    return false;
                    }
                }
                return JSON.stringify(carts) === JSON.stringify({});
            },
            disabledDecrementButton(){
                if(!this.carts.product_quantity >= 2){
                    return this.disabledDecrementButton
                }
            },
            addToCart(id){
                // alert(id)
                axios.post('/api/add-to-cart/'+id)
                .then((response)=>{
                    console.log(response)
                    this.loading = false
                    Fire.$emit('AfterCreated');
                })
                .catch((error)=>{
                    // console.log(error.data)
                })
                this.message = this.message.split('').reverse().join('')
            },

            cartProducts(){
                axios.get('/api/cart-lists/')
                .then(({data}) => (this.carts = data))
                .catch((error)=>{
                    // console.log(error.data)
                })
                this.message = this.message.split('').reverse().join('')
            },
            incrementQty(id){
                axios.get('/api/increment-cart/'+id)
                .then(() => {
                    Fire.$emit('AfterCreated');
                })
                .catch()
            },

            decrementQty(id){
                axios.get('/api/decrement-cart/'+id)
                .then(() => {
                    Fire.$emit('AfterCreated');
                })
                .catch()
            },

            removeCartItem(id){
                axios.get('/api/remove-cart/'+id)
                .then(() => {
                    Fire.$emit('AfterCreated');
                })
                .catch()
            },
            clearCartItems(){
                axios.post('/api/clear-cart/')
                .then(() => {
                    Fire.$emit('AfterCreated');
                })
                .catch()
            },
            
        },
        
        mounted(){
            Fire.$on('AfterCreated', () => {
            this.loading = false
            this.cartProducts()
            // this.incrementQty()
            });
        }
    })
    </script>
@endsection


