<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">Image</span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">logo</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>


    <div class="menu-divider mt-0  ">
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="/admin/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Bảng điều khiển">Bảng điều khiển</div>
            </a>
        </li>
        <!-- News -->
        @if(isset($perms['News']) || $super == 1)
            <li class="menu-item" data-nav="News">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Tin tức">Tin tức</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('news.index',isset($perms['News'])?$perms['News']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.news.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('news.add',isset($perms['News'])?$perms['News']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.news.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
    <!-- Category -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Danh mục</span></li>
        @if(isset($perms['Category']) || $super == 1)
            <li class="menu-item" data-nav="Category">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Danh mục">Danh mục</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('category.index',isset($perms['Category'])?$perms['Category']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.category.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('category.add',isset($perms['Category'])?$perms['Category']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.category.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['CategoryType']) || $super == 1)
            <li class="menu-item" data-nav="CategoryType">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Category Type">Loại danh mục</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('categorytype.index',isset($perms['CategoryType'])?$perms['CategoryType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.categorytype.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('categorytype.add',isset($perms['CategoryType'])?$perms['CategoryType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.categorytype.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Dự án</span></li>
        @if(isset($perms['Projects']) || $super == 1)
            <li class="menu-item" data-nav="Projects">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Dự án">Dự án</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('projects.index',isset($perms['Projects'])?$perms['Projects']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.projects.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('projects.add',isset($perms['Projects'])?$perms['Projects']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.projects.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Tuyển dụng & Ứng tuyển</span></li>
        @if(isset($perms['Recruitment']) || $super == 1)
            <li class="menu-item" data-nav="Recruitment">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Tuyển dụng">Tuyển dụng</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('recruitment.index',isset($perms['Recruitment'])?$perms['Recruitment']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.recruitment.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('recruitment.add',isset($perms['Recruitment'])?$perms['Recruitment']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.recruitment.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['Applies']) || $super == 1)
            <li class="menu-item" data-nav="Applies">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Ứng tuyển">Ứng tuyển</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('applies.index',isset($perms['Applies'])?$perms['Applies']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.applies.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Liên hệ</span></li>
        @if(isset($perms['Contacts']) || $super == 1)
            <li class="menu-item" data-nav="Contacts">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Liên hệ">Liên hệ</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('contacts.index',isset($perms['Contacts'])?$perms['Contacts']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.contacts.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Hình ảnh</span></li>
        @if(isset($perms['Images']) || $super == 1)
            <li class="menu-item" data-nav="Images">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Banner">Banner</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('images.index',isset($perms['Images'])?$perms['Images']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.images.index',['type'=>'banner'])}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('images.add',isset($perms['Images'])?$perms['Images']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.images.add',['type'=>'banner'])}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['Partner']) || $super == 1)
            <li class="menu-item" data-nav="Partner" style="display:none;">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Đối tác">Đối tác</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('partner.index',isset($perms['Partner'])?$perms['Partner']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.partner.index').'?type=partner'}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('partner.add',isset($perms['Partner'])?$perms['Partner']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.partner.add').'?type=partner'}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['BlueprintType']) || $super == 1)
            <li class="menu-item" data-nav="BlueprintType">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Loại ảnh">Loại ảnh </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('blueprinttype.index',isset($perms['BlueprintType'])?$perms['BlueprintType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.blueprinttype.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('blueprinttype.add',isset($perms['BlueprintType'])?$perms['BlueprintType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.blueprinttype.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Faq</span></li>
        @if(isset($perms['Faqs']) || $super == 1)
            <li class="menu-item" data-nav="Faqs">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Faqs">Faqs </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('faqs.index',isset($perms['Faqs'])?$perms['Faqs']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.faqs.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('faqs.add',isset($perms['Faqs'])?$perms['Faqs']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.faqs.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['FaqCategories']) || $super == 1)
            <li class="menu-item" data-nav="FaqCategories">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Faq Category">Faq Category</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('faqcates.index',isset($perms['FaqCategories'])?$perms['FaqCategories']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.faqcates.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('faqcates.add',isset($perms['FaqCategories'])?$perms['FaqCategories']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.faqcates.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
<li class="menu-header small text-uppercase"><span class="menu-header-text">Term And Condition</span></li>
        @if(isset($perms['TermAndCondition']) || $super == 1)
            <li class="menu-item" data-nav="TermAndCondition">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Term And Condition">Term And Condition </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('term-and-condition.index',isset($perms['TermAndCondition'])?$perms['TermAndCondition']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.term-and-condition.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('term-and-condition.add',isset($perms['TermAndCondition'])?$perms['TermAndCondition']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.term-and-condition.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['TermAndConditionCategories']) || $super == 1)
            <li class="menu-item" data-nav="TermAndConditionCategories">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Term And Condition Category">Term And Condition Category</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('term-and-condition-category.index',isset($perms['TermAndConditionCategories'])?$perms['TermAndConditionCategories']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.term-and-condition-category.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('term-and-condition-category.add',isset($perms['TermAndConditionCategories'])?$perms['TermAndConditionCategories']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.term-and-condition-category.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Customer</span></li>
        @if(isset($perms['Customer']) || $super == 1)
            <li class="menu-item" data-nav="Customer">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Customer">Customer </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('customer.index',isset($perms['Customer'])?$perms['Customer']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.customer.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
{{--                    @if(in_array('choose-profile-category.add',isset($perms['ChooseProfileCategory'])?$perms['ChooseProfileCategory']:[]) || $super == 1)--}}
{{--                        <li class="menu-item" data-sub="add">--}}
{{--                            <a href="{{route('admin.choose-profile-category.add')}}" class="menu-link">--}}
{{--                                <div data-i18n="Thêm mới">Thêm mới</div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                </ul>
            </li>
        @endif
        @if(isset($perms['ChooseProfileCategory']) || $super == 1)
            <li class="menu-item" data-nav="ChooseProfileCategory">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Choose Profile Category">Choose Profile Category </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('choose-profile-category.index',isset($perms['ChooseProfileCategory'])?$perms['ChooseProfileCategory']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.choose-profile-category.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('choose-profile-category.add',isset($perms['ChooseProfileCategory'])?$perms['ChooseProfileCategory']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.choose-profile-category.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['ListProfileOption']) || $super == 1)
            <li class="menu-item" data-nav="ListProfileOption">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="List Profile Option">List Profile Option </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('list-profile-option.index',isset($perms['ListProfileOption'])?$perms['ListProfileOption']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.list-profile-option.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('list-profile-option.add',isset($perms['ListProfileOption'])?$perms['ListProfileOption']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.list-profile-option.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        <li class="menu-header small text-uppercase"><span class="menu-header-text">QA</span></li>
        @if(isset($perms['QA']) || $super == 1)
            <li class="menu-item" data-nav="QA">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="QA">QA </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('qa.index',isset($perms['QA'])?$perms['QA']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.qa.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('qa.add',isset($perms['QA'])?$perms['QA']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.qa.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['QAType']) || $super == 1)
            <li class="menu-item" data-nav="QAType">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="QA Type">QA Type</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('qa-type.index',isset($perms['QAType'])?$perms['QAType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.qa-type.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('qa-type.add',isset($perms['QAType'])?$perms['QAType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.qa-type.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['QACate']) || $super == 1)
            <li class="menu-item" data-nav="QACate">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="QA Cate">QA Cate</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('qa-cate.index',isset($perms['QACate'])?$perms['QACate']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.qa-cate.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('qa-cate.add',isset($perms['QACate'])?$perms['QACate']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.qa-cate.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(isset($perms['QAAnswer']) || $super == 1)
            <li class="menu-item" data-nav="QAAnswer">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="QA Answer">QA Answer</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('qa-answer.index',isset($perms['QAAnswer'])?$perms['QAAnswer']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.qa-answer.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('qa-answer.add',isset($perms['QAAnswer'])?$perms['QAAnswer']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.qa-answer.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Investigation</span></li>
        @if(isset($perms['Investigation']) || $super == 1)
            <li class="menu-item" data-nav="Investigation">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Investigation">Investigation </div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('investigation.index',isset($perms['Investigation'])?$perms['Investigation']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.investigation.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
{{--                    @if(in_array('faqs.add',isset($perms['Faqs'])?$perms['Faqs']:[]) || $super == 1)--}}
{{--                        <li class="menu-item" data-sub="add">--}}
{{--                            <a href="{{route('admin.faqs.add')}}" class="menu-link">--}}
{{--                                <div data-i18n="Thêm mới">Thêm mới</div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                </ul>
            </li>
        @endif
        @if(isset($perms['InvestigationType']) || $super == 1)
            <li class="menu-item" data-nav="InvestigationType">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Investigation Type">Investigation Type</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('investigation-type.index',isset($perms['InvestigationType'])?$perms['InvestigationType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index">
                            <a href="{{route('admin.investigation-type.index')}}" class="menu-link">
                                <div data-i18n="Danh sách">Danh sách</div>
                            </a>
                        </li>
                    @endif
                    @if(in_array('investigation-type.add',isset($perms['InvestigationType'])?$perms['InvestigationType']:[]) || $super == 1)
                        <li class="menu-item" data-sub="add">
                            <a href="{{route('admin.investigation-type.add')}}" class="menu-link">
                                <div data-i18n="Thêm mới">Thêm mới</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if($super == 1)
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Roles & Permission</span></li>
            <li class="menu-item" data-nav="Roles">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Role & Permission">Role & Permission</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item" data-sub="role">
                        <a href="{{route('admin.roles.index')}}" class="menu-link">
                            <div data-i18n="Roles list">Roles list</div>
                        </a>
                    </li>
                    <li class="menu-item" data-sub="permission">
                        <a href="{{route('admin.permission.index')}}" class="menu-link">
                            <div data-i18n="Permissions list">Permissions list</div>
                        </a>
                    </li>
                    <li class="menu-item" data-sub="option">
                        <a href="{{route('admin.option.index')}}" class="menu-link">
                            <div data-i18n="Option Permissions list">Option Permissions list</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if(isset($perms['Config']) || $super == 1)
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Cài đặt</span></li>
            <li class="menu-item" data-nav="Config">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Cài đặt">Cài đặt</div>
                </a>
                <ul class="menu-sub">
                    @if(in_array('config.edit',isset($perms['Config'])?$perms['Config']:[]) || $super == 1)
                        <li class="menu-item" data-sub="index-general">
                            <a href="{{route('admin.config.editHome').'/config-general'}}" class="menu-link">
                                <div data-i18n="Chung">Chung</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
    </ul>



</aside>
