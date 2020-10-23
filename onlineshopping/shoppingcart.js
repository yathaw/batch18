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




	$('.profile_editBtn').show();
	$('.profile_cancelBtn').hide();

	$('.profile_editBtn').on('click', function(){
		$("fieldset").removeAttr("disabled");
		$("#imageUpload").removeAttr("disabled");

		$('.profile_editBtn').hide();
		$('.profile_cancelBtn').show();

	});

	$('.profile_cancelBtn').on('click', function(){
		$('#imageUpload').prop('disabled', true);
		$('fieldset').prop('disabled', true);


		$('.profile_editBtn').show();
		$('.profile_cancelBtn').hide();

	});

	function readURL(input){
        if (input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
            console.log('preivew');
        }
        console.log(input.files);
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });


    $('#inputPassword').change(function ()
    {
        var password=$(this).val();
        console.log(password.length);

        if(password.length > 8)
        {
        	$('#error').html(`<span class="text-danger">* Password shouldn't exceed eight digit</span>`);
        }
    });


    $('#inputConfirmPassword').change(function () 
    {
        var cpassword = $(this).val();
        var password = $("#inputPassword").val();


        if(password!=cpassword)
        {
          	$('#cerror').html(`<span class="text-danger">* Confirm Password don't match!</span>`);
        }
        else{
          	$('#cerror').html();
          	$('#cerror').html(`<span class="text-success">* Confirm Password match!</span>`);

        }
    });
    

    $('.orderDetail').click(function(){

		var id = $(this).data('id');
		var orderdate = $(this).data('orderdate');
		var voucherno = $(this).data('voucherno');
		var total = $(this).data('total');
		var status = $(this).data('status');

		console.log(id);		

		$.post('getorderdetail.php',{
			id: id,
		},function(response){
			console.log(response);

      		var orderdetails = JSON.parse(response); 

			var shoppingcartData='';

			shoppingcartData +=`<div>`;

      		$.each(orderdetails,function (i,v) 
			{
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
											<img src="${photo}" class="cartImg">
										</td>
										<td>
											<p> ${name} </p>
											<p> ${codeno} </p>
										</td>
										<td>
											<p> ${qty} </p>
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

			$('#orderDetail').html(shoppingcartData);


		});

        $('#invoiceNo').html(voucherno);
        $('#dateNo').html(orderdate);

        if (status == "Order") {
        	statusBadge = '<h5> <span class="badge badge-warning">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        else if (status == "Confirm") {
        	statusBadge = '<h5> <span class="badge badge-success">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        else if (status == "Cancel") {
        	statusBadge = '<h5> <span class="badge badge-danger">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        else{
        	statusBadge = '<h5> <span class="badge badge-primary">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        $('#invoiceTotal').html(total);
        $('#orderTotal').html(total);


        $('#detailModal').modal('show');

	});





















});