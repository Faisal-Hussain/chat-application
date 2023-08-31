<template>
    <div class="messenger_cont_inner d_flex justify_content_space_between fd_column">
        <div class="messenger_cont_inner_header_b d_flex align_items_center justify_content_space_between">
            <div class="d_flex align_items_center messenger_cont_inner_header_b1">
                <div class="user_pic_b">
                    <div v-if="recipient.roles[0].name == 'admin'">
                        <img :src="image_src_admin"  alt="pic" class="user_pic">
                    </div>
                    <div  v-else>
                        <img :src="image_src_male_small"  alt="pic" class="user_pic" v-if="recipient.gender == 1">
                        <img :src="image_src_female_small"  alt="pic" class="user_pic" v-else>
                    </div>
                </div>
                <div class="info_b d_flex align_items_center justify_content_space_between">
                    <div>
                        <p class="fs_18">{{recipient.nick_name}}</p>
                        <p class="fs_14">
                            {{recipient.age + ' years, ' + recipient.state + ' / ' + recipient.country.name }}
                        </p>
                    </div>
                    <div>
                        <img :src="recipient.country.flag_link" alt="flag">
                    </div>
                </div>
            </div>
            <div class="messenger_cont_inner_header_b2 d_flex align_items_center" v-if="recipient.roles[0].name != 'admin'">
                <button class="d_flex align_items_center justify_content_center" @click="blockUser(recipient.id)" >
                    <img :src="image_src_block " alt="">
                    Block
                </button>
                <button class="d_flex align_items_center justify_content_center" @click="reportUser(recipient.id)">
                    <img :src="image_src_warning" alt="">
                    Report
                </button>
            </div>
        </div>
        <div class="next d-flex justify-content-center" v-if="spiner">
            <pulse-loader></pulse-loader>
        </div>
        <div class="messenger_cont_inner_messages_b" v-for="message in messages" :key="message.id">
            <div class="d_flex align_items_center justify_content_start"  v-if="message.from_id == recipient.id"
                 :class="[recipient.gender == 2 ? 'received_message_block' : 'send_message_block']">
                <div>
                    <img :src="image_src_male_blue"  alt="pic" v-if="recipient.gender == 1" class="pink">
                    <img :src="image_src_female_pink"  alt="pic" v-else class="pink">
                </div>
                <div class="d_flex align_items_center">
                    <img :src="image_src_male"  alt="pic" v-if="recipient.gender == 1">
                    <img :src="image_src_female"  alt="pic" v-else>
                    <span class="fs_16 f_600">{{recipient.nick_name}}</span>
                </div>
                <p class="fs_16">{{ message.message}}</p>
                <div v-if="message.media && message.media.length > 0" class="d-flex">
                    <div class="media" v-for="media in message.media" :key="`media_${media.id}`">
                        <img v-img :src="media.original_url" alt="">
                    </div>
                </div>
            </div>
            <div class="d_flex align_items_center justify_content_start" v-else
                 :class="[user.gender == 2 ? 'received_message_block' : 'send_message_block']">
                <div>
                    <img :src="image_src_male_blue" alt="pic" v-if="user.gender == 1" class="pink">
                    <img :src="image_src_female_pink" alt="pic" v-else class="pink">
                </div>
                <div class="d_flex align_items_center">
                    <img :src="image_src_male" alt="pic" v-if="user.gender == 1">
                    <img :src="image_src_female" alt="pic" v-else>
                    <span class="fs_16 f_600">{{user.nick_name}}</span>
                </div>
                <p class="fs_16">{{ message.message}}</p>
                <div v-if="message.media && message.media.length > 0" class="d-flex">
                    <div class="media" v-for="media in message.media" :key="`media_${media.id}`">
                        <img v-img :src="media.original_url" alt="">
                    </div>
                </div>

            </div>
        </div>
        <div class="send_message_b bc_darkBlue " id="send_message">
            <div v-if="imagesUrl.length > 0" class="upload-image_body d-flex flex-wrap">
                <div class="media-before" v-for="image in imagesUrl" >
                    <img :src="image" alt="">
                </div>
            </div>
            <div class="d_flex align_items_center">
                <div class="send_message_area bc_white d_flex align_items_center justify_content_space_between">
                    <div class="emoji_picker" v-if="show_arrow"  v-on-clickaway="away">
                        <div class="picker_container">
                            <div class="category" v-for="category in categories" :key="`category_${category}`">
                                <span>{{ category }}</span>
                                <div class="emojis_container">
                                    <button @click="handleEmojiClick($event, emoji)" v-for="(emoji, index) in category_emojis(category)" :key="`emoji_${index}`">
                                        {{ emoji }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <textarea  cols="30" rows="1"
                               id="btn-input"
                               name="message"
                               class="form-control input-sm"
                               placeholder="Type your message here..."
                               v-on:input="check"
                               :rules="[v => (v || '' ).length <= 5 || 'Description must be 200 characters or less']"
                               v-model="newMessage" @keyup.enter="sendMessage"></textarea>
                    <div class="d_flex align_items_center send_message_area_attach_b">
                        <div class="bottom_arrow"  @click="show_arrow = !show_arrow">
                            <img :src="image_src_smile" alt="pic">
                        </div>
                        <file-upload
                                :custom-action="sendMessageImage"
                                ref='upload'
                                @input-file="$refs.upload.active = true"
                                :multiple="true"
                                class="file-img-upload"
                        >
                            <img :src="image_src_upload" class="img-upload" alt="pic">
                        </file-upload>
                    </div>
                </div>
                <a class="send_message_btn d_flex align_items_center justify_content_center bc_blue" @click="sendMessage">
                    <button class="c_white fs_16">Send</button>
                </a>
            </div>
        </div>
        <div class="modal-overlay" v-show="showModal">
            <div class="modal-vue">
                <div class="close" @click="closeModal">×</div>
                <div class="form-body p-5">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Report Message</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" cols="30" rows="10" v-model="report_message"></textarea>
                    </div>
                    <div class="d-flex justify_content_end mt-3">
                        <button class="btn-primary btn" @click="sendReport(recipient.id)" >Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mixin as clickaway } from 'vue-clickaway';
    import emojis from '../emojis-data.json';
    import EnlargeableImage from '@diracleo/vue-enlargeable-image';
    import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
    export default {
        mixins: [ clickaway ],
        props: ["user", "recipient", "conversation-id"],
        components: {
            EnlargeableImage,
            PulseLoader
        },
        data() {
            return {
                messages: [],
                newMessage: "",
                image_src_smile: '/images/Smile.png',
                image_src_upload: '/images/Image_select.png',
                image_src_male: '/images/Unknown_User_Male.png',
                image_src_female: '/images/Unknown_User.png',
                image_src_male_blue: '/images/Blue.svg',
                image_src_female_pink: '/images/Pink.svg',
                image_src_male_small: '/images/Unknown_user_male_small.png',
                image_src_female_small: '/images/unknown_user_female_small.png',
                image_src_block: '/images/icons/Block_red.png',
                image_src_warning: '/images/icons/Warning_icon_yellow.png',
                image_src_admin: '/images/Admin_pic_king.png',
                show_arrow: false,
                url: null,
                images: [],
                imagesUrl: [],
                page:1,
                countPage: 0,
                spiner: false,
                report_message: null,
                showModal: false,
            };
        },

        computed: {
                categories()
                {
                    return Object.keys(emojis);
                },

                category_emojis: () => (category) =>
                {
                    return Object.values( emojis[category]);
                }
            },

        methods: {
            check: function() {
                let withOutSpace = this.newMessage.replace(/\s+/g, '').length;
                let space = this.newMessage.length - withOutSpace;
                if(withOutSpace > 10){
                    this.newMessage = this.newMessage.substr(0, 200 + space)
                }
            },

            handleEmojiClick(e, emoji) {
                e.preventDefault();
                this.newMessage =  this.newMessage + emoji
            },

            getMessages() {
                this.spiner = true;
                axios.get('/messages/'+ this.recipient.id + '?page='+ this.page).then(response => {
                    this.spiner = false;
                    this.messages.unshift(...response.data.data.reverse());
                    this.countPage = response.data.last_page;
                    if(this.page == 1) {
                       this.scrollToDiv();
                    }
                });
            },


            async sendMessageImage(file, component) {
                this.images.push(file.file);

                let reader = new FileReader();
                reader.onload = event => {
                    this.imagesUrl.push(event.target.result)
                };
                reader.readAsDataURL(file.file);
                this.scrollToDiv();
            },

            async sendMessage() {
                let count = this.newMessage.replace(/\s/g, "").length;
                if(count > 0 ||  this.images.length > 0) {
                    this.show_arrow = false;
                    const fd = new FormData();
                    if( this.images.length > 0) {
                        for (let i = 0; i < this.images.length ; i++) {
                            let obj = this.images[i];
                            fd.append('file[]', obj);
                        }
                    }else {
                        fd.append('file[]', '');
                    }
                    fd.append('recipient_id', this.recipient.id);
                    fd.append('message', this.newMessage);
                    fd.append('conversationId', this.conversationId);
                    await axios.post('/message/send',fd).then(response => {
                        this.scrollToDiv();
                        this.messages.push(response.data);
                        this.newMessage = "";
                        this.imagesUrl = [];
                        this.images = [];
                    });
                }
            },


            async blockUser(id) {
                await axios.post('/block/user',{
                    id
                }).then(response => {
                    window.location.href = '/home';
                });
            },

            reportUser(id) {
                this.showModal = true
            },

            closeModal(){
                this.showModal = false
            },

            async sendReport(id) {
                if(this.report_message) {
                    await axios.post('/report/send',{
                        'id': id,
                        'message':this.report_message,
                    }).then(response => {
                        this.closeModal();
                        this.report_message = null;
                    });
                }
            },
            scrollToDiv() {
                setTimeout(function () {
                    let element = document.getElementById("send_message");
                    let top = element.offsetTop;
                    window.scrollTo(0, top);
                }, 500);
            },

            away() {
                this.show_arrow = false;
            },

            handleScroll () {
                if(window.scrollY < 2) {
                    let nextPage = this.page +1;
                    this.page = nextPage;
                    if(nextPage <= this.countPage) {
                        this.getMessages();
                    }
                }
            }
        },
        created() {
            this.getMessages();
            window.addEventListener("scroll", this.handleScroll);
            window.Echo.private(`chat.${this.user.id}`).listen(
                ".server.sent",
                (e) => {
                    this.scrollToDiv();
                    this.messages.push(e['message']);
                }
            );
        }
    };
</script>

<style scoped>
    .emoji_picker
    {
        position: absolute;
        display: flex;
        flex-direction: column;
        height: 20rem;
        max-width: 801px;
        width: 100%;
        left: -1px;
        margin-top: -402px
    }

    .emoji_picker
    {
        box-shadow: 0 0 5px 1px rgba(0, 0, 0, .0975);
    }

    .emoji_picker,
    .picker_container
    {
        border-radius: 0.5rem;
        background: white;
    }

    .picker_container
    {
        position: relative;
        padding: 1rem;
        overflow: auto;
        z-index: 1;
    }

    .category
    {
        display: flex;
        flex-direction: column;
        margin-bottom: 1rem;
        color: rgb(169, 169, 169);
    }

    .emojis_container
    {
        display: flex;
        flex-wrap: wrap;
    }

    .category button
    {
        margin: 0.5rem;
        margin-left: 0;
        background: inherit;
        border: none;
        font-size: 1.75rem;
        padding: 0;
    }

    .send_message_area {
        position: relative;
    }

    .bottom_arrow, .img-upload, .send_message_btn, .file-img-upload {
        cursor: pointer;
    }

    .bottom_arrow {
        padding-left: 15px;
        padding-right: 15px;
    }

    .media {
        width: 80px;
        margin-left: 12px;
    }

    .media img {
        border-radius: 8px;
        width: 100%;
    }

    .media-before {
        width: 200px;
        height: 80px;
        padding: 10px;
        margin-bottom: 81px;
        border: 10px white;
    }

    .media-before img {
        width: 100%;
        border-radius: 8px;
        border: 3px solid white;
    }

    textarea {
        border: none;
        background: white;
    }

    textarea:focus {
        background-color: white;
        border-color: unset;
        outline: 0;
        box-shadow: unset;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        background-color: #000000da;
        z-index: 100
    }

    .modal-vue {
        background-color: white;
        height: 500px;
        max-width: 750px;
        padding: 60px 0;
        border-radius: 20px;
        width: 100%;
        margin-top: 250px;
        position: relative;
    }
    .modal-vue .close {
        position: absolute;
        right: 3%;
        top: 1%;
        cursor: pointer;
    }

    .modal-vue textarea {
        border: 1px solid lightgray;
        max-height: 300px;
    }


</style>

