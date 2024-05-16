document.addEventListener("DOMContentLoaded", () => {
   const stars = document.querySelectorAll(".stars i");
   const starsContainer = document.querySelector(".stars");

   // Function to update stars color based on index
   function updateStars(index) {
       stars.forEach((star, i) => {
           star.classList.toggle("active", i <= index);
       });
   }

   // Click event listener for stars
   stars.forEach((star, index) => {
       star.addEventListener("click", () => {
           updateStars(index);
       });
   });

   // Hover event listener for stars container
   starsContainer.addEventListener("mouseover", (event) => {
       if (event.target.tagName === "I") {
           const index = Array.from(stars).indexOf(event.target);
           updateStars(index);
       }
   });

   // Mouseout event listener for stars container
   starsContainer.addEventListener("mouseout", () => {
       const activeIndex = Array.from(stars).findIndex(star => star.classList.contains("active"));
       updateStars(activeIndex);
   });
});
