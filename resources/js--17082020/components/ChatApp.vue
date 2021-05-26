<template>
     <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @send="sendMessage"/>
        <ContactsList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    import firebaseDb from './firebase/firebasestore';
    import Vue from 'vue';
    export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            selectedContact: null,
            messages: {},
            contacts: [],
            cref:null,
            cid: null,
            message: {
                to_id: null,
                type: 'text',
                message: null
            }
        };
    },
    mounted() {            
              
        axios.get('https://drhelpdesk.in/contacts', {
            id: this.user.id
        })
        .then((response)=>{
            // console.log('response');
            // console.log(response);
            this.contacts=response.data;
            // console.log(this.contacts);
           });
        },
        methods:{
            startConversationWith(contact){     
                    this.selectedContact = contact; 
                    this.message.to_id = contact.id
                    // console.log(contact);
                    // Empty message feed to add new conversation
                    this.messages = {}
                    // Unsubscribe to the currently subcribed channel
                    if(this.cref) {
                        this.cref.off('child_added')
                    }   
                    // var cid = null
                    // Set conversation id
                    if(contact.id < this.user.id){
                        this.cid=contact.id+'-'+this.user.id
                    }
                    else{
                        this.cid=this.user.id+'-'+contact.id
                    }
                    // console.log(this.cid);
                    
                    // Get Conversation Reference
                    this.cref=firebaseDb.ref('conversation/' + this.cid)
                    // console.log(this.cref);
                    
                    // Subscribe to new channel
                    this.cref.on('child_added',snapshot=> {
                        // console.log(snapshot.val());
                        
                        // Get message details
                        let messageDetails = snapshot.val()
                        // get message id
                        let messageId =snapshot.key
                        // add message to messages array
                        Vue.set(this.messages, messageId, messageDetails)
                        // set selected contact
                        
                        // set to (receiver) id to message object
                        
                        // console.log(this.messages);
                        
                    })

                    console.log(this.messages);
                    
                },
                sendMessage(text) {
                    // set message to message object
                    this.message.message = text
                    // send message object into conversation to firebase
                    firebaseDb.ref('conversation/' + this.cid).push(this.message)
                }
            },     
            components:{Conversation,ContactsList}  
        }
        </script>
<style lang="scss" scoped>
    .chat-app {
        display: flex;
    }
 </style>

 
