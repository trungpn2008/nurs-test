<template>
    <div class="question-home">
        <div class="text-title">
            <p>よくあるご質問</p>
        </div>
        <p class="text-des">介護なんでも相談室の使い方について、ご利用方法について頂くご質問をおまとめしました。</p>
        <div class="list-question">
            <div class="accordion" role="tablist">
                <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block v-b-toggle.accordion-1 variant="info">Q1. 会員登録は、必須ですか？</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <b-card-text>Q1</b-card-text>
                        </b-card-body>
                    </b-collapse>
                </b-card>

                <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block v-b-toggle.accordion-2 variant="info">Q2. 会員登録や質問は、有料ですか？無料ですか？</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <b-card-text>Q2</b-card-text>
                        </b-card-body>
                    </b-collapse>
                </b-card>

                <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block v-b-toggle.accordion-3 variant="info">Q3. 介護の悩みをどうやって質問ができますか？</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <b-card-text>Q3</b-card-text>
                        </b-card-body>
                    </b-collapse>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "QuestionHome"
}
</script>

<style scoped>

</style>
