<template>
    <div>
    <div class="Project-container">
        <div class="project-content">
           <div class="project-header">
               <PageHeader 
               Page='Project'
               :Message='HeaderName'
               ></PageHeader>
           </div>
            <div class="project-body">
                <div class="project-bodyContent">
                    <!-- Project cards go here-->
                  <div class="card-containers">
                      <div class="container-content">
                          <ProjectCard 
                          class='project-card'
                          v-for="project in projects"
                          :key='project.id'
                          :Project='project'
                          ></ProjectCard>
                      </div>
                 </div>  
                </div>
            </div>
        </div> 
        <div class=" add-button" v-if="!popUp">
            <div class="add-button-content">
                <button class="ADDbutton" @click="expandPOPUP">
                   <b>+</b>
                </button>
            </div>
        </div> 
         <div class="pop-up" v-if="popUp">
                <ProjectForm :project="itemPOPup" @close-popup="closePOPUP" @getdata="getDataAgain"></ProjectForm>
        </div>
    </div>
    </div>
</template>

<script>
import ProjectCard from '../Includes/ProjectCard.vue'
import ProjectForm from '../Includes/ProjectForm.vue'
//import sampleProject from './sample-data/sampleProject.js'
export default {
    components:{
        ProjectCard,
        ProjectForm
    },
    data() {
        return {
            projects : null, //sampleProject.data, 
            popUp: false,
            itemPOPup : null,
        }
    },
    methods:{

        filterbyId(id){
            let item = this.Bugs.filter(element => element.id == id)
            this.itemPOPup = item[0] 
        },

        getDataAgain(){
             fetch('api/project/')
            .then((response)=>{
                return response.json();
            })
            .then((data)=>{
                this.projects = data.data
            })
        },
        expandPOPUP(id=null){
            this.itemPOPup = null
            this.popUp = true;
            //console.log('this is the id ' + id)
            // if(id == null){
            //     console.log('id is null')

            // }else{
            //    this.filterbyId(id);  
            // }
        },
        closePOPUP(){
            this.popUp = false;
        }

    },
    computed: {
        HeaderName(){
            let userAuth = sessionStorage.getItem('laravel-vue-bugtracker-loggedin')
            if(userAuth === 'false' || userAuth === null || userAuth === undefined){
                return 'Guest'
            }else{
                return sessionStorage.getItem('laravel-vue-bugtracker-name')
            }
        }
    },
    mounted() {
        fetch('api/project/')
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{
            this.projects = data.data
        })
    },
}
</script>
<style scoped lang='scss'>
    .container-content{
        display: flex;
        flex: row;
        flex-wrap: wrap
    }
    .project-card{
        width: 32%;
    }
    .project-body{
        margin-top: 50px;
    }
    .add-button{
        position: fixed;
        bottom: 50px ;
        right: 80px
    }
    .ADDbutton{
        border: none;
        background: #0C4AEB;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        color: white;
        font-size: 3.5rem;

    }
    $colors: #29BEDF , #29DF5C, #DF2935;
    $repeat: 3;
</style>