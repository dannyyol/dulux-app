var pprice = 0.00;

function totalPrice(qty) {
    qty = qty.toString().length > 0 ? qty : 0;
    let $variant = $("input[name='variant']:checked");
    let $addons = $("input[name='addons']:checked");

    
    let vprice = $variant.length > 0 ? $variant.data('price') : 0.00;
    let total = parseFloat(pprice) + parseFloat(vprice);

    if ($addons.length > 0) {        
        $addons.each(function() {
            total += parseFloat($(this).data('price'));
        });
    }
    
    total = total.toFixed(2) * parseInt(qty);

    if ($("#productPrice").length > 0) {
        $("#productPrice").html(total.toFixed(2));
    }

    return total.toFixed(2);
}


(function ($) {
    "use strict";
    
    // ============== add to cart js start =======================//

    $(".cart-link").on('click', function (e) {
        e.preventDefault();
        let product = $(this).data('product');
        let variations = JSON.parse(product.variations);
        let addons = JSON.parse(product.addons);
        // set product current price
        pprice = product.current_price;
        
        // clear all previously loaded variations & addon input radio & checkboxes 
        $(".variation-label").addClass("d-none");
        $("#variants").html("");
        $(".addon-label").addClass("d-none");
        $("#addons").html("");

        // load variants & addons in modal if variations or addons available for this item
        if ((variations != null) || (addons != null)) {
            $("#variationModal").modal('show');
            
            // set modal title & quantity
            $("#variationModal .modal-title > span").html(product.title);
            $("input[name='cart-amount']").val(1);

            if(variations != null) {
                $(".variation-label").removeClass("d-none");

                // load variations radio button input fields
                let variants = ``;
                for (let i = 0; i < variations.length; i++) {
                    variants += `<div class="form-check d-flex justify-content-between">
                        <div>
                            <input class="form-check-input" type="radio" name="variant" id="variant${i}" value="${variations[i].name}" data-price="${variations[i].price.toFixed(2)}" ${i == 0 ? 'checked' : ''}>
                            <label class="form-check-label" for="variant${i}">
                            ${variations[i].name}
                            </label>
                        </div>
                        <span>
                            + ${textPosition == 'left' ? currText : ''} ${variations[i].price} ${textPosition == 'right' ? currText : ''}
                        </span>
                    </div>`
                }
                $("#variants").html(variants);
    
    
                // add margin top if variations available
                $(".addon-label").addClass('mt-3');
            } else {
                $(".addon-label").removeClass('mt-3');
            }

            if (addons != null) {
                $(".addon-label").removeClass("d-none");

                // load addons checkbox input fields
                let addonHtml = ``;
                for (let i = 0; i < addons.length; i++) {
                    addonHtml += `<div class="form-check d-flex justify-content-between">
                        <div>
                            <input class="form-check-input" type="checkbox" name="addons" id="addon${i}" value="${addons[i].name}" data-price="${addons[i].price.toFixed(2)}">
                            <label class="form-check-label" for="addon${i}">
                            ${addons[i].name}
                            </label>
                        </div>
                        <span>
                            + ${textPosition == 'left' ? currText : ''} ${addons[i].price} ${textPosition == 'right' ? currText : ''}
                        </span>
                    </div>`
                }
                $("#addons").html(addonHtml);
            }

            // set modal price
            totalPrice(1)
            
            $(".modal-cart-link").attr('data-product_id', product.id);

        } 
        


    });

    // ============== add to cart js end =======================//



    // ============== variant change js start =======================//
    $(document).on('change', '#variants input', function () {
        totalPrice(1);
    });
    // ============== variant change js end =======================//


    // ============== addon change js start =======================//
    $(document).on('change', '#addons input', function () {
        totalPrice(1);
    });
    // ============== addon change js end =======================//


    // ============== addon change js start =======================//
    $(document).on('input', "input[name='cart-amount']", function () {
        totalPrice(1);
    });
    // ============== addon change js end =======================//



    $(window).on('scroll', function() {
        // sticky menu activation
        if ($(window).scrollTop() > 280) {
            $('.categories-tab').addClass('sticky');
        } else {
            $('.categories-tab').removeClass('sticky');
        }
    });
}(jQuery));
