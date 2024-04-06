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

function err(){
    document.getElementById("error-msggg").value="Wrong Username or Password";
}
  