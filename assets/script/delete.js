const deleter = document.querySelector('#delete');
const deleteForm = document.querySelector('#deleteForm');
const success = document.querySelector('.success');

function confirmDelete(){
    if(confirm('Etes-vous sûr de vouloir supprimer le voyage sélectionné ?')){
        deleteForm.submit();
        window.scrollTo(0,0);
        const loader = document.querySelector('.loader');
        loader.classList.toggle('invisible');
        setTimeout(()=> {
            loader.classList.toggle('invisible');
            success.classList.toggle('invisible');
        }, 3000);
    }
}

deleter.addEventListener("click", ()=>{
    confirmDelete()
});
