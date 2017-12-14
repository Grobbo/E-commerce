function selectForm(value){
	if(value == "edit_prod_form"){
		product_request("UPDATE");
	}
	var select = document.getElementById("select_form");
	for(var i=0;i<select.options.length;i++){
		if(select.options[i].value == select.value){				
			document.getElementById(select.options[i].value).style.display = "block";
			
		}else{
			document.getElementById(select.options[i].value).style.display = "none";
		}
	}

}

function product_request(req_type,id,cat,man,desc,price,qty){	
		
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);	
			document.getElementById("edit_prod_result").innerHTML = makeTable(rjson);
		}
	}
	if(req_type=="UPDATE"){
		xhttp.open("GET", "php/admin_request.php?request_type=" + req_type,true);
	}else if(req_type=="EDIT"){
		xhttp.open("GET", "php/admin_request.php?request_type=" + req_type +"&id="+id +"&cat="+cat+"&man="+man +"&desc="+desc +"&price="+price +"&qty="+qty,true);
	}else if(req_type=="DELETE"){
		xhttp.open("GET", "php/admin_request.php?request_type=" + req_type +"&id="+id,true);
	}
	
	xhttp.send();
}

function makeTable(list){
//set up table with id,cat,man,desc,edit button, delete button
var string =	"<table id=tableId> \
			<tr>\
				<th>ID</th>\
				<th>Category</th>\
				<th>Manufacturer</th>\
				<th>Description</th>\
				<th>Price</th>\
				<th>Quantity</th>\
				<th></th>\
				<th></th>\
			</tr>";

for(i = 0;i < list.length; i++){
	string += "<tr>";
	string += "<td>" + list[i].id + "</td>";
	string += "<td id=cat" + list[i].id + ">" + list[i].category + "</td>";
	string += "<td id=man" + list[i].id + ">" + list[i].manufacturer + "</td>";
	string += "<td id=desc" + list[i].id + ">" + list[i].description + "</td>";
	string += "<td id=price" + list[i].id + ">" + list[i].price + "</td>";
	string += "<td id=quantity" + list[i].id + ">" + list[i].quantity + "</td>";
	string += "<td >" + "<button type='button' onclick='editProduct(this.id)' id=" +list[i].id +">Edit</button>"+ "</td>";
	string += "<td>" + "<button type='button' onclick='deleteProduct(this.id)' id=" +list[i].id +">Delete</button>"+ "</td>";	//TODO UNIQUE ID??
	string += "</tr>";
} 

string += "</table>";
return string;

}

function editProduct(id){
	document.getElementById("cat" + id).innerHTML = "<input type='text' class='edit_table_text' placeholder=" + document.getElementById("cat" + id).innerHTML +">";
	document.getElementById("man" + id).innerHTML = "<input type='text' class='edit_table_text' placeholder=" + document.getElementById("man" + id).innerHTML +">";
	document.getElementById("desc" + id).innerHTML = "<input type='text' class='edit_table_text' placeholder=" + document.getElementById("desc" + id).innerHTML +">";
	document.getElementById("price" + id).innerHTML = "<input type='text' class='edit_table_text' placeholder=" + document.getElementById("price" + id).innerHTML +">";
	document.getElementById("quantity" + id).innerHTML = "<input type='text' class='edit_table_text' placeholder=" + document.getElementById("quantity" + id).innerHTML +">";

	document.getElementById(id).innerHTML = "OK";
	document.getElementById(id).onclick = function(){confirmEdit(id);};
}
function confirmEdit(id){
	
	table = document.getElementById("tableId");
	cat = getCellTextVal(table,id,1);
	man = getCellTextVal(table,id,2);	
	desc = getCellTextVal(table,id,3);
	price = getCellTextVal(table,id,4);
	qty =  getCellTextVal(table,id,5);
	product_request("EDIT",id,cat,man,desc,price,qty);
}

function deleteProduct(id){
	if(confirm("Are you sure you want to delete product?")){
		product_request("DELETE",id);
	}
	
}

function getCellTextVal(table,id,cell){
		var tableIndex;	//row that has id...
		for(i=1;i<table.rows.length;i++){
			if(table.rows[i].cells[0].innerHTML == id){
				tableIndex = i;		
			}
		}
		txtVal = table.rows[tableIndex].cells[cell].getElementsByTagName("input")[0].value;
		if(!txtVal){
			txtVal=table.rows[tableIndex].cells[cell].getElementsByTagName("input")[0].getAttribute("placeholder");
		}
		
		return txtVal;
}

function getShipments(){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);
			build_shipments(rjson);	
			
		}
	}
		
	xhttp.open("GET", "php/admin_request.php?request_type=GETSHIPMENTS",true);
	xhttp.send();
}
function build_shipments(list){
	
	var str ="<table><tr><th>Shipment id</th><th>Order Date</th><th>Customer id</th><th>username</th><th>First name</th><th>Last name</th><th>Address</th></tr>";
	for(i=0;i< list.length;i++){
		str += "<tr>";
			
			str += "<td>" + list[i].shipment_id + "</td>";
			str += "<td>" + list[i].order_date + "</td>";
			str += "<td>" + list[i].customer + "</td>";
			str += "<td>" + list[i].user_name + "</td>";
			str += "<td>" + list[i].first_name + "</td>";
			str += "<td>" + list[i].last_name + "</td>";
			str += "<td>" + list[i].address + "</td>";
		str += "</tr>";
	}
	str+= "</table>";
	document.getElementById('shipment_placeholder').innerHTML = str;
}

function search_orders(){
	input = document.getElementById('shipment_id_input').value;
	getOrders(input);
}

function getOrders(input){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			
			var rjson = JSON.parse(this.responseText);
			build_orders(rjson);	
			
		}
	}
	xhttp.open("GET", "php/admin_request.php?request_type=GETORDERS&search_id="+input,true);
	xhttp.send();
}
function build_orders(list){
	var str ="<table><tr><th>Product id</th><th>Shipment ID</th><th>Quantity</th></tr>";
	for(i=0;i< list.length;i++){
		str += "<tr>";
			
			str += "<td>" + list[i].product_id + "</td>";
			str += "<td>" + list[i].shipment_id + "</td>";
			str += "<td>" + list[i].quantity + "</td>";
			
		str += "</tr>";
	}
	str+= "</table>";
	document.getElementById('order_placeholder').innerHTML = str;
}
 
