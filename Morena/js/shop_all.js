let selectMenu = document.querySelector("#products");
let heading = document.querySelector(".right h1");
let container = document.querySelector(".product-wrapper");

selectMenu.addEventListener("change", function(){
	let cake_typeName = this.value;
	heading.innerHTML = this[this.selectedIndex].text;
	// ajax request
	let http = new XMLHttpRequest();
	
	http.onload = function(){
		if(this.readyState == 4 && this.status == 200){
			let response = JSON.parse(this.responseText);
			let out = "";
			for(let item of response){
				out += `
				<div class="product">
					<div class="left">
						<img src="uploaded_img/${item.image}">
					</div>
					<div class="right">
						<p class="name">${item.name}</p>
						<p class="price">₱${item.price}</p>
						<p class="details">${item.details}</p>
						</div>
					</div>
				`;
			}
			container.innerHTML = out;
		}
	}
	
	
	
	http.open('POST', "script.php");
	http.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	http.send("cake_type="+cake_typeName);
});

