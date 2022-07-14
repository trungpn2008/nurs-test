<template>
    <div class="popular-keywords">
        <p class="title-box c-79684C bd-c-79684C">{{title}}</p>
        <div class="list-popular-keywords">
            <b-row>
                <b-col cols="12" sm="6" v-for="item of listKeywords">
                    <p><a :href="item.href">{{item.name }}</a></p>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
export default {
    name: "PopularKeywords",
    data(){
        return{
            title:"人気キーワード",
            listKeywords:[
                {
                    name:"老人ホーム",
                    href:"#"
                },{
                    name:"費　用",
                    href:"#"
                },{
                    name:"訪　問",
                    href:"#"
                },{
                    name:"通　所",
                    href:"#"
                },{
                    name:"看　護",
                    href:"#"
                },{
                    name:"リハビリ",
                    href:"#"
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
