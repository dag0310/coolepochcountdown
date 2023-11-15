<?php $coolepochtimes = [1234567890, 1700000000, 1717171717, 1777777777, 1800000000, 1818181818, 1888888888, 1900000000, 1919191919, 1999999999, 2000000000, 202020202020, 2100000000, 2121212121, 2147485547]; ?>
<?php $coolepochtimes_in_future = []; foreach ($coolepochtimes as $cet) { if (time() > $cet) continue; $coolepochtimes_in_future[] = $cet; } ?>
<?php $coolepoch = !empty($_GET['t']) ? $_GET['t'] : strval($coolepochtimes_in_future[0]); ?><!DOCTYPE html>
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

	<p id="desc" class="desc">
		Only <span id="countdown"></span> until the Epoch Time is <strong><?= $coolepoch ?>!</strong> (<script>document.write(new Date(<?= $coolepoch * 1000 ?>))</script>)
	</p>

	<p class="desc">
		Here are some other cool epoch times:
<?php foreach ($coolepochtimes_in_future as $cetif): ?>
		<a href="?t=<?= $cetif ?>"><?= $cetif ?></a>
<?php endforeach ?>
	</p>

	<p id="desc2" class="desc2">
		A quick idea by <a href='http://www.chrisrowe.net'>Chris Rowe</a> follow him on Twitter <a href='http://www.twitter.com/chrisrowe'>@chrisrowe</a>
		<br>
		Extended beyond 1234567890 by <a href="https://geymayer.com">Daniel Geymayer</a>
	</p>
</div>

<div id="fireworks-template"><div id="fw" class="firework"></div><div id="fp" class="fireworkParticle"><img src="image/particles.gif" alt="" /></div></div><div id="fireContainer"></div>

<script>
var wooAudio = new Audio('audio/woo.mp3');

var doparty=false;
var finish=0;
var appended=false;
setInterval(recount,1000);
recount();
function recount(){

	var d=new Date();
	var t=d.getTime();
	var o=t+"";
	var amn=60;
	var ahr=amn*60;
	var ady=ahr*24;
	var ayr=ady*365;
	var diff=<?=$coolepoch;?>-o.substring(0,10);
	var scs=diff;
	var mns=(diff-(diff%amn))/amn;
	var hrs=(diff-(diff%ahr))/ahr;
	var dys=(diff-(diff%ady))/ady;
	var yrs=(diff-(diff%ayr))/ayr;
	dys=dys%365;
	hrs=hrs%24;
	mns=mns%60;
	scs=scs%60;

	var thetext ="";

	if (yrs>0){
		thetext+=yrs+" year";
		if(yrs!=1){thetext+="s";}
		thetext+=", ";
	}

	if (dys>0){
		thetext+=dys+" day";
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
			$("#desc").text("Woohoo!!! The epoch timestamp just passed <?= $coolepoch ?>!!!");
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
	$("#desc").text("Woohoo!!! The epoch timestamp just passed <?= $coolepoch ?>!!!");
}

function missedit(){
	if (appended == false){
		$("#desc2").append("&nbsp;&bull;&nbsp;<span class='fun'>Relive the moment</span>");
		$("#desc").text("You missed <?=$coolepoch;?>, but fear not - the next cool epoch time will come soon enough :)");
		var tweeturl="http://twitter.com/home?status=I just watched the unix epoch time reach <?= $coolepoch ?> http://coolepochcountdown.com WAHOO";
		$("#tweet").attr("href",tweeturl);
		appended=true;
	}
}
</script>
</body>
</html>
