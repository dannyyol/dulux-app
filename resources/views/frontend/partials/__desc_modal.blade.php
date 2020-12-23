<!-- Descitption modal-->
<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header modal_heading">
                <h4 class="modal-title w-100" id="myModalLabel"></h4>
                <button class="btn btn-danger close-button text-white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div> -->
            <div class="modal-body  justify-content-center">
                <div id="tabs">

                    <ul class="nav nav-tabs tabs-heading " role="tablist">
                        <li class="nav-item" style="border-left: none !important;">
                            <a class="nav-link active" data-index="0" data-toggle="tab" href="#tab-0"
                                role="tab">Key Informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-index="1" data-toggle="tab" href="#tab-1"
                                role="tab">Product Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-index="2" data-toggle="tab" href="#tab-2"
                                role="tab">Documentation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-index="3" data-toggle="tab" href="#tab-3" role="tab">Tips &
                                Advice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link calculator_button" data-index="4" data-toggle="tab" href="#tab-4"
                                role="tab">Calculator</a>
                        </li>

                    </ul>
                </div>
                <div class="tab-content h-100">
                    <div class="tab-pane fade tab-style ml-3 mt-3 active show" id="tab-0" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="left-color-cart" style=""></div>
                                            <div class="mt-3">
                                                <div class="float-left">
                                                    <img src="images/dulux_images/paint-2.png" alt="" srcset=""
                                                        class="modal-before-cart-image">

                                                </div>
                                                <div class="float-right mt-2" style="width:180px !important">
                                                    <h2>{{ $product->title }}</h2>
                                                    <p><small> Hide imperfections on walls beautifully</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="key-info-desc overflow-auto" style="height:400px !important;">
                                        <h1> Tips & Advice </h1>
                                        <p><b> Preparing the Surfaces</b></p>
                                        <p> 
                                            Surfaces must be sound, clean, dry and free from all defective or poorly
                                            adhering material, dirt, grease or wax and be thoroughly rubbed down
                                            using a suitable abrasive paper and dusted off. It is important to
                                            ensure that your wall is smooth and even to obtain the best results from
                                            Dulux PureAir. If after thorough preparation, surfaces remain powdery,
                                            seal with one coat of an appropriate Primer.
                                        </p>

                                        <p> <b> Cleaning </b></p>
                                        Clean all equipment with clean water immediately after use.

                                        <p> <b> Storing</b> </p>
                                        <p> Observe the label precautions. Store in a cool, dry, well ventilated
                                        place away from sources of heat, ignition and direct sunlight. No
                                        smoking. Prevent unauthorised access. Containers which are opened should
                                        be properly resealed and kept upright to prevent leakage. Do not use or
                                        store any paint container by hanging on a hook.
                                        </p>

                                    </div>
                                </div>
                                        <div class="col-md-12 row d-flex justify-content-end mt-5">
                                            <button type="button" class="btn btn-sm btn-primary custom_button mr-3">Send Brochure</button>
                                        <!-- <div class="form-group"> -->
                                            <select id="my-select" class="form-control cart-info-select-button mr-3" name="">
                                                <option>1 Litres</option>
                                            </select>
                                            <!-- </div> -->
                                            <button type="button" class="btn btn-sm btn-success custom_button mr-3" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#centralModalSm-{{ $product->id }}">Add to Cart</button>
                                            <button class="btn btn-danger custom_button text-white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                Cancel
                                            </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-style ml-3 mt-3" id="tab-1" role="tabpanel">
                        Paint HappyTM Technology, "Truly odour free"* when freshly paintedAirfreshTM Technology, keeps air fresh after paintingWashable & easy cleaningMould & fungus resistance/Anti-bacterialColourguard technology, keeps colours looking fresh longerSmooth luxurious finishEnvironmentally preferred paint (Singapore GreenLabel certified)
                    </div>
                    <div class="tab-pane fade tab-style ml-3 mt-3" id="tab-2" role="tabpanel">2</div>
                    <div class="tab-pane fade tab-style ml-3 mt-3" id="tab-3" role="tabpanel">3</div>
                    <div class="tab-pane fade tab-style ml-3 mt-3" id="tab-4" role="tabpanel">
                            <div class="container calculator-container mx-auto">
                                <!-- <div class=""> -->
                                    <div class="calculator-box h-100">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6 mt-5" style="margin:auto; text-align:center !important;">
                                                    <p class="magintop-2"> Do you know the Area ?</p>
                                                    <button class="btn no_button"> No</button>
                                                    <button class="btn yes_button">Yes</button>
                                                    <p class="magintop-2">Enter the height and the length of the surface you want to paint</p>

                                                </div>
                                                <div class="col-md-6 calculator-">
                                                    <p class="">How much paint do I need ?</p>
                                                    <div class="form-group mt-5 calculator-input">
                                                        <small id="helpId" class="form-text text-muted"><b>Height</b> in metres</small>
                                                        <input type="text"
                                                        class="form-control" name="" id="" aria-describedby="helpId" placeholder="Enter Height">
                                                    </div>
                                                    <div class="form-group mt-5 calculator-input">
                                                        <small id="helpId" class="form-text text-muted"><b>Length</b> in metres</small>
                                                        <input type="text"
                                                        class="form-control" name="" id="" aria-describedby="helpId" placeholder="Enter Length">
                                                    </div>
                                                </div>  

                                                <div class="col-md-12 d-flex justify-content-center">
                                            
                                            <!-- </div> -->
                                                <button type="button" class="btn btn-sm btn-success custom_button mr-3" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#centralModalSm-{{ $product->id }}">Calculator</button>
                                                <button class="btn btn-danger custom_button text-white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    Cancel
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                <!-- </div> -->

                            </div>
                    </div>
                    <div class="tab-pane fade tab-style ml-3 mt-3" id="tab-5" role="tabpanel">5</div>
                </div>
                <br>
            </div>
            <!-- <div class="modal-footer">
            </div> -->
        </div>
    </div>
</div>
<!-- description Modal -->