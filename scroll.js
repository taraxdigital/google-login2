// nueva scroll
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to top functionality
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        scrollToTopBtn.classList.add('visible');
      } else {
        scrollToTopBtn.classList.remove('visible');
      }
    });
    
    // Smooth scroll to top when button is clicked
    scrollToTopBtn.addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  
    const shapes = document.querySelectorAll('.shape');
    shapes.forEach((shape, index) => {
      shape.style.animation = `float ${10 + index * 2}s infinite ease-in-out ${index * 2}s`;
    });
  
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const shapes = document.querySelectorAll('.shape');
      shapes.forEach(shape => {
        const speed = shape.getAttribute('data-speed') || 0.5;
        shape.style.transform = `translateY(${scrolled * speed}px)`;
      });
    });
  });