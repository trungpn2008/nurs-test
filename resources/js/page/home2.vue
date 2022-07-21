<template>
    <div class="content">
        <laraberg-editor v-model="html"/>
    </div>
</template>
<script>

export default {
    name: "Home2",
    components:{
    },
    data: () => ({
        LaravelFilemanager:true,
        html: `
        <!-- wp:heading -->
        <h2>Welcome</h2>
            <!-- /wp:heading -->
        `
	}),
}
</script>

<style scoped>

</style>
