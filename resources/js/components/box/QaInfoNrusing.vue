<template>
    <div class="qa-nursing-home">
        <div class="list-qa-nursing">
            <b-container fluid>
                <b-row>
                    <b-col cols="12" sm="4" v-for="item of listQa"><a :href="item.href"><p>{{ item.text }}</p></a>
                    </b-col>
                </b-row>
            </b-container>
        </div>
    </div>
</template>

<script>
export default {
    name: "QaInfoNrusing",
    data() {
        return {
            listQa: [
                {
                    text: '老人ホームの種類について',
                    href: '#'
                },
                {
                    text: '介護付き有料老人ホーム ',
                    href: '#'
                },
                {
                    text: '住宅型有料老人ホーム',
                    href: '#'
                },
                {
                    text: 'サービス付き高齢者向け住宅',
                    href: '#'
                },
                {
                    text: 'グループホーム',
                    href: '#'
                },
                {
                    text: 'ケアハウス',
                    href: '#'
                },
                {
                    text: '特別養護老人ホーム',
                    href: '#'
                },
                {
                    text: '介護老人保健施設',
                    href: '#'
                },
                {
                    text: '介護医療院',
                    href: '#'
                },
            ],
        }
    }
}
</script>

<style scoped>

</style>
