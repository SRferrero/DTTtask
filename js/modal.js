///////////////////////
/*  Modal functions  */
///////////////////////
function modal_watch(img)
{
   // Crea el contenido del modal
   document.getElementById("modal-body").innerHTML = "<img onclick='modal_hide()' src='" + img.src + "' width='180' height='250'/>";

   //Muestra el modal
   document.getElementById("modal").style.display = "block";
}

function modal_buy_sticker(img)
{
	// Crea el contenido del modal
	document.getElementById("modal-header").innerHTML = "<center><b>Buy sticker</b></center>";
	document.getElementById("modal-body").innerHTML = "<img src='" + img.src + "' width='180' height='250'/>" + 
				'<br/><br/><div id="funds"></div>' + 
				'<div id="price"></div><br/>' + 
				'<div id="stock"></div><br/>';
	document.getElementById("modal-footer").innerHTML ="<center>" +
				"<span onclick=\"buy_sticker('" + img.name + "','" + img.id + "')\" class=\"btn btn-success\">Purchase</span>" +
				"<span onclick='modal_hide()' class='btn'>Cancel</span>" +
			'</center>';
	
	// Obtiene los datos para rellenar el modal
	get_price(img.id);
	get_funds(img.name);
	get_stock(img.id);
	
	// Muestra el modal
	document.getElementById("modal").style.display = "block";
}

function modal_buy_album(img)
{
	// Crea el contenido del modal
	document.getElementById("modal-header").innerHTML = "<center><b>Buy album</b></center>";
	document.getElementById("modal-body").innerHTML = "In order to purchase a sticker you must<br/>buy the album first. Would you like to buy<br/>it now?" +
				'<br/><br/><div id="funds"></div>' +
				'<div id="price"></div><br/>';
	document.getElementById("modal-footer").innerHTML ="<center>" +
				"<span onclick=\"buy_album('" + img.name + "','" + img.id + "')\" class=\"btn btn-success\">Purchase</span>" +
				'<span onclick="modal_hide()" class="btn">Cancel</span>' +
			'</center>';
	// Obtiene los datos para rellenar el modal
	get_price_album(img.id);
	get_funds(img.name);
	// Muestra el modal
	document.getElementById("modal").style.display = "block";
}

function modal_login_needed()
{
	// Creamos el contenido del modal
	document.getElementById("modal-header").innerHTML = "<center>Loggin needed</center>";
	document.getElementById("modal-body").innerHTML = "<center>You have to be registered to do this</center>";
	document.getElementById("modal-footer").innerHTML ="<center><br/>" +
				'<a href="login.php?a=login" class ="btn btn-success">Log In</a>' +
				'<a href="login.php?a=register" class ="btn btn-success">Sign Up</a>' + 
				'<span onclick="modal_hide()" class="btn">Cancel</span>' +
			'</center>';
			
	// Mostramos el modal
	document.getElementById("modal").style.display = "block";
}

// Oculta y resetea el modal
function modal_hide()
{
   // Oculta el modal
   document.getElementById("modal").style.display = "none";

   // Resetea el contenido del local
   document.getElementById("modal-header").innerHTML = "";
   document.getElementById("modal-body").innerHTML = "";
   document.getElementById("modal-footer").innerHTML = "";
}

function showError(string){

   document.getElementById("modal-body").innerHTML = ' <span class="error"> ' +string + '</span> <span class="btn btn-primary float-right" onclick="modal_hide()">x</span>';
   //Muestra el modal
   document.getElementById("modal").style.display = "block";
}

//////////////////////////////
/*  Transactions functions  */
//////////////////////////////
function buy_sticker(user,sticker)
{
	var url = 'javascriptMSQL.php?u=' + user + '&s=' + sticker;
	ajax("buy sticker",url);
}

function get_price(sticker)
{
	var url = 'javascriptMSQL.php?s=' + sticker;
	ajax("get price",url);
}

function get_stock(sticker)
{
	var url = 'javascriptMSQL.php?t=' + sticker;
	ajax("get stock",url);
}

function get_price_album(sticker)
{
	var url = 'javascriptMSQL.php?a=' + sticker;
	ajax("get price album",url);
}

function get_funds(user)
{
	var url = 'javascriptMSQL.php?u=' + user;
	ajax("get funds",url);
}

function buy_album(user,sticker)
{
	var url = 'javascriptMSQL.php?u=' + user + '&a=' + sticker;
	ajax("buy album",url);
}

/////////////////////////
/*  Results functions  */
/////////////////////////
function result_buy_sticker(error)
{
	if(error == 0) // Todo ok
	{
		modal_hide();
		showError("You've acquired a new sticker!<br/>Wait 1 seconds to get it.");
		setInterval( function() { location.reload(); }, 1000);
	}
	else if(error == 1)
	{
		modal_hide();
		showError("You already own this sticker!");
	}
	else if(error == 2)
	{
		modal_hide();
		showError("Sorry, this sticker is out of stock");
	}
	else if(error == 3)
	{
		modal_hide();
		showError("Insufficient funds");
	}
	else
	{
		modal_hide();
		showError("Sorry, there have been an error. Try again");
	}
}

function result_buy_album(error)
{
	if(error == 0) // Todo ok
	{
		modal_hide();
		showError("You've acquired a new album!<br/>Wait 1 seconds to get it.");
		setInterval( function() { location.replace("collections.php"); }, 1000);
	}
	else if(error == 1)
	{
		modal_hide();
		showError("You already own this album!");
	}
	else if(error == 2)
	{
		modal_hide();
		showError("Sorry, this album is no longer available");
	}
	else if(error == 3)
	{
		modal_hide();
		showError("Insufficient funds");
	}
	else
	{
		modal_hide();
		showError("Sorry, there have been an error. Try again");
	}
}

function result_get_price(price)
{
	document.getElementById("price").innerHTML = '<b>Price: </b>' + price;
}

function result_get_funds(funds)
{
	document.getElementById("funds").innerHTML = '<b>Funds: </b>' + funds;
}

function result_get_stock(stock)
{
	document.getElementById("stock").innerHTML = 'Current stock:' + stock;
}

/////////////////////
/*  AJAX function  */
/////////////////////
function ajax(action,url)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var response = xmlhttp.responseText;
			
			if(action == "buy sticker")
			{
				result_buy_sticker(response);
			}
			else if(action == "get price")
			{
				result_get_price(response);
			}
			else if(action == "get funds")
			{
				result_get_funds(response);
			}
			else if(action == "buy album")
			{
				result_buy_album(response);
			}
			else if(action == "get price album")
			{
				result_get_price(response);
			}
			else if(action == "get stock")
			{
				result_get_stock(response);
			}
		}
	}
}