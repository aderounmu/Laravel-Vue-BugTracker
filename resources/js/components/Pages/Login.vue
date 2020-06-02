<template>
    <div>
        <div class="login-container">
            <div class="login-header">
                <div class="login-header-content ">
                    <div class="header-links-content">
                        <p class="login-header-item" @click="switchtabLogin" :class="[logintab? 'highlight' : '']" >Login</p> 
                           |  <p class="login-header-item" @click="switchtabRegister" :class="[logintab? '' : 'highlight']">Register</p>
                    </div>
                    <div class= "login-error">
                        <div :class="[isError ? 'login-error-message':'login-success-message']">
                            {{resMessage}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-content">
                <form action="" class="login-form" @submit="loginUser" v-if="logintab">
                    <div class="username-container item-container">
                        <input type="email" v-model="loginDetails.email" name="email" id="login-email" class="login-input login-item"  placeholder="Email">
                    </div>
                    <div class="password-container item-container ">
                        <input type="password" v-model="loginDetails.password" name="password" id="login-password" class="login-input login-item" placeholder="Password">
                    </div>
                    <div class="submit-container item-container ">
                        <button type="submit" class="login-button login-item">Login</button>
                    </div>
                </form>
                <form action="" class="login-form" @submit="registerUser" v-else>
                    <div class="username-container item-container">
                        <input type="text" name="name" v-model="registerDetails.name" id="reg-name" class="login-input login-item"  placeholder="Full Name">
                    </div>
                    <!--<div class="password-container item-container ">
                        <input type="text" name="password" id="" class="login-input login-item" placeholder="Surname">
                    </div>-->
                    <div class="password-container item-container ">
                        <input type="email" name="email" v-model="registerDetails.email" id="reg-email" class="login-input login-item" placeholder="Email">
                    </div>
                    <div class="password-container item-container ">
                        <input type="password" name="password" v-model="registerDetails.password" id="reg-password" class="login-input login-item" placeholder="Password">
                    </div>
                    <div class="password-container item-container ">
                        <input type="password" name="c_password" v-model="registerDetails.c_password" id="reg-c_password" class="login-input login-item" placeholder="Confirm Password">
                    </div>
                    <div class="submit-container item-container ">
                        <button type="submit" class="login-button login-item">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return{
            logintab: true,
            isError: false,
            resMessage:"",
            login_url: "api/login",
            register_url:"api/register",
            loginDetails:{
                email:"",
                password: "",
            },
            registerDetails:{
                name : '',
                email : '',
                password : '',
                c_password : ''
            }

        }
    },
    methods: {
        loginUser(e){
            e.preventDefault()
            fetch(this.login_url,{
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.loginDetails)
            })
            .then((response) => response.json())
            .then((data)=>{
                console.log('Success:', data)
                this.loginDetails.email = ""
                this.loginDetails.password = ""
                if(data.message == "Login Successful"){
                    this.isError = false
                }else{
                    this.isError = true
                }
                this.resMessage = data.message
               sessionStorage.setItem("id",data.id)
               sessionStorage.setItem("name",data.name)
               sessionStorage.setItem("token",data.token)
               sessionStorage.setItem("status","loggedin")
               //make it push to previous page and not home
               this.$router.push({name:'home'})
            })
            .catch((error)=>{
                console.error('Error:', error)
            })

        },
        registerUser(e){
            e.preventDefault()
            if(this.registerDetails.c_password === this.registerDetails.password){

                fetch(this.register_url,{
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(this.registerDetails)
                })
                .then((response) => response.json())
                .then((data)=>{
                    console.log('Success:', data)
                    this.registerDetails.email = ""
                    this.registerDetails.name = ""
                    this.registerDetails.password = ""
                    this.registerDetails.c_password = ""
                    if(data.message === "Registration Successful"){
                        this.isError = false
                    }else{
                        this.isError = true
                    }
                    this.resMessage = data.message
                    //sets login to session storage 
                    //local can also be used 
                    sessionStorage.setItem("id",data.id)
                    sessionStorage.setItem("name",data.name)
                    sessionStorage.setItem("token",data.token)
                })
                .catch((error)=>{
                    console.error('Error:', error)
                })
            }else{
                this.isError = true
                this.resMessage = "Password and Confirm Password must be the same"
            }

        },
        switchtabRegister(){
            this.logintab = false
        },
        switchtabLogin(){
            this.logintab = true
        }

    },


}
</script>

<style scoped>

.login-container{
    display: flex;
    height: 70vh;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}

/* .login-header-content{
    display: flex;
    flex-direction: row
} */
.header-links-content{
    display: flex;
    flex-direction: row;
    color:white;
}

.login-header-content p {
    /*width: 50%;*/
    flex: 2,
}


.login-content{
   
    border-radius: 10px;
    width: 50%;
    margin: 20px;
    display: flex;
    justify-content: center;
}
.login-item{
    width: 100%;
    margin: 10px 30px;
    padding: 10px 5px;
    border-radius: 5px;
    color: white;
}
.login-item::placeholder{
    color: white;
}
.login-input{
    outline: none;
    border: none;
    background-color: #353535;
    padding-left: 10px;
}
.login-button{
    border: none;
    outline: none;
    background-color: #000000
    
}
.item-container{
    width: 100%;
}

.highlight{
    border-bottom: 3px solid #000000
}
.login-header-item{
    color: white;
    cursor:pointer;
}

.login-error-message{
    color: red;
}
.login-success-message{
    color: green
}

</style>