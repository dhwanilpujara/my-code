// function showSlide(slideId) {
//     var slides = document.querySelectorAll('.slide');
//     for (var i = 0; i < slides.length; i++) {
//         slides[i].style.display = 'none';
//     }
//     var currentSlide = document.getElementById(slideId);
//     if (currentSlide) {
//         currentSlide.style.display = 'block';
//         updateButtonStates(currentSlide);
//     }
// }

// document.getElementById('hotelbookform').addEventListener('submit', function (e) {
//     e.preventDefault(); // Prevent the form from submitting
// });
// document.querySelector('button[data-slide="slide1"]').disabled = true;
// // Handle "Next" and "Back" button clicks
// document.querySelectorAll('button[type="button"]').forEach(function (button) {
//     button.addEventListener('click', function () {
//         var slideId = this.getAttribute('data-slide'); // Get the target slide ID from the button's data-slide attribute
//         var currentSlide = document.getElementById(slideId); // Get the current slide by its ID
//         if (currentSlide) {
//             if (currentSlide.style.display !== 'none') { // Check if the current slide is visible
//                 if (updateButtonStates(currentSlide)) { // Check if the current slide's fields are filled
//                     showSlide(slideId); // Move to the target slide if conditions are met
//                 }
//             }
//         }
//     });
// });

// function updateButtonStates(slide) {
//     var nextButton = slide.querySelector('button[data-slide]'); // Get the "Next" button in the current slide
//     var fields = slide.querySelectorAll('input:required, select:required'); // Get all required input and select elements in the current slide
//     var allFieldsFilled = true;
//     for (var i = 0; i < fields.length; i++) {
//         if (fields[i].value === "") {
//             allFieldsFilled = false; // If any required field is empty, set allFieldsFilled to false
//             break;
//         }
//     }
//     nextButton.disabled = !allFieldsFilled; // Disable the "Next" button if not all required fields are filled

//     // If all fields are filled, enable the "Next" button for the next slide
//     if (allFieldsFilled) {
//         var nextSlideButton = slide.querySelector('button[data-slide]'); // Get the "Next" button in the current slide
//         var nextSlideId = nextSlideButton.getAttribute('data-slide'); // Get the ID of the next slide
//         if (nextSlideId) {
//             document.querySelector('button[data-slide="' + nextSlideId + '"]').disabled = false; // Enable the "Next" button for the next slide
//         }
//     }

//     return allFieldsFilled; // Return whether all required fields in the current slide are filled
// }

// function adjustPrice(inputId, increment) {
//     const priceInput = document.getElementById(inputId);
//     const currentValue = parseFloat(priceInput.value) || 0; // Convert to a number, default to 0 if not a number
//     const newValue = currentValue + increment;
//     priceInput.value = newValue.toFixed(2); // Ensure two decimal places
// }




 const steps = Array.from(document.querySelectorAll("form .step"));  
 const nextBtn = document.querySelectorAll("form .next-btn");  
 const prevBtn = document.querySelectorAll("form .previous-btn");  
 const form = document.querySelector("form");  
 nextBtn.forEach((button) => {  
  button.addEventListener("click", () => {  
   changeStep("next");  
  });  
 });  
 prevBtn.forEach((button) => {  
  button.addEventListener("click", () => {  
   changeStep("prev");  
  });  
 });  
 form.addEventListener("submit", (e) => {  
//   e.preventDefault();  
  const inputs = [];  
  form.querySelectorAll("input").forEach((input) => {  
   const { name, value } = input;  
   inputs.push({ name, value });  
  });  
//   console.log(inputs);  
//   form.reset();  
 });  
 function changeStep(btn) {  
  let index = 0;  
  const active = document.querySelector(".active");  
  index = steps.indexOf(active);  
  steps[index].classList.remove("active");  
  if (btn === "next") {  
   index++;  
  } else if (btn === "prev") {  
   index--;  
  }  
  steps[index].classList.add("active"); 
  if (index === steps.length - 1) {
        form.submit();
    }
 } 
 
 
 
 
 