/* Este script es para el slider de las publicaciones */
let thumbnails = document.getElementsByClassName('thumbnail')
    let activeImages = document.getElementsByClassName('active')
    for (let i = 0; i < thumbnails.length; i++) {
      thumbnails[i].addEventListener('mouseover', function() {
        if (activeImages.length > 0) {
          activeImages[0].classList.remove('active')
        }
        this.classList.add('active')
        document.getElementById('img-principal').src = this.src
      })
    }
    let buttonRight = document.getElementById('slideRight');
    let buttonLeft = document.getElementById('slideLeft');
    buttonLeft.addEventListener('click', function() {
      document.getElementById('slider').scrollLeft -= 180
    })
    buttonRight.addEventListener('click', function() {
      document.getElementById('slider').scrollLeft += 180
    })