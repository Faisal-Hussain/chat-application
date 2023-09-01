$(document).ready(function () {
    if(window.routeName != 'chat') {
        window.Echo.private(`chat.${window.id}`).listen(
            ".server.sent",
            (e) => {
               $(".nav-icon_notification").addClass('is_notification');
                playAudio();

               if(window.routeName == 'inbox') {
                   let users = e['users'];
                   $(".inbox_title_count").text(users.length);
                   $(".inbox_cont_body_item_mss").remove();
                   $.each(users, function(index, value) {
                       let urlGender = window.site +  '/images/Unknown_User_Male.png';
                       let urlBlock = window.site +  '/images/icons/Block_red.png';
                       let urlRead = window.site +  '/images/icons/ok_green.png';
                       let chatLink = window.site +  '/pages/chat/' + value.id;
                       let moreInfo = value.age + ' years, ' +  value.state + ' / ' + value.country.name;
                       if(value.gender == 2) {
                           urlGender = window.site +  '/images/Unknown_User.png';
                       }

                       let html =`
                               <div class="inbox_cont_body_item d_flex justify_content_space_between align_items_center inbox_cont_body_item_mss">
                                 <div class="d_flex align_items_center inbox_cont_body_item_b1" onclick="location.href='${chatLink}'" style="cursor: pointer">
                                     <div class="sex_b d_flex justify_content_center align_items_center bc_lightGray">
                                        <img src="${urlGender}" alt="pic" class="">
                                     </div>
                                     <div class="d_flex fd_column">
                                        <p class="fs_18">${value.nick_name}</p>
                                        <p class="fs_14">${moreInfo}</p>
                                     </div>
                                  </div>
                                  <div class="d_flex inbox_cont_body_item_b2 justify_content_space_between align_items_center">
                                      <img src="${value.country.flag_link}" alt="pic">
                                     <span class="c_grey fs_24">|</span>
                                     <a href="javascript:void(0)" data-id="${value.id}" disabled class="d_flex align_items_center justify_content_center block-user">
                                        <img src="${urlBlock}" alt="pic">
                                    </a>
                                    <span class="c_grey fs_24">|</span>
                                    <a href="javascript:void(0)" data-id="${value.id}" class="d_flex align_items_center justify_content_center mark-as_read">
                                      <img src="${urlRead}" alt="pic">
                                    </a>
                                  </div>
                               </div> `;

                       $(".inbox_cont_inner").append(html);
                   });

               }
            }
        );
    }
});


function playAudio() {
    let x = new Audio(window.site+ '/music/notification.mp3');
    x.play();
}