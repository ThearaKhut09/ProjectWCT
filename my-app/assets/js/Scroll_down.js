  // Helper function to check if an element is in the viewport
  function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
           rect.bottom >= 0;
}

// Add scroll event listener to animate elements
function animateOnScroll() {
    const elements = document.querySelectorAll('.animated');
    elements.forEach((element) => {
        if (isInViewport(element)) {
            element.classList.add('visible');
        }
    });
}

// Initial check and event listener
window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);