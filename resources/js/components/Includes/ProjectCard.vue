<template>
    <div>
        <div class="cardContent">
            <div class="Toprow">
                <div class="content">
                    <div class="project-icon-container">
                        <div class="project-icon" :class="[icon_color]">
                            {{getIcon}}
                        </div>
                    </div>
                    
                    <div class="project-title-container">
                        <div class="project-title">
                            {{Project.Title}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="Middlerow">
                <div class="description">
                      {{Project.Description}}      
                </div>
            </div>
            <div class="Bottomrow">
                <div class="content">
                    <div class="user-image_container">
                        <div class="userimages">
                            user images should be here
                        </div>
                    </div> 
                    <div class="navigator-container">
                        <div class="navigation-button">
                            <div class="nav-button-content">
                                <router-link :to="{name:'Bugs', params: {id : this.Project.id , project_title : this.Project.Title}}">
                                    <img src="img/mdi_arrow_up.png" alt="">
                                </router-link>
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
    props:{
        Project : Object,
    },
    computed:{
        getIcon(){
            let letters = this.Project.Title;
            letters=letters.split("")
            letters= letters[0] + letters[1]

            return letters.toUpperCase()
        },
        icon_color(){
            let rndNo = Math.floor(Math.random()*3) + 1;
            rndNo = rndNo.toString();
            return 'icon-color-'+rndNo;
        }
    }
}
</script>
<style scoped>
    .cardContent{
        background: #353535;
        box-shadow: 6px 6px 10px #000000;
        border-radius: 10px;
        height: 200px;
        margin: 20px
    }
    .nav-button-content{
        border-radius: 50%;
        background-color: rgba(125, 125,125, 0.25)
    }
    .Toprow{
        /* margin: 10px; */
        padding: 10px 20px 5px;
    }
     .content{
        display: flex;
        flex-direction: row;
    }
    .project-icon-container{
        flex: 2
    }
    .project-icon{
        width: 69px;
        height: 69px;
        padding: 10px 0px;
        text-align: center;
        border-radius: 10px;
        font-size: 2rem;
    }
    .project-title-container{
        padding-left: 20px;
        flex: 8
    }
    .project-title{
        color: #ffffff;
        font-size: 1.04rem;

    }
    .icon-color-1{
        background:#29BEDF ;
    }
    .icon-color-2{
        background:#29DF5C;
    }
    .icon-color-3{
        background:#DF2935 ;
    }
    .Middlerow{
        padding: 5px 20px 0px;
    }
    .description{
        height: 50px;
        overflow: hidden;
        color: #989898;
        font-size: 0.9rem
    }
    .Bottomrow {
        padding: 10px 20px 5px
    }

    .user-image_container{
        flex: 8;
    }
    .navigator-container{
        
    }

</style>