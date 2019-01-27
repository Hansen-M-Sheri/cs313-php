
// make a object of cartItem
function addItem(id, title, subtitle, price, qty, action) {

    $.post('./cart_ajax.php',
        {"id": id, "title": title, "subtitle": subtitle, "price": price, "qty": qty, "action":"add"},

        function (returnedData) {
        console.log(returnedData);

    }, 'json');
}

function removeItem(id, action){
    $.post('./cart_ajax.php',
        //{"id": id, "title": title, "subtitle": subtitle, "price": price, "qty": qty, "action":"deleteItem"},
        {"id":id, "action":'deleteItem'},
        function (returnedData) {
            console.log(returnedData);

        }, 'json');
}
//
function deleteCart(action){
    $.post('./cart_ajax.php',
        //{"id": id, "title": title, "subtitle": subtitle, "price": price, "qty": qty, "action":"deleteCart"},
        {"action":action},
        function (returnedData) {
            console.log(returnedData);

        }, 'json');
}


 