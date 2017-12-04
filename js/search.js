function search_request() {						//TODO sort by (rating / numratings.. for rating)
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
	+"&sortBy="+document.getElementById("sortBy").value,true);
	xhttp.send();

}

function comment_request(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);
			comment_div_builder(rjson);
		}
	}
	xhttp.open("GET","php/comments.php?id="+id ,true);
	xhttp.send();

}

function add_to_cart(id){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
			var rjson = JSON.parse(this.responseText);
			build_cart(rjson);
		}
	}
	xhttp.open("GET","php/cart.php?id="+id ,true);
	xhttp.send();
	
}

function build_cart(list){									//TODO ta bort TH ? ta bort th för img.   
															//TODO run on page load...
		cart = document.getElementById("cart_content"); 
		str = "\
		<table>\
			<tr>\
				<th>img</th>\
				<th>Product</th>\
				<th>Quantity</th>\
			<th>Price</th>\
			</tr>";
		var sum = 0;
		for(i = 0; i <list.length;i++){
				str += "<tr>" + "<td>" + "<img src = " + "'" + list[i].product.image +"'" + "/>"+ "</td>";
				str += "<td>" + list[i].product.description + "</td>";
				str += "<td>" + list[i].quantity + "</td>";
				str += "<td>" + list[i].product.price + "</td>";
				
				str +="</tr>";
				sum += parseInt(list[i].product.price);
		}	
			
		str +=  "</table>	<hr width=90%><span id = 'sum'>placeholder for sum</span>";
		
		
		cart.innerHTML = str;
		document.getElementById("sum").innerHTML = "sum: " + sum;

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
		base.setAttribute("class","item_container");
		base.onclick = function() {
				if(this.lastChild.hasChildNodes()){
					while(this.lastChild.hasChildNodes()){
						this.lastChild.removeChild(this.lastChild.lastChild);
					}
				}else{
					comment_request(this.id);		
				}
			}
		 
		img = document.createElement("img");
		img.setAttribute("class","image");
		img.src =list[index].image; //get from db source path to img
		img.setAttribute("alt", "NO IMAGE");

		cat_desc = document.createElement("div");
		cat_desc.setAttribute("class","item_div");
		cat_desc.innerHTML = list[index].category + "<br>" + list[index].manufacturer + "<br>" +list[index].description;

		pr = document.createElement("div");
		pr.setAttribute("class","item_div");
		pr.innerHTML = "Price: " + list[index].price + " SEK";
		
		
		addButton = document.createElement("Button");
		addButton.setAttribute("type","button")
		addButton.setAttribute("class","add_button");
		addButton.setAttribute("value",list[index].id);
		addButton.innerHTML = "Add to Cart";
		addButton.onclick = function(){add_to_cart(this.value)};
		pr.appendChild(addButton);

		//TODO RATING..
		rat = document.createElement("div");
		rat.setAttribute("class","item_div");
		rat.innerHTML = "RatingAvg: " + list[index].rating + "<br>" + "Number of Ratings :" + "200";	//TODO Change from 200 to ...
		
		comment_icon = document.createElement("img");
		comment_icon.src ="/images/comments.png";
		comment_icon.setAttribute("height","50");
		comment_icon.setAttribute("width", "50");
		comment_icon.setAttribute("alt", "NO IMAGE");
	
		comment_box = document.createElement("div");
		comment_box.setAttribute("id","comment_container");
		comment_box.setAttribute("class","comment_container");
		comment_box.setAttribute("name","comment_container");

		base.appendChild(img);
		base.appendChild(cat_desc);
		base.appendChild(pr);
		base.appendChild(rat);
		base.appendChild(comment_icon);
		base.appendChild(comment_box);
	
		document.getElementById("canvas").appendChild(base);
		document.getElementById("canvas").appendChild(br);
	}
}

function comment_div_builder(commentsJson){
	if(commentsJson.length > 0){	
		comment = document.getElementById(commentsJson[0].product_id).lastChild;
		while (comment.firstChild) {
    			comment.removeChild(myNode.firstChild);
		}
		for(index = 0;index < commentsJson.length; index++){	
		commentdiv = document.createElement("div");
		commentdiv.setAttribute("class","comments");
		commentdiv.innerHTML = commentsJson[index].comment_text + "<br>"; 
		comment.appendChild(commentdiv);
		}
	}
}

function console_log(id){
	console.log("Item ID "+ id);
}
