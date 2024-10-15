//fixed navigation bar when scroll.
const nav = document.querySelector(".nav");
window.addEventListener("scroll", function () {
  const scrollHeight = window.pageYOffset;
 
  if (scrollHeight > 50) {
    nav.classList.add("fixed-nav");
  } else {
    nav.classList.remove("fixed-nav");
  }
});



//back to top btn click.
const btn = document.querySelector('.btn');
btn.addEventListener('click', function(){
    window.scrollTo({
    top:0,
    behavior:'smooth'
  });
})

//back to top btn display.
window.addEventListener('scroll', function (){
  const scrollHeight = window.pageYOffset;
  console.log(scrollHeight);
  // Check if the current scroll position is greater than half of the page height
  if (scrollHeight > 800) {
      // Show the button
      btn.classList.add("btn-show");
  } else {
      // Hide the button
      btn.classList.remove("btn-show");
  }
});