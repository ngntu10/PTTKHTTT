<div class="form-container">
    <div class="update-teacher-form bg-white h-75 overflow-auto" style="width: 70%;">
        <div class="update-teacher-form__title-section w-100 bg-dark d-flex justify-content-between align-items-center sticky-top" style="height: 60px;">
            <div class="ps-3">
                <h5 class="update-teacher-form__title text-white fw-bold">Cập nhật giáo viên</h5>
            </div>    
            <div class="update-teacher-form__btn-container pe-3 d-flex justify-content-end align-items-center">
                <button class="update-teacher-form__cancel-btn btn btn-light border border-gray me-3 shadow-sm">
                    <i class="fas fa-times" style="color: #333;"></i>
                </button>
                <button class="update-teacher-form__save-btn btn btn-light border border-gray me-3 shadow-sm">
                    <i class="fas fa-check" style="color: #333;"></i>
                </button>
                <button class="update-teacher-form__profile-btn btn btn-light border border-gray shadow-sm" teacherID="<?php echo isset($lecturer->id_giang_vien) ? $lecturer->id_giang_vien: '' ?>">
                    <i class="far fa-user-circle" style="color: #333;"></i>
                </button>
            </div>
        </div>
        <div class="update-teacher-form__content-section p-3">
            <div class="text-center fw-bold fs-2 mb-3">Thông tin cơ bản</div>
            <div class="update-teacher-form__info-container row mb-3">
                <div class="col-6 mb-5 text-center">
                    <label class="me-3">Họ và tên</label>
                    <input type="text" class="update-teacher-form__fullname" value="<?php echo isset($lecturer->ho_ten) ? $lecturer->ho_ten: 'Error' ?>">
                </div>
                <div class="col-6 mb-5 text-center">
                    <label class="me-3">Ngày sinh</label>
                    <input type="date" class="update-teacher-form__dob" value="<?php echo isset($lecturer->ngay_sinh) ? $lecturer->ngay_sinh: '' ?>">
                </div>
                <div class="col-6 text-center">
                    <label class="me-3">Email</label>
                    <input type="text" class="update-teacher-form__email" value="<?php echo isset($lecturer->email) ? $lecturer->email: 'Error' ?>">
                </div>
                <div class="col-6 text-center">
                    <label class="me-3">Giới tính</label>
                    <select name="gioitinh" class="update-teacher-form__sex">
                        <option value="1" <?php echo (isset($lecturer->gioi_tinh) && $lecturer->gioi_tinh == 1) ? ' selected="selected"' : '' ?>>Nam</option>
                        <option value="0" <?php echo (isset($lecturer->gioi_tinh) && $lecturer->gioi_tinh == 0) ? ' selected="selected"' : '' ?>>Nữ</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="text-center fw-bold fs-2 mb-3">Các lớp tham gia giảng dạy</div>
            <table class="table deleteClassTable mt-3 table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">ID Lớp học</th>
                        <th scope="col">Tên môn học</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($phancongs); $i++){
                            $courseid = str_pad($phancongs[$i]->id_mon_hoc, 3, "0", STR_PAD_LEFT) . "." . str_pad($phancongs[$i]->id_lop_hoc, 6, "0", STR_PAD_LEFT);
                            echo "<tr>
                                    <th scope='row'>{$courseid}</th>
                                    <td>{$phancongs[$i]->ten_mon_hoc}</td>
                                    <td>{$phancongs[$i]->ngay_bat_dau}</td>
                                    <td>{$phancongs[$i]->ngay_ket_thuc}</td>
                                    <td><input type='checkbox' class='deleteTeachingCourse' value='{$phancongs[$i]->id_lop_hoc}'></td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
            <hr>
            <div class="text-center fw-bold fs-2 mb-3">Các lớp không tham gia giảng dạy</div>
            <table class="table addClassTable mt-3 table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">ID Lớp học</th>
                        <th scope="col">Tên môn học</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Thêm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($notphancongs); $i++){
                            $courseid = str_pad($notphancongs[$i]->id_mon_hoc, 3, "0", STR_PAD_LEFT) . "." . str_pad($notphancongs[$i]->id_lop_hoc, 6, "0", STR_PAD_LEFT);
                            echo "<tr>
                                    <th scope='row'>{$courseid}</th>
                                    <td>{$notphancongs[$i]->ten_mon_hoc}</td>
                                    <td>{$notphancongs[$i]->ngay_bat_dau}</td>
                                    <td>{$notphancongs[$i]->ngay_ket_thuc}</td>
                                    <td><input type='checkbox' class='addClasses' value='{$notphancongs[$i]->id_lop_hoc}'></td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
            <hr>
            
        </div>
    </div>
</div>