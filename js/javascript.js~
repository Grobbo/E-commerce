function search_request() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);
			build_item_list(rjson);	
		}
	}
	xhttp.open("GET", "php/handle_request.php?search_string="
	+ document.getElementById("search_string").value
	+"&criteria="+document.getElementById("criteria").value
	,true);
	xhttp.send();

}

function build_item_list(list){	

	var node = document.getElementById("canvas");
	while (node.firstChild) {
 	   node.removeChild(node.firstChild);
	}
	
	top_menu = document.createElement("div");
	top_menu.setAttribute("class","item_div");
	
	top_manu = document.createElement("div");
	top_manu.setAttribute("class","item_text");
	top_manu.innerHTML = "Manufacturer";
	
	top_cat = document.createElement("div");
	top_cat.setAttribute("class","item_text");
	top_cat.innerHTML = "Category";

	top_desc = document.createElement("div");
	top_desc.setAttribute("class","item_text");
	top_desc.innerHTML = "Description";

	top_pr = document.createElement("div");
	top_pr.setAttribute("class","item_text");
	top_pr.innerHTML = "Price";

	top_menu.appendChild(top_manu);
	top_menu.appendChild(top_cat);
	top_menu.appendChild(top_desc);
	top_menu.appendChild(top_pr);
	br = document.createElement("br");
	
	document.getElementById("canvas").appendChild(top_menu);
	document.getElementById("canvas").appendChild(br);
	
	for(index = 0;index < list.length; index++){
		
		base = document.createElement("div");
		base.setAttribute("id", list[index].id);
		base.setAttribute("class","item_div");
		base.setAttribute("onclick",say_hello(list[index].id)); //byts till att visa info om item 
		
		manu = document.createElement("div");
		manu.setAttribute("class","item_text");
		manu.innerHTML = list[index].manufacturer;

		cat = document.createElement("div");
		cat.setAttribute("class","item_text");
		cat.innerHTML = list[index].category;

		desc = document.createElement("div");
		desc.setAttribute("class","item_text");
		desc.innerHTML = list[index].description;
		
		pr = document.createElement("div");
		pr.setAttribute("class","item_text");
		pr.innerHTML = list[index].price;

		cartbutton = document.createElement("div");
		cartbutton.setAttribute("class","item_text");
			form = document.createElement("form");
			form.setAttribute("action","php/cart.php");
			form.setAttribute("method","POST");
				input = document.createElement("input");
				input.setAttribute("name","product_id");
				input.setAttribute("type","hidden");
				input.setAttribute("value",list[index].id);
				button = document.createElement("button");
				button.setAttribute("class","add_button");
				button.setAttribute("type","submit");
				button.innerHTML = "Add to Cart";
			form.appendChild(input);
			form.appendChild(button);
		cartbutton.appendChild(form);
		
		base.appendChild(manu);
		base.appendChild(cat);
		base.appendChild(desc);
		base.appendChild(pr);
		base.appendChild(cartbutton);
		
		
		document.getElementById("canvas").appendChild(base);
		document.getElementById("canvas").appendChild(br);
	}
}



function say_hello(id){
	console.log("Item ID "+ id);
}
