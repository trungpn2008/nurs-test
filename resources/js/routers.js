const routers = [
    {
        path: '/',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/home/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'home',
    },
    {
        path: '/homes',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/homes/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'homes',
    },
    {
        path: '/introduction',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/introduction/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'homes',
    },
    {
        path: '/news',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/news/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/faq',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/fqa/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },



    {
        path: '/advice',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/advice/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'advice',
    },
    {
        path: '/community',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/community/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'community',
    },
    {
        path: '/company',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/company/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/confirmation',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/confirmation/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/genaral',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/genaral/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'genaral',
    },
    {
        path: '/qa',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/qa/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/info',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/info/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/inquiry',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/inquiry/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/list',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/list/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/logout',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/logout/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/news_details',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/news_details/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/nursing',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/nursing/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/posting',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/posting/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/privacy',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/privacy/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'privacy',
    },
    {
        path: '/profile',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/profile/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/registration',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/registration/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'register',
    },
    {
        path: '/screen',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/screen/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'screen',
    },
    {
        path: '/transactions',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/transactions/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'transactions',
    },
    {
        path: '/user',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/user/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/login',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/login/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'login',
    },

];
export default routers;
