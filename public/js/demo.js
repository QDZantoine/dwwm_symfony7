let btn1=document.getElementById('btn1');  // Selectionner l'element dont l'id = 'btn1'
btn1.style.background="blue";
btn1.style.color="white";
//  On peut aussi appliquer le stile en une seule ligne avec setAttribute
let btn2=document.querySelector("#btn2"); // une autre façon de selection un element
btn2.setAttribute("style","width:125px;min-height:70px;background:red;color:white;border-radius:5px");

//---Les elements specifiés par id peut créer automatiquement une variable qui porte le nom de l'id
btn3.className="bouton-green";   //   Mise en style d'un element en utilisant une class