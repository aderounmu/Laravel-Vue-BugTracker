<template>
    <div>
        <div class="nav-container">
            <nav class="navbar">
                 <div class="nav-upitem-container">
                     <div class="upitem-content">
                        <div class="nav-item">
                            <router-link to="/" class='nav-link'>
                                <img src="img/mdi_home.png" alt="">
                            </router-link>
                        </div>
                        <div class="nav-item" >
                            <router-link to="/Project" class='nav-link'>
                                <img src="img/mdi_file_copy.png" alt="">
                            </router-link>   
                        </div>
                        <div class="nav-item" >
                            <router-link to="#" class='nav-link'><img src="img/mdi_timeline.png" alt=""></router-link>   
                        </div>
                     </div>
                 </div>
                 <div class="nav-downitem-container">
                     <div class="downitem-content">
                        <div class="nav-item log-out" @click= "logout()">
                            User image 
                            <br/>
                            (click to logout) 
                        </div>
                     </div>
                 </div>
            </nav>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        logout(){
            sessionStorage.removeItem('token')
            sessionStorage.removeItem('name')
            sessionStorage.removeItem('id')
            sessionStorage.setItem('status','loggedout')
            this.$router.push({name:'login'})
        }
    }
}
</script>

<style lang="scss" scoped>
.nav-container{
    height: 100%;
    width: auto;
}
.navbar{
    background-color: #353535;
    display: flex;
    //position: fixed;
    //top:20px;
    flex-direction: column;
    height: 100%;
    width: auto;
    padding: 0px;
    
}

.nav-upitem-container{
    flex: 8;
    width: 100%
}
.nav-downitem-container{
    flex: 2.5;
}

.nav-item{
    margin: 20px 0px 40px;
    width: 100%;
}

.nav-item img{
    width: 32px;
    height: 32px
    
}
.nav-link{
    display: block;
    width: 100%;
    padding: 10px 25px;
}
.log-out{
    color:white;
    cursor: pointer;
}
.nav-link:hover, 
.router-link-exact-active
{
border-left: solid blue 5px;
background:#232323;
}
</style>