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
    {
        path: '/board-posting',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/BoardPosting.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/profile',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/profile.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/user-page',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/UserPage.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/info-user',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/InfoUser.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/inquiry',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/Inquiry.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/faq',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/Faq.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/logout',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/logout.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/hashtag',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/hashtag.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/q-a',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/QuestionsAndAnswers.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/notice',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/notice.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/notice-holiday',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/NoticeHoliday.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/post-confirm',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/PostConfirm.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/post-complete',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/PostComplete.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/home-nursing',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/homenursing.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/detail-question',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/detailQuestion.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/manager-intro',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/ManagerIntroduction.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
];
export default routers;
