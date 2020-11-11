<?php 
	require 'header.php';
?>

	<script type="text/javascript">
	
		$(document).ready(function () 
		{
	    	$('#editStudentdiv').hide();
	    	getStudentlist();

	    	$('tbody').on('click','.edit',function(){
	    		$('#editStudentdiv').show();
	    		$('#addStudentdiv').hide();

	    		var id = $(this).data('id');

	    		$.get('studentlist.json',function(response){

	    			var studentObjArray = JSON.parse(response);

	    			var  name = studentObjArray[id].name;
	    			var  email = studentObjArray[id].email;
	    			var  gender = studentObjArray[id].gender;
	    			var  address = studentObjArray[id].address;
	    			var  profile = studentObjArray[id].profile;

	    			$('#edit_name').val(name);
	    			$('#edit_email').val(email);
	    			$('#edit_address').val(address);

	    			if (gender == "Male") {
	    				$('#edit_male').attr('checked', 'checked');
	    			}
	    			else{
	    				$('#edit_female').attr('checked', 'checked');

	    			}

	    			$('#showOldPhoto').attr('src',profile);

	    			$('#edit_id').val(id);

	    			$('#edit_oldprofile').val(profile);

	    		});
	    	});

	    	$('tbody').on('click','.detail',function(){

	    		$('#detailModal').modal('show');

	    		var id = $(this).data('id');

	    		$.get('studentlist.json',function(response){

	    			var studentObjArray = JSON.parse(response);

	    			var  name = studentObjArray[id].name;
	    			var  email = studentObjArray[id].email;
	    			var  gender = studentObjArray[id].gender;
	    			var  address = studentObjArray[id].address;
	    			var  profile = studentObjArray[id].profile;

	    			$('#detail_name').text(name);
	    			$('#detail_gender').text(gender);
	    			$('#detail_email').text(email);
	    			$('#detail_address').text(address);

	    			$('#detail_profile').attr('src',profile);


	    		});
	    	});

	    	$('tbody').on('click','.delete',function(){

	    		var id = $(this).data('id');

	    		var ans = confirm('Are you sure want to delete?');

	    		if (ans) {
	    			$.post(
	    				'deletestudent.php', {sid:id},
	    				function(data){
	    					getStudentlist();
	    				}
	    			)
	    		}

	    	});

	    	function getStudentlist(){
	    		$.get('studentlist.json',function(response){

	    			console.log(typeof(response));

	    			// string
	    			var studentObjArray = JSON.parse(response);

	    			// !string
	    			// var studentObjArray = response;

	    			var html='';
	    			var j = 1;

	    			$.each(studentObjArray, function(i,v){
	    				var name = v.name;
	    				var gender = v.gender;
	    				var email = v.email;

	    				html += `<tr> 
	    							<td> ${j++} </td>
	    							<td> ${name} </td>
	    							<td> ${gender} </td>
	    							<td> ${email} </td>
	    							<td>
	    								<button class="detail btn btn-success" data-id="${i}">Detail</button>

			                        	<button class="edit btn btn-warning" data-id="${i}">Edit</button>

			                        	<button class="delete btn btn-danger" data-id="${i}">Delete</button></td>
	    							</td>
	    						</tr>`;
	    			});

	    			$('tbody').html(html);


	    		});
	    	}




























	  	});

	</script>
	
	<div class="container" id="addStudentdiv">
		
		<div class="row mt-5">
			<div class="col-12 text-center">
				<h1 class="display-4"> Add New Student </h1>
			</div>
		</div>

		<div class="row mt-5">
			<div class="col align-self-center">
				<form action="addstudent.php" method="POST" enctype="multipart/form-data">
					
					<div class="form-group row">
						<label for="profile" class="col-sm-2 col-form-label"> Profile </label>
					    <div class="col-sm-10">
					    	<input type="file"  id="profile" name="profile">
					    </div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"> Name </label>
					    <div class="col-sm-10">
					    	<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
					    </div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"> Email </label>
					    <div class="col-sm-10">
					    	<input type="email" class="form-control" id="name" placeholder="Enter Email" name="email">
					    </div>
					</div>

					<fieldset class="form-group">
					    <div class="row">
					    	<legend class="col-form-label col-sm-2 pt-0"> Gender </legend>
					      
					      	<div class="col-sm-10">
					        
					        	<div class="form-check">
					          		<input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
					          		<label class="form-check-label" for="male">
					            		Male
					          		</label>
					        	</div>
					        
					        	<div class="form-check">
					          		<input class="form-check-input" type="radio" name="gender" id="female" value="Female">
					          		<label class="form-check-label" for="female">
					            		Female
					          		</label>
					        	</div>
					        
					      </div>
					    </div>
					</fieldset>

					<div class="form-group row">
						<label for="address" class="col-sm-2 col-form-label"> Address </label>
					    <div class="col-sm-10">
					    	<textarea class="form-control" rows="5" name="address"></textarea>
					    </div>
					</div>

					<div class="form-group row">
					    <div class="col-sm-10">
					   		<button type="submit" class="btn btn-primary">
					   			SAVE
					   		</button>
					    </div>
					</div>


				</form>
			</div>
		</div>
	</div>

	<div class="container" id="editStudentdiv">
		
		<div class="row mt-5">
			<div class="col-12 text-center">
				<h1 class="display-4"> Edit Existing Student </h1>
			</div>
		</div>

		<div class="row mt-5">
			<div class="col align-self-center">
				<form action="updatestudent.php" method="POST" enctype="multipart/form-data">

					<input type="hidden" name="edit_id" id="edit_id">
					<input type="hidden" name="edit_oldprofile" id="edit_oldprofile">

					<div class="form-group row">
						<label for="profile" class="col-sm-2 col-form-label"> Profile </label>
					    <div class="col-sm-10">

							<ul class="nav nav-tabs" id="myTab" role="tablist">
	  							<li class="nav-item">
	    							<a class="nav-link active" id="oldprofile-tab" data-toggle="tab" href="#oldprofile" role="tab" aria-controls="oldprofile" aria-selected="true"> Old Profile </a>
	  							</li>
	  
		  						<li class="nav-item">
		    						<a class="nav-link" id="newprofile-tab" data-toggle="tab" href="#newprofile" role="tab" aria-controls="newprofile" aria-selected="false"> New Profile</a>
		  						</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
									<img src="" id="showOldPhoto" class="img-fluid" width="100px" height="90px">
								</div>
							
								<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
									<input type="file"  id="profile" name="edit_newprofile">
								</div>
							</div>

						
					    	
					    </div>
					</div>

					<div class="form-group row">
						<label for="edit_name" class="col-sm-2 col-form-label"> Name </label>
					    <div class="col-sm-10">
					    	<input type="text" class="form-control" id="edit_name" placeholder="Enter Name" name="edit_name">
					    </div>
					</div>

					<div class="form-group row">
						<label for="edit_email" class="col-sm-2 col-form-label"> Email </label>
					    <div class="col-sm-10">
					    	<input type="email" class="form-control" id="edit_email" placeholder="Enter Email" name="edit_email">
					    </div>
					</div>

					<fieldset class="form-group">
					    <div class="row">
					    	<legend class="col-form-label col-sm-2 pt-0"> Gender </legend>
					      
					      	<div class="col-sm-10">
					        
					        	<div class="form-check">
					          		<input class="form-check-input" type="radio" name="edit_gender" id="edit_male" value="Male">
					          		<label class="form-check-label" for="edit_male">
					            		Male
					          		</label>
					        	</div>
					        
					        	<div class="form-check">
					          		<input class="form-check-input" type="radio" name="edit_gender" id="edit_female" value="Female">
					          		<label class="form-check-label" for="edit_female">
					            		Female
					          		</label>
					        	</div>
					        
					      </div>
					    </div>
					</fieldset>

					<div class="form-group row">
						<label for="address" class="col-sm-2 col-form-label"> Address </label>
					    <div class="col-sm-10">
					    	<textarea class="form-control" rows="5" name="edit_address" id="edit_address"></textarea>
					    </div>
					</div>

					<div class="form-group row">
					    <div class="col-sm-10">
					   		<button type="submit" class="btn btn-primary">
					   			 Update
					   		</button>
					    </div>
					</div>


				</form>
			</div>
		</div>
	</div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th> # </th>
				<th> Name </th>
				<th> Gender </th>
				<th> Email </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>


	<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLabel"> Student Information </h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
		      	</div>
		      
		      	<div class="modal-body">
		        	<div class="container">
		        		<div class="row">
		        			<div class="col-4">
		        				<img src="" id="detail_profile" class="img-fluid">
		        			</div>
		        			<div class="col-8">
		        				<h1 id="detail_name"></h1>
		        				<p id="detail_gender"></p>
		        				<p id="detail_email"></p>
		        				<p id="detail_address"></p>
		        			</div>
		        		</div>
		        	</div>
		      	</div>
		    </div>
		</div>
	</div>










<?php 
	require 'footer.php';
?>