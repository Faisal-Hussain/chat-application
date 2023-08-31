function openNavSearch() {
    document.getElementById("sidenavSearch").style.display= "block";
    if(y.matches){
        document.getElementById("sidenavSearch").style.width = "270px";
    } else {
        document.getElementById("sidenavSearch").style.width = "350px";
    }
}

function closeNavSearch() {
    document.getElementById("sidenavSearch").style.width = "0";
}

let y = window.matchMedia("(max-width: 414px)")