<template>
    <div>
        <div class="Bug-page-content">
            <PageHeader 
               Page='Bug'
               :Message='$route.params.project_title'
            ></PageHeader>
        
            <div class="section-container" >
                <div class="emptyBugs" v-if="Bugs.length === 0">
                    NO BUGS Here
                </div>
                <div class = "item section-content" v-if="!popUp" v-for="section in alt_allDates" >
                    <div class ="section-header">
                        <div class="section-header-content">
                            <div class="month">{{section.date.day}}</div>
                            <div class="date">{{section.date.date}} {{section.date.month}} {{ section.date.year}}</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="section-body-content">
                            <BugCard  @expand-popup ="expandPOPUP($event)" v-for="bug in section.data" :key="bug.id" :Bug="bug"></BugCard>
                        </div>  
                    </div>
                </div>
            </div>
            <div class=" add-button" v-if="!popUp" >
                <div class="add-button-content">
                    <button class="ADDbutton" @click="expandPOPUP(null)">
                    <b>+</b>
                    </button>
                </div>
            </div>
            <div class="pop-up" v-if="popUp">
                <BugForm :Bug="itemPOPup" @close-popup="closePOPUP" @getdata="getDataAgain"></BugForm>
            </div>
        </div>
    </div>
</template>

<script>
import BugCard from '../Includes/BugCard.vue'
import BugForm from '../Includes/BugForm.vue'
export default {

    data() {
        return {
            Bugs : [ ] ,
            editMode: false,
            popUp: false,
            itemPOPup : {},
            //projectID: Number()
        }
    },
    components:{
        BugCard,
        BugForm
    },
    methods: {
        getDatevalues(item){
             let D = new Date(item)
                let days=['Sunday', 'Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday']
                let months = ['January','February','March','April','May','June','July','August','September','October','November','December']
                let day_date = days[D.getDay()]
                let month_date = months[D.getMonth()]
                let date_date= D.getDate()
                let year_date = D.getFullYear()

                let dateValues = {
                    day : day_date,
                    month : month_date,
                    date : date_date,
                    year : year_date
                }
            return dateValues;
        },

        filterbyId(id){
            let item = this.Bugs.filter(element => element.id == id)
            this.itemPOPup = item[0] 
        },

        getDataAgain(){
            fetch('api/project/'+this.$route.params.id+'/bug')
            .then((response)=>{
                return response.json();
            })
            .then((data)=>{
                this.Bugs = data.data//this.Bugs.concat(data.data)
                console.log('data has been gotten')
            })
        },
        
        expandPOPUP(id=null){
            this.popUp = true;
            //console.log('this is the id ' + id)
            if(id === null){
                this.itemPOPup = null
                console.log('id is null')

            }else{
               this.filterbyId(id);  
            }
        },
        closePOPUP(){
            this.popUp = false;
        },
        checkDateEqual(dateOne,dateTwo){
            let date1 = new Date(dateOne)
            let date2 = new Date(dateTwo)
            
            if (date1.getDate() === date2.getDate() 
            && date1.getMonth() === date2.getMonth()
            && date1.getFullYear() === date2.getFullYear()
            ) {
                return true
            }else{
                return false
            }
        }
    },
    mounted(){
        // fetch('api/project/'+this.$route.params.id+'/bug')
        // .then((response)=>{
        //     return response.json();
        // })
        // .then((data)=>{
        //     this.Bugs = data.data//this.Bugs.concat(data.data)
        //     console.log('data has been gotten')
        // })
        this.getDataAgain()
    },
    computed: {
        allDates(){
            let dates = []
            this.Bugs.forEach(element => {
                if(element === null){
                    return " "
                }
               let ourdate = this.getDatevalues(element.created_at)
                if(
                    !dates.some(element =>{
                        if(element.day === ourdate.day && element.month === ourdate.month && element.date === ourdate.date && element.year === ourdate.year){
                            return true
                        }else{
                            return false    
                        }    
                    })   
                ){
                     dates.push(ourdate)
                }       
            });
            return dates
        },
        alt_allDates(){
            let create_index = 0;
            let dataBydate = []
            let Datesofitems = []

            /*sortingdate*/

            try {
            this.Bugs.forEach(element => {
                let inputIndex = Datesofitems.findIndex(item => this.checkDateEqual(item,element.created_at))
            
                if(inputIndex === -1 || dataBydate.length === 0 || Datesofitems.length === 0){
                    dataBydate[create_index] = {
                        date: this.getDatevalues(element.created_at),
                        data:[]
                    }
                    Datesofitems.push(element.created_at)
                    dataBydate[create_index].data.push(element)
                    create_index++
                }else{
                    dataBydate[inputIndex].data.push(element)
                }
                    
            });    
            } catch (error) {
               console.log(error) 
            }
            
            
            
            return dataBydate
        },
        sortAllByDate(){
            let allitems = [];
            this.allDates.forEach(item => {
                let dateitems = {
                    date : item,
                    data:[]
                }
                dateitems.data = this.Bugs.filter(element => {
                    let itemdate = this.getDatevalues(element.created_at)
                    if(item.day === itemdate.day && item.month === itemdate.month && item.date === itemdate.date && item.year === itemdate.year){
                            return true
                        }else{
                            return false    
                    }  
                });
                allitems.push(dateitems)
            });
            return allitems
        }
    },
}
</script>

<style scoped>
   .item{
       color: white;
   }
   .section-container{
       margin: 50px 0px 0px
   }
   .section-content{
       margin-bottom: 40px;
   }
   .section-body-content{
       margin: 30px 0px 0px;
       display: flex;
       flex-direction: row;
       flex-wrap: nowrap;
       overflow-x:scroll; 
       overflow-y: hidden;
       
   }
   .month{
       font-size: 2rem;
   }
   .date{
       font-size: 1.1rem;
   }
   /*.section-body-content::-webkit-scrollbar{
       display: none;
   }*/

   .emptyBugs{
       font-size: 5rem;
       text-align: center;
       color: white;
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
    

    .Open-bg{
        background:#29DF5C;
    }
    .Closed-bg{
        background:#DF2935
    }
    .Processing-bg{
        background:#29BEDF ;
    }
</style>