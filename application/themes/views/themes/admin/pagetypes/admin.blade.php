<!doctype html>
<html lang="{{Config::get('application.language')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Admin Area</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   
   <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>

    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
  
  <!-- Include the Google Charts API -->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
    {{ HTML::script('themes/admin/js/app.js') }} 

</head>
{{ Session::get('info') }}
<body class="dashboard">
  <div class="dashboard-wrapper">
    <div class="container">
      <div class="header_dashboard">
      <div class="row-fluid">
        {{  Elements::get('dashboard_elements') }}
        <div class="span12">
         {{  Elements::get('dashboard_navigation') }}
        </div>
      </div>
    </div>
 <div class="row-fluid">
<div class="span12 main">
<div class="ajax-message"></div>
<br/>
 <div class="row-fluid">
 <div class="span6">
<div class="block header_block">
<h4><i class="icon-signal header-icon"></i> <?php echo Lang::line('dashboard.header_analytics');?>:</h4>
</div>
<br/>
<div class="block">
 @if(!empty($results))


<!-- Create an empty div that will be filled using the Google Charts API and the data pulled from Google -->
<div id="chart"></div>




<!-- Create a new chart and plot the pageviews for each day -->
<script type="text/javascript">
  
 

  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();

       
    data.addColumn('string', 'Day');
    data.addColumn('number', 'Pageviews');
    
   
    

    data.addRows([
      <?php
      foreach($results as $result) {
          echo '["'.date('M j',strtotime($result->getDate())).'", '.$result->getPageviews().'],';
      }
      ?>
    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart'));
    chart.draw(
    data, {
    titleTextStyle: {
    color: '#333',
    fontName: 'Quantico',
    fontSize: 12,}, 
    width:"100%", 
    height:"750%", 
    title: 'Data for the period : <?php echo date('M j, Y',strtotime('-30 day')).' - '.date('M j, Y'); ?>',
    colors:['#8CC63F','#e6f4fa'],
    areaOpacity: 0.2,
     lineWidth:'1',
     vAxis: {title: "Views", textPosition: 'in',textStyle: { color: '#8CC63F', fontSize: 8, fontName: 'Quantico',}},                 
     hAxis: { textPosition: 'in', showTextEvery: 2, slantedText: false, textStyle: { color: '#333', fontSize: 12 ,fontName: 'Quantico',} },
     pointSize: 10,
     chartArea:{left:10,top:30,width:"95%",height:"100%"},
     "backgroundColor": { fill: "none" }, 
     animation:{duration:'800',easing:'in'},
     legendTextStyle: {color: '#333',  fontSize: 89, fontName: 'Quantico',},
     tooltipTextStyle: {color: '#111',  fontSize: 10, fontName: 'Quantico',}
                      
                     
    });
  }

</script>

@else



<h4>{{Lang::line('dashboard.analytics_inactive')->get()}}</h4>



@endif
</div>
<br/>
</div>

<div class="span6">
  <div class="block header_block">
<h4><i class="icon-envelope header-icon"></i> <?php echo Lang::line('dashboard.header_messages');?>:</h4>
</div>
<br/>
 <div class="block">
   <p>No messages...</p>

   
 </div>
</div>
</div>
</div>
</div>

<br/>

<div class="header_dashboard">
<div class="row-fluid">
<div class="span12">
<div class="span4"></div>
<div class="span4">
{{  Elements::get('admin_footer') }}
</div>
<div class="span4"></div>
</div>
</div>
</div>
   
    
</body>
</html>
