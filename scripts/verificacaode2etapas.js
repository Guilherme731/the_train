const botao = document.querySelector('button');
const inputs = document.querySelectorAll('input');


window.addEventListener('load', () => inputs[0].focus());

inputs.forEach(input => {

    const currentInput = input;
    const nextInput = input.nextElementSibling;
   
    if(currentInput.value.length > 1){
        currentInput.value = currentInput.value.slice(1);
    }

    if(nextInput !== null && nextInput.hasAttribute)
    
})
