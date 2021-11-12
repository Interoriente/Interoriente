
  const btnAbrirSidebar = document.querySelector(".boton");
  const btn = document.getElementById("menuLateral");
  const sidebar = document.querySelector(".sidenav");

    // If localStorage is supported by the browser
    if (typeof(Storage) !== "undefined") {
        // If we need to open the bar
        
        if(localStorage.getItem("sidebar") == "opened"){
          /* Quitando botón cuando se abre el sidebar */
            btn.style.display = 'none';
           
            // Open the bar
            document.getElementById("mySidenav").style.width = "220px";
            document.getElementById("main").style.marginLeft = "250px";
            // Add the transition class again
        }
    }

/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
  btn.style.display = 'none';
   // If localStorage is supported by the browser
    if (typeof(Storage) !== "undefined") {
        // Save the state of the sidebar as "open"
        localStorage.setItem("sidebar", "opened");
    }

    document.getElementById("mySidenav").style.width = "220px";
    document.getElementById("main").style.marginLeft = "250px";

  }
  /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  // If localStorage is supported by the browser
    if (typeof(Storage) !== "undefined") {
        // Save the state of the sidebar as "open"
        localStorage.setItem("sidebar", "closed");
    }
    /* Agregando animación */
    sidebar.classList.add('tr-side');
    /* Mostrando el botón  */
    btn.style.display = 'block';
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
  /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
