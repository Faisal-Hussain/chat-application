// function SwitchVip() {
//     let x = document.getElementById("vip_dates_block_select");
//     let y = document.getElementById("vip_dates_b");
//     if (x.style.display === "none") {
//         x.style.display = "block";
//         y.style.display="none";
//     } else {
//         x.style.display = "none";
//     }
// }
// function SaveVip() {
//     let x = document.getElementById("vip_dates_b");
//     let y = document.getElementById("vip_dates_block_select");
//     if (x.style.display === "none") {
//         x.style.display = "block";
//         y.style.display="none";
//     } else {
//         x.style.display = "none";
//         // y.style.display="none";
//     }
// }

function  EditVip(){
    let x = document.getElementById("vip_dates_b");
    let y = document.getElementById("vip_dates_block_select");
    if (y.style.display === "none") {
        y.style.display = "block";
        x.style.display="none";
    } else {
        y.style.display = "none";
        // y.style.display="none";
    }
}

