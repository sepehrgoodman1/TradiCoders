/* Set rates + misc */
var taxRate = 0.05;
var shippingRate = 15.00;
var fadeTime = 300;


/* Assign actions */
$('.product-quantity input').change(function () {
    updateQuantity(this);
});

$('.product-removal button').click(function () {
    removeItem(this);
});




/* Recalculate cart */
function recalculateCart() {
    var subtotal = 0;

    /* Sum up row totals */
    $('.product').each(function () {
        try {
            subtotal += parseInt(fixNumbers($(this).children('.product-line-price').text()));
        }catch (e) {
            console.log(e);
        }
    });

    /* Calculate totals */
    var total = subtotal;

    /* Update totals display */
    $('.totals-value').fadeOut(fadeTime, function () {
        $('#cart-total').html(total);
        if (total == 0) {
            // $('.checkout').fadeOut(fadeTime);
        } else {
            $('.checkout').fadeIn(fadeTime);
        }
        $('.totals-value').fadeIn(fadeTime);
    });
}


function fixNumbers(str) {
    arabicNumbers = ["٠","١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    persianNumbers = ["۰","۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    if (typeof str === 'string') {
        for (var i = 0; i < 10; i++) {
            str = str.replaceAll(persianNumbers[i], i).replaceAll(arabicNumbers[i], i);
        }
    }
    return str;
}

/* Update quantity */
function updateQuantity(quantityInput) {
    /* Calculate line price */
    var productRow = $(quantityInput).parent().parent();
    var price = fixNumbers(productRow.children('.product-price').text());
    var quantity = $(quantityInput).val();
    var linePrice = price * quantity;
    var orderid = quantityInput.id;

    /* Update line price display and recalc cart totals */
    productRow.children('.product-line-price').each(function () {
        $(this).fadeOut(fadeTime, function () {
            $(this).text(linePrice);
            recalculateCart();
            var data = "request=updateOrder&orderId=" + orderid+"&count="+quantity;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // alert(this.responseText);
                }
            };

            xmlhttp.open("GET", "../../ajaxcenter.php?" + data, true);
            xmlhttp.send();


            $(this).fadeIn(fadeTime);
        });
    });
}


/* Remove item from cart */
function removeItem(removeButton) {
    /* Remove row from DOM and recalc cart total */
    var productRow = $(removeButton).parent().parent();
    productRow.slideUp(fadeTime, function () {
        var orderid = removeButton.id;
        productRow.remove();
        recalculateCart();

        var data = "request=removeOrder&orderId=" + orderid;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // alert(this.responseText);
            }
        };

        xmlhttp.open("GET", "../../ajaxcenter.php?" + data, true);
        xmlhttp.send();
    });
}

function showTab(tabId){
    document.getElementById('paid').style.display = "none";
    document.getElementById('shopping').style.display = "none";
    document.getElementById(tabId).style.display = "block";
}

const TypePay = document.querySelectorAll('.TypeOfPayement');
var j = 0;

for (let i = 0; i < TypePay.length; i++) {
    TypePay[i].addEventListener('click', ()=>{
        TypePay.forEach((button) => {
            button.classList.remove("Active_Pay");
          });
      
          TypePay[i].classList.add("Active_Pay");
    })
    
}