@extends('admin.layouts.default')

@section('title')
    {{ __('titles.add_new_course') }}
@endsection

@section('inline_styles')
    <!-- page css -->
    <link href="{{ asset('assets/admin/vendor/selectize/dist/css/selectize.default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/summernote/dist/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
          rel="stylesheet">
    <style>
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            /* display: flex; */
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow: auto;
        }

        .preview-images-zone > .preview-image:first-child {
            height: 185px;
            width: 250px;
            position: relative;
            margin-right: 5px;
        }

        .preview-images-zone > .preview-image {
            height: 185px;
            width: 250px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }

        .preview-images-zone > .preview-image > .image-zone {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone > .preview-image > .image-zone > img {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone > .preview-image > .tools-edit-image {
            position: absolute;
            z-index: 100;
            color: #fff;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
            display: none;
        }

        .preview-images-zone > .preview-image > .image-cancel {
            font-size: 18px;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            display: none;
            z-index: 100;
        }

        .preview-image:hover > .image-zone {
            cursor: move;
            opacity: .5;
        }

        .preview-image:hover > .tools-edit-image,
        .preview-image:hover > .image-cancel {
            display: block;
        }

        .ui-sortable-helper {
            width: 90px !important;
            height: 90px !important;
        }

        .container {
            padding-top: 50px;
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">Add new permission</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="#" class="breadcrumb-item"><i class="ti-home p-r-5"></i>Home</a>
                        <a class="breadcrumb-item" href="{{ route('instructor.courses.index') }}">Courses</a>
                        <span class="breadcrumb-item active">Add new course</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header border bottom">
                    <h4 class="card-title">Add new course</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <p>Please input <code> course information </code> and <code> wait for admin approve </code>
                        for create new course.</p>
                    @include('flash::message')
                    <form action="{{ route('instructor.courses.store') }}" method="post">
                        @csrf
                        <div class="row m-t-30">
                            <div class="col-md-4">
                                <div class="p-h-10">
                                    <div class="form-group">
                                        <label class="control-label" for="input-course-title">Course Title *</label>
                                        <input type="text" class="form-control" id="input-course-title"
                                               name="title" placeholder="Course Title ...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-course-parent-category">Select Parent
                                        Category *</label>
                                    <select class="form-control" id="input-course-parent-category">
                                        <option disabled="disabled" selected></option>
                                        @foreach($parentCategoryList as $category)
                                            <option value="{{ $category->id }}"> {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-course-category">Select Category *</label>
                                    <select class="form-control" id="input-course-category" name="category_id">
                                        <option disabled="disabled" selected></option>
                                        {{--                                        @foreach($categoryList as $category)--}}
                                        {{--                                            <option value="{{ $category->id }}"> {{ $category->title }}</option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Select Level *</label>
                                    <select class="form-control" id="input-course-level" name="level">
                                        <option disabled="disabled" selected></option>
                                        @for($temp = 1; $temp <= 3; $temp++)
                                            <option value="{{ $temp }}"> {{ $temp }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="text-course-description">Course Description
                                        *</label>
                                    <div class="m-t-15" id="text-course-description">
                                        <div id="summernote-standard"></div>
                                        <input type="hidden" id="input-course-description" name="description">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <fieldset class="form-group">
                                    <label class="control-label" for="button-upload">Upload Course Image <3 images>
                                        *</label><br>
                                    <a href="javascript:void(0)" id="button-upload" onclick="$('#pro-image').click()">Upload
                                        Image</a>
                                    <input type="file" id="pro-image" name="image[]" style="display: none;"
                                           class="form-control" multiple>
                                    <input type="hidden" name="course_avatar" id="input-course-avatar">
                                    <input type="hidden" name="course_avatar_2" id="input-course-avatar-2">
                                    <input type="hidden" name="course_avatar_3" id="input-course-avatar-3">
                                </fieldset>
                                <div class="preview-images-zone">
                                    <div class="preview-image preview-show-1" style="margin-left: 10px">
                                        <div class="image-cancel" data-no="1">x</div>
                                        <div class="image-zone"><img id="pro-img-1"
                                                                     src="{{ asset('images/default_course_avatar/upload_course_1.jpg') }}">
                                        </div>
                                        <div class="tools-edit-image"><a href="javascript:void(0)" data-no="1"
                                                                         class="btn btn-light btn-edit-image">Edit</a>
                                        </div>
                                    </div>
                                    <div class="preview-image preview-show-2" style="margin-left: 30px">
                                        <div class="image-cancel" data-no="2">x</div>
                                        <div class="image-zone"><img id="pro-img-2"
                                                                     src="{{ asset('images/default_course_avatar/upload_course_2.jpg') }}">
                                        </div>
                                        <div class="tools-edit-image"><a href="javascript:void(0)" data-no="2"
                                                                         class="btn btn-light btn-edit-image">Edit</a>
                                        </div>
                                    </div>
                                    <div class="preview-image preview-show-3" style="margin-left: 30px">
                                        <div class="image-cancel" data-no="3">x</div>
                                        <div class="image-zone"><img id="pro-img-3"
                                                                     src="{{ asset('images/default_course_avatar/upload_course_3.jpg') }}">
                                        </div>
                                        <div class="tools-edit-image"><a href="javascript:void(0)" data-no="3"
                                                                         class="btn btn-light btn-edit-image">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="padding-top: 10px">
                                <div class="m-t-15">
                                    <div class="col-md-6" style="float: right;">
                                        <button class="btn btn-default" id="btn-reset" style="display: inline">Reset
                                        </button>
                                    </div>
                                    <div class="col-md-6" style="float: right">
                                        <button class="btn btn-info" id="btn-get-permission" style="display: inline;">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@include('admin.layouts.delete_modal')

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/selectize/dist/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/forms/form-elements.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        var num = 4;
        var flag = 1;

        $(document).ready(function () {
            $('.note-editor').on('mouseout', function () {
                $('#input-course-description').val($('.note-editable ').html());
            })

            $('#btn-reset').on('click', function (event) {
                event.preventDefault();
                $('#input-course-title').val('');
                $('#input-course-level').prop('selectedIndex', 0);
                $('#input-course-level').prop('selectedIndex', 0);
            })
            document.getElementById('pro-image').addEventListener('change', readImage, false);

            $(".preview-images-zone").sortable();

            $(document).on('click', '.image-cancel', function () {
                let no = $(this).data('no');
                $(".preview-image.preview-show-" + no).remove();
                flag = flag - 1;
                num = num - 1;
            });

            $('#note-editing-area').mouseleave(function () {
                $('#input-course-description').val($('#summernote').summernote('code'));
            });

            $('#input-course-parent-category').on('change', function () {
                // console.log($(this).val());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/categories/' + $(this).val() + '/getSubCategoryList',
                    type: 'post',
                    success: function (response) {
                        var responseData = jQuery.parseJSON(response);
                        $('#input-course-category').empty();
                        responseData.forEach(function (element) {
                            $('#input-course-category').append(new Option(element.title, element.id));
                        })
                    }
                });
            })
        })

        function readImage() {
            if (window.File && window.FileList && window.FileReader) {
                var files = event.target.files; //FileList object
                var output = $(".preview-images-zone");

                for (let i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (!file.type.match('image')) continue;

                    var picReader = new FileReader();

                    picReader.addEventListener('load', function (event) {
                        if (flag < 4) {
                            $(".preview-image.preview-show-" + flag).remove();
                            var picFile = event.target;
                            var margin_left = '';
                            if (flag == 1) {
                                margin_left = '10px';
                            } else if (flag == 2) {
                                margin_left = '30px';
                            } else if (flag == 3) {
                                margin_left = '30px';
                            }
                            style = "margin-left: 10px";
                            var html = '<div class="preview-image preview-show-' + num + '" style="margin-left: ' + margin_left + ';">' +
                                '<div class="image-cancel" data-no="' + num + '">x</div>' +
                                '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                                '<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num + '" class="btn btn-light btn-edit-image">Edit</a></div>' +
                                '</div>';

                            if (flag == 1) {
                                output.prepend(html);
                            } else if (flag == 2) {
                                $('.preview-show-' + (num - 1)).after(html);
                            } else if (flag == 3) {
                                output.append(html);
                            }
                            num = num + 1;
                            flag = flag + 1;
                        } else {
                            alert('Max upload image count is 3 !')
                        }

                    });

                    picReader.readAsDataURL(file);
                }
                // $("#pro-image").val('');
            } else {
                console.log('Browser not support');
            }
        }

    </script>
@endsection