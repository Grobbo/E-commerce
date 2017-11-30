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

//TODO SORT BY MENU...
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
		img.src ="/images/nia.png"; //get from db source path to img
		img.setAttribute("alt", "NO IMAGE");

		cat_desc = document.createElement("div");
		cat_desc.setAttribute("class","item_div");
		cat_desc.innerHTML = list[index].category + "<br>" + list[index].manufacturer + "<br>" +list[index].description;

		pr = document.createElement("div");
		pr.setAttribute("class","item_div");
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
		rat.setAttribute("class","item_div");
		rat.innerHTML = "RatingAvg: " + "5" + "<br>" + "Number of Ratings :" + "200";
		
		comment_icon = document.createElement("img");
		comment_icon.src ="/images/comments.png";
		comment_icon.setAttribute("height","50");
		comment_icon.setAttribute("width", "50");
		comment_icon.setAttribute("alt", "NO IMAGE");
	
		comment_box = document.createElement("div");
		comment_box.setAttribute("id","comment_container");
		comment_box.setAttribute("class","comment_container");

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
		comment = document.getElementById(commentsJson[0].product_id);
		p = document.createElement("p");
		var test = "";
		for(index = 0;index < commentsJson.length; index++){	
			
			test += "Test comment on tool id:" +commentsJson[index].product_id + "<br> Comment--> " + commentsJson[index].comment_text + "<br>";		
		}
	p.innerHTML = test;
	comment.appendChild(p);
		
	}
}

function console_log(id){
	console.log("Item ID "+ id);
}
