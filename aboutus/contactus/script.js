document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contact-form");
    const successMessage = document.getElementById("success-message");
  
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent the form from submitting
  
      // Get form elements
      const fullName = contactForm.querySelector("input[name='full-name']");
      const email = contactForm.querySelector("input[name='email']");
      const message = contactForm.querySelector("textarea");
      const submitButton = contactForm.querySelector("input[type='submit']");

  
      // Get the spans for error messages
      const fullNameError = fullName.nextElementSibling;
      const emailError = email.nextElementSibling;
      const messageError = message.nextElementSibling;
  
      // Validate the form fields
      let isValid = true;
  
      if (fullName.value.trim() === "") {
        fullNameError.innerText = "Full Name is required";
        isValid = false;
      } else {
        fullNameError.innerText = "";
      }
  
      if (email.value.trim() === "") {
        emailError.innerText = "Email is required";
        isValid = false;
      } else {
        emailError.innerText = "";
      }
  
      if (message.value.trim() === "") {
        messageError.innerText = "Message is required";
        isValid = false;
      } else {
        messageError.innerText = "";
      }
  
      // If the form is valid, you can submit it
      if (isValid) {
        // Disable the submit button to prevent multiple submissions
        submitButton.disabled = true;
  
        // You can submit the form data using AJAX or simply allow the default form submission
        // Example using AJAX:
        const formData = new FormData(contactForm);
        fetch("contact.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.text())
          .then((data) => {
            // Handle the response and display a success message or an error message
            if (data === "success") {
              successMessage.innerText = "Message sent successfully!";
              contactForm.style.display = "none"; // Hide the form
            } else {
              successMessage.innerText = "An error occurred. Please try again.";
            }
          })
          .catch((error) => {
            console.error("Error:", error);
            successMessage.innerText = "An error occurred. Please try again.";
          });
  
        // Reset the form (optional)
        // contactForm.reset();
      }
    });
  
    // Clear error messages on input focus
    const inputFields = contactForm.querySelectorAll("input, textarea");
    inputFields.forEach(function (input) {
      input.addEventListener("focus", function () {
        const errorSpan = input.nextElementSibling;
        errorSpan.innerText = "";
      });
    });
  });
  