@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Faqs /</span> Edit
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Sửa Faqs</h5>
        <form id="form-category-type" class="card-body" method="post" action="" enctype="application/x-www-form-urlencoded">
            @csrf
            <h6 class="fw-normal">1. Thông tin cấu hình</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="question">Question <span style="color: red">*</span></label>
                    <input type="text" id="question" name="question" class="form-control" placeholder="Question" value="{{$faqs->question}}" />
                </div>
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="category_faq">Loại danh mục</label>
                        <div class="">
                            <select id="category_faq" name="faq_category_id" class="form-select" data-allow-clear="true">
                                <option value="">Choose category faqs</option>
                                @if($faqs->faq_category_id)
                                    <option value="{{$faqs->faq_category_id}}" selected="selected">{{$faqs->title}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="answer">Answer <span style="color: red">*</span></label>
                    <textarea name="answer" id="answer"  class="form-control" placeholder="Nội dung bài viết" cols="30" rows="10" hidden>{{$faqs->answer}}</textarea>
                </div>
            </div>
            <hr class="my-4 mx-n4" />
            <div class="pt-4">
                <button type="submit" form="form-category-type" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <a href="{{route('admin.faqs.index')}}" class="btn btn-label-secondary">Back</a>
            </div>
        </form>
    </div>
    </div>
@endsection
@section('javascript')
    <script src="/libs/cleavejs/cleave.js"></script>
<script src="/libs/cleavejs/cleave-phone.js"></script>
<script src="/libs/moment/moment.js"></script>
<script src="/libs/flatpickr/flatpickr.js"></script>
    <script src="/libs/select2/select2.js"></script>
    <script src="/js/form-layouts.js"></script>
    <script src="/js/ckfinder/ckfinder.js"></script>
    <script src="/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
    <script>
        const mediaUpload = ({filesList, onFileChange}) => {
            setTimeout(() => {
                const uploadedFiles = Array.from(filesList).map(file => {
                    return {
                        id: file.name,
                        name: file.name,
                        url: `https://dummyimage.com/600x400/000/fff&text=${file.name}`
                    }
                })
                onFileChange(uploadedFiles)
            }, 1000)
        }
        Laraberg.init('answer',{ mediaUpload })
        $(document).ready(function () {
            get_category_faqs({
                object: '#category_faq',
                url: '{{ route("admin.faqs.ajax-get-category-faq")}}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Choose category faqs'
            });

            function get_category_faqs(options) {
                $(options.object).select2({
                    ajax: {
                        url: options.url,
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                keyword: params.term,
                            }
                            return query;
                        },
                        processResults: function (json, params) {
                            var results = [{
                                id: '',
                                text: options.title_default
                            }];

                            for (i in json.data) {
                                var item = json.data[i];
                                results.push({
                                    id: item[options.data_id],
                                    text: item[options.data_text]
                                });
                            }
                            return {
                                results: results,
                            };
                        },
                        minimumInputLength: 3,
                    }
                });
            }
        })
        const formCategoryType = document.querySelector('#form-category-type');

        document.addEventListener('DOMContentLoaded', function (e) {
            (function () {
                // Form validation for Add new record
                if (formCategoryType) {
                    const fv = FormValidation.formValidation(formCategoryType, {
                        fields: {
                            question: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter question'
                                    },
                                    stringLength: {
                                        min: 3,
                                        max:255,
                                        message: 'The title must be more than 3 and less than 255 characters long'
                                    }
                                }
                            },
                            answer: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter answer'
                                    },
                                    stringLength: {
                                        min: 3,
                                        max:255,
                                        message: 'The code must be more than 3 and less than 255 characters lon'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                // Use this for enabling/changing valid/invalid class
                                // eleInvalidClass: '',
                                eleValidClass: '',
                                rowSelector: function (field, ele) {
                                    // field is the field name & ele is the field element
                                    switch (field) {
                                        case 'question':
                                        case 'answer':
                                        default:
                                            return '.row';
                                    }
                                }
                            }),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            // Submit the form when all fields are valid
                            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                            autoFocus: new FormValidation.plugins.AutoFocus()
                        },
                        init: instance => {
                            instance.on('plugins.message.placed', function (e) {
                                //* Move the error message out of the `input-group` element
                                if (e.element.parentElement.classList.contains('input-group')) {
                                    // `e.field`: The field name
                                    // `e.messageElement`: The message element
                                    // `e.element`: The field element
                                    e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                                }
                                //* Move the error message out of the `row` element for custom-options
                                if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                                    e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                                }
                            });
                        }
                    });
                }
            })();
        });
        sidebarMenu('$STUDLY_NAME$', 'index');
    </script>
@endsection=
