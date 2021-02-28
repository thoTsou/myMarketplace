function changeTotal(price, operator, count) {
    //alert(price+" "+operator+" "+count);

    var cartTotal = parseFloat(document.getElementById('cartTotal').innerHTML);

    //alert(cartTotal);



    var input = parseInt(document.getElementById('pQuantity'+count).value);
    //alert(input);

    if (operator === '+') {
        document.getElementById('pQuantity'+count).value = input + 1;
        cartTotal = cartTotal + price;
    } else {
        document.getElementById('pQuantity'+count).value = input - 1;
        cartTotal = cartTotal - price;
    }



    document.getElementById('cartTotal').innerHTML = cartTotal;

}