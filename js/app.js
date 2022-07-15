//accordion button script for student grade method
    var acc = document.getElementsByClassName("accordion");
    var k;

    for (k = 0; k < acc.length; k++) {
      acc[k].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      });
    }

//logout button script
    function logout(){
      window.location.href = "inc/logout.inc.php";
    }