const routers = [
    {
        path: '/',
        components: {
            header:()=> import('./layouts/header.vue'),
            footer:()=> import('./layouts/footer/footer.vue'),
        },
        name: 'pc-top1',
    },

];
export default routers;
