<div class="content-section">
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">Thông tin chi tiết
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
    </h3>
    <div class="list-of-lecturers-container">
       
    </div>
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">
        Danh sách học viên
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
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">Danh sách buổi học
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
    });
</script>