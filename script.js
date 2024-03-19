document.addEventListener("DOMContentLoaded", function() {
    const background = document.querySelector(".background");
    const content = document.querySelector(".content");
  
    window.addEventListener("scroll", function() {
      let scrollPosition = window.pageYOffset;
      background.style.top = scrollPosition * 0.3 + "px"; // Adjust scroll speed
      content.style.top = scrollPosition * 1 + "px"; // Adjust content scroll speed
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    const fixedImage = document.getElementById("fixedImage");

    window.addEventListener("scroll", function() {
        let scrollPosition = window.pageYOffset || document.documentElement.scrollTop || document.documentElement.scrollBottom;

        // Check if scroll position is between 2000 and 3000 pixels
        if (scrollPosition >= 0 && scrollPosition <= 2000) {
            fixedImage.style.position = "absolute";
            fixedImage.style.top = "320%";
            fixedImage.style.left = "75%";
            fixedImage.style.transform = "translate(-50%, -50%)";
        }
        else if (scrollPosition >= 2000 && scrollPosition <= 3200){
            fixedImage.style.position = "fixed";
            fixedImage.style.top = "50%";
            fixedImage.style.left = "75%";
            fixedImage.style.transform = "translate(-50%, -50%)";
        }
        else {
            fixedImage.style.position = "absolute";
            fixedImage.style.top = "450%";
            fixedImage.style.left = "75%";
            fixedImage.style.transform = "translate(-50%, -50%)";
        }
            
    });
});

function validateForm() {
    var password = document.getElementById("password").value;
    var hasAlphabet = /[a-zA-Z]/.test(password); // Check if password contains at least one alphabet
    var hasNumber = /[0-9]/.test(password); // Check if password contains at least one number
    var hasSpecialChar = /[!@#$%&*_-]/.test(password); // Check if password contains at least one special character

    var passwordMsg = document.getElementById("password-validation-msg");

    if (password.length < 8 || password.length > 15) {
        passwordMsg.textContent = "Password must be between 8 to 15 characters";
        return false;
    }

    if (!hasAlphabet) {
        passwordMsg.textContent = "Password must contain at least one alphabet";
        return false;
    }

    if (!hasNumber) {
        passwordMsg.textContent = "Password must contain at least one number";
        return false;
    }

    if (!hasSpecialChar) {
        passwordMsg.textContent = "Password must contain at least one special character ( ! @ # $ % & * _ - )";
        return false;
    }

    // Clear validation message if all criteria are met
    passwordMsg.textContent = "";
    return true; // Form is valid
}
  
  