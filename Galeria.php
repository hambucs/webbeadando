<html lang="en">
<head> 
	<title>Fotoshoot</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Galeriastyle.css">

</head>
<body>
	
	<div class="loader"></div>
	<div class="main-content">
	 <button class="fomenu" onclick="toggleMenu()"></button>
    <div class="menu">
      <nav>
        <a style="animation-delay: 0.2s" onclick="showUploadForm()" >Upload</a>
        <a href="about.html" style="animation-delay: 0.4s">About</a>
        <a href="Fotoshoot.php" style="animation-delay: 0.5s">Log out</a>
      </nav>
    </div>
	<div class="alma">
	</div>
	<header>
		<nav id="logo" class="navi">
			<a href="mainpage.html"><img class="logo" src="logo.png"></a>
		</nav>
	</header>
	<div class="upload-forms" id="upload-form">
		<img class="icon-close" src="close.svg" onclick="hideUploadForm()">
        <form class="forms" action="upload.php" method="post" enctype="multipart/form-data">
			<h3>upload an image</h3>
			<p>Choose a file to upload:</p>
			<div class="inputbox">
				<input type="file" name="image" id="image" placeholder="Choose a file:">
			</div>
			<p>Enter a name for the image:</p>
			<div class="inputbox1">
				<input type="text" name="image-name" id="image-name" placeholder="Image name:">
			</div>
				<button class="uploadb" type="submit" value="Upload">Upload</button>
			</div>
        </form>
      </div>
<main id="wrapper">
	<img class="message" src="message.png">
  <div id="content" class="o-wrapper">
    <ul class="gallery">
      <?php
        
        foreach(glob('images/*.*') as $file) 
        {
          echo "<li class='image'><img src='{$file}'></li>";
        }
      ?>
    </ul>
    <footer>
      <h2 class="end">Upload a photo</h2>
    </footer>
  </div>
</main>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/ScrollSmoother.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/SplitText3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chroma-js/2.4.2/chroma.min.js"></script>
<script>
    function showUploadForm() {
      document.getElementById('upload-form').style.display = 'block';
    }
    function hideUploadForm() {
      document.getElementById('upload-form').style.display = 'none';
    }
  </script>
<script>
gsap.registerPlugin(ScrollTrigger, ScrollSmoother, SplitText);

/* Fade in the logo */
gsap.fromTo('.logo', {
  opacity: 0,
  yPercent: 50
}, {
  yPercent: -50,
  opacity: 1,
  duration: 1,
  ease: 'power3.out'
});

/* Smooth content */
let smoother = ScrollSmoother.create({
 wrapper: "#wrapper",
 content: "#content",
 smooth: 6,
 effects: true
});

smoother.effects(".image", {
  speed: (i) => {
    // Desktop three columns layout
    if (window.matchMedia('(min-width:730px)').matches) {
      // Center column is faster
      return i % 3 === 1 ? 1.15 : 1;
    } else {
      // Mobile, right column is fast
      return i % 2 === 0 ? 1 : 1.15;
    }
  }
});


/* Logo to header animation */
let logoTl = gsap.timeline({
  scrollTrigger: {
    trigger: document.body,
    start: 0,
    end: () => window.innerHeight * 1.2,
    scrub: 0.6
  }
});
logoTl.fromTo('.logo', {
  top: '50vh',
  yPercent: -50,
  scale: 4,
  textShadow: '0 0 2px rgba(0,0,0,0.3)'
}, {
  top: 0,
  yPercent: 0,
  scale: 1,
  textShadow: '0 0 2px rgba(0,0,0,0)',
  duration: 0.8
});
// Toggle the burger visibility
logoTl.fromTo('.fomenu', {
  opacity: 0
}, {
  opacity: 1,
  duration: 0.1
}, 0.9);

logoTl.fromTo('.upload-forms', {
  opacity: 0
}, {
  opacity: 1,
  duration: 0.1
}, 0.9);

logoTl.fromTo('.message', {
  opacity: 0
}, {
  opacity: 1,
  duration: 0.1
}, 0.9);

logoTl.fromTo('.menu', {
  opacity: 0
}, {
  opacity: 1,
  duration: 0.1
}, 0.9);
// Toggle the header box-shadow
logoTl.fromTo('header', {
  boxShadow: '0px 0px 10px rgba(0,0,0,0)',
}, {
  boxShadow: '0px 0px 10px rgba(0,0,0,.15)',
  duration: 0.2
}, 0.8);


/* That's all Folks animation */
let endTl = gsap.timeline({
  repeat: -1,
  delay: 0.5,
  scrollTrigger: {
    trigger: '.end',
    start: 'bottom 100%-=50px'
  }
});
gsap.set('.end', {
  opacity: 0
});
gsap.to('.end', {
  opacity: 1,
  duration: 1,
  ease: 'power2.out',
  scrollTrigger: {
    trigger: '.end',
    start: 'bottom 100%-=50px',
    once: true
  }
});
let mySplitText = new SplitText(".end", { type: "words,chars" });
let chars = mySplitText.chars;
let endGradient = chroma.scale(['#F9D371', '#F47340', '#EF2F88', '#8843F2']);
endTl.to(chars, {
  duration: 0.5,
  scaleY: 0.6,
  ease: "power3.out",
  stagger: 0.04,
  transformOrigin: 'center bottom'
});
endTl.to(chars, {
  yPercent: -20,
  ease: "elastic",
  stagger: 0.03,
  duration: 0.8
}, 0.5);
endTl.to(chars, {
  scaleY: 1,
  ease: "elastic.out(2.5, 0.2)",
  stagger: 0.03,
  duration: 1.5
}, 0.5);
endTl.to(chars, {
  color: (i, el, arr) => {
    return endGradient(i / arr.length).hex();
  },
  ease: "power2.out",
  stagger: 0.03,
  duration: 0.3
}, 0.5);
endTl.to(chars, {
  yPercent: 0,
  ease: "back",
  stagger: 0.03,
  duration: 0.8
}, 0.7);
endTl.to(chars, {
  color: 'hsl(0,0,0)',
  duration: 1.4,
  stagger: 0.05
});
let menu = document.querySelector('.fomenu')

menu.addEventListener('click', (e) => {
  ScrollTrigger.refresh()
})
</script>

<script>
const hideScrollbar = () => {
  const scrollBarCSS = `
    ::-webkit-scrollbar {
      width: 0.5em;
    }

    ::-webkit-scrollbar-track {
      box-shadow: none;
      background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
      border-radius: 1rem;
      background-color: #000000;
      opacity: 0.5;
    }
  `;

  const style = document.createElement('style');
  style.type = 'text/css';
  style.appendChild(document.createTextNode(scrollBarCSS));
  document.head.appendChild(style);
}

hideScrollbar();

</script>

<script>
    window.addEventListener("load", function() {
        var loader = document.querySelector(".loader");
        var mainContent = document.querySelector(".main-content");
        window.scrollTo({top: 0, behavior: 'smooth'}); // Scroll to the top of the page before the loader animation
        setTimeout(function() {
            loader.style.display = "none";
            mainContent.style.opacity = "1";
            // check if the page was accessed through a reload or refresh
            if(performance.navigation.type === 1) {
                // scroll to the top of the page when the page is refreshed
                window.scroll(0 , 0);
            }
        }, 2000); // Reduce the time of the loader animation to 2 seconds
    });
</script>
<script type="text/javascript">
      const toggleMenu = () => document.body.classList.toggle("open");
</script>
</body>
</html>
