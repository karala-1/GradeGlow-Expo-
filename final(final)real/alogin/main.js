document.getElementById('menu-toggle').addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuToggle = document.getElementById('menu-toggle');
    mobileMenu.classList.toggle('active');
    menuToggle.classList.toggle('open');
});


//Del lado Izquierdo perri//
document.addEventListener("scroll", function() {
    const sections = document.querySelectorAll(".tras");

    sections.forEach(tras => {
        const sectionPosition = tras.getBoundingClientRect().top;
        const sectionBottom = tras.getBoundingClientRect().bottom;
        const screenPosition = window.innerHeight / 1.3;

       
        if (sectionPosition < screenPosition && sectionBottom > 0) {
            tras.classList.add("show");
        } 
  
        else {
            tras.classList.remove("show");
        }
    });
});


//Del lado derecho perri//
document.addEventListener("scroll", function() {
    const sections = document.querySelectorAll(".tres");

    sections.forEach(tres => {
        const sectionPosition = tres.getBoundingClientRect().top;
        const sectionBottom = tres.getBoundingClientRect().bottom;
        const screenPosition = window.innerHeight / 1.3;

      
        if (sectionPosition < screenPosition && sectionBottom > 0) {
            tres.classList.add("show");
        } 
     
        else {
            tres.classList.remove("show");
        }
    });
});


document.addEventListener("scroll", function() {
    const sections = document.querySelectorAll(".tras");

    sections.forEach(tras => {
        const sectionPosition = tras.getBoundingClientRect().top;
        const sectionBottom = tras.getBoundingClientRect().bottom;
        const screenPosition = window.innerHeight / 1.3;

       
        if (sectionPosition < screenPosition && sectionBottom > 0) {
            tras.classList.add("show");
        } 
  
        else {
            tras.classList.remove("show");
        }
    });
});


//Del lado derecho perri//
document.addEventListener("scroll", function() {
    const sections = document.querySelectorAll(".tres");

    sections.forEach(tres => {
        const sectionPosition = tres.getBoundingClientRect().top;
        const sectionBottom = tres.getBoundingClientRect().bottom;
        const screenPosition = window.innerHeight / 1.3;

      
        if (sectionPosition < screenPosition && sectionBottom > 0) {
            tres.classList.add("show");
        } 
     
        else {
            tres.classList.remove("show");
        }
    });
});