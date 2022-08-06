/* Control de la animación del logo */
let tl = gsap.timeline();
tl.from(".content", {
  y: "-30%",
  opacity: 0,
  duration: 1.5,
  ease: Power4.easeOut,
});
tl.from(
  ".stagger1",
  {
    opacity: 0,
    y: -50,
    stagger: 0.3,
    duration: 1.5,
    ease: Power4.easeOut,
  },
  "-=1.5"
);
tl.from(
  ".hero-desing",
  {
    opacity: 0,
    y: 50,
    ease: Power4.easeOut,
    duration: 1,
  },
  "-=2"
);

gsap.from(".square-anim", {
  stagger: 0.1,
  scale: 0.1,
  duration: 0.2,
  ease: Back.easeOut.config(1.3),
});
