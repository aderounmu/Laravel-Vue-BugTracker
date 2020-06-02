<template>
    <div>
        <div class="page-header">
            <div class="page-header__left">
                <!-- welcome message-->
                <div class="Message">
                    <span class='welcome' v-show="isProject">Welcome </span> {{Message}} 
                </div>
            </div>
            <div :class="[ isProject ? 'page-header__right_project' : 'page-header__right']">
                <div class="header__right-content">
                    <div class="userIcons" v-show="!isProject" >
                        Here is the list of Images 
                    </div>
                    <div class="settings">
                        <div class="setting-content">
                            <div class="settings-button">
                                <button class= 'settings-icon'>
                                    <img src="img/mdi_settings.png" alt="">
                                </button>
                            </div>
                            <div class="filter-button">
                                <button class='settings-icon'>
                                    <img src="img/mdi_filter_list.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>  
    </div>
</template>

<script>
export default {
    props:['Page', 'Message'],
    data(){
        return{
            
        }
            
        
    },
    methods: {
        
    },
    computed: {
        isProject(){
            if(this.Page == 'Project'){
                return true;
            }
        }
    },
}
</script>

<style  scoped>

.page-header , .setting-content , .header__right-content{
 display: flex;
 flex-direction:row
}
.page-header{
    margin-top: 30px;
}

.page-header__left{
    flex: 8 
}
.page-header__right_project{
  /*flex: 2*/
}
.page-header__right{
    /* flex: 3 */
}

.settings-icon{
    border: none;
    background-color: transparent;
    margin: 10px
}
.settings-icon img{
    height: 32px;
    width: 32px;
}

.Message{
    font-size:2.3rem;
    color: white
}


</style>