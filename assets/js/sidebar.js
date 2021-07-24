
    // If localStorage is supported by the browser
    if (typeof(Storage) !== "undefined") {
        // If we need to open the bar
        if(localStorage.getItem("sidebar") == "opened"){
            // Remove class with transition from the 'sidebar' and the 'main'
            
            // Open the bar
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            // Add the transition class again
           
          
        }
    }

/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
   // If localStorage is supported by the browser
    if (typeof(Storage) !== "undefined") {
        // Save the state of the sidebar as "open"
        localStorage.setItem("sidebar", "opened");
    }
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";

  }
  /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  // If localStorage is supported by the browser
    if (typeof(Storage) !== "undefined") {
        // Save the state of the sidebar as "open"
        localStorage.setItem("sidebar", "closed");
    }
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
  /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
