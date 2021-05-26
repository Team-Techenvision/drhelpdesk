<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to_id == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div v-if="' sent'" class="chat-message-text">
                   
                   {{ message.message }} 
                </div>
                    <div> 
                        <lable  class="chat-send chat-sended">Recieved </lable>
                    </div>
                    <div>
                        <lable  class="chat-receive chat-received"> send </lable>   
                    </div>           
            </li>
        </ul> 
    </div>
</template>
 
<script>
    export default {
        props: {
            contact: {
                type: Object,
                 
            },
            messages: {
                type: Object,
                required: true
            }
        },
        methods:{
        scrollToBottom(){
            setTimeout(()=>{
               this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
         }, 50);

         
        }
    },
    watch:{
        contact(contact){
            this.scrollToBottom()
        },
        messages(messages){
            this.scrollToBottom()

        }
    }
        

}
</script>
<style lang="scss" scoped>
    .feed {
        background-color: rgba(155, 155, 155, 0.1);
        height: 100%;
        max-height: 280px;
        overflow-y: auto;
        position: relative;

        ul {
            list-style-type: none;
            padding: 10px;
            width: 100%;
            height: 100%;

            li {
                // display: block;
                &.message {
                    margin: 10px 0;
                    width: 100%;

                    .chat-message-text {
                        max-width: 80%;
                        font-size: 11px;
                        border-radius: 5px;
                        padding: 6px 12px;
                        display: inline-block;
                        
                    }

                    &.sent {
                        text-align: right;
                        
                        .chat-message-text {
                            background-color: #dadada;
                    
                        }
                        .chat-send{
                          
                            background-color:#fff;
                              display:none;
                        }
                         .chat-sended{
                          
                            background-color:#fff;
                             
                        }
                    }

                    &.received {
                        text-align: left;
                        
                        .chat-message-text {
                           
                            background-color: #a6d7ff;

                        }
                        .chat-receive{
                             
                             background-color: #fff;
                             display:none;
                        }

                         .chat-received{
                             
                             background-color: #fff;
                             
                        }
                    }
                }
            }
        }
        // .sent{
        //          text-align: right;
                        
        //                 .chat-message-text {
        //                     background-color: #dadada;

        //                 }
        //             }

        // }
        .img-box {
            background-color:rgba(0, 0, 0, 0.9);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            img {
                max-width: 85%;
                max-height: 85%;
            }

            div {
                position: absolute;
                top: 30px;
                right: 30px;
                background-color: #fff;
                width: 25px;
                height: 25px;
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
            }
        }

        .sender {
            font-size: 9px;
            display: block;
            cursor: pointer;
            font-weight: 700;
            margin-bottom: 4px;
        }
    }
</style>

