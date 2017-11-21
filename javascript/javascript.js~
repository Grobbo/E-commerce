function search_request() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);	
			document.getElementById("test").innerHTML = itemize_list(rjson);
		}
	}
	xhttp.open("GET", "php/handle_request.php?search_string="
	+ document.getElementById("search_string").value
	+"&criteria="+document.getElementById("criteria").value
	,true);
	xhttp.send();

}

function itemize_list(list){
 
	var string = build_top_menu();
	for(index = 0;index < list.length; ++index){
		string += '<div class="item_container" onclick="say_hello('+list[index].id+')"' + list[index].id + '>' + 
		'<div class="item_text"> <p>' + list[index].manufacturer+ '</div>' + 
		'<div class="item_text"> <p>' + list[index].category + '</div>' +
		'<div class="item_text"> <p>' + list[index].description + '</div>' +
		'<div class="item_text"> <p>' + list[index].price + '</div>' +
		build_add_to_cart_button(list[index].id)+ '</div><br>'; 
	}
	return string;		
}

function build_top_menu(){
	return '<div class="item_div"><div class="item_text"><p>Manufacturer</p></div><div class="item_text"><p>Category</p></div><div class="item_text"><p>Description</p></div><div class="item_text"><p>Price</p></div></div>';
}


//need to be processed
function build_add_to_cart_button (id){
	return '<div class="item_text"><form action="php/cart.php" method="POST"><input name="product_id" type="hidden" value="' + id +'"/><button class="add_button" type="submit">Add to Cart</button></form></div>';
}

function say_hello(id){
	console.log("Item ID "+ id);
}
