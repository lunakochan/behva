// const header = document.querySelector('.site-header');
// let isFixed = false;

// window.addEventListener('scroll', () => {
//     if (window.scrollY > 50 && !isFixed) {
//         header.classList.add('scroll');

//         // หน่วงนิดนึงเพื่อให้ transform ทำงาน
//         setTimeout(() => {
//             header.classList.add('scroll-ready');
//         }, 10);

//         isFixed = true;
//     }

//     if (window.scrollY <= 50 && isFixed) {
//         header.classList.remove('scroll', 'scroll-ready');
//         isFixed = false;
//     }
// });

const startAnimation = (entries, observer) => {
    entries.forEach(entry => {
        if ( entry.isIntersecting ) {
            entry.target.classList.add(entry.target.dataset.animate);
        }
    });
};

const observer = new IntersectionObserver(startAnimation);
const options = { root: null, rootMargin: '0px', threshold: 1 };

const elements = document.querySelectorAll('.animate__animated');
elements.forEach(el => {
    observer.observe(el, options);
});


//insert class front page on menu, when you click on menu, menu mobile hide
var menuSec = document.getElementsByClassName("front-page");
for (i = 0; i < menuSec.length; i++) {
	menuSec[i].onclick = function() {menuHide()};
}
function menuHide() {
	document.getElementById('menu-mobile').style.width='0';
}

jQuery(document).ready(function($) {
    $('.menu-icon').on('click', function() {
        $(this).toggleClass('is-open');        // toggle icon
        $('#menu-mobile').toggleClass('active'); // toggle menu container
    });
});
