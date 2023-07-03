$(document).ready(function(){
    $('.header__burger').click(function (event) {
        $('.header__burger, .header__list').toggleClass('active');
        $('body').toggleClass('lock');
    });
});

$(document).ready(function(){
    const dropdown  = document.querySelector('.menu ');
    const header__mail  = document.querySelector('.header__mail ');
    const header__user_img  = document.querySelector('.header__user-img ');
    $('.header__user-avatar').hover(
        function() {
            $( dropdown ).removeClass('hide');
            $( header__mail ).addClass('header__mail-hover');
            $( header__user_img ).addClass('header__mail-hover');
        },
        function() {
        }
    );
    $('.header__user-nav').hover(
        function() {
            $( dropdown ).removeClass('hide');
            $( header__mail ).addClass('header__mail-hover');
            $( header__user_img ).addClass('header__mail-hover');
        },
        function() {

        }
    );
    $('.header').hover(
        function() {

        },
        function() {
            $( dropdown ).addClass('hide');
            $( header__mail ).removeClass('header__mail-hover');
            $( header__user_img ).removeClass('header__mail-hover');

        }
    );
});

// progres bar
function updateProgressBar(progressBar, value) {
    value = Math.round(value);
    progressBar.querySelector(".progress__fill").style.width = `${value}%`;
    progressBar.querySelector(".progress__text").textContent = `${value}%`;
}

const progress_check = document.querySelector(".progress-check");
const progress_about = document.querySelector(".progress-about");
try {
    updateProgressBar(progress_check, 50);
} catch (error) {}

try {
    updateProgressBar(progress_about, 66.66);
} catch (error) {}


// dropdown
const dropdownBg = document.querySelector(".dropdown-bg");

Array.from(document.querySelectorAll(".nav-item")).forEach(item => {
    item.onmouseover = () => {
        dropdownBg.style.opacity = 1;
        dropdownBg.style.visibility = "visible";
        dropdownBg.style.width = getComputedStyle(item.lastElementChild).width;
        dropdownBg.style.height = getComputedStyle(item.lastElementChild).height;

        dropdownBg.style.top = `${item.lastElementChild.offsetTop}px`;
        dropdownBg.style.left = `${item.lastElementChild.offsetLeft}px`;
    };

    item.onmouseout = () => {
        dropdownBg.style.opacity = 0;
        dropdownBg.style.visibility = "hidden";
    };
});

$(".multiple-items").slick({
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

var containers;
function initDrawers() {
    containers = document.querySelectorAll(".dropdown__menu");
    setHeights();
    wireUpTriggers();
    window.addEventListener("resize", setHeights);
}

window.addEventListener("load", initDrawers);

function setHeights() {
    containers.forEach(container => {
        // Get content
        let content = container.querySelector(".content");
        // Needed if this is being fired after a resize
        content.removeAttribute("aria-hidden");
        // Height of content to show/hide
        let heightOfContent = content.getBoundingClientRect().height;
        // Set a CSS custom property with the height of content
        container.style.setProperty("--containerHeight", `${heightOfContent}px`);
        // Once height is read and set
        setTimeout(e => {
            container.classList.add("height-is-set");
            content.setAttribute("aria-hidden", "true");
        }, 0);
    });
}

function wireUpTriggers() {
    containers.forEach(container => {
        // Get each trigger element
        let btn = container.querySelector(".trigger");
        // Get content
        let content = container.querySelector(".content");
        btn.addEventListener("click", () => {
            container.setAttribute(
                "data-drawer-showing",
                container.getAttribute("data-drawer-showing") === "true" ? "false" : "true"
            );
            content.setAttribute(
                "aria-hidden",
                content.getAttribute("aria-hidden") === "true" ? "false" : "true"
            );
        });
    });
}

