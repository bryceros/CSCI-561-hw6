<html>
<head>
<style>
    body{
        position: absolute;
        margin: auto 0;
    }
    .main_block{
        height: 243px;
        width: 610px;
        margin: 0 auto;
        padding: 10px 0;
        color: white;
        background-color: rgb(44,159,44);
        position: relative;
        border-radius: 10px;
    }
    #other_block{
        margin: 0 auto;
    }
    .title{
        font-style: italic;
        text-align:center;
        font-size: 2.3em;
        margin: 0 auto;
    }
    .anchor{
        margin: 0 auto;
        text-align: center;
        vertical-align: bottom;
        position: absolute;
        bottom: 10px;
        width:90%;
    }
    .right{
        float:right;
        padding-right:40px;
    }
    .error{
        display: table;
        margin: 0 auto;
        padding: 0 3em;
        border: 2px solid rgb(154,154,154);
        color:black;
        background-color: rgb(236,236,236);

    }
    .card {
        width: 360px;
        height: 240px;
        margin: 0 auto;
        background-color: RGB(79,182,240);
        color: white;
        border-radius: 10px;
        font-size:1.3em;
    }
    .card ul {
        padding: 10px 10px;
    }
    .card ul li {
        margin: 0.1em 0;
    }
    .city{
        font-size:1.3em;
    }
    .timezone{
        font-size:0.6em;
    }
    .temperature{
        font-size:3.6em;
    }
    .temperature img{
        vertical-align: top;
        width: 10px;
        height: 10px;
    }
    .temperature span{
        font-size:0.5em;
    }
    .summary{
        font-size:1.3em;
    }
    span.item {
        vertical-align: top;
        display: table-cell;
        text-align: center;
        width: 20px;
    }
    span.item span.hover{
        visibility: hidden;
        display:inline;
        position: absolute;
        z-index: 1;
        margin-top: 15px;
        color:black;
        background-color:rgba(255,255,255,.5);
        font-size:0.8em
    }
    span.item:hover span.hover{
        visibility: visible;
    }
    ul{
        list-style: none;
    }
    img {
        width: 20px;
        height: 20px;
    }
    .caption {
        display: block;
    }
    .menu{
        display: table;
        table-layout: fixed;
        width: 100%;
    }
    #table {
        display: table;
        margin: 0 auto;         
        table-layout: fixed;
        text-align:center;
        border: 1px solid blue;
        background-color: RGB(79,182,240);
        color: white;

    }
    .row {
        display: table-row;        
        text-align:center;
        border: 1px solid black;
    }
    .cell {
        display: table-cell;         
        text-align:center;
        border: 1px solid blue;
        padding: 5px 5px;
    }
    .summary_card{
        width: 405px;
        height: 340px;
        margin: 0 auto;
        border-radius:10px;
        background-color: RGB(152,198,208);
        color: white;
    }
    .sum_temp{
        display:inline-block;
        margin-top: 60px;
        margin-left:20px;
    }
    .sum{
        font-size:1.8em;
    }
    .temp{
        font-size:5em;
    }
    .temp img{
        vertical-align: top;
        width: 10px;
        height: 10px;
    }
    .temp span{
        font-size:0.8em;
    }
    .icon{
        width: 180px;
        height: 180px;
        float: right;

    }
    .stats{
        margin-top:0;
    }
    .stat_title{
        display:inline-block;
        width:65%;
        text-align:right;
        vertical-align: middle;
    }
    .stat_value{
        display:inline-block;
        vertical-align: middle;
        font-size: 1.4em;
    }
    .stat_value span{
        font-size: 0.6em;
    }
    .graph_button{
        width: 50px;
        height: 50px;
        margin: -1em auto;
        background-size: contain;
        background-repeat: none;
        background-image:URL("https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-down-512.png");
    }
    .graph_title{
        margin:auto 0;
        text-align:center;
        font-size: 1.5em;
    }
    #chart{
        width: 100wh;
        height: 200px;
        margin: 0 auto;
        visibility: hidden;
    }
    .main_block,.card,#table,.summary_card,.graph_title,#chart{
        margin: 1em auto;
    }
    form ul li span{
        display:inline-block;
        width:13%;
    }
    .input_box {
        display:inline-block;
        width:57.5%;
        height:65%;
        border-right: white 4px solid;
    }

/* Inline #1 | http://localhost:8000/ */

.input_box ul li {
  padding: 2px;
}

/* Inline #0 | http://localhost:8000/ */


</style>
</head>
<body>
    <div class="main_block">
    <h2 class="title"> Weather Search</h2>
    <form id="myform" method="post" action="">
        <div class="input_box">
        <ul>
            <li>
                <span>Street</span>
                <input name="street" value="">
            </li>
            <li>
                <span>City</span>
                <input name="city" value="">
            </li>
            <li>
                <span>State</span>
                <Select name="state" value=""></select>
            </li>
        </ul>
        </div>
        <span class="right">
                <input type="checkbox"  name="current_location">
                <span>Current Location</span>
        </span>
        <div class="anchor">
            <input type="submit" value="search" onsubmit="return validateForm()">
            <input type="reset" value="clear">
        </div>
    </form>
    </div>
    <div id="other_block"><div>
    <?php
        $street = $_POST["street"];
        $current_location = $_POST["current_location"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $coordinates['lat'] = $_POST["lat"];
        $coordinates['lng'] = $_POST["lng"];
        $time = $_POST["time"];
        if(isset($coordinates['lat']) && isset($coordinates['lng']) && isset($time)){
            $data = getDetailSummary($coordinates,$time);
            $innerHTML= generateSummary($data);
            $innerHTML .= generateGraph($data["Hourly"]);
            echo $innerHTML;
        } else if(isset($coordinates['lat']) && isset($coordinates['lng'])){
            $data = getForcast($coordinates);
            $data["Card"]["City"] = $city;
            $data["Coord"] = $coordinates;
            echo generateHTML($data);
        } else if (isset($street) && isset($city) && isset($state)) {
            $coordinates = geocodeAddress($street, $city, $state);
            $data = getForcast($coordinates);
            $data["Card"]["City"] = $city;
            $data["Coord"] = $coordinates;
            echo generateHTML($data);
        }

        function generateHTML($data){
            $innerhtml = generateCard($data["Card"]); 
            $innerhtml .= generateTable($data["Table"],$data["Coord"]); 
            return $innerhtml;           
        }
        function generateTable($data,$coord){
            $status_img["clear-day"] = $status_img["clear-night"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-12-512.png";
            $status_img["rain"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-04-512.png";
            $status_img["snow"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-19-512.png";
            $status_img["sleet"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-07-512.png";
            $status_img["wind"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.pn";
            $status_img["fog"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png";
            $status_img["cloudy"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-01-512.png";
            $status_img["partly-cloudy-day"] = $status_img["partly-cloudy-night"] = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-02-512.png";
            $keys = ["Date","Status","Summary","TemperatureHigh","TemperatureLow","Wind Speed"];
            $innearhtml = '<div id="table"><div class="row">';
            for($i=0;$i<count($keys);++$i){
                $innearhtml .= '<span class="cell">'.$keys[$i].'</span>';
            }
            $innearhtml .= '</div>';
            for($i=0;$i<count($data);++$i){
                $innearhtml .= '<div class="row">';
                for($j=0;$j<count($keys);++$j){
                    if($keys[$j] == "Status"){
                        $innearhtml .= '<span class="cell"><img src="'.$status_img[$data[$i][$keys[$j]]].'"></span>';
                    } else if($keys[$j] == "Date"){
                        $innearhtml .= '<span class="cell">'.date('Y--m--d', $data[$i][$keys[$j]]).'</span>';
                    } else if($keys[$j] == "Summary"){
                        $packet['lat'] = $coord['lat'];
                        $packet['lng'] = $coord['lng'];
                        $packet["time"] = $data[$i]["Date"];
                        $innearhtml .= '<span class="cell link" packet='.json_encode($packet).'>'.$data[$i][$keys[$j]].'</span>';
                    } else{
                        $innearhtml .= '<span class="cell">'.$data[$i][$keys[$j]].'</span>';
                    }
                }
                $innearhtml .= '</div>';
            }
            $innearhtml .= '</div>';
            return $innearhtml;
        }
        function generateCard($data){
            $temperature_img = "https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png"; 
            $humidity_img = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-16-512.png";
            $pressure_img = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-25-512.png";
            $windSpeed_img = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.png";
            $visibility_img = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-30-512.png";
            $cloudCover_img = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png";
            $ozone_img = "https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-24-512.png";
            return '<div class="card">
            <ul>
            <li class="city">'.$data["City"].'</li>
            <li class="timezone">'.$data["Timezone"].'</li>
            <li class="temperature">'.round($data["Temperature"]).'<img src="'.$temperature_img.'"><span>F</span></li>
            <li class="summary">'.$data["Summary"].'</li>
            <li>
            <div class="menu">
            <span class="item">
            <img src="'.$humidity_img.'"/>
            <span class="hover">Humidity</span>
            <span class="caption">'.$data["Humidity"].'</span>
            </span>
            <span class="item">
            <img src="'.$pressure_img.'"/>
            <span class="hover">Pressure</span>
            <span class="caption">'.$data["Pressure"].'</span>
            </span>
            <span class="item">
            <img src="'.$windSpeed_img.'"/>
            <span class="hover">Wind Speed</span>
            <span class="caption">'.$data["WindSpeed"].'</span>
            </span>
            <span class="item">
            <img src="'.$visibility_img.'"/>
            <span class="hover">Visibility</span>
            <span class="caption">'.$data["Visibility"].'</span>
            </span>
            <span class="item">
            <img src="'.$cloudCover_img.'"/>
            <span class="hover">Cloud Cover</span>
            <span class="caption">'.$data["CloudCover"].'</span>
            </span>
            <span class="item">
            <img src="'.$ozone_img.'"/>
            <span class="hover">Ozone</span>
            <span class="caption">'.$data["Ozone"].'</span>
            </span>
            </div>
            </li>
            </ul>
            </div>';
        }
        function generateGraph($data){
            $packet["Up"] = "https://cdn0.iconfinder.com/data/icons/navigation-set-arrows-part-one/32/ExpandLess-512.png";
            $packet["Down"] = "https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-down-512.png";
            $packet["Hourly"] = $data;
            return '<div class="graph_block">
            <div class="graph_title">Day\'s Hourly Weather</div>
            <div class="graph_button"packet='.json_encode($packet).'></div>
            <div id="chart"></div>
            </div>';
        }
        function generateSummary($data){

            $icon_img["clear-day"] = $icon_img["clear-night"] = "https://cdn3.iconfinder.com/data/icons/weather-344/142/sun-512.png";
            $icon_img["rain"] = "https://cdn3.iconfinder.com/data/icons/weather-344/142/rain-512.png";
            $icon_img["snow"] = "https://cdn3.iconfinder.com/data/icons/weather-344/142/snow-512.png";
            $icon_img["sleet"] = "https://cdn3.iconfinder.com/data/icons/weather-344/142/lightning-512.png";
            $icon_img["wind"] = "https://cdn4.iconfinder.com/data/icons/the-weather-is-nice-today/64/weather_10-512.png";
            $icon_img["fog"] = "https://cdn3.iconfinder.com/data/icons/weather-344/142/cloudy-512.png";
            $icon_img["cloudy"] = "https://cdn3.iconfinder.com/data/icons/weather-344/142/cloud-512.png";
            $icon_img["partly-cloudy-day"] = $icon_img["partly-cloudy-night"] = "https://cdn3.iconfinder.com/data/icons/weather-344/142/sunny-512.png";
            $temperature_img = "https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png";
            
            function precipIntensity($value){
                if($value <= 0.001){
                    return 'None';
                } else if($value <= 0.015){
                    return 'Very Light';
                } else if($value <= 0.05){
                    return 'Light';
                } else if($value <= 0.1){
                    return 'Moderate';
                } else {
                    return 'heavy';
                } 
            }
            $innerhtml = '<div class="graph_title">Daily Weather Detail</div><div class="summary_card">';
            $innerhtml .= '<div class=sum_temp><div class=sum>'.$data['Summary'].'</div><div class=temp>'.round($data['Temperature']).'<img src="'.$temperature_img.'"><span>F</span></div></div>';
            $innerhtml .= '<image class="icon" src="'.$icon_img[$data['Icon']].'">';

            $innerhtml .= '<div class="stats">
            <div class="precipitation"><span class="stat_title">Precipitation: </span><span class="stat_value">'.precipIntensity($data["Precipitation"]).'</span></div>
            <div class="rain"><span class="stat_title">Chance of Rain: </span><span class="stat_value">'.round($data["Chance of Rain"]*100).'<span> %</span></span></div>
            <div class="wind_speed"><span class="stat_title">Wind Speed: </span><span class="stat_value">'.$data["Wind Speed"].'<span> mph</span></span></div>
            <div class="humidity"><span class="stat_title">Humidity: </span><span class="stat_value">'.round($data["Humidity"]*100).'<span> %</span></span></div>
            <div class="visibility"><span class="stat_title">Visibility: </span><span class="stat_value">'.$data["Visibility"].'<span> mi</span></span></div>
            <div class="sunrise_sunset"><span class="stat_title">Sunrise / Sunset: </span><span class="stat_value">'.explode(" ",ltrim(date('h A', $data["Sunrise"]),'0'))[0].'<span> '.explode(" ",ltrim(date('h A', $data["Sunrise"]),'0'))[1].'</span> / '.explode(" ",ltrim(date('h A', $data["Sunset"]),'0'))[0].'<span> '.explode(" ",ltrim(date('h A', $data["Sunset"]),'0'))[1].'</span></span></div>
            </div>';
            $innerhtml .= '</div>';
            return $innerhtml;

        }
        function getDetailSummary($coordinates,$time){
            $address = $coordinates['lat'].', '.$coordinates['lng'].', '.$time;
            $api_key = "89b9849303b7b90094b011d8ebd2489d";
            $url = "https://api.darksky.net/forecast/".$api_key."/".$address."?exclude=minutely";
            $data = json_decode(file_get_contents($url),TRUE);
            $summary['Summary'] = $data["currently"]["summary"];
            $summary['Temperature'] = $data["currently"]["temperature"];
            $summary['Icon'] = $data["currently"]["icon"];
            $summary['Precipitation'] = $data["currently"]["precipIntensity"];
            $summary['Chance of Rain'] = $data["currently"]["precipProbability"];
            $summary['Wind Speed'] = $data["currently"]["windSpeed"];
            $summary['Humidity'] = $data["currently"]["humidity"];
            $summary['Visibility'] = $data["currently"]["visibility"];
            $summary['Sunrise'] = $data["daily"]["data"][0]['sunriseTime']-$data["daily"]["data"][0]['time'];
            $summary['Sunset'] = $data["daily"]["data"][0]['sunsetTime']-$data["daily"]["data"][0]['time'];
            $summary['Hourly'] = array();
            for($i =0; $i < count($data["hourly"]["data"]);++$i){
                array_push($summary['Hourly'],$data["hourly"]["data"][$i]["temperature"]);
            }
            return $summary;
        }
        function getForcast($coordinates){
            $address = $coordinates['lat'].', '.$coordinates['lng'];
            $api_key = "89b9849303b7b90094b011d8ebd2489d";
            $url = "https://api.darksky.net/forecast/".$api_key."/".$address."?exclude=minutely,hourly,alerts,flags";
            $content = @file_get_contents($url);
            if (strpos($http_response_header[0], "200")){
                $data = json_decode($content,TRUE);
                $card['Timezone'] = $data["timezone"];
                $card['Temperature'] = $data["currently"]["temperature"];
                $card['Summary'] = $data["currently"]["summary"];
                $card['Humidity'] = $data["currently"]["humidity"];
                $card['Pressure'] = $data["currently"]["pressure"];
                $card['WindSpeed'] = $data["currently"]["windSpeed"];
                $card['Visibility'] = $data["currently"]["visibility"];
                $card['CloudCover'] = $data["currently"]["cloudCover"];
                $card['Ozone'] = $data["currently"]["ozone"];
                
                $reval["Card"] = $card;
                for($i =0; $i < count($data["daily"]["data"]);++$i){
                    $table[$i]['Date'] = $data["daily"]["data"][$i]["time"];
                    $table[$i]['Status'] = $data["daily"]["data"][$i]["icon"];
                    $table[$i]['Summary'] = $data["daily"]["data"][$i]["summary"];
                    $table[$i]['TemperatureHigh'] = $data["daily"]["data"][$i]["temperatureHigh"];
                    $table[$i]['TemperatureLow'] = $data["daily"]["data"][$i]["temperatureLow"];
                    $table[$i]['Wind Speed'] = $data["daily"]["data"][$i]["windSpeed"];
                }

                $reval["Table"] = $table;

                return $reval;
            } else{
                echo "<span class=\"error\">Address is not valid</span>";
                exit();
            }
        }
        function geocodeAddress($street, $city, $state){
            $coordinates['lat'] = null;
            $coordinates['lng'] = null;
            $address = urlencode( $street.' '.$city.', '.$state);
            $api_key = "AIzaSyByVe_oKFDcxgoi_USkqNkurU28eilrz3A";
            $url = "https://maps.googleapis.com/maps/api/geocode/xml?address=".$address."&key=".$api_key."";
            //setting the curl parameters.
            
            $headers = array(
                "Content-type: text/xml;charset=\"utf-8\"",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "SOAPAction: \"run\""
            );

                    try{
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);

                        // send xml request to a server

                        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

                        curl_setopt($ch, CURLOPT_POSTFIELDS,  $xmlRequest);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                        curl_setopt($ch, CURLOPT_VERBOSE, 0);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        $data = curl_exec($ch);

                        //convert the XML result into array
                        if($data === false){
                            $error = curl_error($ch);
                            echo "<span class=\"error\">Address is not valid</span>";
                            exit();
                        }else{

                            $data = json_decode(json_encode(simplexml_load_string($data)),TRUE);  
                            $coordinates['lat'] = $data["result"]["geometry"]["location"]["lat"];
                            $coordinates['lng'] = $data["result"]["geometry"]["location"]["lng"];
                        }
                        curl_close($ch);

                    }catch(Exception  $e){
                        echo "<span class=\"error\">Address is not valid</span>";
                }
            return $coordinates;
        }
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        street_dom = document.getElementsByName("street")[0];
        current_location_dom = document.getElementsByName("current_location")[0];
        city_dom = document.getElementsByName("city")[0];
        state_dom = document.getElementsByName("state")[0];
        form_dom = document.getElementById("myform");
        block_dom = document.getElementById("other_block");
        html_dom = document.getElementsByTagName("html")[0];

        function update_dom(){
            var new_street_dom = document.getElementsByName("street")[0];
            var new_current_location_dom = document.getElementsByName("current_location")[0];
            var new_city_dom = document.getElementsByName("city")[0];
            var new_state_dom = document.getElementsByName("state")[0];
            var new_form_dom = document.getElementById("myform");
            var new_block_dom = document.getElementById("other_block");
            var new_html_dom = document.getElementsByTagName("html")[0];

            new_street_dom.value = street_dom.value;
            new_city_dom.value = city_dom.value;
            
            new_state_dom.innerHTML = state_dom.innerHTML;
            new_state_dom.selectedIndex = state_dom.selectedIndex;

            new_current_location_dom.onclick = current_location_dom.onclick;
            if(current_location_dom.checked){
                new_current_location_dom.checked = true;
                new_street_dom.disabled =true;
                new_street_dom.value = "";
                new_city_dom.disabled =true;
                new_city_dom.value = "";
                new_state_dom.disabled=true;
                new_state_dom.selectedIndex = 0;
            }

            new_form_dom.onsubmit = form_dom.onsubmit;
            new_form_dom.onreset = form_dom.onreset;
            
            street_dom =  new_street_dom;
            current_location_dom = new_current_location_dom;
            city_dom = new_city_dom;
            state_dom = new_state_dom;
            form_dom = new_form_dom;
            block_dom = new_block_dom;
            html_dom = new_html_dom;

            
            var links = document.getElementsByClassName("link")
            for(var i=0, max=links.length; i < max; i++){
                links[i].onclick = function(){
                    console.log(this.getAttribute("packet"));
                    var packet = JSON.parse(this.getAttribute("packet"));
                    var form = new FormData();
                    for ( var key in packet ) {
                        form.append(key, packet[key]);
                    }
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            html_dom.innerHTML= xhr.responseText;
                            update_dom();
                            graph_button_dom = document.getElementsByClassName("graph_button")[0];
                            var packet= JSON.parse(graph_button_dom.getAttribute("packet"));
                            graph_button_dom.style.backgroundImage = "url("+packet["Down"]+")";
                            graph(packet["Hourly"]);
                            graph_button_dom.onclick = function(){
                                var packet = JSON.parse(this.getAttribute("packet"));
                                if ("url(\""+packet["Down"]+"\")" == this.style.backgroundImage){
                                    this.style.backgroundImage = "url("+packet["Up"]+")";
                                    document.getElementById('chart').style.visibility = "visible";
                                } else{
                                    this.style.backgroundImage = "url("+packet["Down"]+")"
                                    document.getElementById('chart').style.visibility = "hidden";
                                }
                            } 
                        }
                    }
                    xhr.open("post", "index.php")
                    xhr.send(form);
                    x = 2;
                }
            } 
        }
        function graph(hourly){
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'Hourly');
                data.addColumn('number', 'T');
                for(i = 0; i<hourly.length; ++i){
                    data.addRow([i, hourly[i]]);
                }
                var options = {
                curveType: 'function',
                hAxis: {
                    title: 'Time',
                },
                vAxis: {
                    title: 'Temperature',
                },
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart'));

                chart.draw(data, options);
            }
        }
        form_dom.onreset = function(){
            block_dom.innerHTML="";
            street_dom.disabled=false;
            city_dom.disabled=false;
            state_dom.disabled=false;
            form_dom.reset();
        };
        form_dom.onsubmit = function(){
            if(current_location_dom.checked){
                var url = "http://ip-api.com/json";
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(xhr.responseText);
                        var coord = new FormData();
                        coord.append("lat",data["lat"]);
                        coord.append("lng",data["lon"]);
                        coord.append("city",data["city"]);
                        var xhr2 = new XMLHttpRequest();
                        xhr2.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                html_dom.innerHTML= xhr2.responseText;
                                update_dom();
                                x =3;
                            }
                        };
                                xhr2.open("post", "index.php")
                                xhr2.send(coord);
                    }       
                };
                xhr.open("post", url, false)
                xhr.send();
            }
            else {
                if(street_dom.value == ""){
                    block_dom.innerHTML = "<span class=\"error\">Please check the input street</span>";
                }
                else if(city_dom.value == ""){
                    block_dom.innerHTML = "<span class=\"error\">Please check the input city</span>";
                }
                else if(state_dom.selectedIndex == 0){
                    block_dom.innerHTML = "<span class=\"error\">Please check the input state</span>";
                }
                else{
                    var form = new FormData(form_dom);
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            html_dom.innerHTML= xhr.responseText;
                            update_dom();

                        }
                    }
                    xhr.open("post", "index.php")
                    xhr.send(form);
                }
            }
            return false;

        };

        current_location_dom.onclick = function (){
            if(this.checked){
                street_dom.disabled =true;
                street_dom.value = "";
                city_dom.disabled =true;
                city_dom.value = "";
                state_dom.disabled=true;
                state_dom.selectedIndex = 0;
            }   else {
                street_dom.disabled=false;
                city_dom.disabled=false;
                state_dom.disabled=false;
            }
        };
        function generateSelectState(dom,data){
            var state_data = {
                "States":[
                {
                "Abbreviation":"AL",
                "State":"Alabama"
                },
                {
                "Abbreviation":"AK",
                "State":"Alaska"
                },
                {
                "Abbreviation":"AZ",
                "State":"Arizona"
                },
                {
                "Abbreviation":"AR",
                "State":"Arkansas"
                },
                {
                "Abbreviation":"CA",
                "State":"California"
                },
                {
                "Abbreviation":"CO",
                "State":"Colorado"
                },
                {
                "Abbreviation":"CT",
                "State":"Connecticut"
                },
                {
                "Abbreviation":"DE",
                "State":"Delaware"
                },
                {
                "Abbreviation":"DC",
                "State":"District Of Columbia"
                },
                {
                "Abbreviation":"FL",
                "State":"Florida"
                },
                {
                "Abbreviation":"GA",
                "State":"Georgia"
                },
                {
                "Abbreviation":"HI",
                "State":"Hawaii"
                },
                {
                "Abbreviation":"ID",
                "State":"Idaho"
                },
                {
                "Abbreviation":"IL",
                "State":"Illinois"
                },
                {
                "Abbreviation":"IN",
                "State":"Indiana"
                },
                {
                "Abbreviation":"IA",
                "State":"Iowa"
                },
                {
                "Abbreviation":"KS",
                "State":"Kansas"
                },
                {
                "Abbreviation":"KY",
                "State":"Kentucky"
                },
                {
                "Abbreviation":"LA",
                "State":"Louisiana"
                },
                {
                "Abbreviation":"ME",
                "State":"Maine"
                },
                {
                "Abbreviation":"MD",
                "State":"Maryland"
                },
                {
                "Abbreviation":"MA",
                "State":"Massachusetts"
                },
                {
                "Abbreviation":"MI",
                "State":"Michigan"
                },
                {
                "Abbreviation":"MN",
                "State":"Minnesota"
                },{
                "Abbreviation":"MS",
                "State":"Mississippi"
                },{
                "Abbreviation":"MO",
                "State":"Missouri"
                },{
                "Abbreviation":"MT",
                "State":"Montana"
                },{
                "Abbreviation":"NE",
                "State":"Nebraska"
                },{
                "Abbreviation":"NV",
                "State":"Nevada"
                },{
                "Abbreviation":"NH",
                "State":"New Hampshire"
                },{
                "Abbreviation":"NJ",
                "State":"New Jersey"
                },{
                "Abbreviation":"NM",
                "State":"New Mexico"
                },{
                "Abbreviation":"NY",
                "State":"New York"
                },{
                "Abbreviation":"NC",
                "State":"North Carolina"
                },{
                "Abbreviation":"ND",
                "State":"North Dakota"
                },{
                "Abbreviation":"OH",
                "State":"Ohio"
                },{
                "Abbreviation":"OK",
                "State":"Oklahoma"
                },{
                "Abbreviation":"OR",
                "State":"Oregon"
                },{
                "Abbreviation":"PA",
                "State":"Pennsylvania"
                },{
                "Abbreviation":"RI",
                "State":"Rhode Island"
                },{
                "Abbreviation":"SC",
                "State":"South Carolina"
                },{
                "Abbreviation":"SD",
                "State":"South Dakota"
                },{
                "Abbreviation":"TN",
                "State":"Tennessee"
                },{
                "Abbreviation":"TX",
                "State":"Texas"
                },{
                "Abbreviation":"UT",
                "State":"Utah"
                },{
                "Abbreviation":"VT",
                "State":"Vermont"
                },{
                "Abbreviation":"VA",
                "State":"Virginia"
                },{
                "Abbreviation":"WA",
                "State":"Washington"
                },{
                "Abbreviation":"WV",
                "State":"West Virginia"
                },{
                "Abbreviation":"WI",
                "State":"Wisconsin"
                },
                {
                "Abbreviation":"WY",
                "State":"Wyoming"
                }
                ]
                };
            var text = "<option Selected>State</option> <option>------------------</option>";
            for(i = 0; i < state_data.States.length; ++i){
                text += "<option value=\""+state_data.States[i].Abbreviation+"\">"+state_data.States[i].State+"</option>";
            }
            dom.innerHTML = text;
        }
        generateSelectState(state_dom,"States.txt")

    </script>
</body>
</html>