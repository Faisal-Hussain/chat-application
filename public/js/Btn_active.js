document.addEventListener('DOMContentLoaded', () => {

    let myBtns=document.querySelectorAll('.sex_btn');
    myBtns.forEach(function(btn) {

        btn.addEventListener('click', () => {
            myBtns.forEach(b => b.classList.remove('active_sex_btn'));
            btn.classList.add('active_sex_btn');
        });

    });

});
