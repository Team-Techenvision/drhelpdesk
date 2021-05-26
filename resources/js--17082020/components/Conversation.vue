<template>
    <div class="conversation">
        <h1> {{ contact ? contact.name : 'Select a Contact' }}</h1>    
        <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>    
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';
    import firebaseDb  from './firebase/firebasestore';
    export default {
        props: {
             
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Object,
                default: []
            }
        },
        methods: {
            sendMessage(text) {
                  if(!this.contact){
                  return;
                }
                this.$emit('send', text, 0);
                // firebaseDb.ref('chats/' + state.userDetails.userId + '/' + payload.otherUserId).push(payload.message)
                // axios.post(`conversation/send`,{
                //  contact_id:this.contact.id,
                //  text: text
                // }).then((response)=>{
                //       console.log(hhhh);
                //       console.log(reponse.data);
                //     this.$emit('new',response.data);
                // })
            }
            },

            //   getName: function() {
            //   var contact_id=this.contact.id;
            //     return firebaseDb.database().ref('conversation/send' +
            //   contact_id).on('new', function(snapshot) {
            //            if (snapshot.val()) {
            //                 var obj = snapshot.val();
            //                 var userName = snapshot.val().username;
            //                 // console.log('username:', userName)
            //                 }
            //             });
            //         }
            //     },
            // firebaseGetUser({ commit }) {
            //     firebaseDb.ref('users').on('child_added', snapshot=>{
            //         let userDetails = snapshot.val()
            //         let userId = snapshot.key
            //         commit('addUser', {
            //                     userId,
            //                 userDetails
            //             })
            //         })
            //     firebaseDb.ref('users').on('child_changed', snapshot=>{
            //         let userDetails = snapshot.val()
            //         let userId = snapshot.key
            //         commit('updateUser', {
            //                 userId,
            //                 userDetails
            //                 })
            //             })
            //         },
            //     },
        
        components:{MessagesFeed,MessageComposer}
                
    }
</script>

<style lang="scss" scoped>
    .conversation {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        h1 {
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px dashed rgba(0,0,0,0.1);
        }
    }
</style>
