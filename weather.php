<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>The Weather</title>
    <style>
     * { font-family: "Myriad Pro", Helvetica, serif; font-size: 25px}
     #what, a { font-size: 60px; }
    a{ text-decoration: none; color: #02509f}
    a:visited{ color: #02509f }
    a:hover{ color: #5d99d7 }
     div,h1{ width: 400px; display: block; margin: auto; text-align: center; padding: 10px;}
     h1{ margin-top: 100px; font-size: 40px; }
    </style>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js'></script>
<script>
//<![CDATA[
    function getip(json){
        //        alert(json.ip); // alerts the ip address
        page = "http://api.ipinfodb.com/v2/ip_query.php?key=1a4729c64f980625e518dc8122d9ca63d2a9ef738377c1fe96d9a8a107469d7d&ip="+json.ip
                +"&output=json&timezone=false&callback=?";
        $.ajax({
          url: page,
          dataType: 'json',
          success: jsoncallback
        });
    }

    function jsoncallback(json){
        city = json['ZipPostalCode'];
        $("#searchcontrol").html("Loading... for "+city);
        page = "/weather.php?zip="+city;
        $.ajax({
            url: page,
            dataType: 'html',
            success: getweather
        });}

    function getweather(json){
        $("#searchcontrol").html("");
        $("#searchcontrol").replaceWith(json.replace(/<span.+?>/g, ""));
        $("#what").html("<a target='_blank' href='http://www.wunderground.com/cgi-bin/findweather/hdfForecast?query="+$("#zip").html()+"'>"+$("#what").html()+"</a>");
        $("#zip").html("Weather for " + $("#zip").html());
        $("#when").html($("#when").html() + " will be: ");
    }
//]]>
</script>
</head><body><h1>What's the Weather?</h1>
 <script type="application/javascript" src="http://jsonip.appspot.com/?callback=getip"></script>
    <div id="searchcontrol">Loading...</div>
  </body>
</html>
