$(document).ready(function(){

	cartNoti();
	showTable();

	$('.hideForm').hide();	

	$('.addtocartBtn').on('click', function(){
		var id = $(this).data('id');
		var name = $(this).data('name');
		var codeno = $(this).data('codeno');
		var photo = $(this).data('photo');
		var price = $(this).data('price');
		var discount = $(this).data('discount');
		var qty = 1;

		var mylist = {id:id, codeno:codeno,
					name:name, photo:photo,
					price:price, discount:discount,
					qty:qty};

		var cart = localStorage.getItem('cart');
		var cartArray;

		if (cart==null) {
			cartArray = Array();
		}
		else{
			cartArray = JSON.parse(cart);
		}

		var status=false;

		$.each(cartArray, function(i,v){
			if (id == v.id) {
				v.qty++;
				status = true;
			}
		});

		if (!status) {
			cartArray.push(mylist);
		}

		var cartData = JSON.stringify(cartArray);
		localStorage.setItem("cart",cartData);

		cartNoti();
	});

	function cartNoti(){
		var cart = localStorage.getItem('cart');
		if (cart) {
			var cartArray = JSON.parse(cart);
			var total =0;
			var noti = 0;
			$.each(cartArray, function(i,v){

				var unitprice = v.price;
				var discount = v.discount;
				var qty = v.qty;
				if (discount) {
					var price = discount;
				}
				else{
					var price = unitprice;
				}
				var subtotal = price * qty;

				noti += qty ++;
				total += subtotal ++;
			})
			$('.cartNoti').html(noti);
			$('.cartTotal').html(total+' Ks');
		}
		else{
			$('.cartNoti').html(0);
			$('.cartTotal').html(0+' Ks');
		}
	}

	function showTable(){
		var cart = localStorage.getItem('cart');

		if (cart) {
			$('.shoppingcart_div').show();
			$('.noneshoppingcart_div').hide();

			var cartArray = JSON.parse(cart);
			var shoppingcartData='';


			if (cartArray.length > 0) {
				var total = 0;
				$.each(cartArray, function(i,v){
					var id = v.id;
					var codeno = v.codeno;
					var name = v.name;
					var unitprice = v.price;
					var discount = v.discount;
					var photo = v.photo;
					var qty = v.qty;

					if (discount) {
						var price = discount;
					}
					else{
						var price = unitprice;
					}
					var subtotal = price * qty;

					shoppingcartData += `<tr> 
											<td> 
												<button class="btn btn-outline-danger remove_btn btn-sm" data-id="${i}" style="border-radius: 50%"> 
													<i class="icofont-close-line"></i> 
												</button>
											</td>
											<td> 
												<img src="${photo}" class="cartImg">
											</td>
											<td>
												<p> ${name} </p>
												<p> ${codeno} </p>
											</td>
											<td>
												<button class="btn btn-outline-secondary plus_btn" data-id="${i}"> 
													<i class="icofont-plus"></i> 
												</button>
											</td>
											<td>
												<p> ${qty} </p>
											</td>
											<td>
												<button class="btn btn-outline-secondary minus_btn" data-id="${i}"> 
													<i class="icofont-minus"></i>
												</button>
											</td>
											<td>`; 
					if (discount > 0) {
						shoppingcartData += `<p class="text-danger"> 
												${discount} Ks
											</p>
											<p class="font-weight-lighter">
												<del> ${unitprice} Ks </del>
											</p>
											`;
					}
					else{
						shoppingcartData += `<p class="text-danger"> 
												${unitprice} Ks
											</p>`;
					}

					shoppingcartData+=`</td>
										<td> 
											<p> ${subtotal} Ks </p> 
										</td>
									</tr>`;
					total += subtotal ++;
				});

				$('#shoppingcart_table').html(shoppingcartData);

			}
			else{
				$('.shoppingcart_div').hide();
				$('.noneshoppingcart_div').show();
			}
		}
		else{
			$('.shoppingcart_div').hide();
			$('.noneshoppingcart_div').show();
		}
	}


	// Remove Item
	$('#shoppingcart_table').on('click','.remove_btn', function()
	{
		var id = $(this).data('id');

		console.log(id);

		var cart=localStorage.getItem("cart");
		var cartArray = JSON.parse(cart);

		$.each(cartArray,function (i,v) 
		{
			if (i == id) 
			{
				cartArray.splice(id,1);
			}
		})

		var cartData=JSON.stringify(cartArray);

		localStorage.setItem("cart",cartData);
		
		showTable();
		cartNoti();

	});

	// Add Quantity
	$('#shoppingcart_table').on('click','.plus_btn', function()
	{
		var id = $(this).data('id');

		var cart=localStorage.getItem("cart");
		var cartArray = JSON.parse(cart);
		
		$.each(cartArray,function (i,v) 
		{
			console.log(i);
			if (i == id) 
			{
				v.qty++;
			}
		})
		
		var cartData = JSON.stringify(cartArray);
		localStorage.setItem('cart',cartData);
		showTable();
		cartNoti();

	});

	// Sub Quantity
	$('#shoppingcart_table').on('click','.minus_btn', function()
	{
		var id = $(this).data('id');

		var cart=localStorage.getItem("cart");
		var cartArray = JSON.parse(cart);
		
		$.each(cartArray,function (i,v) 
		{
			if (i == id) 
			{
				v.qty--;
				if (v.qty == 0) 
				{
					cartArray.splice(id,1);
				}
			}
		})
		
		var cartData = JSON.stringify(cartArray);
		localStorage.setItem('cart',cartData);
		showTable();
		cartNoti();

	});

	$('.checkoutbtn').on('click',function(){
		var notes = $('#notes').val();
		var cart = localStorage.getItem('cart');
		var cartArray = JSON.parse(cart);

		var total =0;
		$.each(cartArray, function(i,v){

			var unitprice = v.price;
			var discount = v.discount;
			var qty = v.qty;
			if (discount) {
				var price = discount;
			}
			else{
				var price = unitprice;
			}
			var subtotal = price * qty;

			total += subtotal ++;
		});

		console.log(total);

		$.post('storeorder.php',{
			cart: cartArray,
			notes: notes,
			total: total
		},function(response){
			localStorage.clear();
			location.href="ordersuccess.php";
		});
	});








































});