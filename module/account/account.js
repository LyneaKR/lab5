
const modal = document.getElementById("myModal");
const btn = document.querySelectorAll(".qwer");
const span = document.getElementsByClassName("close")[0];



 
  btn.forEach(element => { 
    element.addEventListener('click', showModal); 
  }); 
   
   
  span.addEventListener('click', closeModal); 
   
  window.addEventListener('click', function(event) { 
    if (event.target == modal) { 
      closeModal(); 
    } 
  }); 
   
  function showModal() { 
    modal.style.display = "block"; 
  } 
   
  function closeModal() { 
    modal.style.display = "none"; 
  } 
