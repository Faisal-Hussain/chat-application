<template>
    <div class="messenger_cont">
        <div class="messenger_cont_inner d_flex justify_content_space_between fd_column">
            <div class="messenger_cont_inner_messages_b">
                <!--<infinite-loading @distance="1" direction="top" @infinite="infiniteHandler"></infinite-loading>-->
                <div class="next d-flex justify-content-center" v-if="spiner">
                    <pulse-loader></pulse-loader>
                </div>
                <div class="left clearfix" v-for="message in messages" :key="message.id">
                    <div class="d_flex justify_content_start flex-column align_items_start" v-if="message.from_id == recipient.id">
                        <div class="d_flex align_items_center justify_content_end  received_message_block ">
                            <div class="d_flex align_items_center">
                                <img :src="image_src_male"  alt="pic" v-if="recipient.gender == 1">
                                <img :src="image_src_female"  alt="pic" v-else>
                                <span class="fs_16 f_600">{{recipient.nick_name}}</span>
                            </div>
                            <p class="fs_16">{{ message.message}}</p>
                        </div>
                        <div v-if="message.media && message.media.length > 0">
                            <div class="media" v-for="media in message.media" :key="`media_${media.id}`">
                                <img v-img :src="media.original_url" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="d_flex align_items_end justify_content_end  send_message_block_div flex-column" v-else>
                        <div class="d_flex align_items_center justify_content_end  send_message_block">
                            <div class="d_flex align_items_center">
                                <img :src="image_src_male"  alt="pic" v-if="user.gender == 1">
                                <img :src="image_src_female"  alt="pic" v-else>
                                <span class="fs_16 f_600">{{user.nick_name}}</span>
                            </div>
                            <p class="fs_16">{{ message.message}}</p>
                        </div>
                        <div v-if="message.media && message.media.length > 0">
                            <div class="media" v-for="media in message.media" :key="`media_${media.id}`">
                                <img v-img :src="media.original_url" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="send_message_b bc_darkBlue d-flex flex-column" id="send_message">
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
                        <textarea  cols="30" rows=""
                                   id="btn-input"
                                   name="message"
                                   class="form-control input-sm"
                                   placeholder="Type your message here..."
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
                            >
                                <img :src="image_src_upload" class="img-upload" alt="pic">
                            </file-upload>
                        </div>
                    </div>
                    <a class="send_message_btn d_flex align_items_center justify_content_center bc_blue" @click="sendMessage">
                        <button  class="c_white fs_16">Send</button>
                    </a>
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
                show_arrow: false,
                url: null,
                images: [],
                imagesUrl: [],
                page:1,
                countPage: 0,
                spiner: false,
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

    .bottom_arrow, .img-upload, .send_message_btn {
        cursor: pointer;
    }

    .media {
        width: 210px;
        height: 100px;
        padding-bottom: 125px;
    }

    .media img {
        height: 100px !important;
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

</style>

