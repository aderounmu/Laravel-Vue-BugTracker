<template>
    <div>
        <div class="form-container white">
            <button @click="$emit('close-popup')" class="close-button">X</button>
            <form @submit="onSubmit">
                <div class="form-content">
                    <div class="bug-form-title">
                        <div class="title-content">
                            <input  :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" type="text" name="title" id="title" v-model="updateItem.Title">
                        </div>
                    </div>
                    <div class="bug-form-details">
                        <div class="heading">Details</div>
                        <div class="details-content">
                            <div class="category details-item">
                                <label for="category">Category:</label>
                                <input :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" type="text" name="category" id="category" v-model="updateItem.Category">
                            </div>
                            <div class="bug-priority details-item">
                                <label for="priority">Priority:</label>
                                <select :disabled="!islogined" :style="priorityColor" name="priority" v-model="updateItem.Priority" >
                                    <option style="background: #DF2935" value="Closed">Closed</option>
                                    <option style="background: #29DF5C" value="Open"> Open</option>
                                    <option  style="background: #29BEDF" value="Processing">Processing</option>
                                </select>
                            </div>
                            <div class="bug-version details-item">
                                <label for="version">Version:</label>
                                <input :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" type="text" name="version" id="version" v-model="updateItem.Version">
                            </div>
                            <div class="bug-sprint details-item">
                                <label for="sprint">Sprint:</label>
                                <input :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" type="text" name="sprint" id="sprint" v-model="updateItem.Sprint">
                            </div>
                            <div class="bug-environment details-item">
                                <label for="environment">Environment:</label>
                                <input :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" type="text" name="environment" id="environment" v-model="updateItem.Environment">
                            </div>
                            <div class="bug-components details-item">
                                <label for="components">Components:</label>
                                <input :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" type="text" name="components" id="components" v-model="updateItem.Components">
                            </div>
                            <div class="bug-labels details-item">
                                <label for="labels">Labels:</label>
                                <input :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" type="text" name="labels" id="labels" v-model="updateItem.Labels">
                            </div>
                        </div>
                    </div>
                    <div class="bug-form-description ">
                        <div class="heading">Description</div>
                        <div class="description-content">
                            <textarea :disabled="!islogined" class="bug-form-input" :class="[!isEditing ? 'bug-item-new':' ']" name="decription" id="description" rows="10" v-model="updateItem.Description"></textarea>
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
        'Bug'
    ],
    data(){
        return{
            updateItem: {
            },
            isEditing: true,
            islogined: true,
            bug_url : 'api/bug'
        }
    },
    methods: {
        onSubmit(e){
            e.preventDefault()
            if(this.isEditing === true){
                //to set update date 
                let api_token = ""
                // let nowDate = new Date().getTime()
                // let updateDate = new Date()
                // updateDate.setTime(nowDate)
                //this.updateItem.updated_at = updateDate.toISOString();
                this.updateItem.updated_at = new Date().toISOString();
                if(sessionStorage.getItem('status') !== null || sessionStorage.getItem('status') === "loggedin"){
                    api_token = sessionStorage.getItem("token")

                    //updating bug

                    fetch(this.bug_url+'/'+this.updateItem.id,{
                    method: 'PUT',
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
                    })
                    .catch((error)=>{
                        //response = error
                        console.error('Error:', error)
                    })

                }else{
                    api_token = null 
                    this.$router.push({name: 'login'})
                }

            }else{
                let api_token = ""
                //adding a new bug 
                if(sessionStorage.getItem('laravel-vue-bugtracker-loggedin') === "true"){
                    api_token = sessionStorage.getItem("laravel-vue-bugtracker-token")
                    let user = sessionStorage.getItem("laravel-vue-bugtracker-id")
                    console.log(user)
                    this.updateItem.created_by = Number(user)

                    //adding a new bug 

                    fetch(this.bug_url,{
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
        let projectID = Number(this.$route.params.id)
            if(this.Bug == null || typeof(this.Bug) == "undefined" || this.Bug == NaN){
                this.updateItem = {
                Environment:"",
                Category:"",
                Components:"",
                Description:"Enter Description here ......",
                Labels:"",
                Priority:"",
                Sprint:"",
                Title:"New Title ......",
                Type:"",
                Version:"",
                assigned_user:"",
                created_at:"",
                created_by: "",
                id:"",
                project_id: projectID, //this.route.,
                updated_at: null,
            }
                this.isEditing = false
            }else{
                this.updateItem = this.Bug
                this.isEditing = true
            }
    },
    computed:{
        //Number(this.$route.params.id), //this.route.,
        priorityColor(){
            let e = this.updateItem.Priority
            switch (e) {
                case "Open":
                    return {background:"#29DF5C"}
                    break;
                case "Closed":
                    return {background:"#DF2935"}
                    break;
                case "Processing":
                    return {background:"#29BEDF"}
                    break;
                default:
                    return " "
            }
        }
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

.bug-form-input{
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

.bug-form-details{
    background-color: #232323;
    padding: 10px 30px;   
}
.heading{
    font-size: 1.5em;
}
.details-content{
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    font-size: 1em;
}
.details-item{
    padding: 0px 10px;
    label{
        color: grey
    }
}
.bug-form-description{
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
 .bug-item-new{
        border: black 1px solid;
}
</style>