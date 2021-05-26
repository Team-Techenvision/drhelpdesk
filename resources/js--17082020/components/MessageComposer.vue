<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="Start typing here...">
              </textarea>
            <button @click="send" class="button"> Send </button>
      
        
    </div>
</template>

<script>
    export default {
    data(){
        return{
            message:''
        };
    },
        
        methods: {
            send(e) {
                if(this.message == '') {
                    return;
                }
                this.$emit('send', this.message, 0);
                this.message = '';
                // console.log(e);
                e.preventDefault()
            }
        }
    }
</script>

<style lang="scss" scoped>
    .composer {
        padding: 10px;
        position: relative;

        textarea {
            width: 90%;
            resize: none;
            border-radius: 3px;
            border: 1px solid rgba(0,0,0,0.1);
            padding: 6px;
        }

        .image-label {
            position: absolute;
            bottom: 6px;
            right: 18px;
            color: grey;
            cursor: pointer;
        }

        .button {
            position: absolute;
            right: 26px;
            bottom: 38px;
            color:white;
            background-color:green;

        }
    }
 
@media screen and (max-width:500px) {
   .composer {
        padding: 10px;
        position: relative;

        textarea {
            width: 100%;
            resize: none;
            border-radius: 3px;
            border: 1px solid rgba(0,0,0,0.1);
            padding: 6px;
        }

        .image-label {
            position: absolute;
            bottom: 6px;
            right: 18px;
            color: grey;
            cursor: pointer;
        }

        .button {
            position: absolute;
            right: 26px;
            bottom: 31px;
            color:white;
            background-color:green;
            top:23px;

        }
    
  }
}

 
</style>