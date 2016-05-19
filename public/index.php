<? $coolepoch = "1234567890"; ?><html><head><style type="text/css">body { background-color: #000;color: #fff;font-family:arial,helvetica;font-size:11em;text-align: center;}a{color: #fff;}#main {margin: 0px auto;margin-top: 150px;text-align:center;}.desc, .desc2{clear: both;font-size: 0.09em;line-height: 35px;letter-spacing: 1px;}.desc2{font-size: 0.07em;color: #aaa;}</style>
<title>Countdown (actually up) to the UNIX Epoch time being <?=$coolepoch;?>!</title>
<meta name="description" content="Come join us to watch the countdown (actually up) to the UNIX Epoch time being <?=$coolepoch;?> live on the internets!" />
<meta name="keywords" content="epoch, countdown, <?=$coolepoch;?>, internets, meme, unix timestamp" />
<meta name="author" content="Chris Rowe" />
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="style/fireworks.css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
<script type="text/javascript" src="script/soundmanager2.js"></script>
<script type="text/javascript" src="script/fireworks.js"></script>
</head>


<!-- IF YOU'RE TRYING TO CHEAT AND SEE WHAT HAPPENED AT 1234567890 THEN STICK javascript:partytime(); IN YOUR ADDRESS BAR -->


<body><div id="main"><span id="timer"><script>var d = new Date();var t = d.getTime();var o = t+"";document.write(o.substring(0,10));</script></span><br/>
<span class="desc">You missed it :( but fear not some other people captured the epoch moment <a href='http://www.youtube.com/watch?v=z7Fl7qCO4Zo&feature=PlayList&p=22DBADA214858C7C&index=0&playnext=1'>on youtube</a> </span><br/>
<span class="desc2">A quick idea by <a href='http://www.chrisrowe.net'>Chris Rowe</a> follow me on twitter <a href='http://www.twitter.com/chrisrowe'>@chrisrowe</a>
&nbsp;&bull;&nbsp; <a href='http://en.wikipedia.org/wiki/Unix_time'>What's the Epoch Time?</a> &nbsp;&bull;&nbsp; Some xkcd <span class="fun">fun</span> with <a href='http://xkcd.com/376/'>epoch fail!</a></span><br/>
</div><div id="fireworks-template"><div id="fw" class="firework"></div><div id="fp" class="fireworkParticle"><img src="image/particles.gif" alt="" /></div></div><div id="fireContainer"></div>
<script>
soundManager.url='/soundmanager2.swf';
soundManager.debugMode=false;
soundManager.onload=function(){soundManager.createSound('woo','/audio/woo.mp3');}

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

	var tweeturl="http://twitter.com/home?status=Only "+thetext+" till the unix epoch time reaches 1234567890 http://coolepochcountdown.com";

	$("#timer").html(o.substring(0,10));
	$('#countdown').text(thetext);

	if(o.substring(0,10)==<?=$coolepoch;?>){partytime();}
	if(o.substring(0,10)<<?=$coolepoch;?>){
		document.title=thetext + " to go...";
		$("#tweet").attr("href",tweeturl);
	}

	if(finish<30){
		if(doparty==true){
			$(".desc").text("Woohoo!!! The epoch timestamp just passed 1234567890!!!");
			var tweeturl="http://twitter.com/home?status=I just watched the unix epoch time reach 1234567890 http://coolepochcountdown.com WAHOO";
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
	document.title="HAPPY 1234567890!!!";
	soundManager.play('woo');
	$(".desc").text("Woohoo!!! The epoch timestamp just passed 1234567890!!!");
}

function missedit(){
	if (appended == false){
		$(".desc2").append("&nbsp;&bull;&nbsp;<span class='fun'>Relive the moment</span>");
		$(".desc").text("You missed it but you can relive the moment below");
		var tweeturl="http://twitter.com/home?status=I just watched the unix epoch time reach 1234567890 http://coolepochcountdown.com WAHOO";
		$("#tweet").attr("href",tweeturl);
		appended=true;
	}
}

var pageTracker=_gat._getTracker("UA-7308649-1");
pageTracker._trackPageview();


</script>
</body>
</html>