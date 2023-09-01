document.addEventListener('DOMContentLoaded', () => {

    let myBtns=document.querySelectorAll('.sex_btn');
    myBtns.forEach(function(btn) {

        btn.addEventListener('click', () => {
            myBtns.forEach(b => b.classList.remove('active_sex_btn', 'female_btn_new'));
            if( btn.classList.contains('female_btn')) {
                btn.classList.add('female_btn_new');
            }
            btn.classList.add('active_sex_btn');
        });
    });
});
