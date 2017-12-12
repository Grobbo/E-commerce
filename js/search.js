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

function rating_set(prodid,rat){
	var http = new XMLHttpRequest();
	var url = "php/rating.php";
	var str = "prodid="+prodid+"&rating="+rat;	
	http.open("POST", url, true);

	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
	    if(http.readyState == 4 && http.status == 200) {
		var rjson = JSON.parse(this.responseText);		
		update_rating(rjson);
	    }
	}
	http.send(str);

}

function update_rating(json){	
	update = document.getElementById("rating"+json[0].id);
	update.innerHTML = "RatingAvg: "+ (json[0].rating/json[0].num_ratings).toFixed(3) + "<br>" + "Number of Ratings :" + json[0].num_ratings;
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
		var select = document.createElement("select");
		for(var i = 0; i <= 5 ; i++){
			var opt = document.createElement("option");
			opt.setAttribute("value", i);
			opt.innerHTML = i;
			select.appendChild(opt);
		}
		var ratbut = document.createElement("button");
		ratbut.innerHTML = "Rate";
		ratbut.onclick = function () {
			rating_set(this.parentNode.parentNode.id,this.parentNode.firstChild.value);
			
		}; 		
		rat.appendChild(select);
		rat.appendChild(ratbut);
		var ratavg = document.createElement("p");
		ratavg.setAttribute("id","rating"+list[index].id);
		ratavg.innerHTML = "RatingAvg: "+ (list[index].rating/list[index].num_ratings).toFixed(3) + "<br>" + "Number of Ratings :" + list[index].num_ratings;
		rat.appendChild(ratavg);
		
		
		comment_icon = document.createElement("img");
		comment_icon.src ="/images/comments.png";
		comment_icon.setAttribute("height","50");
		comment_icon.setAttribute("width", "50");
		comment_icon.setAttribute("alt", "NO IMAGE");
		comment_icon.onclick = function() {
				if(this.parentElement.lastChild.hasChildNodes()){
					while(this.parentElement.lastChild.hasChildNodes()){
						this.parentElement.lastChild.removeChild(this.parentElement.lastChild.lastChild);
					}
				}else{
					comment_request(this.parentElement.id);		
				}
			}
	
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
	if(commentsJson.length > 0 && commentsJson[0] != "none"){	
		var comment = document.getElementById(commentsJson[0].product_id).lastChild;
		while (comment.hasChildNodes()) {
    			comment.removeChild(comment.lastChild);
		}
		for(index = 0;index < commentsJson.length; index++){	
			if(commentsJson[index].super_id == null){		
				var commentdiv = document.createElement("div");
				commentdiv.setAttribute("class","comments");
				commentdiv.setAttribute("id", commentsJson[index].id);
				commentdiv.setAttribute("prodid",commentsJson[index].product_id);
				commentdiv.innerHTML = commentsJson[index].comment_text + "<br>";
				var button = document.createElement("button");
				button.innerHTML = "Add comment";				
				button.onclick = function () { //function to make form for comment
										
					this.parentNode.replaceChild(comment_form_builder(this.parentNode.getAttribute("id"),this.parentNode.getAttribute("prodid")),this);
				};
				commentdiv.appendChild(button);

				comment.appendChild(commentdiv);
				comment_on_comment_builder(commentdiv,commentsJson[index].id,50,commentsJson);
			}
		}
		comment.appendChild(comment_form_builder(null,commentsJson[0].product_id));
					
	}else{
		var comment = document.getElementById(commentsJson[1]).lastChild;
		
		comment.appendChild(comment_form_builder(null,commentsJson[1]));
	}
}

function comment_form_builder(id, prodid){
	var form = document.createElement("div");
	form.setAttribute("id",id);
	form.setAttribute("prodid",prodid);
	form.style.margin = "10px";
	var textarea = document.createElement("input");
	textarea.setAttribute("type","text");
	textarea.setAttribute("name","text")
	textarea.setAttribute("placeholder","Comment text");
	var button = document.createElement("button");
	button.innerHTML = "Confirm";
	form.appendChild(textarea);
	form.appendChild(document.createElement("br"));
	form.appendChild(button);
	button.onclick = function () {	
	comment_post_req(this.parentNode.getAttribute("prodid"),this.parentNode.id,this.parentNode.firstChild.value);	
	};
	
	return form;
}


function comment_on_comment_builder(div,id,margin,commentslist){	
	for(var i = 0; i < commentslist.length; i++){
		if(commentslist[i].super_id == id){
			var comment = document.createElement("div");
			comment.style.marginLeft = margin+"px";
			comment.setAttribute("id",commentslist[i].id);
			comment.setAttribute("prodid",commentslist[i].product_id);
			var text = document.createElement("div");
			text.innerHTML = commentslist[i].comment_text + "<br>";
			var img = document.createElement("img");
			img.src ="/images/comments_divider.png";
			img.setAttribute("width","30px");
			img.setAttribute("height","20px");			
			comment.appendChild(img);
			comment.appendChild(text);
			var button = document.createElement("button");
				button.innerHTML = "Add comment";				
				button.onclick = function () {
					this.parentNode.replaceChild(comment_form_builder(this.parentNode.getAttribute("id"),this.parentNode.getAttribute("prodid")),this);
				};
			comment.appendChild(button);			
			div.appendChild(comment);
			comment_on_comment_builder(comment,commentslist[i].id,margin,commentslist);
		}
	} 
	return;
}

function console_log(id){
	console.log("Item ID "+ id);
}

function comment_post_req(prodid,sid,text){
	var http = new XMLHttpRequest();
	var url = "php/comments.php";
	var str = "prodid="+prodid+"&sid="+sid+"&text="+text+"&comment=true";	
	http.open("POST", url, true);

	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
	    if(http.readyState == 4 && http.status == 200) {
		comment_request(this.responseText);
	    }
	}
	http.send(str);
}
