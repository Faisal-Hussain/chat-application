function openNavSearch() {
    document.getElementById("sidenavSearch").style.display= "block";
    if(y.matches){
        // document.getElementById("sidenavSearch").style.width = "270px";
        document.getElementById("sidenavSearchList").style.width = "100%";
        document.getElementById("sidenavSearchList").style.height = 'max-content';
    } else {
        // document.getElementById("sidenavSearch").style.width = "350px";
        document.getElementById("sidenavSearchList").style.width = "100%";
        document.getElementById("sidenavSearchList").style.height = 'max-content';
    }
}

function closeNavSearch() {
    // document.getElementById("sidenavSearch").style.width = "0";
    document.getElementById("sidenavSearchList").style.width = "0px";
    document.getElementById("sidenavSearchList").style.height = "0px";
}

let y = window.matchMedia("(max-width: 414px)")