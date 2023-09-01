$(document).ready(function () {
    window.Echo.channel('online').listen(
        ".server.online",
        (e) => {
            $.ajax({
                type: "get",
                url: "/online/users",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {},
                success: function (data) {
                    let length = 'Online ' + data.length;

                    $(".count-online").text(length);
                    $(".sidenav-left .sidenav_body_content_item").remove();
                    $(".sidenav-left_mobile .sidenav_body_content_item").remove();
                    $.each(data, function (index, value) {
                        let url = window.site + '/pages/chat/' + value.id;
                        let urlGenderMale = window.site + '/images/icons/Male_icon_blue.png';
                        let urlGenderFemale = window.site + '/images/icons/Female_icon_rose.png';

                        let ageInfo = `<span>${value.age + ' years '}</span>`;
                        let countryInfo = `<span>${value.state + ' / ' + value.country.name}</span>`;
                        let flagInfo = `<div>
                                              <img src="${value.country.flag_link}" alt="">
                                        </div>`;

                        if(value.setting){
                            if(value.setting.reveal_age == 0) {
                                ageInfo = `<span></span>`;
                            }

                            if(value.setting.reveal_country == 0) {
                                countryInfo = `<span></span>`;
                                flagInfo = `<div> </div>`;
                            }
                        }

                        let divHtml = `
                            <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                                <img src="${urlGenderMale}" alt="">
                            </div>
                            <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                                <div>
                                    <p class="fs_18">${value.nick_name}</p>
                                    <p class="fs_14">
                                        ${ageInfo}
                                        ${countryInfo}
                                    </p>
                                </div>
                                 ${flagInfo}
                            </div>`;

                        if (value.gender == 2) {
                            divHtml = `
                            <div class="sex_b d_flex justify_content_center align_items_center bc_lightRose">
                                <img src="${urlGenderFemale}" alt="">
                            </div>
                            <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                                <div>
                                    <p class="fs_18">${value.nick_name}</p>
                                    <p class="fs_14">
                                        ${ageInfo}
                                        ${countryInfo}
                                    </p>
                                </div>
                                  ${flagInfo}
                            </div>`;
                        }

                        let html = `
                                <div class="sidenav_body_content_item d_flex bc_lightGray" onclick="location.href='${url}';">
                                 ${divHtml}
                               </div> `;

                        $(".sidenav-left .sidenav_body_content").append(html);
                        $(".sidenav-left_mobile  .sidenav_search_body_content").append(html);
                    });
                }
            });
        }
    );

});