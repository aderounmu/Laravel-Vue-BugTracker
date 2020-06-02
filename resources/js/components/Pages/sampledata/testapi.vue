<template>
    <div>
        <div class="items">
            <p>{{person.name}}</p>
            <p>{{person.id}}</p>
            <p>{{person.token}}</p>
            <p>{{person.message}}</p>
        </div>
        <div class="button">
            <button @click="loginattempt">login</button>
        </div>
    </div>
</template>


<script>
export default {
    name: 'test',
    data() {
        return {
            login: {
                email : "tokunbo45@gmail.com",
                password: "12345678",
            },
            base_url: "api/login",
            person:{
                name: "",
                id: "",
                message:"",
                token:"",
            }
        }
    },
    methods:{
        loginattempt(){
            console.log( JSON.stringify(this.login))
            fetch(this.base_url,{
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.login)
            })
            .then((response) => response.json())
            .then((data)=>{
                this.person = data
                console.log('Success:', data)
            })
            .catch((error)=>{
                //response = error
                console.error('Error:', error)
            })
        },
        
    }
    
}
</script>

<style scoped>
    .items{
        color: white
    }
</style>