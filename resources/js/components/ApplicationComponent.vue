<template>
    <div>
      <div class = "application-container">
            <Title-banner class='title-banner'></Title-banner>
            <div class="application-content">
                <div class="sidebar">
                    <Navigation class= 'navigation'></Navigation>
                </div>
            <div class="main">
                <div class="appBackground-image">
                    <img src="img/background.png" alt="" srcset="">
                </div>
                <router-view></router-view>      
            </div>
        </div>    
    </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
.appBackground-image{
    position: fixed;
    z-index: -1;
    top: 42%;
    left: 49%;
}
    
</style>