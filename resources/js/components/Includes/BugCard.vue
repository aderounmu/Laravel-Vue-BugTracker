<template>
    <div>
        <div class="card-container">
            <div class="card-content">
                <div class="card-row-1">
                    <div class="row-1-content">
                        <div class="row-1-left">
                            <div class="category" :class="[Bug.Priority]">
                                {{Bug.Category}}
                            </div>
                        </div>
                        <div class="row-1-right">
                            <div class="status">
                                <div class="status-content" :class="[Bug.Priority+'-bg']">
                                   {{Bug.Priority}} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-row-2">
                    <div class="row-2-content">
                        <div class="title">
                            {{Bug.Title}}
                        </div>
                    </div>
                </div>
                <div class="card-row-3">
                    <div class="row-3-content">
                        userimage are here
                    </div>
                </div>
                <div class="card-row-4">
                    <div class="row-4-content">
                        <div class="description">
                            {{Bug.Description}}
                        </div>
                    </div>
                </div>
                <div class="card-row-5">
                    <div class="row-5-content">
                        <div class="row-5-left">
                            <div class="ticket-id" :class="[Bug.Priority]">
                               Ticket #{{Bug.id}}
                            </div>
                        </div>
                        <div class="row-5-right">
                            <div class="open-button-container">
                                <div class="open-button-content">
                                    <button class="open-button" @click="$emit('expand-popup', Bug.id)">
                                        <img src="img/mdi_arrow_up.png" alt="">
                                    </button>
                                </div>
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
    props:['Bug'],
    methods: {
    
    },
}
</script>

<style scoped lang="scss">
    .row-1-content , .row-5-content {
        display: flex ;
        flex-direction: row;
    }
    .card-container{
        background: #353535;
        box-shadow: 6px 6px 10px #000000;
        border-radius: 30px;
        width: 290px;
        height: 360px;  
        margin: 20px;
    }
    .Open-bg{
        background:#29DF5C;
    }
    .Closed-bg{
        background:#DF2935
    }
    .Processing-bg{
        background:#29BEDF ;
    }
    .Open{
        color:#29DF5C;
    }
    .Closed{
    color:#DF2935
    }
    .Processing{
        color:#29BEDF ;

    }
    .card-content{
        padding: 20px;
    }
    .row-1-left{
        flex: 4

    } .row-1-right{
        flex: 2
    }
    .category{
        font-size: 1.3rem;
    }
    .status-content{
        font-size: 1rem;
        padding:5px;
        text-align: center;
        border-radius: 5px;
    }
    .row-2-content{
        margin: 10px 0px;
    }
    .title{
        font-size: 1.35rem;
        line-height: 1.45rem;
    }
    .row-3-content{
        margin: 10px;
    }
    .row-4-content{
        height: 120px;
        overflow: hidden;
    }
    .description{
        color: #989898;
        font-size: 0.9rem;
    }
    .row-5-content{
        margin: 20px 0px 20px;
    }

    .row-5-left{
        flex: 6;
    }
    .row-5-right{
        flex: 1;
    }
    .open-button{
        border: none;
        border-radius: 50%;
        background-color:  rgba(125, 125,125, 0.25);
        padding: 5px
    }
    .ticket-id{
        font-size: 1.2rem;
    }
</style>