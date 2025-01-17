<div class="content-section">
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">Thông tin chi tiết
        <div class="component-container">
            <div class="cancel-div cancel-update-class-div">
                <button class="cancel-update-class-btn highlight-button--cancel">
                    <i class="fa-solid fa-x highlight-icon--cancel" style="font-size: 12px!important;"></i>
                </button>
            </div>
            <div style="margin-right: 10px;" class="save-div save-update-class-div">
                <button class="save-update-class-btn highlight-button--save">
                    <i class="fa-solid fa-check highlight-icon--save" style="font-size: 12px!important;"></i>
                </button>
            </div>
            <button class="update-btn highlight-button">
                Điều chỉnh
                <i class="fa-solid fa-pen highlight-icon"></i>
            </button>
        </div>
    </h3>
    <table class="class-infor-table">
        <tbody>
            <tr>
                <td>Mã lớp</td>
                <td><?php echo str_pad($id_lop_hoc, 6, "0", STR_PAD_LEFT) ?></td>
            </tr>
            <tr>
                <td>Mã môn học</td>
                <td><?php echo str_pad($id_mon_hoc, 3, "0", STR_PAD_LEFT) ?></td>
            </tr>
            <tr>
                <td>Tên môn học</td>
                <td><?php echo $ten_mon_hoc ?></td>
            </tr>
            <tr>
                <td>Ngày bắt đầu</td>
                <td><?php echo $ngay_bat_dau ?></td>
            </tr>
            <tr>
                <td>Ngày kết thúc</td>
                <td><?php echo $ngay_ket_thuc ?></td>
            </tr>
            <tr>
                <td>Tổng số buổi</td>
                <td><?php echo $so_luong_buoi_hoc ?></td>
            </tr>
            <tr>
                <td>Số buổi đã học</td>
                <td><?php echo $so_luong_buoi_hoc_da_hoc ?></td>
            </tr>
            <tr>
                <td>SL thành viên</td>
                <td><?php echo $so_luong_hoc_vien ?></td>
            </tr>
            <tr>
                <td>SL giảng viên</td>
                <td><?php echo $so_luong_giang_vien ?></td>
            </tr>
        </tbody>
    </table>
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center;">
        Danh sách giảng viên
        <button class="add-lecturer-btn highlight-button">
            <i class="fa-solid fa-plus add-class-icon highlight-icon"></i>
        </button>
    </h3>
    <div class="list-of-lecturers-container">
        
    </div>
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">
        Danh sách học viên
        <div class="component-container">
            <!-- <div class="cancel-div cancel-update-class-div">
                <button class="cancel-update-class-btn highlight-button--cancel">
                    <i class="fa-solid fa-x highlight-icon--cancel" style="font-size: 12px!important;"></i>
                </button>
            </div>
            <div style="margin-right: 10px;" class="save-div save-update-class-div">
                <button class="save-update-class-btn highlight-button--save">
                    <i class="fa-solid fa-check highlight-icon--save" style="font-size: 12px!important;"></i>
                </button>
            </div> -->
            <button class="delete-student-into-class-btn highlight-button">
                Xóa
                <i class="fa-solid fa-trash-can highlight-icon"></i>
            </button>
            <button class="add-student-into-class-btn highlight-button">
                Thêm
                <i class="fa-solid fa-plus highlight-icon"></i>
            </button>
        </div>
    </h3>
    <table class="students-table">
        <thead>
            <tr>
                <td>Mã học viên</td>
                <td>Họ tên</td>
                <td>Giới tính</td>
                <td>Ngày sinh</td>
                <td>Email</td>
                <td>Số buổi vắng</td>
                <td>
                    <input type="checkbox" class="checkbox-all-students-table">
                </td>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">Danh sách buổi học
        <div class="component-container">
            <div class="cancel-div cancel-update-class-div">
                <button class="cancel-update-class-btn highlight-button--cancel">
                    <i class="fa-solid fa-x highlight-icon--cancel" style="font-size: 12px!important;"></i>
                </button>
            </div>
            <div style="margin-right: 10px;" class="save-div save-update-class-div">
                <button class="save-update-class-btn highlight-button--save">
                    <i class="fa-solid fa-check highlight-icon--save" style="font-size: 12px!important;"></i>
                </button>
            </div>
            <button class="delete-schedule-from-class-btn highlight-button">
                Xóa
                <i class="fa-solid fa-trash-can highlight-icon"></i>
            </button>
            <button class="add-schedule-into-class-btn highlight-button">
                Thêm
                <i class="fa-solid fa-plus highlight-icon"></i>
            </button>
        </div>
    </h3>
    <table class="schedule-table">
        <thead>
            <tr>
                <td>Mã buổi học</td>
                <td>Ngày học</td>
                <td>Phòng</td>
                <td>Giờ bắt đầu</td>
                <td>Giờ kết thúc</td>
                <td>
                    Trạng thái
                </td>
                <td>
                    <input type="checkbox" class="checkbox-all-schedule-table">
                </td>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!-- <script src="<?php echo base_url('assets/script.js'); ?>"></script> -->

<script>
    var id_lop_hoc = $(`.class-infor-table tr`).eq(0).find(`td`).eq(1).text() * 1;
    let listOfSchedule = [];
    let listOfStudents = [];
    function reloadSchedule() {
        loadingEffect(true);
        $.ajax({
            url: `${window.location.protocol}//${window.location.hostname}/Admin/CoursesController/getScheduleListByLCourseId`,
            method: 'GET',
            contentType: "text",
            dataType: "json",
            data: {
                id: id_lop_hoc * 1
            },
            success: function(response) {
                loadingEffect(false);
                listOfSchedule = response;
                $(`.class-infor-table tr`).eq(5).find(`td`).eq(1).text(response.length);
                let schedule_table = $(`.schedule-table tbody`);
                schedule_table.empty();
                let i = 0;
                for (let schedule of listOfSchedule) {
                    let mh = schedule.id_lop_hoc === null ? "--" : `${schedule.ten_mon_hoc} ${schedule.id_mon_hoc.toString().padStart(3, '0')}.${schedule.id_lop_hoc.toString().padStart(6, '0')}`;
                    let state = "";
                    switch (schedule.trang_thai * 1) {
                        case 1:
                            state = "<span style='color: #FFA33C'>Chưa diễn ra</span>";
                            break;
                        case 2:
                            state = "<span style='color: #52ec4d'>Đã hoàn thành</span>";
                            break;
                        case 0:
                            state = "<span style='color: #ff0000'>Trống</span>";
                            break;
                        default:
                            state = "Trường hợp không xác định";
                            break;
                    }
                    let dow = {
                        1: "Chủ Nhật",
                        2: "Thứ Hai",
                        3: "Thứ Ba",
                        4: "Thứ Tư",
                        5: "Thứ Năm",
                        6: "Thứ Sáu",
                        7: "Thứ Bảy"
                    };
                    let thu = dow[schedule['thu']];
                    $state = "";
                    switch (schedule['trang_thai']) {
                        case 1:
                            $state = "<span style='color: #FFA33C'>Chưa diễn ra</span>";
                            break;
                        case 2:
                            $state = "<span style='color: #52ec4d'>Đã hoàn thành</span>";
                            break;
                        case 0:
                            $state = "<span style='color: #ff0000'>Trống</span>";
                            break;
                    }
                    schedule_table.append(`
                        <tr>
                            <td>${schedule.id_buoi_hoc.toString().padStart(10, '0')}</td>
                            <td>${dow[schedule.thu]} ${schedule.ngay}</td>
                            <td>${schedule.id_phong.toString().padStart(3, '0')}</td>
                            <td>${schedule['thoi_gian_bat_dau']}</td>
                            <td>${schedule['thoi_gian_ket_thuc']}</td>
                            <td>${state}</td>
                            <td style="text-align: center;"> 
                                <input value="${i++}" type="checkbox" class="schedule-checkbox">
                            </td>
                        </tr>
                        `);
                }
            }
        });
    }

    function reloadStudentList() {
        loadingEffect(true);
        $.ajax({
            url: `${window.location.protocol}//${window.location.hostname}/Admin/CoursesController/getListOfStudentsByCourseId`,
            method: 'GET',
            contentType: "text",
            dataType: "json",
            data: {
                id: id_lop_hoc * 1
            },
            success: function(response) {
                loadingEffect(false);
                listOfStudents = response;
                $(`.class-infor-table tr`).eq(7).find(`td`).eq(1).text(response.length);
                $(`.class-infor-section__members-quantity`).text((response.length));
                let student_table = $(`.students-table tbody`);
                student_table.empty();
                let i = 0;
                for (let student of listOfStudents) {
                    let profile_url = "<?php echo base_url()?>"  +  "profile/student?id=" + student.id_hoc_vien;
                    let gioi_tinh = student.gioi_tinh == 1 ? "Nam" : "Nữ";
                    // $id_hoc_vien = str_pad($hoc_vien['id_hoc_vien'], 8, '0', STR_PAD_LEFT);
                    // echo "
                    // <tr class='student-row'>
                    //     <td>{$id_hoc_vien}</td>
                    //     <td> {$hoc_vien['ho_ten']}
                    //         <a href='{$profile_url}'><i style='margin-left: 4px;' class='fa-solid fa-square-arrow-up-right'></i></a>
                    //     </td>
                    //     <td>{$gioi_tinh}</td>
                    //     <td>{$hoc_vien['ngay_sinh_hv']}</td>
                    //     <td>{$hoc_vien['email']}</td>
                    //     <td>{$hoc_vien['so_buoi_vang']}</td>
                    // </tr>
                    // ";
                    // let i = 0;
                    student_table.append(`
                        <tr class='student-row'>
                            <td>${student.id_hoc_vien.toString().padStart(6, '0')}</td>
                            <td>${student.ho_ten} 
                                <a href='${profile_url}'><i style='margin-left: 4px;' class='fa-solid fa-square-arrow-up-right'></i></a>
                            </td>
                            <td>${gioi_tinh}
                            </td>
                            <td>${student.ngay_sinh_hv}</td>
                            <td>${student.email}</td>
                            <td>${student.so_buoi_vang}</td>
                            <td style="text-align: center;"> 
                                <input value="${i++}" type="checkbox" class="student-checkbox">
                            </td>
                        </tr>
                        `);
                }
            }
        });
    }

    function reloadLecturerList() {
        loadingEffect(true);
        $.ajax({
            url: `${window.location.protocol}//${window.location.hostname}/Admin/CoursesController/getListOfLecturersByCourseId`,
            method: 'GET',
            contentType: "text",
            data: {
                id: id_lop_hoc * 1
            },
            dataType: "json",
            success: function(response) {
                loadingEffect(false);
                let lecturers_section = $(`.list-of-lecturers-container`);
                lecturers_section.empty();
                $(`.class-infor-table tr`).eq(8).find(`td`).eq(1).text((response.length));
                for (let lecturer of response) {
                    let profile_url = "<?php echo base_url() ?>" + "profile/lecturer?id=" + lecturer['id_giang_vien'];
                    lecturers_section.append(`
                <span class='lecturer-link-span'>
                    <a class='lecturer-link' href='${profile_url}'><span>${lecturer['ho_ten']}</span>&nbsp;-&nbsp;<span>${lecturer['email']}</span></a>
                    <i name='${lecturer['ho_ten']}' value='${lecturer['id_giang_vien']}' class='fa-solid fa-x delete-lecturer-btn' style='z-index:100; font-size: 12px!important;'></i>
                </span><br>
                `);
                }
                $(`.delete-lecturer-btn`).click(function() {
                    let ho_ten = $(this).attr('name');
                    let id_giang_vien = $(this).attr('value');
                    let lecturer = ho_ten + `(${id_giang_vien})`;
                    let id_mon_hoc = $(`.class-infor-table tr`).eq(1).find(`td`).eq(1).text();
                    let class_name_field = $(`.class-infor-table tr`).eq(2).find(`td`).eq(1);
                    let class_name = class_name_field.text() + ` ${id_mon_hoc.toString().padStart(3, '0')}.${id_lop_hoc.toString().padStart(6, '0')}`;
                    if (window.confirm(`Xóa giảng viên ${lecturer} khỏi lớp ${class_name}?`)) {
                        loadingEffect(true);
                        $.ajax({
                            url: `<?php echo base_url() ?>Admin/CoursesController/deleteLecturerFromCourse`,
                            contentType: "text",
                            dataType: "json",
                            data: {
                                id_giang_vien: id_giang_vien,
                                id_lop_hoc: id_lop_hoc
                            },
                            success: function(response) {
                                loadingEffect(false);
                                reloadLecturerList();
                                if (response.state && response.effectedNumRows > 0) {
                                    toast({
                                        title: "Thành công!",
                                        message: `Xóa giảng viên ${lecturer} khỏi lớp ${class_name} thành công`,
                                        type: "success",
                                        duration: 100000
                                    });
                                } else if (response.state && response.effectedNumRows == 0) {
                                    toast({
                                        title: "Thông báo!",
                                        message: `Giảng viên ${lecturer} không có trong lớp ${class_name}!`,
                                        type: "warning",
                                        duration: 100000
                                    });
                                } else {
                                    toast({
                                        title: `Xóa giảng viên ${lecturer} vào lớp ${class_name} thất bại`,
                                        message: response.message,
                                        type: "error",
                                        duration: 100000
                                    });
                                }
                            }
                        })
                    }
                })
            }
        });
    }

    function kiem_tra_tinh_trang(ngay_bat_dau, ngay_ket_thuc) {
        // Chuyển đổi chuỗi ngày thành đối tượng Date
        let datetime_bat_dau = chuyenChuoiThanhDate(ngay_bat_dau);
        let datetime_ket_thuc = chuyenChuoiThanhDate(ngay_ket_thuc);
        let datetime_hien_tai = new Date();

        // Đặt giờ, phút và giây về cuối ngày
        datetime_bat_dau.setHours(0, 0, 0, 0);
        datetime_ket_thuc.setHours(23, 59, 59, 999);

        if (datetime_bat_dau <= datetime_hien_tai && datetime_ket_thuc >= datetime_hien_tai) {
            return '<span class="class__item--inprocess">Đang diễn ra</span>';
        } else if (datetime_ket_thuc < datetime_hien_tai) {
            return '<span class="class__item--over">Đã kết thúc</span>';
        } else {
            return '<span class="class__item--upcoming">Sắp diễn ra</span>';
        }
    }

    // Hàm chuyển đổi chuỗi ngày thành đối tượng Date
    function chuyenChuoiThanhDate(chuoiNgay) {
        let parts = chuoiNgay.split('/');
        return new Date(parts[2], parts[1] - 1, parts[0]);
    }

    $(document).ready(function() {
        reloadSchedule();
        reloadStudentList();
        reloadLecturerList();
        let isCheckedAllStudentTable = false;
        $(`.checkbox-all-students-table`).click(function() {
            if (!isCheckedAllStudentTable) {
                $(`.students-table tbody .student-checkbox`).prop(`checked`, true);
            } else {
                $(`.students-table tbody .student-checkbox`).prop(`checked`, false);
            }
            isCheckedAllStudentTable = !isCheckedAllStudentTable;
        })
        let isCheckedAllScheduleTable = false;
        $(`.checkbox-all-schedule-table`).click(function() {
            if (!isCheckedAllScheduleTable) {
                $(`.schedule-table tbody .schedule-checkbox`).prop(`checked`, true);
            } else {
                $(`.schedule-table tbody .schedule-checkbox`).prop(`checked`, false);
            }
            isCheckedAllScheduleTable = !isCheckedAllScheduleTable;

        })
        $(`.add-schedule-into-class-btn`).click(function() {
            loadingEffect(true);
            $.ajax({
                url: `${window.location.protocol}//${window.location.hostname}/Admin/CoursesController/getInsertScheduleForm`,
                method: 'GET',
                success: function(response) {
                    loadingEffect(false);
                    $('body').append(response);
                    $(`.insert-schedule-form__cancel-btn`).click(function() {
                        $('.form-container').remove();
                    });
                }
            });
        })
        $(`.add-student-into-class-btn`).click(function() {
            loadingEffect(true);
            $.ajax({
                url: `<?php echo base_url(); ?>/Admin/CoursesController/getInsertStudentForm`,
                method: 'GET',
                // dataType: "json",
                success: function(response) {
                    console.log("ok");
                    loadingEffect(false);
                    // console.log(response);
                    $('body').append(response);
                    let id_mon_hoc = $(`.class-infor-table tr`).eq(1).find(`td`).eq(1).text() * 1;
                    $(`.insert-student-form__cancel-btn`).click(function() {
                        $('.form-container').remove();
                    });
                    $(`.insert-student-form__save-btn`).click(function() {
                        var selectedStudents = {};
                        $(`.insert-student-form__students-table .student-checkbox:checked`).each(function() {
                            selectedStudents[$(this).val() + ""] = $(this).parent().parent().find(`td`).eq(1).text();
                        });
                        console.log(selectedStudents);
                        let class_name = $(`.class-infor-table tr`).eq(2).find(`td`).eq(1).text();
                        var obj = {
                            id_lop_hoc: id_lop_hoc,
                            student_id_list: selectedStudents
                        }
                        var jsonData = JSON.stringify(obj);
                        //     // Insert list of lecturers's id into phanconggiangvien
                        $.ajax({
                            url: '<?php echo base_url(); ?>/Admin/CoursesController/insertStudentsIntoClass',
                            method: 'POST',
                            contentType: 'application/json', // Đặt kiểu dữ liệu của yêu cầu là JSON
                            data: jsonData,
                            success: function(response) {
                                var processResult = (response);
                                loadingEffect(false);
                                reloadStudentList();
                                $('.form-container').remove();
                                // Gọi hàm in thông báo, type: "succcess", title: "Thêm lớp thành công", content: "Lớp ${className} ${selectedSubjectId}.${processResult1.auto_increment_id} được thêm thành công"
                                for (var [student, processState] of Object.entries(processResult)) { // có vấn đề
                                    if (processState.state) {
                                        toast({
                                            title: "Thành công!",
                                            message: `Thêm học viên ${student} vào lớp ${class_name} ${id_mon_hoc.toString().padStart(3, '0')}.${id_lop_hoc.toString().padStart(6, '0')} thành công`,
                                            type: "success",
                                            duration: 100000
                                        });
                                        // Gọi hàm in thông báo, type: "succcess", title: "Thêm lớp thành công", content: "Lớp ${className} ${selectedSubjectId}.${processResult1.auto_increment_id} được thêm thành công"
                                    } else {
                                        toast({
                                            title: "Thất bại!",
                                            message: `Thêm học viên ${student} vào lớp ${class_name} ${id_mon_hoc.toString().padStart(3, '0')}.${id_lop_hoc.toString().padStart(6, '0')} thất bại(${processState.message}).`,
                                            type: "error",
                                            duration: 100000
                                        });

                                        // Gọi hàm in thông báo, type: "error", title: "Thêm giảng viên ${lecturer} thêm vào lớp ${selectedSubjectId}.${processResult1.auto_increment_id} thất bại", content: "processState.message"
                                    }
                                }
                                // reloadStudentList();
                                // Xử lý phản hồi từ máy chủ khi thành công
                                console.log('Server response:', response);
                            },
                            error: function(xhr, status, error) {
                                // Xử lý lỗi khi gửi yêu cầu
                                console.error('Error:', status, error);
                            }
                        });
                    });
                }
            });
        })
    })
    $(`.delete-lecturer-btn`).click(function() {
        let ho_ten = $(this).attr('name');
        let id_giang_vien = $(this).attr('value');
        let lecturer = ho_ten + `(${id_giang_vien})`;
        // let id_lop_hoc = id_lop_hoc * 1;
        let id_mon_hoc = $(`.class-infor-table tr`).eq(1).find(`td`).eq(1).text();
        let class_name_field = $(`.class-infor-table tr`).eq(2).find(`td`).eq(1);
        let class_name = class_name_field.text() + ` ${id_mon_hoc.toString().padStart(3, '0')}.${id_lop_hoc.toString().padStart(6, '0')}`;
        if (window.confirm(`Xóa giảng viên ${lecturer} khỏi lớp ${class_name}?`)) {
            loadingEffect(true);
            $.ajax({
                url: `<?php echo base_url() ?>Admin/CoursesController/deleteLecturerFromCourse`,
                contentType: "text",
                dataType: "json",
                data: {
                    id_giang_vien: id_giang_vien,
                    id_lop_hoc: id_lop_hoc
                },
                success: function(response) {
                    loadingEffect(false);
                    reloadLecturerList();
                    if (response.state && response.effectedNumRows > 0) {
                        toast({
                            title: "Thành công!",
                            message: `Xóa giảng viên ${lecturer} khỏi lớp ${class_name} thành công`,
                            type: "success",
                            duration: 100000
                        });
                    } else if (response.state && response.effectedNumRows == 0) {
                        toast({
                            title: "Thông báo!",
                            message: `Giảng viên ${lecturer} không có trong lớp ${class_name}!`,
                            type: "warning",
                            duration: 100000
                        });
                    } else {
                        toast({
                            title: `Xóa giảng viên ${lecturer} vào lớp ${class_name} thất bại`,
                            message: response.message,
                            type: "error",
                            duration: 100000
                        });
                    }
                }
            })
        }
    })
    $(`.delete-student-into-class-btn`).click(function() {
        if (confirm("Xóa các học viên tương ứng ra khỏi lớp học này?")) {
            loadingEffect(true);
            let student_id_list = [];
            $(`.students-table tbody .student-checkbox:checked`).each(function() {
                student_id_list.push(listOfStudents[$(this).val()].id_hoc_vien);
            })
            console.log(student_id_list);
            console.log(id_lop_hoc);
            $.ajax({
                url: "<?php echo base_url() ?>/Admin/CoursesController/deleteStudentFromCourse",
                method: "POST",
                contentType: "json",
                dataType: "json",
                data: JSON.stringify({
                    id_lop_hoc: id_lop_hoc,
                    danh_sach_id_hoc_vien: student_id_list
                }),
                success: function(response) {
                    loadingEffect(false);
                    reloadStudentList();
                    for (var [schedule, processState] of Object.entries(response)) { // có vấn đề
                        if (processState.state) {
                            toast({
                                title: "Thành công!",
                                message: `Xóa học viên ${schedule.toString().padStart(6, '0')} khỏi lớp học thành công`,
                                type: "success",
                                duration: 100000
                            });
                            // Gọi hàm in thông báo, type: "succcess", title: "Thêm lớp thành công", content: "Lớp ${className} ${selectedSubjectId}.${processResult1.auto_increment_id} được thêm thành công"
                        } else {
                            toast({
                                title: "Xóa không thành công!",
                                message: `${processState.message}`,
                                type: "error",
                                duration: 100000
                            });

                            // Gọi hàm in thông báo, type: "error", title: "Thêm giảng viên ${lecturer} thêm vào lớp ${selectedSubjectId}.${processResult1.auto_increment_id} thất bại", content: "processState.message"
                        }
                    }
                },
                error: function() {
                    reloadStudentList();
                    toast({
                        title: "Lỗi!",
                        message: `Đã có lỗi xảy ra!`,
                        type: "error",
                        duration: 100000
                    });
                    loadingEffect(false);
                }
            })
        }
    })
    $(`.delete-schedule-from-class-btn`).click(function() {
        if (confirm("Xóa các buổi học tương ứng ra khỏi lớp học này?")) {
            loadingEffect(true);
            let schedule_id_list = [];
            $(`.schedule-table tbody .schedule-checkbox:checked`).each(function() {
                schedule_id_list.push(listOfSchedule[$(this).val()].id_buoi_hoc);
            })

            $.ajax({
                url: "<?php echo base_url() ?>/Admin/CoursesController/deleteScheduleFromCourse",
                method: "POST",
                contentType: "json",
                dataType: "json",
                data: JSON.stringify({
                    id_lop_hoc: id_lop_hoc,
                    danh_sach_id_buoi_hoc: schedule_id_list
                }),
                success: function(response) {
                    loadingEffect(false);
                    reloadSchedule();
                    for (var [schedule, processState] of Object.entries(response)) { // có vấn đề
                        if (processState.state) {
                            toast({
                                title: "Thành công!",
                                message: `Xóa buổi học ${schedule.toString().padStart(10, '0')} ra khỏi lớp học thành công`,
                                type: "success",
                                duration: 100000
                            });
                            // Gọi hàm in thông báo, type: "succcess", title: "Thêm lớp thành công", content: "Lớp ${className} ${selectedSubjectId}.${processResult1.auto_increment_id} được thêm thành công"
                        } else {
                            toast({
                                title: "Xóa không thành công!",
                                message: `${processState.message}`,
                                type: "error",
                                duration: 100000
                            });

                            // Gọi hàm in thông báo, type: "error", title: "Thêm giảng viên ${lecturer} thêm vào lớp ${selectedSubjectId}.${processResult1.auto_increment_id} thất bại", content: "processState.message"
                        }
                    }
                },
                error: function() {
                    // reloadStudentList();
                    toast({
                        title: "Lỗi!",
                        message: `Đã có lỗi xảy ra!`,
                        type: "error",
                        duration: 100000
                    });
                    loadingEffect(false);
                }
            })
        }
    })
    $(`.add-lecturer-btn`).click(function() {
        loadingEffect(true);
        $.ajax({
            url: `${window.location.protocol}//${window.location.hostname}/Admin/CoursesController/getInsertLecturerForm`,
            method: 'GET',
            success: function(response) {
                loadingEffect(false);
                $('body').append(response);
                $(`.insert-lecturer-form__cancel-btn`).click(function() {
                    $('.form-container').remove();
                });
                $(`.insert-lecturer-form__save-btn`).click(function() {
                    var selectedLecturers = {};
                    $(`.insert-lecturer-form__lecturers-table .lecturer-checkbox:checked`).each(function() {
                        selectedLecturers[$(this).val() + ""] = $(this).parent().parent().find(`td`).eq(1).text();
                    });
                    // let id_lop_hoc_ = id_lop_hoc * 1;
                    let id_mon_hoc = $(`.class-infor-table tr`).eq(1).find(`td`).eq(1).text() * 1;
                    let class_name = $(`.class-infor-table tr`).eq(2).find(`td`).eq(1).text();
                    var obj = {
                        id_lop_hoc: id_lop_hoc,
                        lecturer_id_list: selectedLecturers
                    }
                    var jsonData = JSON.stringify(obj);
                    // Insert list of lecturers's id into phanconggiangvien
                    $.ajax({
                        url: '<?php echo base_url(); ?>/Admin/CoursesController/insertLecturersIntoClass',
                        method: 'POST',
                        contentType: 'application/json', // Đặt kiểu dữ liệu của yêu cầu là JSON
                        data: jsonData,
                        success: function(response) {
                            console.log(id_lop_hoc);
                            console.log(selectedLecturers);

                            // Xử lý in ra thông báo khi request thêm danh sách giảng viên vào lớp
                            var processResult = (response);
                            loadingEffect(false);
                            $('.form-container').remove();
                            // Gọi hàm in thông báo, type: "succcess", title: "Thêm lớp thành công", content: "Lớp ${className} ${selectedSubjectId}.${processResult1.auto_increment_id} được thêm thành công"
                            for (var [lecturer, processState] of Object.entries(processResult)) { // có vấn đề
                                if (processState.state) {
                                    toast({
                                        title: "Thành công!",
                                        message: `Thêm giảng viên ${lecturer} vào lớp ${class_name} ${id_mon_hoc.toString().padStart(3, '0')}.${id_lop_hoc.toString().padStart(6, '0')} thành công`,
                                        type: "success",
                                        duration: 100000
                                    });
                                    // Gọi hàm in thông báo, type: "succcess", title: "Thêm lớp thành công", content: "Lớp ${className} ${selectedSubjectId}.${processResult1.auto_increment_id} được thêm thành công"
                                } else {
                                    toast({
                                        title: "Thất bại!",
                                        message: `Thêm giảng viên ${lecturer} vào lớp ${class_name} ${id_mon_hoc.toString().padStart(3, '0')}.${id_lop_hoc.toString().padStart(6, '0')} thất bại(${processState.message}).`,
                                        type: "error",
                                        duration: 100000
                                    });

                                    // Gọi hàm in thông báo, type: "error", title: "Thêm giảng viên ${lecturer} thêm vào lớp ${selectedSubjectId}.${processResult1.auto_increment_id} thất bại", content: "processState.message"
                                }
                            }
                            reloadLecturerList();
                            // Xử lý phản hồi từ máy chủ khi thành công
                            console.log('Server response:', response);
                        },
                        error: function(xhr, status, error) {
                            // Xử lý lỗi khi gửi yêu cầu
                            console.error('Error:', status, error);
                        }
                    });
                });
            }
        });
    })
    $(document).on('change', '.mon_hoc_cbb', function() {
        console.log($(this).val());
        $(`.class-infor-table tr`).eq(1).find(`td`).eq(1).text(`${$(this).val().padStart(3, '0')}`);
    });
    let id = '';
    let class_name = '';
    let ngbd = '';
    let ngkt = '';
    $(`.update-btn`).click(function() {
        loadingEffect(true);
        // Component trong table information
        let id_field = $(`.class-infor-table tr`).eq(1).find(`td`).eq(1);
        id = id_field.text();
        let class_name_field = $(`.class-infor-table tr`).eq(2).find(`td`).eq(1);
        class_name = class_name_field.text();
        let begin_date_field = $(`.class-infor-table tr`).eq(3).find(`td`).eq(1);
        ngbd = begin_date_field.text();
        let final_date_field = $(`.class-infor-table tr`).eq(4).find(`td`).eq(1);
        ngkt = final_date_field.text();
        // alert(id)
        // alert(`${`${ngkt.substr(6, 4)}-${ngkt.substr(3, 2)}-${ngkt.substr(0, 2)}`}`);
        console.log(ngbd);
        let options = '';
        $.ajax({
            url: `${window.location.protocol}//${window.location.hostname}/Admin/CoursesController/getListOfSubjects`,
            method: 'POST',
            contentType: 'application/json', // Đặt kiểu dữ liệu của yêu cầu là JSON
            data: null,
            success: function(response) {
                // console.log(response);

                for (let subject of response) {
                    options += `<option name="${subject['ten_mon_hoc']}" ${subject['id_mon_hoc'] == id ? "selected" : ""} value="${subject['id_mon_hoc']}">${subject['id_mon_hoc'].padStart(3, '0') + " - " + subject['ten_mon_hoc']}</option>`;
                }
                class_name_field.html(`
                    <select style="height: 23px" class="mon_hoc_cbb">${options}</select>
                    
            `);
                loadingEffect(false);

            }

        })
        begin_date_field.html(`
                <input class="ngbd" type="date" value="${`${ngbd.substr(6, 4)}-${ngbd.substr(3, 2)}-${ngbd.substr(0, 2)}`}">
            `);
        final_date_field.html(`
                <input class="ngkt" type="date" value="${`${ngkt.substr(6, 4)}-${ngkt.substr(3, 2)}-${ngkt.substr(0, 2)}`}">
            `)

        $(`.save-update-class-div`).css(`position`, `static`);
        $(`.save-update-class-div`).css(`z-index`, `1`);
        $(`.cancel-update-class-div`).css(`position`, `static`);
        $(`.cancel-update-class-div`).css(`z-index`, `1`);

        let updatebtn = $(`.update-btn`);
        updatebtn.prop(`disabled`, true);
        updatebtn.removeClass(`highlight-button`);
        updatebtn.addClass(`highlight-button--disable`);
    });
    $(`.cancel-update-class-btn`).click(function() {
        if (!window.confirm("Hủy bỏ thông tin chỉnh sửa hiện tại?")) {
            return;
        }
        let id_field = $(`.class-infor-table tr`).eq(1).find(`td`).eq(1);
        id_field.text(id);
        let class_name_field = $(`.class-infor-table tr`).eq(2).find(`td`).eq(1);
        class_name_field.text(class_name);
        let begin_date_field = $(`.class-infor-table tr`).eq(3).find(`td`).eq(1);
        begin_date_field.text(ngbd);
        let final_date_field = $(`.class-infor-table tr`).eq(4).find(`td`).eq(1);
        final_date_field.text(ngkt);
        $(`.save-update-class-div`).css(`position`, `absolute`);
        $(`.save-update-class-div`).css(`z-index`, `-1`);
        $(`.cancel-update-class-div`).css(`position`, `absolute`);
        $(`.cancel-update-class-div`).css(`z-index`, `-1`);

        let updatebtn = $(`.update-btn`);
        updatebtn.prop(`disabled`, false);
        updatebtn.removeClass(`highlight-button--disable`);
        updatebtn.addClass(`highlight-button`);
    });
    $(`.save-update-class-btn`).click(function() {
        // Lấy dữ liệu bỏ vào obj
        loadingEffect(true);
        let course = {
            id_lop_hoc: id_lop_hoc * 1,
            id_mon_hoc: $(`.mon_hoc_cbb`).val() * 1,
            ngay_bat_dau: $(`.ngbd`).val(),
            ngay_ket_thuc: $(`.ngkt`).val()
        }
        courseData = JSON.stringify(course);
        $.ajax({
            url: `<?php echo base_url() ?>/Admin/CoursesController/updateCourse`,
            method: 'POST',
            contentType: 'application/json', // Đặt kiểu dữ liệu của yêu cầu là JSON
            data: courseData,
            success: function(response) {
                loadingEffect(false);
                if (response.state) {
                    toast({
                        title: "Thành công!",
                        message: `Cập nhật thông tin lớp ${id_lop_hoc} thành công!`,
                        type: "success",
                        duration: 100000
                    });
                    $(`.save-update-class-div`).css(`position`, `absolute`);
                    $(`.save-update-class-div`).css(`z-index`, `-1`);
                    $(`.cancel-update-class-div`).css(`position`, `absolute`);
                    $(`.cancel-update-class-div`).css(`z-index`, `-1`);

                    let updatebtn = $(`.update-btn`);
                    updatebtn.prop(`disabled`, false);
                    updatebtn.removeClass(`highlight-button--disable`);
                    updatebtn.addClass(`highlight-button`);
                    console.log(course);
                    $(`.class-infor-table tr`).eq(2).find(`td`).eq(1).html(`${$(`.mon_hoc_cbb option:selected`).attr(`name`)}`);
                    $(`.class-infor-table tr`).eq(3).find(`td`).eq(1).html(`${course.ngay_bat_dau.substr(9, 2).padStart(2, '0')}/${course.ngay_bat_dau.substr(5, 2).padStart(2, '0')}/${course.ngay_bat_dau.substr(0, 4)}`);
                    $(`.class-infor-table tr`).eq(4).find(`td`).eq(1).html(`${course.ngay_ket_thuc.substr(9, 2).padStart(2, '0')}/${course.ngay_ket_thuc.substr(5, 2).padStart(2, '0')}/${course.ngay_ket_thuc.substr(0, 4)}`);
                    $(`.state-in-left-menu`).html("Trạng thái: " + kiem_tra_tinh_trang($(`.class-infor-table tr`).eq(3).find(`td`).eq(1).text(), $(`.class-infor-table tr`).eq(4).find(`td`).eq(1).text()));
                    let class_name = $(`.class-infor-table tr`).eq(2).find(`td`).eq(1).text() + ` ${course.id_mon_hoc.toString().padStart(3, '0')}.${course.id_lop_hoc.toString().padStart(6, '0')}`
                    $(`.class-infor-section__class-name`).text(class_name);
                    $(`.header-container h1`).text(class_name);
                } else {
                    toast({
                        title: "Cập nhật thấp bại!",
                        message: `${response.message}!`,
                        type: "error",
                        duration: 100000
                    });
                }
            }
        });
    });
</script>