<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>My Bootstrap 101 Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Any description nga imo ebutang about your page or apps">
<meta name="author" content="Your name here">
<!-- Bootstrap CSS 
	     Note: bootstrap.min.css simple means minified (compact). Actually you can use bootstrap.css, to see how the CSS is done
	-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap CSS Responsive (if e resize nimo ang browser mo auto resize ang page, re-align/reform etc.) -->
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<style type="text/css">
      /*
	   *  Your created style here.
	   *  Author       : Your name
	   *  Date created : 
       *  Date modified: 
	   */
	  body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
</head>
<body>
<!-- 
With navbar-inverse
<div class="navbar navbar-inverse navbar-fixed-top">
-->

<!-- default not using navbar-inverse -->
<div class="navbar navbar-fixed-top">

  <div class="navbar-inner"> 
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
      <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
      </a> <a class="brand" href="#">Trouble Ticket</a> 
      <div class="nav-collapse collapse"> 
        <ul class="nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown 
            <b class="caret"></b></a> 
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li class="nav-header">Nav header</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form pull-right">
          <input class="span2" type="text" placeholder="Email">
          <input class="span2" type="password" placeholder="Password">
          <button type="submit" class="btn">Sign in</button>
        </form>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
<div class="container"> 

  <!-- Example row of columns -->
  <div class="row"> 
    <div class="span8"> 
      <h3>Table example</h3>
      <table class="table table-hover table-bordered table-striped">
        <tr> 
          <th>#</th>
          <th>Studid</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Year</th>
          <th>Course</th>
          <th>Status</th>
        </tr>
        <tr> 
          <td>1</td>
          <td>2008-2103</td>
          <td> ALLERE, Angely P. </td>
          <td>F</td>
          <td>4</td>
          <td>BSIT </td>
          <td></td>
        </tr>
        <tr> 
          <td>2</td>
          <td>2009-1521</td>
          <td>ARAGONES, Ina Claire Leah N. </td>
          <td>F</td>
          <td>4</td>
          <td>BSIT </td>
          <td></td>
        </tr>
        <tr> 
          <td>3</td>
          <td>2009-7383</td>
          <td>BASHER, HANAN T. </td>
          <td>F</td>
          <td>4</td>
          <td>BSIT </td>
          <td></td>
        </tr>
        <tr> 
          <td>4</td>
          <td>2008-1134</td>
          <td>BAYADOG, Jeinalisa L. </td>
          <td>F</td>
          <td>4</td>
          <td>BSIT </td>
          <td></td>
        </tr>
        <tr> 
          <td>5</td>
          <td>2006-3955</td>
          <td>CA&Ntilde;ALES, Drexil Jade V. </td>
          <td>M</td>
          <td>4</td>
          <td>BSIT </td>
          <td></td>
        </tr>
        <tr> 
          <td>6</td>
          <td>2008-0452</td>
          <td>CHIU, Michael Gabriel U. </td>
          <td>M</td>
          <td>4</td>
          <td>BSIT </td>
          <td></td>
        </tr>
        <tr> 
          <td>7</td>
          <td>2007-0524</td>
          <td>Cruz, Gian Ralph B. </td>
          <td>M</td>
          <td>4</td>
          <td>BSIT </td>
          <td></td>
        </tr>
      </table>
    </div>
    <div class="span4"> 
      <h3>Form Example</h3>
      <form>
        <legend>Legend</legend>
        <label>Label name</label>
        <input type="text" placeholder="Type something...">
        <span class="help-block">Example block-level help text here.</span> 
        <label class="checkbox"> 
        <input type="checkbox">
        Check me out </label>
        <button type="submit" class="btn">Submit</button>
      </form>
	  
	  <h4>Another form element</h4>
      <div class="input-append"> 
        <input class="span2" id="appendedInputButton" size="16" type="text">
        <button class="btn" type="button">Go!</button>
      </div>
      <div class="input-append"> 
        <input class="span2" id="appendedInputButtons" size="16" type="text">
        <button class="btn" type="button">Search</button>
        <button class="btn" type="button">Options</button>
      </div>
    </div>
  </div>
  <hr>
  <div class="row"> 
    <div class="span4"> 
      <h2>Heading</h2>
      <p>Span4</p>
      <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <div class="span4"> 
      <h2>Heading</h2>
      <p>Span4</p>
      <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <div class="span4"> 
      <h2>Heading</h2>
      <p>Span4</p>
      <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
  </div>
  <hr>
  <footer> 
  <p>&copy; Company 2012</p>
  </footer> </div>
<!-- /container -->
<!-- jQuery latest version since Bootstrap is dependent on it -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<!-- Bootstrap JS file (it containes predefined functionalities. Read the manual online on how to use) -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
