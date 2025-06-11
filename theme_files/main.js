


var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 5,
    freeMode: true,
    watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },
  });




  // ****************************RAED MORE*******************************


// Slide Up Slide Down


function AddReadMore() {
  //This limit you can set after how much characters you want to show Read More.
  var carLmt = 280;
  // Text to show when text is collapsed
  var readMoreTxt = " ... Read More";
  // Text to show when text is expanded
  var readLessTxt = " Read Less";


  //Traverse all selectors with this class and manupulate HTML part to show Read More
  $(".addReadMore").each(function() {
      if ($(this).find(".firstSec").length)
          return;

      var allstr = $(this).text();
      if (allstr.length > carLmt) {
          var firstSet = allstr.substring(0, carLmt);
          var secdHalf = allstr.substring(carLmt, allstr.length);
          var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
          $(this).html(strtoadd);
      }

  });
  //Read More and Read Less Click Event binding
  $(document).on("click", ".readMore,.readLess", function() {
      $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
  });
}
$(function() {
  //Calling function after Page Load
  AddReadMore();
});





  /*******************************second-swipper****************************************** */

  var swiper = new Swiper(".my-second-Swiper", {
    autoplay: 
    {
      delay: 2000,
    },
    loop: true,
    // slidesPerView: 4,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 2,
        spaceBetween: 15
      },
      // when window width is >= 640px
      640: {
        slidesPerView: 3,
        spaceBetween: 25
      },
      // when window width is >= 900px
      900: {
        slidesPerView: 4,
        spaceBetween: 40
      }
    }
  });




  // var mySwiper = new Swiper ('.swiper-container', 
	// {
  //   speed:1000,
	// 	direction: 'horizontal',
	// 	navigation: 
	// 	{
	// 	  nextEl: '.swiper-button-next',
	// 	  prevEl: '.swiper-button-prev',
	// 	},
	// 	pagination: 
	// 	{
	// 		el: '.swiper-pagination',
	// 		dynamicBullets: true,
	// 	},
	// 	zoom: true,
	// 	keyboard: 
	// 	{
	// 		enabled: true,
	// 		onlyInViewport: false,
	// 	},
	// 	mousewheel: 
	// 	{
	// 		invert: true,
	// 	},
  //   autoplay: 
  //   {
  //     delay: 2000,
  //   },
  //   loop: true,
	// }); 




    /*******************************dropzone****************************************** */

  let myDropzone = Dropzone({
    paramName: "file", // The name that will be used to transfer the file
    accept: function(file, done) {
      if (file.name == "justinbieber.jpg") {
        done("Naha, you don't.");
      }
      else { done(); }
    }
  });












  // ......................................COUNTER

  //COUNTER-SECTION IN-VIEW
(function ($) {
$(function () {
var section = document.querySelector('.counter-section');
var hasEntered = false;
if (! section)
return;

var initAnimate = (window.scrollY + window.innerHeight) >= section.offsetTop;
if (initAnimate && !hasEntered) {
hasEntered = true;
counterActivate();
}

window.addEventListener('scroll', (e) => {
var shouldAnimate = (window.scrollY + window.innerHeight) >= section.offsetTop;

if (shouldAnimate && !hasEntered) {
hasEntered = true;
counterActivate();
}
});
function counterActivate() {
$('.counter-count .count').each(function () {
$(this).prop('Counter', 0).animate({
  Counter: $(this).text()
}, {
  duration: 4000,
  easing: 'swing',
  step: function (now) {
      $(this).text(Math.ceil(now), 3);
  }
});
});
}
}); // END OF DOCUMENT READY
})(jQuery);

  /* AUTHOR LINK */
   $('.about-me-img').hover(function(){
          $('.authorWindowWrapper').stop().fadeIn('fast').find('p').addClass('trans');
      }, function(){
          $('.authorWindowWrapper').stop().fadeOut('fast').find('p').removeClass('trans');
      });







      // ...............navigator.canShare.apply.................


    // ########select2#########3

      // In your Javascript (external .js resource or <script> tag)
     



      $(document).ready(function(){

var list = $(".list li");
var numToShow = 3;
var button = $("#next");
var numInList = list.length;
list.hide();
if (numInList > numToShow) {
  button.show();
}
list.slice(0, numToShow).show();

button.click(function(){
    var showing = list.filter(':visible').length;
    list.slice(showing - 1, showing + numToShow).fadeIn();
    var nowShowing = list.filter(':visible').length;
    if (nowShowing >= numInList) {
      button.hide();
    }
});

});