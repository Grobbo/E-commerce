function add_to_cart(id){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);
			build_cart(rjson);
		}
	}
	xhttp.open("GET","php/cart.php?request=ADD&id="+id ,true);
	xhttp.send();
}
function remove_one_from_cart(id){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);
			build_cart(rjson);
		}
	}
	xhttp.open("GET","php/cart.php?request=REMOVE&id="+id ,true);
	xhttp.send();
}


function getCurrentCart(){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);
			build_cart(rjson);
		}
	}
	xhttp.open("GET","php/cart.php?request=FETCH" ,true);
	xhttp.send();
	
}
function checkout(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			//var rjson = JSON.parse(this.responseText);
			alert(this.responseText);
			getCurrentCart();
		}
	}
	
	num_items = numberOfCartItems();
	xhttp.open("GET","php/checkout.php?num_items="+num_items ,true);
	xhttp.send();
}


function build_cart(list){									
		cart = document.getElementById("cart_content"); 
		str = "\
		<table id ='cart_table'>\
			<tr>\
				<th></th>\
				<th>Product</th>\
				<th>Quantity</th>\
			<th>Price</th>\
			<th></th>\
			<th></th>\
			</tr>";//th left empty for formating...
		var sum = 0;
		for(i = 0; i <list.length;i++){
				str += "<tr id= " + "'" + list[i].product.id +"'" + " >" + "<td>" + "<img src = " + "'" + list[i].product.image +"'" + "/>"+ "</td>";
				str += "<td>" + list[i].product.description + "</td>";
				str += "<td>" + list[i].quantity + "</td>";
				str += "<td>" + list[i].product.price + "</td>";
				
				str += "<td>" + "<button id='inc" + list[i].product.id +"'type='button' onclick='inc_quantity(this.id)'>+</button>" + "</td>";
				str += "<td>" + "<button id='dec" + list[i].product.id +"'type='button' onclick='dec_quantity(this.id)'>-</button>" + "</td>";
				
				
				str +="</tr>";
				sum += (parseInt(list[i].product.price) * parseInt(list[i].quantity));
		}	
			
		str +=  "</table>	<span id = 'sum' class='sum'>placeholder for sum</span>";
		
		
		cart.innerHTML = str;
		document.getElementById("sum").innerHTML = "<b>sum: " + sum +"</b>";
		document.getElementById("checkoutDiv").innerHTML = "<button type = 'button' onclick='checkout()'>Checkout</button>"

}
function inc_quantity(id){
	id=id[3];				//workaround to not have same id on buttons...
	add_to_cart(id);
	
}
function dec_quantity(id){
	id=id[3];				//workaround to not have same id on buttons...
	remove_one_from_cart(id);
}
function numberOfCartItems(){
	table = document.getElementById('cart_table');
	item_count = 0;
	for(i = 1; i<table.rows.length;i++){
		item_count += parseInt(table.rows[i].cells[2].innerHTML);
	}
	return item_count;
}

