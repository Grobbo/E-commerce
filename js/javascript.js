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

	br = document.createElement("br");
	
	for(index = 0;index < list.length; index++){
		
		base = document.createElement("div");
		base.setAttribute("id", list[index].id);
		base.setAttribute("class","item_div");
		 
		img = document.createElement("img");
		img.src ="/images/nia.png"; //get from db source path to img
		img.setAttribute("height","50");
		img.setAttribute("width", "50");
		img.setAttribute("alt", "NO IMAGE");

		cat_desc = document.createElement("div");
		cat_desc.setAttribute("class","item_text");
		cat_desc.innerHTML = list[index].category + "<br>" + list[index].manufacturer + "<br>" +list[index].description;

		pr = document.createElement("div");
		pr.setAttribute("class","item_text");
		pr.innerHTML = "Price: " + list[index].price + " SEK";

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
		pr.appendChild(form);
		
		//TODO RATING..
		rat = document.createElement("div");
		rat.setAttribute("class","item_text");
			

		com_write = document.createElement("div");
		com_write.setAttribute("class","item_text");
			link_write_com = document.createElement("a");
			link_read_com = document.createElement("a");
			link_write_com.setAttribute("href","#");
			link_write_com.setAttribute("id","writeLink");
			link_write_com.setAttribute("title","Write Comment");
			link_write_com.setAttribute("onclick","func();return false")
			link_write_com.innerHTML = "Write Comment ";
		com_write.appendChild(link_write_com);

		com_read = document.createElement("div");
		com_read.setAttribute("class","item_text");
			link_read_com.setAttribute("href","#");
			link_read_com.setAttribute("id","writeLink");
			link_write_com.setAttribute("title","Read Comment");
			link_read_com.setAttribute("onclick","func();return false")
			link_read_com.innerHTML = "Read Comment ";
		com_read.appendChild(link_read_com);

		base.appendChild(img);
		base.appendChild(cat_desc);
		base.appendChild(pr);
		base.appendChild(com_write);
		base.appendChild(com_read);
		base.onclick = console_log(list[index].id); //byts till att visa info om item
		
		document.getElementById("canvas").appendChild(base);
		document.getElementById("canvas").appendChild(br);
	}
}



function console_log(id){
	console.log("Item ID "+ id);
}
