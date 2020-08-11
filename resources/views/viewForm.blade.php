<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Daniel Gonzalez">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700;900&display=swap" rel="stylesheet">
	<link rel="icon" href="{{ asset('img/icono.ico') }}" sizes="16x16 32x32" type="image/png">

	<title>{!! __('title') !!}</title>

</head>
<body>
	<main class="container">
		<!-- Logo -->
		<header>
			<div class="row">
				<div class="col-12 header-style">
					<img src="{{asset('img/sigma-logo.png')}}">
					<h2 class="title-style">{!! __('Test Sigma') !!}</h2>
				</div>
			</div>
		</header>
		<div class="row">
			<article class="article-style">
				{!! __('text lorem') !!}
			</article>
		</div>
		<div class="row container-style">
			<section class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<img src="{{asset('img/sigma-image.png')}}" class="img-section">
			</section>
			<section class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<form action="{{route('form.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<fieldset class="form-style">
                        <div class="form-group col-md-12 mb-12">
							<label class="label-style" for="selectState">{!! __('State') !!}*</label>
							<select class="form-control" id="selectState" name="selectState" placeholder="Seleccionar Departamento" value="{{old('selectState')}}" >
								<option value=""></option>
							</select>
							{!! $errors->first('selectState', '<small class="error_msg">:message</small>') !!}
						</div>
						<div class="form-group col-md-12 mb-12">
							<label class="label-style" for="selectCity">{!! __('City') !!}*</label>
							<select class="form-control" id="selectCity" name="selectCity" placeholder="Ciudad" value="{{old('selectCity')}}" >
								<option value=""></option>
							</select>
							{!! $errors->first('selectCity', '<small class="error_msg">:message</small>') !!}
						</div>
						<div class="form-group col-md-12 mb-12">
							<label class="label-style" for="formName">{!! __('Name') !!}*</label>
							<input type="text" class="form-control" id="formName" name="formName" placeholder="Nombre" minlength="5" maxlength="50" value="{{old('formName')}}">
							{!! $errors->first('formName', '<small class="error_msg">:message</small>') !!}
						</div>
						<div class="form-group col-md-12 mb-12">
							<label class="label-style" for="formEmail">{!! __('Email') !!}*</label>
							<input type="email" class="form-control" id="formEmail" name="formEmail" placeholder="Correo Electronico" value="{{old('formEmail')}}" minlength="5" maxlength="30" >
							{!! $errors->first('formEmail', '<small class="error_msg">:message</small>') !!}
						</div>
						<div class="btn-center col-md-12 mb-12">
							<button class="btn-style btn btn-danger" id="btn_function">{!! __('Submit') !!}</button>
						</div>
					  </fieldset>
				</form>
			</section>			
		</div>
	</main>
	<!-- Modal -->
<input type="hidden" id="insert_data" value=" <?php echo $data ?? ''; ?>" />
<input type="hidden" id="click_modal" data-toggle="modal" data-target="#modalConfirmation">	
<div class="modal fade" id="modalConfirmation" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">{!! __('title_confirm') !!}</h4>
		</div>
		<div class="modal-body">
			<img src="{{asset('img/Yes_Check_Circle.png')}}" class="img-section">
			<p class="info-text">{!! __('message_confirm') !!}</p>
		</div>
		<div class="modal-footer">
          <button type="button" id="ok_modal" class="btn-style btn btn-danger" data-dismiss="modal">Ok</button>
        </div>
	</div>
</div>
<footer>
	
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("input").focusout(function() {
			var value = $(this).val();
			if (value.length == 0) {
				$(this).addClass("is-invalid");
			} 
			else {
				$(this).removeClass("is-invalid");
			}
		});
	});
</script>
<script>
$(document).ready(function(){
	var data = $("#insert_data").val();
	const proxyurl = "https://cors-anywhere.herokuapp.com/";
	const url = "https://sigma-studios.s3-us-west-2.amazonaws.com/test/colombia.json"; 
	fetch(proxyurl + url)
		.then(response => response.text())
		.then(contents => setState(contents))
	.catch(() => console.log("No se puede acceder a " + url + " por favor revisa tu codigo "))

	function setState(contents){
		
		var obj = JSON.parse(contents);
		var keys = Object.keys(obj);

		for(let i = 0; i < keys.length; i++){
				let state = keys[i]; 
			 	$("#selectState").append('<option value="'+state+'">'+state+'</option>');
		}

		$("#selectState").change(function() {

			var state = $("#selectState option:selected").text();	
			const city = obj[state];
			var keys = Object.keys(city);
			$("#selectCity").empty();

			for(let i = 0; i < city.length; i++) {
			    $("#selectCity").append('<option value="'+city[i]+'">'+city[i]+'</option>');
			}
			
		});
	}

	if(data==1){
		$("#click_modal").click();
	}
});
</script>
</body>
</html>