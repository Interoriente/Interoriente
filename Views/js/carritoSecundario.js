const sumar = document.getElementById("sumar");
const restar = document.getElementById("restar");
let input = document.getElementById("input");
let cantidad = Number(input.value);

sumar.addEventListener("click", function(){
    cantidad += 1;
    input.value = String(cantidad);
});

restar.addEventListener("click", function(){
    cantidad -= 1;
    input.value = String(cantidad);
});
$(input).on("change keyup paste", function(){
    
})