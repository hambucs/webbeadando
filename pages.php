<!DOCTYPE HTML>
<html>
<head>
<script src="pages.js"></script>
<link rel="stylesheet" href="pages.css">
<style>
#div1 {
  width: 350px;
  height: 70px;
  padding: 10px;
  border: 1px solid #aaaaaa;
}
</style>

</head>
<body>



<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
<br>
<img id="drag1" src="b1.jpg" draggable="true" ondragstart="drag(event)" width="336" height="69">
<canvas id="myCanvas" width="200" height="100"
style="border:1px solid #c3c3c3;">
Your browser does not support the canvas element.
</canvas>
<svg width="300" height="200">
  <polygon points="100,10 40,198 190,78 10,78 160,198"
  style="fill:red;stroke:black;stroke-width:5;fill-rule:evenodd;" />
</svg>
<svg height="130" width="500">
  <defs>
    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:rgb(25,55,0);stop-opacity:1" />
      <stop offset="100%" style="stop-color:rgb(205,0,0);stop-opacity:1" />
    </linearGradient>
  </defs>
  <ellipse cx="100" cy="70" rx="85" ry="55" fill="url(#grad1)" />
  <text fill="#fff0ff" font-size="45" font-family="Verdana" x="50" y="86">SVG</text>
  Sorry, your browser does not support inline SVG.
</svg>
<p><a href="mailto:someone@gmail.com">Send email</a></p>



<p>Count numbers: <output id="result"></output></p>
<button onclick="startWorker()">Start Worker</button> 
<button onclick="stopWorker()">Stop Worker</button>




<div id="kupak"></div>

</body>
</html>
