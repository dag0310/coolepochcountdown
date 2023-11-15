<?php $coolepoch = !empty($_GET['t']) ? $_GET['t'] : '1234567890'; ?><!DOCTYPE html>
<html>
<head>
	<title>Countdown (actually up) to the UNIX Epoch time being <?= $coolepoch ?>!</title>
	<meta name="description" content="Come join us to watch the countdown (actually up) to the UNIX Epoch time being <?= $coolepoch ?> live on the internets!">
	<meta name="keywords" content="epoch, countdown, <?=$coolepoch;?>, internets, meme, unix timestamp">
	<meta name="author" content="Chris Rowe, Daniel Geymayer">
	<link rel="icon" href="favicon.ico">
	<style type="text/css">body { background-color: #000;color: #fff;font-family:arial,helvetica;text-align: center;}a{color: #fff;} #timer{font-size:15vw;} #main {margin: 0px auto;margin-top: 150px;text-align:center;}.desc, .desc2{clear: both;font-size:2vw;line-height: 35px;letter-spacing: 1px; max-width:75%; margin:0 auto; line-height:1.5em; margin-top:1em;}.desc2{color: #aaa;}.fun { border-bottom:1px dotted #555; cursor:help;}</style>
	<link rel="stylesheet" type="text/css" href="style/fireworks.css" media="screen">
	<script type="text/javascript" src="script/jquery.min.js"></script>
	<script type="text/javascript" src="script/fireworks.js"></script>
</head>

<body>
<div id="main">
	<span id="timer"><script>var d = new Date();var t = d.getTime();var o = t+"";document.write(o.substring(0,10));</script></span>
	<br>

	<p class="desc">
		Only <span id="countdown"></span> until the Epoch Time is <strong><?= $coolepoch ?>!</strong> (<script>document.write(new Date(<?= $coolepoch * 1000 ?>))</script>)
	</p>

	<p class="desc2">
		A quick idea by <a href='http://www.chrisrowe.net'>Chris Rowe</a> follow him on Twitter <a href='http://www.twitter.com/chrisrowe'>@chrisrowe</a>
		<br>
		Extended by <a href="https://geymayer.com">Daniel Geymayer</a>
	</p>
</div>

<div id="fireworks-template"><div id="fw" class="firework"></div><div id="fp" class="fireworkParticle"><img src="image/particles.gif" alt="" /></div></div><div id="fireContainer"></div>

<script>
var wooAudio = new Audio('audio/woo.mp3');

recount();
var doparty=false;
var finish=0;
var appended=false;
setInterval("recount()",1000);

function recount(){

	var d=new Date();
	var t=d.getTime();
	var o=t+"";
	var amn=60;
	var ahr=amn*60;
	var ady=ahr*24;
	var awk=ady*7;
	var diff=<?=$coolepoch;?>-o.substring(0,10);
	var scs=diff;
	var mns=(diff-(diff%amn))/amn;
	var hrs=(diff-(diff%ahr))/ahr;
	var dys=(diff-(diff%ady))/ady;
	var wks=(diff-(diff%awk))/awk;
	dys=dys%7;
	hrs=hrs%24;
	mns=mns%60;
	scs=scs%60;

	var thetext ="";

	if (dys>0){
		thetext=dys+" day";
		if(dys!=1){thetext+="s";}
		thetext+=", ";
	}

	if (hrs>0){
		thetext+=hrs+" hour";
		if(hrs!=1){thetext+="s";}
		thetext+=", ";
	}

	if (mns>0){
		thetext+=mns+" minute";
		if(mns!=1){thetext+="s";}
		thetext+= " and ";
	}
	thetext+=scs+" second";
	if(scs!=1){thetext+="s";}

	var tweeturl="http://twitter.com/home?status=Only "+thetext+" till the unix epoch time reaches <?= $coolepoch ?> http://coolepochcountdown.com";

	$("#timer").html(o.substring(0,10));
	$('#countdown').text(thetext);

	if(o.substring(0,10)==<?=$coolepoch;?>){partytime();}
	if(o.substring(0,10)<<?=$coolepoch;?>){
		document.title=thetext + " to go...";
		$("#tweet").attr("href",tweeturl);
	}else{
		missedit();
	}

	if(finish<30){
		if(doparty==true){
			$(".desc").text("Woohoo!!! The epoch timestamp just passed <?= $coolepoch ?>!!!");
			var tweeturl="http://twitter.com/home?status=I just watched the unix epoch time reach <?= $coolepoch ?> http://coolepochcountdown.com WAHOO";
			$("#tweet").attr("href",tweeturl);
			setTimeout('createFirework(20,50,2,null,null,null,null,null,Math.random()>0.5,true);',(Math.floor(Math.random()*7500)));
			createFirework(20,50,2,null,null,null,null,null,Math.random()>0.5,true)
			finish++;
			if(finish%2==1){
				$("body").css("background-color","gray");
				$("a").css("color","black");
				$("body").css("color","black");
			}else{
				$("body").css("background-color","black");
				$("a").css("color","white");
				$("body").css("color","white");
			}
		}
	}
}

$(".fun").live("click", function(){partytime();});

function partytime(){
	finish=0;
	doparty=true;
	document.title="HAPPY <?= $coolepoch ?>!!!";
	wooAudio.play();
	$(".desc").text("Woohoo!!! The epoch timestamp just passed <?= $coolepoch ?>!!!");
}

function missedit(){
	if (appended == false){
		$(".desc2").append("&nbsp;&bull;&nbsp;<span class='fun'>Relive the moment</span>");
		$(".desc").text("You missed <?=$coolepoch;?>, but fear not - the next cool epoch time will come soon enough :)");
		var tweeturl="http://twitter.com/home?status=I just watched the unix epoch time reach <?= $coolepoch ?> http://coolepochcountdown.com WAHOO";
		$("#tweet").attr("href",tweeturl);
		appended=true;
	}
}
</script>
</body>
</html>
