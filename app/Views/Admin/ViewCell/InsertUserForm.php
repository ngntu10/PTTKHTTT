<div class="form-container">
    <div class="insert-student-form insert-user-form">
        <div class="insert-student-form__title-section">
            <h5 class="insert-student-form__title">Tạo mới user</h5>
        </div>

        <div class="grid-2-column user-form__input-container">
            <div class="center-div">
                <div class="uploaded-ava-container">
                    <img class="uploaded-ava" src="<?php base_url() ?>/assets/img/avatar_blank.jpg" alt="">
                    <input id="fileInput" class="file-upload-input" type="file">
                    <label for="fileInput" class="custom-file-input img-input"><i class="fa-solid fa-upload"></i></label>
                </div>
            </div>
            <div style="min-width: 210px;">
                <span>Tài khoản</span> <br>
                <input class="account-field" type="text" autocomplete="off"> <br>
                <span>Vai trò</span> <br>
                <select name="" id="" class="role-cbb">
                    <option value="0">Adminstrator</option>
                    <option value="1">Giảng viên</option>
                    <option value="2">Học viên</option>
                </select>
            </div>
            <div style="min-width: 210px;">
                <span>Mật khẩu</span>
                <br>
                <input class="password-field" type="password" autocomplete="new-password"> <br>
                <span>Nhập lại mật khẩu</span><br>
                <input class="confirmed-password-field" type="password" autocomplete="off"> <br>
            </div>
        </div>

        <div class="upload-avatar-btn-container">

        </div>

        <div class="insert-lecturer-form__search-bar-container">
            <input style="border-radius: 0; height: 30px; width: 90px; z-index: 3" type="text" class="w-25 form-control search-lecturer-input" placeholder="Tìm kiếm">
            <button class="btn btn-info search-lecturer-button highlight-button"><i class="fas fa-search icon-search highlight-icon" style=""></i></button>
        </div>

        <div class="insert-student-form__students-table-container">
            <table class="insert-student-form__students-table table-list">
                <thead>
                    <tr>
                        <td>Mã admin</td>
                        <td>Họ tên</td>
                        <td>Email</td>
                        <td>Chọn</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="insert-student-form__btn-container">
            <button class="insert-student-form__cancel-btn insert-user-form__cancel-btn">Hủy</button>
            <button class="insert-student-form__save-btn insert-user-form__save-btn">Lưu thông tin</button>
        </div>
    </div>
    <script>
        function uploadingNoti(message, type) {
            if (type) {
                $(`.upload-avatar-btn-container`).prepend(`
                <span class="upload-file-noti upload-file-noti--success">${message}</span>
            `);
                // $(`#filename-display`).text(`Chưa tệp nào được chọn`);
                // $(`.file-upload-input`).val(``);
            } else {
                $(`.upload-avatar-btn-container`).prepend(`
                <span class="upload-file-noti upload-file-noti--error">${message}</span>
            `);
            }
            setTimeout(function() {
                $(`.upload-file-noti`).css(`opacity`, 0);
            }, 3000);
            setTimeout(function() {
                $(`.upload-file-noti`).remove();
            }, 4000);
        }
        $(document).ready(function() {
            $(`.insert-user-form__save-btn`).click(function() {
                if (!confirm("Xác nhận tạo mới user?")) {
                    return;
                }

                let account = $(`.account-field`).val();
                let password = $(`.password-field`).val();
                let confirmed_password = $(`.confirmed-password-field`).val();
                let role = $(`.role-cbb`).val();
                let cb = $(".group-checkbox:checked:first");
                if (cb.length == 0) {
                    uploadingNoti("Hãy chọn giảng viên, học viên hoặc admin", false);
                    return;
                }
                let id_role = cb.val();

                // console.log( $(".group-checkbox").length + "lenght");
                // let id_role = 2;
                let fileList = $(".file-upload-input").prop("files");

                if (password != confirmed_password) {
                    uploadingNoti("Mật khẩu xác nhận không khớp", false);
                    return;
                }

                if (account == '') {
                    uploadingNoti("Vui lòng nhập tài khoản", false);
                    return;
                }
                if (password == '') {
                    uploadingNoti("Vui lòng nhập mật khẩu", false);
                    return;
                }
                
                if (account.length < 8 || account.length > 20) {
                    uploadingNoti("Tài khoản có từ 8-20 ký tự", false);
                    return;
                }
                if (password.length < 8 || password.length > 20) {
                    uploadingNoti("Mật khẩu có từ 8-20 ký tự", false);
                    return;
                }
                var file = null;
                if (fileList.length > 0) {
                    file = fileList[0];
                    if (file.size / (1024 * 1024) > 50) {
                    uploadingNoti("Độ lớn file không vượt quá 50MB", false);
                    return;
                }
                }
                


                var formData = new FormData();
                formData.append('file', file);
                formData.append('account', account);
                formData.append('password', password);
                formData.append('role', role);
                formData.append('id_role', id_role);
                console.log(id_role + "id role");
                console.log(role);
                loadingEffect(true);
                $.ajax({
                    url: '<?php echo base_url(); ?>/Admin/CoursesController/insertUser',
                    method: 'POST',
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        loadingEffect(false);
                        reloadUssers();
                        $(`.form-container`).remove();
                        if (response.state) {
                            toast({
                            title: `Thành công!`,
                            message: `Thêm user mới thành công`,
                            type: "success",
                            duration: 100000
                        });
                        } else {
                            toast({
                            title: `Đã có lỗi xảy ra!`,
                            message: response.message,
                            type: "error",
                            duration: 100000
                        });
                        }
                        
                        console.log(response);
                    },
                    error: function(response) {
                        loadingEffect(false);
                        toast({
                            title: `Lỗi!`,
                            message: response.message,
                            type: "error",
                            duration: 100000
                        });
                    }
                })
            })
            loadingEffect(true);
            $(`.table-list`).empty();
            $(`.table-list`).append(`<thead style="top: -1px;">
                    <tr>
                        <td>Mã admin</td>
                        <td>Họ tên</td>
                        <td>Email</td>
                        <td>Chọn</td>
                    </tr>
                </thead>
                <tbody></tbody>
                `);
            loadingEffect(true);
            // lấy admin
            $.ajax({
                url: '<?php echo base_url(); ?>/Admin/CoursesController/getListOfAdmins',
                method: 'POST',
                dataType: "json",
                success: function(response) {
                    loadingEffect(false);
                    console.log(response);
                    for (let ad of response) {
                        $('.table-list tbody').append(`
                                <tr>
                                    <td>${ad.id_ad}</td>
                                    <td>${ad.ho_ten}</td>
                                    <td>${ad.email}</td>
                                    <td>
                                        <input type="checkbox" value="${ad.id_ad}" class="group-checkbox">
                                    </td>
                                </tr>
                                `);
                    }
                }
            });
            $(`.role-cbb`).change(function() {
                let choice = $(`.role-cbb option:selected`).val() * 1;
                if (choice === 0) {
                    $(`.table-list`).empty();
                    $(`.table-list`).append(`<thead style="top: -1px;">
                    <tr>
                        <td>Mã admin</td>
                        <td>Họ tên</td>
                        <td>Email</td>
                        <td>Chọn</td>
                    </tr>
                </thead>
                <tbody></tbody>
                `);
                    loadingEffect(true);
                    // lấy admin
                    $.ajax({
                        url: '<?php echo base_url(); ?>/Admin/CoursesController/getListOfAdmins',
                        method: 'POST',
                        dataType: "json",
                        success: function(response) {
                            loadingEffect(false);
                            console.log(response);
                            for (let ad of response) {
                                $('.table-list tbody').append(`
                                <tr>
                                    <td>${ad.id_ad}</td>
                                    <td>${ad.ho_ten}</td>
                                    <td>${ad.email}</td>
                                    <td>
                                        <input type="checkbox" value="${ad.id_ad}" class="group-checkbox">
                                    </td>
                                </tr>
                                `);
                            }
                        }
                    });
                } else if (choice === 2) {
                    loadingEffect(true);

                    $(`.table-list`).empty();
                    $(`.table-list`).append(`<thead style="top: -1px;">
                    <tr>
                        <td>Mã học viên</td>
                        <td>Họ tên</td>
                        <td>Giới tính</td>
                        <td>Ngày sinh</td>
                        <td>Email</td>
                        <td>Chọn</td>
                    </tr>
                </thead>
                <tbody></tbody>
                `);
                    $.ajax({
                        url: '<?php echo base_url(); ?>/Admin/CoursesController/getListOfStudents',
                        method: 'POST',
                        dataType: "json",
                        success: function(response) {
                            loadingEffect(false);
                            console.log(response);
                            for (let student of response) {
                                $('.table-list tbody').append(`
                                <tr>
                                    <td>${student.id_hoc_vien}</td>
                                    <td>${student.ho_ten}</td>
                                    <td>${student.gioi_tinh == 1 ? "Nam" : "Nữ"}</td>
                                    <td>${student.ngay_sinh}</td>
                                    <td>${student.email}</td>
                                    <td>
                                        <input type="checkbox" value="${student.id_hoc_vien}" class="group-checkbox">
                                    </td>
                                </tr>
                                `);
                            }
                        }
                    });
                } else if (choice === 1) {
                    loadingEffect(true);
                    $(`.table-list`).empty();
                    $(`.table-list`).append(`<thead style="top: -1px;">
                    <tr>
                        <td>Mã giảng viên</td>
                        <td>Họ tên</td>
                        <td>Giới tính</td>
                        <td>Ngày sinh</td>
                        <td>Email</td>
                        <td>Chọn</td>
                    </tr>
                </thead>
                <tbody></tbody>
                `);
                    $.ajax({
                        url: '<?php echo base_url(); ?>/Admin/CoursesController/getListOfLecturers',
                        method: 'POST',
                        dataType: "json",
                        success: function(response) {
                            loadingEffect(false);
                            console.log(response);
                            for (let gv of response) {
                                $('.table-list tbody').append(`
                                <tr>
                                    <td>${gv.id_giang_vien}</td>
                                    <td>${gv.ho_ten}</td>
                                    <td>${gv.gioi_tinh == 1 ? "Nam" : "Nữ"}</td>
                                    <td>${gv.ngay_sinh}</td>
                                    <td>${gv.email}</td>
                                    <td>
                                        <input type="checkbox" value="${gv.id_giang_vien}" class="group-checkbox">
                                    </td>
                                </tr>
                                `);
                            }
                        }
                    });
                }
            })
            $(document).on('change', '.group-checkbox', function() {
                // Uncheck all checkboxes in the group
                $('.group-checkbox').prop('checked', false);
                // Check the one that was clicked
                $(this).prop('checked', true);
            });
            $(`.insert-user-form__cancel-btn`).click(function() {
                if (confirm("Xác nhận hủy bỏ thông tin hiện tại?"))
                    $(`.form-container`).remove();
            })
            $('#fileInput').change(function() {
                // Lấy ra đối tượng input file
                var input = this;

                // Kiểm tra xem người dùng đã chọn file hay chưa
                if (input.files && input.files[0]) {
                    // Tạo đối tượng FileReader để đọc nội dung file
                    var reader = new FileReader();

                    // Lắng nghe sự kiện khi FileReader đã đọc xong file
                    reader.onload = function(e) {
                        // Gán nội dung của file vào thuộc tính src của thẻ img
                        $('.uploaded-ava').attr('src', e.target.result);
                    };

                    // Đọc file như là một đối tượng dữ liệu URL
                    reader.readAsDataURL(input.files[0]);
                }
            });
            console.log("ll")
            $('.account-field').val('');
            $('.password-field').val('');
            $('.confirmed-password-field').val('');
        });
    </script>
</div>