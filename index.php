<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<title>only Connect - Connecting Wall</title>
		<meta name="description" content="The HTML5 Herald">
		<meta name="author" content="SitePoint">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		
	</head>
	

	
	<body>
		<style>
			@font-face {
			font-family: 'Alte DIN 1451 Mittelschrift';
			src: url('fonts/AlteDIN1451Mittelschrift.eot');
			src: url('fonts/AlteDIN1451Mittelschrift.eot?#iefix') format('embedded-opentype'),
			url('fonts/AlteDIN1451Mittelschrift.woff2') format('woff2'),
			url('fonts/AlteDIN1451Mittelschrift.woff') format('woff'),
			url('fonts/AlteDIN1451Mittelschrift.ttf') format('truetype'),
			url('fonts/AlteDIN1451Mittelschrift.svg#AlteDIN1451Mittelschrift') format('svg');
			font-weight: normal;
			font-style: normal;
			}
			
			@font-face {
			font-family: 'Alte DIN 1451 Mittelschrift gepraegt';
			src: url('fonts/AlteDIN1451Mittelschriftgepraegt.eot');
			src: url('fonts/AlteDIN1451Mittelschriftgepraegt.eot?#iefix') format('embedded-opentype'),
			url('fonts/AlteDIN1451Mittelschriftgepraegt.woff2') format('woff2'),
			url('fonts/AlteDIN1451Mittelschriftgepraegt.woff') format('woff'),
			url('fonts/AlteDIN1451Mittelschriftgepraegt.ttf') format('truetype'),
			url('fonts/AlteDIN1451Mittelschriftgepraegt.svg#AlteDIN1451Mittelschriftgepraegt') format('svg');
			font-weight: normal;
			font-style: normal;
			}
			
			
			
			*{
			margin:0;
			padding:0;
			}
			
			body, html{
			height:100%;
			width:100%;
			font-family: "Alte DIN 1451 Mittelschrift";
			
			}
			
			html{
				background:linear-gradient(to bottom left, #283e74 10%,#76a1ce 60%, white 100%);
				background-repeat:no-repeat;
				background-attachment:fixed;
			}
			
			
			.container{
			overflow:hidden;
			margin:auto;
			padding:50px;
			box-sizing:border-box;
			max-width:900px;
			min-width: 450px;
			}
			
			.wrapper{
			width:100%;
			padding-bottom:75%;
			margin:auto;
			position:relative;
			}
			
			.blockWrapper{
			position: absolute;
			top: 0; left: 0;
			width:102.5%;
			height:102.5%;
			margin:0 -5px -5px 0;
			
			
			}
			
			.block{
			background:#b1defb;
			width:22.5%;
			height:22.5%;
			margin:0 2.5% 2.5% 0;
			border-radius:10px;
			transition: 
			top 1s 0.5s ease-in-out,
			left 1s 0.5s ease-in-out,
			transform 0.5s ease-in-out,
			background 0.2s;
			position:absolute;
			display:flex;
			box-shadow:-2px -2px 10px rgba(0,0,0,.25) inset, 2px 2px 10px rgba(255,255,255,0.5) inset;
			font-size:clamp(20px, 2.5vw , 35px);
			user-select: none; 
			}
			
			.block.out{
			transform:scale(1.05);
			}
			
			.block.active{
			color:white;
			
			}
			
			.block.done{
			pointer-events:none;
			color:white;
			}
			
			.block.color0{
			background:#05496e;
			}
			.block.color1{
			background:#017d5b;
			}
			.block.color2{
			background:#562042;
			}
			.block.color3{
			background:#01707b;
			}
			
			
			
			
			
			
			.block div{
			margin:auto;
			}
			
			.block[data-col="0"]{
			left:0%;
			}
			.block[data-col="1"]{
			left:25%;
			}
			.block[data-col="2"]{
			left:50%;
			}
			.block[data-col="3"]{
			left:75%;
			}
			
			.block[data-row="0"]{
			top:0%;
			}
			.block[data-row="1"]{
			top:25%;
			}
			.block[data-row="2"]{
			top:50%;
			}
			.block[data-row="3"]{
			top:75%;
			}
			
			
		</style>
		<div class="container">
		<div class="wrapper">
			<div class="blockWrapper">
				
				<?php
					include('randomizer.php');
					include('solutions.php');
					
					$allOptions = array_merge($options[0],$options[1],$options[2],$options[3]);
					
					shuffle($allOptions);
					$row=-1;
					foreach($allOptions as $key=>$value){
						
						echo '<div class="block" data-id="'.$value[0].'" data-col="'.($key%4).'" data-row="'.($key%4 == 0 ? ++$row : $row).'"><div>'.$value[1].'</div></div>';
						
					}
				?>
				
			</div>
			
		</div>
		
		</div>
		
		
		<script>
			
			var currentRow = 0;
			
			$('.block').on('click', function(){
				
				$(this).toggleClass('active').toggleClass('color'+currentRow);
				
				if($('.block.active').length == 4){
					validate();
					
					
				}
				
				
			});
			
			function reorder(order){
				var openPos = [];
				$.each(order, function(key, val){
					var that = $('[data-id="'+val[0]+'"]');
					if(that.attr('data-row') != currentRow){
						openPos.push([that.attr('data-row'),that.attr('data-col')])
					}	
					that.attr('data-row', currentRow).attr('data-col', key).addClass('out');
					
					
				})
				if(openPos.length > 0){
					$('[data-row="'+currentRow+'"]').not('.done').each(function(key){
						$(this).attr('data-row', openPos[key][0]).attr('data-col', openPos[key][1]).addClass('out');
					})
					
				}
				currentRow++; 
				if(currentRow == 3){
					$('.block').not('.done').addClass('active').addClass('color'+currentRow)
					validate();
					console.log('You won!');
				}
				
			}
			
			function validate(){
				var id = [];		
				
				$('.block.active').each(function(){
					id.push($(this).data('id'));
				})
				$.post("validate.php",
				{
					ids: id
				},
				function(data, status){
					if(data){
						console.log(data);
						var order = JSON.parse(data);
						$('.block.active').addClass('done').addClass('color'+currentRow);
						
					}
					$('.block').removeClass('active');
					$('.block').not('.done').removeClass('color'+currentRow);
					if(data){
						reorder(order);	
					}
					
				});
				setTimeout(function(){
					$('.block').removeClass('out');
					},1500)
			}
			
			
		</script>
		
	</body>
</html>	