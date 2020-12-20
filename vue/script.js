Vue.component('comments',{
    template:'#comment-template',
    props:['comment'],
    data: function(){
        return{
            plus:false,
            minus:false
        }
    },
    methods:{
        add:function(){
            this.plus=!this.plus
            this.minus=false
        },
        decrease:function(){
            this.plus=false
            this.minus=!this.minus
        }
    },
    computed:{
        score:function(){
            if(this.plus){
                return this.comment.score +1
            }else if(this.minus){
                return this.comment.score -1
            }else
                return this.comment.score
        }
    }
})
let vm = new Vue({
    el:'#app',
    data:{
        comments:[
            {content:'komentar 1' ,time:'tgl 20/12/2020, jam 7:28', score:0},
            {content:'komentar 2' ,time:'21/12/2020, jam 10:59', score:5},
            {content:'komentar 3' ,time:'22/12/2020, jam 11:20', score:5}
        ],
        commentPost:''
    },

    methods:{
        postComment: function(){
            let today = new Date();
            let date = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
            let time = today.getHours() + ":" + today.getMinutes();
            const dateTime = 'tgl '+date +', '+ 'jam '+ time

            this.comments.push(
                {content:this.commentPost ,time:dateTime, score:0}
            ),
            this.commentPost=''
        }
    }
})