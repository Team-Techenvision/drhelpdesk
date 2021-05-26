<template>
	<div class="contacts-list">
		<ul>
			<li v-for="(contact,index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{ 'selected': index == selected }"> 
				<div class="avatar">
					<img :src="'http://drhelpdesk.in'" >
				</div>
				<div class="contact">
					<p class="name">{{ contact.name }}</p>
				    <!--<p class="email">{{ contact.email }}</p>  -->
				</div>
			</li>
		</ul>
	</div>
</template>


<script>
	export default{
  			  props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: 0
            };
        },
        methods: {
            selectContact(index, contact) {
                console.log('list select contact');
                
                this.selected = index;
                this.$emit('selected', contact);
            }
        }
    }

</script>

<style lang="scss" scoped>
   
     
    .contacts-list {
        flex: 2;
        height: 70vh;
        overflow-y: auto;
        border-left: 1px solid rgba(0,0,0,0.1);
          
        ul {
            list-style-type: none;
            padding-left: 0;

            li {
                display: flex;
                padding: 2px;
                padding-left: 10px;
                border-bottom: 1px solid rgba(0,0,0,0.1);
                height: 80px;
                position: relative;
                cursor: pointer;

                &.selected {
                    background-color: rgba(0,0,0,0.1);
                }

                .avatar{
                flex:1;
                display:flex;
                align-items:center;
                 
                 img{
                  width:65px;
                  border-radius:60%;
                  margin:0 auto;
                  overflow:hidden;
                  height:10vh;
                 }


                }

            //     img {
            //     max-width: 85%;
            //     max-height: 85%;
            // }
                .contact {
                    flex: 3;
                    font-size: 14px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;

                    p {
                        margin: 0px;

                        &.name {
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }

    @media only screen and (max-width: 500px) {
       
       .contacts-list {
        flex: 2;
        height: 70vh;
        overflow-y: auto;
        border-left: 1px solid rgba(0,0,0,0.1);
          
        ul {
            list-style-type: none;
            padding-left: 0;

            li {
                display: flex;
                padding: 2px;
                padding-left: 10px;
                border-bottom: 1px solid rgba(0,0,0,0.1);
                height: 150px;
                position: relative;
                cursor: pointer;

                &.selected {
                    background-color: rgba(0,0,0,0.1);
                }

                .avatar{
                flex:2;
                display:flex;
                align-items:center;
                 
                 img{
                  width:40px;
                  border-radius:50%;
                  margin:0 auto;
                  overflow:hidden;
                  height:10vh;
                  margin-bottom:67px
                 }


                }

            //     img {
            //     max-width: 85%;
            //     max-height: 85%;
            // }
                .contact {
                    flex: 3;
                    font-size: 14px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;

                    p {
                        margin: 0px;

                        &.name {
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }
    }
</style>