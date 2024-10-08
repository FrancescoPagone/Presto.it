import "./bootstrap";
import "bootstrap";

import Swiper from "swiper/bundle";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", function () {
    // Carousel functionality
    const slides = document.querySelectorAll(".carousel-slide");
    if (slides.length > 0) {
        let currentSlide = 0;

        function showSlide(index) {
            slides[currentSlide].classList.remove("active");
            slides[index].classList.add("active");
            currentSlide = index;
        }

        function nextSlide() {
            let nextIndex = (currentSlide + 1) % slides.length;
            showSlide(nextIndex);
            setTimeout(nextSlide, 5000);
        }
        setTimeout(nextSlide, 5000);
    }

    // Revisor Anlasis carousel functionality

    const articleCarousel = document.getElementById("articleCarousel");
    const imageAnalyses = document.querySelectorAll(
        "#imageAnalysisSection .image-analysis"
    );

    if (articleCarousel && imageAnalyses.length > 0) {
        articleCarousel.addEventListener("slide.bs.carousel", function (e) {
            imageAnalyses.forEach(function (analysis, index) {
                if (index === e.to) {
                    analysis.classList.remove("d-none");
                    analysis.classList.add("d-block");
                } else {
                    analysis.classList.remove("d-block");
                    analysis.classList.add("d-none");
                }
            });
        });
    }

    // Swiper initialization (if elements exist)
    if (typeof Swiper !== "undefined") {
        const swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: {
                    el: ".mySwiper",
                    slidesPerView: 4,
                },
            },
        });

        const swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
    }

    // Navbar overlay menu
    const menuToggle = document.getElementById("menuToggle");
    const closeMenu = document.getElementById("closeMenu");
    const overlayMenu = document.getElementById("overlayMenu");

    if (menuToggle && closeMenu && overlayMenu) {
        menuToggle.addEventListener("click", function () {
            overlayMenu.style.display = "flex";
            gsap.fromTo(
                overlayMenu,
                { opacity: 0 },
                { duration: 0.2, opacity: 1, ease: "power2.in" }
            );
        });

        closeMenu.addEventListener("click", function () {
            gsap.to(overlayMenu, {
                duration: 0.2,
                opacity: 0,
                ease: "power2.out",
                onComplete: () => {
                    overlayMenu.style.display = "none";
                },
            });
        });
    }

    // Profile tab functionality
    const userInfo = document.querySelector(".user-info");
    const profileForm = document.getElementById("profileForm");
    const editBtn = document.querySelector(".edit-profile-btn");
    const cancelBtn = document.querySelector(".cancel-edit-btn");

    function toggleEditMode() {
        userInfo.classList.toggle("d-none");
        profileForm.classList.toggle("d-none");
    }

    if (editBtn && cancelBtn) {
        editBtn.addEventListener("click", toggleEditMode);
        cancelBtn.addEventListener("click", toggleEditMode);
    }

    const tabs = document.querySelectorAll("#myTab .nav-link");
    const tabContents = document.querySelectorAll(".tab-pane");

    tabs.forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();

            // Deactivate all tabs and contents
            tabs.forEach((t) => t.classList.remove("active"));
            tabContents.forEach((c) => c.classList.remove("show", "active"));

            // Activate clicked tab and its content
            this.classList.add("active");
            const tabId = this.getAttribute("href").substring(1);
            document.getElementById(tabId).classList.add("show", "active");
        });
    });

    // Loader (shown only once per session)
    // let loaderWrapper = document.getElementById('loader-wrapper');
    // if (sessionStorage.getItem('loaderShown') !== 'true') {
    //     loaderWrapper.style.display = 'flex';
    //     sessionStorage.setItem('loaderShown', 'true');

    //     gsap.to(loaderWrapper, {
    //         opacity: 0,
    //         duration: 0.5,
    //         delay: 2,
    //         ease: "power2.inOut",
    //         onComplete: function() {
    //             loaderWrapper.style.display = "none";
    //         }
    //     });
    // }

    // Circle animation for image containers
    let imageContainers = document.querySelectorAll(".imageContainer");

    imageContainers.forEach(function (container) {
        let circle = container.querySelector(".circle");
        let image = container.querySelector("img");

        container.addEventListener("mouseenter", function () {
            gsap.to(circle, {
                scale: 1,
                opacity: 0.8,
                duration: 0.5,
                ease: "power1.out",
                boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)",
            });
        });

        container.addEventListener("mouseleave", function () {
            gsap.to(circle, {
                scale: 0,
                opacity: 0,
                duration: 0.5,
                ease: "power1.in",
                boxShadow: "0 2px 4px rgba(0, 0, 0, 0.2)",
            });
        });

        container.addEventListener("mousemove", function (e) {
            let rect = image.getBoundingClientRect();
            let x = e.clientX - rect.left - 25;
            let y = e.clientY - rect.top - 25;

            gsap.to(circle, {
                left: x,
                top: y,
                duration: 0.5,
                ease: "power1.out",
            });
        });
    });

    const productCards = document.querySelectorAll(".product-card");

    productCards.forEach((card) => {
        card.addEventListener("mouseenter", () => {
            gsap.to(card, {
                y: -3,
                scale: 1.01,
                duration: 0.25,
                ease: "power2.out",
                boxShadow: "0 6px 12px rgba(0, 0, 0, 0.1)",
            });
        });

        card.addEventListener("mouseleave", () => {
            gsap.to(card, {
                y: 0,
                scale: 1,
                duration: 0.25,
                ease: "power2.inOut",
                boxShadow: "0 2px 4px rgba(0, 0, 0, 0.1)",
            });
        });
    });
});
