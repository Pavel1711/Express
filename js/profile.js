let editProfile = document.querySelector('.editProfile'),
    saveProfile = document.querySelector('.saveProfile'),
    inputProfile = document.querySelectorAll('.form-control');

editProfile.addEventListener('click', () => {
    edit(false);
})

saveProfile.addEventListener('click',()=>{
    edit(true);
})

function edit(condition) {
    if(condition){
        saveProfile.classList.remove('d-flex');
        saveProfile.classList.add('d-none');
        editProfile.classList.remove('d-none');
        editProfile.classList.add('d-flex');
        for(let i = 0; i<inputProfile.length; i++){
            inputProfile[i].setAttribute('disabled','disabled');
        }
    }else{
        saveProfile.classList.remove('d-none');
        saveProfile.classList.add('d-flex');
        editProfile.classList.remove('d-flex');
        editProfile.classList.add('d-none');
        for(let i = 0; i<inputProfile.length; i++){
            inputProfile[i].removeAttribute('disabled');
        }
    }
}


