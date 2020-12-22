<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="app">
        <form action="">
            <input type="text" v-model="list.name">
            <button v-show="!updateButtonSubmit" @click.prevent="add" >add</button>
            <button v-show="updateButtonSubmit" @click.prevent="update">update</button>
        </form>
        <ul v-for="(user,index) in users">
            <li>
                <span>@{{user.name}}</span>
                <button @click="edit(user,index)">Edit</button> || <button @click="trash(user,index)">Delete</button>
            </li>
        </ul>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    <script>
        let vm =  new Vue({
            el:'#app',
            data(){
                return {
                    users:[],
                    updateButtonSubmit:false,
                    list:{
                        'name':''
                    },
                    selectId: null,
                    updateName: null,
                }
            },
            methods:{
                getData(){
                    this.$http.get('/api/list').then(response => {
                    let result= response.body.data
                    this.users=result
                }, )
                },
                add(){
                    let input = this.list.name.trim();
                    if(input){
                        // POST /someUrl
                        this.$http.post('/api/list', {name: input}).then(response => {
                            this.users.push(
                                response.body.data
                            )
                        },);
                    }
                    this.list ={ 
                    }
                },
                edit(user,index){
                    this.selectId=user.id,
                    this.updateName=index,
                    this.updateButtonSubmit=true,
                    this.list.name=user.name
                },
                update(){
                    let input = this.list.name;
                        if(input){
                            this.$http.post('/api/list/update/'+this.selectId,{name:input}).then(response => {
                                
                            this.users[this.updateName].name=input
                            this.list={}
                            this.updateButtonSubmit=false
                            this.selectId= null 
                            })
                        }
                    
                },
                trash(user,index){
                    let del =confirm('apakah data akan di hapus ?')
                    this.$http.post('/api/list/delete/'+ user.id).then(response => {
                        if(del){
                            this.users.splice(index,1)
                            this.getData();
                        }
                    })
                }
            },
            mounted(){
                // GET /someUrl
                this.getData();
            }
            
})

    </script>
</body>
</html>