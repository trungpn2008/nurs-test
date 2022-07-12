const routers = [
    {
        path: '/',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/home.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/home',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/home2.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/home2',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/home3.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/guideline',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/guidelines.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/terms-of-use',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/GeneralTermsofUse.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/community-policy',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/CommunityPolicy.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/privacy-policy',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/PrivacyPolicy.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/register',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/Register.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
];
export default routers;
