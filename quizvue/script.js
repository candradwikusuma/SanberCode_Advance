let vm = new Vue({
    el:'#app',
    data(){
        return {
            users:[
                {'name':'candra dwi kusuma'},
                {'name':'fajrin'},
                {'name':'faqih'},
                
            ],
            updateButtonSubmit:false,
            list:{
                'name':''
            },
            selectId: ''
        }
    },
    methods:{
        add(){
            this.users.push(
                this.list
            )
            this.list ={

            }
        },
        edit(user,index){
            this.selectId=index,
            this.updateButtonSubmit=true,
            this.list.name=user.name
        },
        update(){
            this.users[this.selectId].name=this.list.name,
            this.list={},
            this.updateButtonSubmit=false,
            this.selectId= ''
        },
        trash(index){
            let del =confirm('apakah data akan di hapus ?')

            if(del){
                this.users.splice(index,1)
            }
        }
    }
    

})