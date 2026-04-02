document.addEventListener("DOMContentLoaded", function() {

  const elements = document.querySelectorAll(".fade-up");

  function animateOnScroll() {
    elements.forEach(el => {
      const elementTop = el.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;

      if (elementTop < windowHeight - 80) {
        el.classList.add("show");
      }
    });
  }

  window.addEventListener("scroll", animateOnScroll);

  // Run once on load
  animateOnScroll();

});
