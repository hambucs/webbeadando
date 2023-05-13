<html> 
<head>
	<title>Fotoshoot</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<script src="script.js"></script>
</head>
<body>
<div class="loader"></div>
<div class="main-content">
<header>
		<nav>
			<ul>
				<li><a href="Fotoshoot.php"><img  class="logo" src="logo.png"></a></li>
				<li><button class="login" > <span>LOG IN</span></button></li>
			</ul>
		</nav>
</header>

<div class="form-box">
			<img class="icon-close" src="close.svg">
            <div class="loginbox">
    <form id="loginForm">
        <h3>Log in</h3>
        <div class="error" id="error-message"></div>
        <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" name="email" required>
            <label for="">Email</label>
        </div>
        <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password" required>
            <label for="">Password</label>
        </div>
        <button type="submit">Log in</button>
        <div class="register">
            <p>Don't have an account <a class="linkregistration">Register</a></p>
        </div>
    </form>
</div>
			<div class="registrationbox">
                <form id="RegistratinForm" >
					<h3>Registration</h3>
					<div class="error" id="error-message1"></div>
					<div class="success" id="error-message2"></div>
					<div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="">Password</label>
                    </div>
                    <button type="submit">Registration</button>
                    <div class="register">
                        <p>If you have an account <a class="linklogin" >Log in</a></p>
                    </div>
			</form>
		</div>
</div>
<div id="cookie-notification">
		<p>This website uses cookies to improve your experience. By continuing to use this site, you accept our use of cookies. <a href="#">Learn More</a></p>
		<button class="accept" onclick="acceptCookies()">Accept</button>
</div>
<section class="first">
  <div class="outer">
    <div class="inner">
      <div class="bg">
        <h2 class="section-heading">Welcome on Fotoshoot!</h2>
      </div>
    </div>
  </div>
</section>
<section class="second">
  <div class="outer">
    <div class="inner">
      <div class="bg">
        <h2 class="section-heading">There are some secret..</h2>
      </div>
    </div>
  </div>
</section>
<section class="third">
  <div class="outer">
    <div class="inner">
      <div class="bg">
        <h2 class="section-heading">Do you want to know?</h2>
      </div>
    </div>
  </div>
</section>
<section class="fourth">
  <div class="outer">
    <div class="inner">
      <div class="bg">
        <h2 class="section-heading">You have one last step</h2>
      </div>
    </div>
  </div>
</section>
<section class="fifth">
  <div class="outer">
    <div class="inner">
      <div class="bg">
        <h2 class="section-heading">Log in or Register</h2>
      </div>
    </div>
  </div>
</section>
</div>
<script src="https://assets.codepen.io/16327/gsap-latest-beta.min.js"></script>
<script src="https://assets.codepen.io/16327/Observer.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/SplitText3.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
gsap.registerPlugin(Observer);

let sections = document.querySelectorAll("section"),
  images = document.querySelectorAll(".bg"),
  headings = gsap.utils.toArray(".section-heading"),
  outerWrappers = gsap.utils.toArray(".outer"),
  innerWrappers = gsap.utils.toArray(".inner"),
  splitHeadings = headings.map(heading => new SplitText(heading, { type: "chars,words,lines", linesClass: "clip-text" })),
  currentIndex = -1,
  wrap = gsap.utils.wrap(0, sections.length),
  animating;

gsap.set(outerWrappers, { yPercent: 100 });
gsap.set(innerWrappers, { yPercent: -100 });

function gotoSection(index, direction) {
  index = wrap(index); // make sure it's valid
  animating = true;
  let fromTop = direction === -1,
      dFactor = fromTop ? -1 : 1,
      tl = gsap.timeline({
        defaults: { duration: 1.25, ease: "power1.inOut" },
        onComplete: () => animating = false
      });
  if (currentIndex >= 0) {
    // The first time this function runs, current is -1
    gsap.set(sections[currentIndex], { zIndex: 0 });
    tl.to(images[currentIndex], { yPercent: -15 * dFactor })
      .set(sections[currentIndex], { autoAlpha: 0 });
  }
  gsap.set(sections[index], { autoAlpha: 1, zIndex: 1 });
  tl.fromTo([outerWrappers[index], innerWrappers[index]], { 
      yPercent: i => i ? -100 * dFactor : 100 * dFactor
    }, { 
      yPercent: 0 
    }, 0)
    .fromTo(images[index], { yPercent: 15 * dFactor }, { yPercent: 0 }, 0)
    .fromTo(splitHeadings[index].chars, { 
        autoAlpha: 0, 
        yPercent: 150 * dFactor
    }, {
        autoAlpha: 1,
        yPercent: 0,
        duration: 1,
        ease: "power2",
        stagger: {
          each: 0.02,
          from: "random"
        }
      }, 0.2);

  currentIndex = index;
}

Observer.create({
  type: "wheel,touch,pointer",
  wheelSpeed: -1,
  onDown: () => !animating && gotoSection(currentIndex - 1, -1),
  onUp: () => !animating && gotoSection(currentIndex + 1, 1),
  tolerance: 10,
  preventDefault: true
});

gotoSection(0, 1);

</script>
<script>
	const formbox = document.querySelector('.form-box');
	const login = document.querySelector('.login');
	const linklogin = document.querySelector('.linklogin');
	const linkregistration = document.querySelector('.linkregistration');
	const iconclose = document.querySelector('.icon-close');
	linkregistration.addEventListener('click', ()=>{
		formbox.classList.add('active');
	});
	linklogin.addEventListener('click', ()=>{
		formbox.classList.remove('active');
	});
	login.addEventListener('click', ()=>{
		formbox.classList.add('activelogin');
	});
	iconclose.addEventListener('click', ()=>{
		formbox.classList.remove('activelogin');
	});
</script>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            var loader = document.querySelector(".loader");
            var mainContent = document.querySelector(".main-content");
            setTimeout(function() {
                loader.style.display = "none";
                mainContent.style.opacity = "1";
            }, 3000);
        });
    </script>
	<script>
$(document).ready(function(){
    $("#loginForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: "forlogin.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                if(response.status === "success"){
                    window.location.href = "mainpage.html";
                }else{
					document.getElementById("error-message").style.display = "block";
                    $("#error-message").html(response.message);
                }
            }
        });
    });
});
</script>
<script>
$(document).ready(function(){
    $("#RegistratinForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: "database.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
				if(response.status == 'error'){
                    document.getElementById("error-message1").style.display = "block";
                    $("#error-message1").html(response.message);
                }else{
					document.getElementById("error-message2").style.display = "block";
					document.getElementById("error-message1").style.display = "none";
                    $("#error-message2").html(response.message);
                }
            }
        });
    });
});
</script>
<script>
		function acceptCookies() {
			document.cookie = "accepted=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
			document.getElementById("cookie-notification").style.display = "none";
		}
		
		function checkCookies() {
			if (document.cookie.indexOf("accepted=true") == -1) {
				document.getElementById("cookie-notification").style.display = "block";
			}
		}
		
		window.onload = checkCookies;
	</script>
</body>
</html>
