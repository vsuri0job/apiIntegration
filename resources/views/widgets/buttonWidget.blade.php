<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="jQuery Button, CheckBox, Toggle Button, Repeat Button, Radio Button, Link Button, Button" /> 
    <meta name="description" content="The jqxLinkButton widget represents a button created from anchor element" />
    <title id='Description'>The jqxLinkButton widget represents a button created from anchor element.</title>
    <link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />	
    <script type="text/javascript" src="../../scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../../scripts/demos.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxbuttons.js"></script>
    <style type="text/css">
        .widget_reviewbuzz.medium.bubble {
    width: 300px;
    height: 300px;
    background: url({{url('assets/widget.png')}}) 0 0;
}
    .widget_reviewbuzz.bubble .reviews {
   width: 80px;
    font-size: 11px;
    margin: 172px 0 0 114px;
}
.widget_reviewbuzz .reviews {
    font: 11px Arial;
    line-height: 20px;
    text-align: center;
    font-weight: bold;
    color: #003c73;
    width: 82px;
    height: 20px;
    position: absolute;
    margin: 70px 0 0 125px;
}
.widget_reviewbuzz.medium.bubble:hover {
   opacity:0.7;
    filter: alpha(opacity=50);
}
}
    </style>
</head>
<body>
    <div id='content'>
        <script type="text/javascript">
            $(document).ready(function () {
                // Create a jqxLinkButton widget.
                $("#jqxButton").jqxLinkButton({ width: '200', height: '30'});
            });
        </script>
        <div style='width:200px;' id='jqxWidget'>
            <div>
               <!--  <a style='margin-left: 25px;' target="_blank" href="http://www.jqwidgets.com" id='jqxButton'>Link Button</a> -->
               <div data-reviews-count="2470" class="medium widget_reviewbuzz bubble">    <div class="stars"><span></span><span></span><span></span><span></span><span class="half"></span></div>    <div class="reviews">2,470 Reviews</div></div>
            </div>
        </div>
    </div>
</body>
</html>