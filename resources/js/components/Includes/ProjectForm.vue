<template>
    <div>
        <div class="form-container white">
            <button @click="$emit('close-popup')" class="close-button">X</button>
            <form @submit="onSubmit">
                <div class="form-content">
                    <div class="prject-form-title">
                        <div class="title-content">
                            <input  :disabled="!islogined" class="project-form-input" :class="[!isEditing ? 'project-item-new':' ']" type="text" name="title" id="title" v-model="updateItem.Title">
                        </div>
                    </div>
                    <div class="project-form-description ">
                        <div class="heading">Description</div>
                        <div class="description-content">
                            <textarea :disabled="!islogined" class="project-form-input" :class="[!isEditing ? 'project-item-new':' ']" name="decription" id="description" rows="10" v-model="updateItem.Description"></textarea>
                        </div>
                    </div>
                    <div class="submit-btn-container">
                        <button type="submit" class="submit-button">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props:[
        'project'
    ],
    data(){
        return{
            updateItem: {
            },
            isEditing: false,
            islogined: true,
            project_url: 'api/project'
        }
    },
    methods: {
        onSubmit(e){
            e.preventDefault()
            let api_token = null
            if(this.isEditing == true){
                //this.updateItem.updated_at = new Date.now();
            }else{
                if(sessionStorage.getItem('status') !== null || sessionStorage.getItem('status') === "loggedin"){
                    api_token = sessionStorage.getItem("token")
                    let user = sessionStorage.getItem("id")
                    console.log(user)
                    this.updateItem.created_by = Number(user)
                    //creating a new project
                    fetch(this.project_url,{
                    method: 'POST',
                    headers: {
                        'Authorization':'Bearer '+ api_token,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(this.updateItem),
                    })
                    .then((response) => response.text())
                    .then((data)=>{
                    // this.person = data
                        console.log('Success:', data)
                        this.$emit('getdata')
                        this.$emit('close-popup')
                    })
                    .catch((error)=>{
                        //response = error
                        console.error('Error:', error)
                    })

                }else{
                    api_token = null 
                    this.$router.push({name: 'login'})
                }

            }
        }

    },
    mounted() {
        //let projectID = Number(this.$route.params.id)
            if(this.project == null || typeof(this.project) == "undefined" || this.project == NaN){
                this.updateItem = {
                //Administrators:Array[0]
                //Author:Object
                Description:"Enter Description here ......",
                Title:"New Title ......",
                Type:"",
               //assigned_users:Array[0]
                created_by:"",
                //id:""

            }
                this.isEditing = false
            }else{
                //this.updateItem = this.project
                this.isEditing = true
            }
    },
    computed:{
    }
    
}
</script>
<style lang="scss" scoped>
.white{
    color : white
}
.form-container{
    position: absolute;
    top: 20%;
    background: #353535;
    box-shadow: 6px 6px 10px #000000;
    border-radius: 30px;
    width: 80vw;
    height: 75vh;
    margin: auto;
    
}

.project-form-input{
    border:none;
    outline: none ;
    background-color: transparent;
    color: white;
}

#title{
    width: 100%;
    font-size: 2em;
}
.title-content{
    padding: 20px 30px ;
}

.heading{
    font-size: 1.5em;
}

.project-form-description{
    padding: 20px 30px 0px ;
}
.description-content{

}
#description{
 width: 100%;
 overflow-y: scroll;
 font-size: 0.9em
}

.close-button{
    position: absolute;
    right: -15px;
    top: -25px;
    border: none;
    background:#DF2935;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    color: white;
    font-size: 2rem;
}
.submit-btn-container{
    padding: 10px 30px;
}
.submit-button{
    border: none;
    background: #29DF5C;
    width: 90px;
    height: 40px;
    border-radius: 10px;
    color: white;
    font-size: 1.25rem;
}
 .project-item-new{
    border: black 1px solid;
}
</style>