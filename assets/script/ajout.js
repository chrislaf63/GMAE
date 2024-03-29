const submit = document.querySelector('#addTravel');
const success = document.querySelector('.success');
submit.addEventListener('click',()=>{
    const loader = document.querySelector('.loader');
    loader.classList.toggle('invisible');
    setTimeout(()=> {
        loader.classList.toggle('invisible');
        success.classList.toggle('invisible');
    }, 3000);
})