function selectForm(){
	var select = document.getElementById("select_form");
	for(var i=0;i<select.options.length;i++){
		if(select.options[i].value == select.value){				
			document.getElementById(select.options[i].value).style.display = "block";
			
		}else{
			document.getElementById(select.options[i].value).style.display = "none";
		}
	}
}

function product_request(){//change name... copied from index.php...
	alert("tja");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);	
			document.getElementById("edit_prod_result").innerHTML = makeTable(rjson);
		}
	}
	xhttp.open("GET", "php/admin_request.php",true);
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
	string += "<td>" + "<button type='button'>Delete</button>"+ "</td>";
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
	document.getElementById(id).onclick = function(){confirmEdit(id)};
}
function confirmEdit(id){
	table = document.getElementById("tableId");
	for(i=1;i<table.rows[id].cells.length -2;i++){
		txtVal = table.rows[id].cells[i].getElementsByTagName("input")[0].value;
		if(!txtVal){
			txtVal=table.rows[id].cells[i].getElementsByTagName("input")[0].getAttribute("placeholder");
		}
		table.rows[id].cells[i].innerHTML = txtVal;
	}

	document.getElementById(id).innerHTML = "Edit";
	document.getElementById(id).onclick = function(){editProduct(id)};
}
 
