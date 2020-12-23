<div class="modal fade" id="centralModalSm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <form action="{{ url('save/review') }}" method="POST">
        @csrf
        <div class="modal-dialog w-100 modal-lg " role="document">
            <div class="modal-content modal_content">
                <div class="modal-header cart_heading">
                    <h3 class="modal-title w-100 my-auto" id="myModalLabel">Go Paperless, Enter your Details</h3>
                    <button class="btn btn-danger custom_button cart_close_button text-white" type="button"
                        class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-left">X</span> Close
                    </button>

                </div>
                <div class="modal-body">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-8 details-input">
                                <div class="form-group">
                                    <input type="text" name="name" id="" class="form-control" placeholder="Name"
                                        aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phonenumber" id="" class="form-control"
                                        placeholder="Phone No" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" id="" class="form-control" placeholder="Email"
                                        aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                    <textarea id="my-textarea" class="form-control" name="comment" rows="3"
                                        placeholder="How is your experience ?"></textarea>
                                </div>

                            </div>

                            <div class="col-md-4 my-auto enter_detail_total_price" style="text-align:center !important">
                                <h2> Total Price:</h2>
                                <h1> $22.00 </h1>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm custom_button clear-button">Clear</button>
                    <input type="submit" class="btn btn-sm custom_button checkout-button"
                        style="padding-top:7px !important;" value="Confirm & Pay">
                </div>
            </div>
        </div>
    </form>
</div>
