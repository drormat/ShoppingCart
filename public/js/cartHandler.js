/**
 * Created by drormatalon on 2/14/16.
 */
(function( cartHandler, $, undefined ) {


    cartHandler.fillCartList = function() {
        $.ajax({
            url: root + '/api/cart',
            type: 'GET',
            dataType: 'json',
            error: function () {
            },
            success: function (res) {
                var cartList = $('#cart-list');

                if (typeof cartList !== 'undefined') {

                    var cartItems = res.data;
                    if (cartItems) {
                        cartList.append("<li class='item-list'><span class='item-name'><b>Product Name</b></span><span class='item-amount'><b>Amount</b></span></li>");
                        for (cartItem in cartItems) {
                            cartList.append(cartListItemBuilder(cartItems[cartItem].product_id,cartItems[cartItem].name, cartItems[cartItem].amount));
                        }
                    }
                }
            }
        });

    }
    cartHandler.addToCart = function(id,name){
        $.ajax({
            url: root + '/api/cart/create?itemID='+id+'&itemName='+name,
            type: 'GET',
            dataType: 'json',
            error: function () {
            },
            success: function (res) {
                var cartList = $('#cart-list');

                if (typeof cartList !== 'undefined') {

                    var cartItem = res.data;
                    if (cartItem) {

                        var listItem = cartList.find('#'+cartItem.product_id);
                        if(listItem.length > 0)
                        {
                            listItem.find('.item-amount').text(cartItem.amount);
                        }
                        else
                        {
                            cartList.append(cartListItemBuilder(cartItem.product_id, cartItem.name, cartItem.amount));
                        }

                    }
                }
            }
        });
    }

    cartHandler.removeFromCart = function(id,refresh){
        $.ajax({
            url: root + '/api/cart/destroy?itemID='+id,
            type: 'DELETE',
            dataType: 'json',
            error: function () {
            },
            success: function (res) {
                var cartList = $('#cart-list');

                if (typeof cartList !== 'undefined') {

                    var cartItem = res.data;
                    if (cartItem) {

                        var listItem = cartList.find('#'+cartItem.product_id);
                        if(listItem.length > 0)
                        {
                            if(listItem.find('.item-amount').text() === '1')
                            {
                                listItem.remove();
                            }
                            else {
                                listItem.find('.item-amount').text(cartItem.amount);
                            }

                            if(refresh){
                                window.location.replace(root+"/cartitems/checkout");

                            }
                        }

                    }
                }
            }
        });
    }


    function cartListItemBuilder(id,name, amount) {
        return "<li  class='item-list' id='"+id+"'>" +
            "<span class='item-name'>" + name + "</span>" +
            "<span class='item-amount'>" + amount + "</span>" +
            "<a class='remove-btn' onclick='cartHandler.removeFromCart("+id+")'>X</a></li>";
    }
}( window.cartHandler = window.cartHandler || {}, jQuery ));
