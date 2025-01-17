
<div class="form-container">
    <div class="insert-schedule-form">
        <div class="insert-schedule-form__title-section">
            <h5 class="insert-schedule-form__title">Thêm buổi học</h5>
        </div>
        <h6 class="insert-schedule-form__table-title" style="margin-top: 15px;">
            Bộ lọc
            <button class="insert-schedule-form__filter-btn" style="margin-right: 0px; height: 23.5px;">Lọc dữ liệu</button>
        </h6>
        <div class="insert-schedule-form__filter-table-container">
            <table class="insert-schedule-form__filter-table">
                <tr>
                    <td>Ngày bắt đầu: <input class="insert-schedule-form__begin-date" type="date"></td>
                    <td>
                        Ca:
                        <select class="insert-schedule-form__shifts-cbb" name="ok" id="">
                            <option value="-1"></option>
                            <?php
                            foreach ($shifts as $shift) {
                                echo "
                                    <option value='{$shift->id_ca}'>{$shift->thoi_gian_bat_dau} - {$shift->thoi_gian_ket_thuc}</option>
                                ";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        Thứ:
                        <select class="insert-schedule-form__dow-cbb" name="" id="">
                            <option value="-1"></option>
                            <option value="1">Chủ Nhật</option>
                            <option value="2">Thứ Hai</option>
                            <option value="3">Thứ Ba</option>
                            <option value="4">Thứ Tư</option>
                            <option value="5">Thứ Năm</option>
                            <option value="6">Thứ Sáu</option>
                            <option value="7">Thứ Bảy</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ngày kết thúc: <input class="insert-schedule-form__final-date" type="date"></td>
                    <td>
                        Phòng:
                        <select class="insert-schedule-form__rooms-cbb" name="" id="">
                            <option value="-1"></option>
                            <?php
                            foreach ($rooms as $room) {
                                echo "
                                        <option value='{$room->id_phong}'>{$room->id_phong}</option>
                                    ";
                            }
                            ?>
                        </select>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="insert-schedule-form__filter-btn-container">
            <p class="insert-schedule-form__error-noti"></p>
        </div>
        <h6 class="insert-schedule-form__table-title">
            <span class="insert-schedule-form__table-title1">Danh sách buổi học</span>
            <button style="height: 25px; margin-right: 0px!important; width: 31.38px;" class="insert-schedule-form__choose-schedule-btn">
                <i class="fa-solid fa-down-long"></i>
            </button>
        </h6>
        <div class="insert-schedule-form__schedule-table-container">
            <table class="insert-schedule-form__schedule-table insert-schedule-form__filtered-schedule">
                <thead>
                    <tr>
                        <td>Mã buổi học</td>
                        <td>Ngày học</td>
                        <td>Phòng</td>
                        <td>Ca</td>
                        <td>Trạng thái</td>
                        <!-- 0 trống, 1 chưa bắt đầu, 2 đã hoàn thành -->
                        <td>Lớp</td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input class="checkbox-all-table1" type="checkbox">
                        </td>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>

        <h6 class="insert-schedule-form__table-title">
            Danh sách đã chọn
            <button class="insert-schedule-form__delete-chosen-schedule-btn" style="margin-right: 0px; height: 25px;">
            <i class="fa-solid fa-trash-can"></i>
        </button>
        </h6>
        <div class="insert-schedule-form__schedule-table-container">
            <table class="insert-schedule-form__schedule-table insert-schedule-form__chosen-schedule">
                <thead>
                    <tr>
                        <td>Mã buổi học</td>
                        <td>Ngày học</td>
                        <td>Phòng</td>
                        <td>Ca</td>
                        <td>Trạng thái</td>
                        <!-- 0 trống, 1 chưa bắt đầu, 2 đã hoàn thành -->
                        <td>Lớp</td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input class="checkbox-all-table2" type="checkbox">
                        </td>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
        <div class="insert-schedule-form__btn-container">
            <button class="insert-schedule-form__cancel-btn">Hủy</button>
            <button class="insert-schedule-form__save-btn">Lưu thông tin</button>
        </div>
    </div>
    
<script>
    
    $(document).ready(function() {
        let id_lop_hoc = $(`.class-infor-table tr`).eq(0).find(`td`).eq(1).text()*1;;
        $(`.insert-schedule-form__save-btn`).click(function() {
            loadingEffect(true);
            $.ajax({
                url: "<?php echo base_url()?>/Admin/CoursesController/insertScheduleIntoClass",
                contentType: "text",
                dataType: "json",
                data: {
                    json: JSON.stringify(listOfChosenSchedule),
                    id: id_lop_hoc
                },
                success: function(response) {
                    let i = 0;                    
                    for (var [id_buoi_hoc, processState] of Object.entries(response)) {
                        if (processState['state'] == true) {
                            i++;
                        } else {
                            toast({
                            title: `Lỗi khi thêm buổi học ${id_buoi_hoc}!`,
                            message: `${processState[`message`]}!`,
                            type: "error",
                            duration: 100000
                        });
                        }
                    }
                    toast({
                            title: `Thông báo!`,
                            message: `Thêm thành công ${i} buổi học!`,
                            type: "success",
                            duration: 100000
                        });
                        loadingEffect(false);
                        reloadSchedule();
                        $('.form-container').remove();
                },
                error: function() {
                    toast({
                            title: "Lỗi!",
                            message: `Đã có lỗi xảy ra!`,
                            type: "error",
                            duration: 100000
                        });
                        loadingEffect(false);
                        $('.form-container').remove();
                }
            })
            

        })
        let isChecked = false;
        $(`.checkbox-all-table2`).click(function(){
            if (!isChecked) {
                $(`.insert-schedule-form__chosen-schedule tbody .schedule-checkbox`).prop(`checked`, true);
            } else {
                $(`.insert-schedule-form__chosen-schedule tbody .schedule-checkbox`).prop(`checked`, false);
            }
            isChecked = !isChecked;
        });
        let isChecked2 = false;
        $(`.checkbox-all-table1`).click(function(){
            if (!isChecked2) {
                $(`.insert-schedule-form__filtered-schedule tbody .schedule-checkbox`).prop(`checked`, true);
            } else {
                $(`.insert-schedule-form__filtered-schedule tbody .schedule-checkbox`).prop(`checked`, false);
            }
            isChecked2 = !isChecked2;
        });
        let listOfChosenSchedule = [];
        let listOfFiltered = [];
        $(`.insert-schedule-form__delete-chosen-schedule-btn`).click(function() {
            $(`.insert-schedule-form__chosen-schedule .schedule-checkbox:checked`).each(function() {
                let index = listOfChosenSchedule.indexOf($(this).val());
                if (index != -1) {
                    listOfChosenSchedule.splice(index, 1);
                    $(this).parent().parent().remove();
                }
            })
           
        })
        $(`.insert-schedule-form__choose-schedule-btn`).click(function() {
            loadingEffect(true);
            $(`.insert-schedule-form__error-noti`).text(``);
            let indexList = [];
            let isReturn = false;
            $(`.insert-schedule-form__filtered-schedule .schedule-checkbox:checked`).each(function() {
                let index = $(this).attr("value");
                indexList.push(index);
                if (index < listOfFiltered.length) {
                    if (listOfFiltered[index].id_lop_hoc != null){
                        $(`.insert-schedule-form__error-noti`).text(`Không được thêm buổi học đang có lớp học khác diễn ra`);
                        loadingEffect(false);
                        isReturn = true;
                    }
                } 
            });
            if (isReturn) return;
            
            for (let index of indexList) {
                if (listOfChosenSchedule.indexOf(listOfFiltered[index].id_buoi_hoc) == -1) {
                    listOfChosenSchedule.push(listOfFiltered[index].id_buoi_hoc);
                    let schedule = listOfFiltered[index];
                    let mh = schedule.id_lop_hoc === null ? "--" : `${schedule.ten_mon_hoc} ${schedule.id_mon_hoc.toString().padStart(3, '0')}.${schedule.id_lop_hoc.toString().padStart(6, '0')}`;
                        let state = "";
                        switch (schedule.trang_thai*1) {
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
                    $(`.insert-schedule-form__chosen-schedule tbody`).append(`
                            <tr>
                                <td>${schedule.id_buoi_hoc.toString().padStart(10, '0')}</td>
                                <td>${dow[schedule.thu]} ${schedule.ngay}</td>
                                <td>${schedule.id_phong.toString().padStart(3, '0')}</td>
                                <td>${schedule.id_ca}(${schedule.thoi_gian_bat_dau} - ${schedule.thoi_gian_ket_thuc})</td>
                                <td>${state}</td>
                                <td>${mh}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <input class="schedule-checkbox" value="${schedule.id_buoi_hoc}" type="checkbox">
                                </td>
                            </tr>
                    `);
                }
            }
            loadingEffect(false);
            $(`.insert-schedule-form__filtered-schedule input[type="checkbox"]`).prop(`checked`, false);
            isChecked2 = false;
        });
        $(`.insert-schedule-form__filter-btn`).click(function() {
            loadingEffect(true);
            $(`.insert-schedule-form__error-noti`).text(``);
            let beginDate = $(`.insert-schedule-form__begin-date`).val();
            let finalDate = $(`.insert-schedule-form__final-date`).val();
            if (beginDate === "" || finalDate === "") {
                loadingEffect(false);
                $(`.insert-schedule-form__error-noti`).text(`Hãy chọn khoảng bắt đầu - kết thúc hợp lệ`);
                return;
            }
            let shift = $(`.insert-schedule-form__shifts-cbb`).val();
            let dow = $(`.insert-schedule-form__dow-cbb`).val();
            let room = $(`.insert-schedule-form__rooms-cbb`).val();
            data = {
                ngay_bat_dau: beginDate,
                ngay_ket_thuc: finalDate,
                id_ca: shift,
                thu_trong_tuan: dow,
                id_phong: room
            }
            data = JSON.stringify(data);
            console.log(data);
            $.ajax({
                url: "<?php echo base_url() ?>" + "/Admin/CoursesController/getScheduleList",
                contentType: "text",
                dataType: "json",
                data: {
                    json: data
                },
                success: function(response) {
                    loadingEffect(false);
                    listOfFiltered = response;
                    console.log(response);
                    let filtered_table = $(`.insert-schedule-form__filtered-schedule`);
                    filtered_table.find(`tbody`).empty();
                    let generatedHTML = ``;
                    let i = 0;
                    for (let schedule of response) {
                        
                        let mh = schedule.id_lop_hoc === null ? "--" : `${schedule.ten_mon_hoc} ${schedule.id_mon_hoc.toString().padStart(3, '0')}.${schedule.id_lop_hoc.toString().padStart(6, '0')}`;
                        let state = "";
                        switch (schedule.trang_thai*1) {
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
                        generatedHTML += `
                            <tr>
                                <td>${schedule.id_buoi_hoc.toString().padStart(10, '0')}</td>
                                <td>${dow[schedule.thu]} ${schedule.ngay}</td>
                                <td>${schedule.id_phong.toString().padStart(3, '0')}</td>
                                <td>${schedule.id_ca}(${schedule.thoi_gian_bat_dau} - ${schedule.thoi_gian_ket_thuc})</td>
                                <td>${state}</td>
                                <td>${mh}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <input class="schedule-checkbox" value="${i++}" type="checkbox">
                                </td>
                            </tr>`; 
                    }
                    filtered_table.find(`tbody`).append(generatedHTML);
                    $(`.insert-schedule-form__table-title1`).text(`Danh sách lớp học(${response.length} kết quả)`);
                }
            })
        })
    })
</script>
</div>