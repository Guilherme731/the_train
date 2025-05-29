function irParaCima(){
  const node = document.getElementById("lista1").lastElementChild;
  const list = document.getElementById("lista2");
  list.insertBefore(node, null);
}

function irParaBaixo(){
  const node = document.getElementById("lista2").lastElementChild;
  const list = document.getElementById("lista1");
  list.insertBefore(node, null);
}