﻿
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FREAKING MATH</title>
	<!-- Latest compiled and minified JS -->
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<link href="bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<!-- Latest compiled and minified JS -->
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
</head>
<body style="background-color: black">
	<div class="wrap"> 
		<div class="front text-center">
			<img src="logo.png" alt=""><br>
			<button class="btn-lg btn-danger btn play"><i class="fa fa-play"></i></button>
			<div class="copyright">&copy <a target="_blank" href="">All Rights Reserved</a></div>
		</div>

		<div class="play-ground" style="display:none">
			<div id="point"><b>0</b></div>
			<div id="time"><i class="fa fa-clock-o"></i> <b>1</b>s</div>
			<div class="timeslide"></div>
			<div class="main">
				<b class="num-a">00</b> + <b class="num-b">00</b><br>
				= <b class="result">0</b>
			</div>
			<h4 class="mess"></h4>
			<div class="answer">
				<button class="right choice"><i class="fa fa-check"></i></button>
				<button class="wrong choice"><i class="fa fa-times"></i></button>
			</div>
		</div>

		<div class="end text-center" style="display:none">
			<img src="logo.png" alt=""><br>
			<h4>Bạn ghi được <b class="showPoint"></b> điểm !!!</h4>
			<h4>Điểm cao nhất : <b class="max"></b></h4>
			<br>
			<button class="btn-lg btn-danger btn replay"><i class="fa fa-play"></i></button>
			<div class="copyright">&copy <a target="_blank" href="">All Rights Reserved</a></div>
		</div>

	</div>

</div>


</div>

</body>
<script>
var max = 0;
var rand;
var countDown = null;
var count = 1;
var result;
var showResult;
var a;
var b;
var level = 1;
$(".play").click(function(){
	$(".front").hide();
	$(".play-ground").show();
	start();
})
$(".replay").click(function(){
	$(".play-ground").show();
	$(".end").hide();
	reset();
	start();
})
$(".right").click(function(){
	right();
})
$(".wrong").click(function(){
	wrong();
})
function start(){
	a = (Math.floor(Math.random() * 5) + 1);
	b = (Math.floor(Math.random() * 5) + 1);
	$(".num-a").text(a);
	$(".num-b").text(b);
	rand = (Math.floor(Math.random() * 2));
	if(rand == 1){
		kq = check();
		$(".result").text(kq);
	} else{
		kq = check();

		kq = (Math.floor(Math.random() * 3)+1);
		$(".result").text(kq);
	}
	$(".timeslide").css({'width':'0%'}).animate({width:'100%'},1000);
	countDown = setInterval(time,1000);
}
function next(){
	
	a = (Math.floor(Math.random() * (level * 10)) + 1);
	b = (Math.floor(Math.random() * (level * 10)) + 1);
	$(".num-a").text(a);
	$(".num-b").text(b);
	rand = (Math.floor(Math.random() * 2));
	if(rand == 1){
		kq = check();
		$(".result").text(kq);
	} else{
		kq = check();
		kq = (Math.floor(Math.random() * kq)+rand);
		$(".result").text(kq);
	}
	$('#time b').html(1);
		$(".timeslide").css('width','0%');

	$(".timeslide").css({'width':'0%'}).animate({width:'100%'},1000);
	
}
function check(){
	var kq = a + b;
	return kq;
}
function right(){
	$(".timeslide").css('width','0%');
	var cpoint = parseInt($("#point b").text());
	if(cpoint == 10){
		level++;
		$(".mess").text('Khó hơn :v').fadeIn('fast');
		setTimeout(function(){
			$(".mess").fadeOut('slow');
		},2000);
	}
	result = a + b;
	var rResult = parseInt($(".result").text());
	if(result == rResult){
		addPoint();
		next();
	} else{
		lose();
	}
}
function wrong(){
	$(".timeslide").css('width','0%');

	result = a + b;
	var rResult = parseInt($(".result").text());
	if(result != rResult){
		addPoint();
		next();
	} else{
		lose();
	}
}
function time(){
	var count = parseInt($('#time b').text());
	if(count == 0){
		clearInterval(countDown);
		lose();
	}else{
		$('#time b').html(count - 1);
	}
}

function addPoint(){
	var point = parseInt($("#point b").text());
	$("#point b").text(point + 1);
}
function lose(){
	var point = parseInt($("#point b").text());
	if(point >= max){
	max = point;
	}
	$(".play-ground").hide();
	$(".end").show();
	$('.showPoint').html(point);
	$(".max").text(max);
	clearInterval(countDown);

}
function reset(){
	$("#point b").text(0);
	$('#time b').html(1);
	clearInterval(countDown);
	$(".timeslide").css({'width':'0%'});


}
$(document).keydown(function(event){
	if(event.which == 37){
		right();
	} else if(event.which == 39){
		wrong();
	}
	if(event.which == 13){
		$(".front").hide();
		$(".play-ground").show();
		$(".end").hide();
		reset();
		start();
	}
})
</script>
<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>-->
<!-- <div class="modal fade" id="save">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Thua CMNR</h4>
		</div>
		<div class="modal-body">
			<img src="lose.png" alt=""><br>
			<h3>Bạn hoàn thành được <b id="showpoint"></b> combos !?! Tin nổi không ?</h3>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
			<button type="button" class="btn btn-primary">Lưu vào BXH</button>
		</div>
	</div>
</div>
</div> -->
</html>