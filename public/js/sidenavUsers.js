function openNav() {
    document.getElementById("sidenavUsers").style.display= "block";
    if(x.matches){
        document.getElementById("sidenavUsers").style.width = "270px";
    } else {
        document.getElementById("sidenavUsers").style.width = "350px";
    }
}

function closeNav() {
    // document.getElementById("sidenavUsers").style.width = "0";
    document.getElementById("sidenavUsersContent").style.width = "0";
    document.getElementById("sidenavUsersContent").style.height = "0";
}

let x = window.matchMedia("(max-width: 414px)")