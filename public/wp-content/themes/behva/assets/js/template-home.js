document.addEventListener('DOMContentLoaded', function () {

  var secTab            = document.querySelector('.sec_tab');
  var tabSplide         = document.querySelector('.tab-splide');
  var paginationWrapper = document.querySelector('.custom-pagination');
  var nextSection       = document.querySelector('.sec_contact');
  var prevSection       = document.querySelector('.sec_banner'); // มี/ไม่มีก็ได้

  if (!secTab || !tabSplide || !paginationWrapper) {
    return;
  }

  var splide = new Splide('.tab-splide', {
    type      : 'slide',
    perPage   : 1,
    perMove   : 1,
    wheel     : false,         
    waitForTransition: true,
    height    : '60vh',
    speed     : 700,
    pagination: false,
    arrows    : false,
    gap       : '24px',
    focus     : 'left',
    trimSpace : true,
  });

  splide.on('mounted move', function () {
    var slides = tabSplide.querySelectorAll('.splide__slide');

    paginationWrapper.innerHTML = '';

    slides.forEach(function (slide, index) {
      var title = slide.getAttribute('data-title') || 'Slide ' + (index + 1);
      var color = slide.getAttribute('data-color');

      var btn = document.createElement('button');
      btn.className = 'custom-page-btn';
      btn.textContent = title;
      btn.type = 'button';
      btn.dataset.index = index;

      if (index === splide.index) {
        btn.classList.add('is-active');
        if (color) {
          btn.style.backgroundColor = color;
        }
      }

      btn.addEventListener('click', function () {
        paginationWrapper.querySelectorAll('.custom-page-btn').forEach(function (button) {
          button.classList.remove('is-active');
          button.style.backgroundColor = '';
        });

        splide.go(index);
        btn.classList.add('is-active');
        if (color) {
          btn.style.backgroundColor = color;
        }
      });

      paginationWrapper.appendChild(btn);
    });
  });

  splide.mount();

  splide.on('moved', function (newIndex) {
    var slides  = tabSplide.querySelectorAll('.splide__slide');
    var buttons = paginationWrapper.querySelectorAll('.custom-page-btn');

    buttons.forEach(function (button, idx) {
      var slide = slides[idx];
      var color = slide ? slide.getAttribute('data-color') : null;

      button.classList.toggle('is-active', idx === newIndex);
      if (idx === newIndex && color) {
        button.style.backgroundColor = color;
      } else {
        button.style.backgroundColor = '';
      }
    });
  });


  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    console.warn('GSAP หรือ ScrollTrigger ยังไม่ถูกโหลด');
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  var sliderActive = false; // true เมื่อ sec_tab ถูก pin

  ScrollTrigger.create({
    trigger    : secTab,
    start      : 'top -30%',
    end        : 'bottom 30%',   
    pin        : true,
    pinSpacing : true,
    scrub      : false,        
    onEnter: function () {
      sliderActive = true;
    },
    onEnterBack: function () {
      sliderActive = true;
    },
    onLeave: function () {
      sliderActive = false;
    },
    onLeaveBack: function () {
      sliderActive = false;
    },
  });

  var isAnimating   = false;
  var lastWheelTime = 0;
  var COOLDOWN      = 450;
  var exitDownArmed = false;
  var exitUpArmed   = false;

  splide.on('move', function () {
    isAnimating = true;
  });

  splide.on('moved', function () {
    isAnimating = false;
  });

  function handleWheel(event) {
    if (!sliderActive) {
      return;
    }

    var deltaY = event.deltaY;
    if (deltaY === 0) {
      return;
    }

    event.preventDefault();

    var now = Date.now();
    if (isAnimating || now - lastWheelTime < COOLDOWN) {
      return;
    }

    var goingDown = deltaY > 0;
    var atLast    = splide.index === splide.length - 1;
    var atFirst   = splide.index === 0;

    if (goingDown) {
      if (atLast) {
        if (!exitDownArmed) {
          exitDownArmed = true;
          exitUpArmed   = false;
          lastWheelTime = now;
          return;
        }

        exitDownArmed = false;
        sliderActive  = false;

        if (nextSection) {
          nextSection.scrollIntoView({
            behavior: 'smooth',
            block   : 'start',
          });
        }

        lastWheelTime = now;
        return;
      }

      exitDownArmed = false;
      exitUpArmed   = false;
      splide.go('>');
      lastWheelTime = now;
      return;
    }

    if (!goingDown) {
      if (atFirst) {
        if (!exitUpArmed) {
          exitUpArmed   = true;
          exitDownArmed = false;
          lastWheelTime = now;
          return;
        }

        exitUpArmed  = false;
        sliderActive = false;

        if (prevSection) {
          prevSection.scrollIntoView({
            behavior: 'smooth',
            block   : 'start',
          });
        }

        lastWheelTime = now;
        return;
      }

      exitDownArmed = false;
      exitUpArmed   = false;
      splide.go('<');
      lastWheelTime = now;
    }
  }

  secTab.addEventListener('wheel', handleWheel, { passive: false });

});