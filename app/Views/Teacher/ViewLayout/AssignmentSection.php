<div class="content-section">
    <a href="<?php base_url() ?>/courses/resource?courseid=<?php echo $id_lop_hoc ?>" class="custom-link">
        <i class="fa-solid fa-angles-left" style="margin-right: 3px;"></i>
        Tài nguyên
    </a>
    <h3 class="assignment-title" style="margin-right: 14px; margin-top: 0px; margin-left: 27px; display: flex; align-items: center;">

       
    </h3>

    <p class="assignment-content">
    </p>

    <h5 style="margin-left: 30px; margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">
        Trạng thái bài tập
        <div class="component-container">
            <div class="cancel-div cancel-update-assignment-div">
                <button class="cancel-update-assignment-btn highlight-button--cancel">
                    <i class="fa-solid fa-x highlight-icon--cancel" style="font-size: 12px!important;"></i>
                </button>
            </div>
            <div style="margin-right: 10px;" class="save-div save-update-assignment-div">
                <button class="save-update-assignment-btn highlight-button--save">
                    <i class="fa-solid fa-check highlight-icon--save" style="font-size: 12px!important;"></i>
                </button>
            </div>
            <button class="update-btn highlight-button">
                Điều chỉnh
                <i class="fa-solid fa-pen highlight-icon"></i>
            </button>
        </div>
    </h5>
    <table class="assignment-infor-table">
        <tr>
            <td>Trạng thái</td>
            <td>
                <span>Chưa đến hạn</span><span>/Hiệu lực</span>
            </td>
        </tr>
        <tr>
            <td>Thời gian nộp bài</td>
            <td>

            </td>
        </tr>
        <tr>
            <td>Thời gian hiệu lực</td>
            <td>

            </td>
        </tr>
        <tr>
            <td>Thời gian còn lại</td>
            <td>
                <!--  -->

            </td>
        </tr>
    </table>

    <h5 style="margin-left: 30px;">
        Danh sách bài nộp
    </h5>
    <table class="submit-table">
        <thead>
            <tr>
                <td>Mã học viên</td>
                <td>Họ tên</td>
                <td>Trạng thái nộp</td>
                <td>Thời gian</td>
                <td>Tệp đính kèm</td>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <script>
        function getCurrentDateTimeString() {
            const currentDate = new Date();

            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, '0');
            const day = String(currentDate.getDate()).padStart(2, '0');
            const hours = String(currentDate.getHours()).padStart(2, '0');
            const minutes = String(currentDate.getMinutes()).padStart(2, '0');
            const seconds = String(currentDate.getSeconds()).padStart(2, '0');

            const dateTimeString = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

            return dateTimeString;
        }

        function calculateTimeDifference(inputTime, inputTime2) {
            // Convert input time strings to Date objects
            const inputDateTime = parseDateString(inputTime);
            const currentTime = parseDateString(inputTime2);

            // Compare current time and input time
            if (currentTime < inputDateTime) {
                // If current time is less than input time, calculate remaining time
                const timeDifference = 'Còn ' + formatTimeDifference(inputDateTime - currentTime);
                return timeDifference;
            } else {
                // If current time is greater than input time, calculate overdue time
                const timeDifference = 'Quá hạn ' + formatTimeDifference(currentTime - inputDateTime);
                return timeDifference;
            }
        }

        function calculateTimeDifference2(inputTime, inputTime2) {
            // Convert input time strings to Date objects
            const inputDateTime = parseDateString(inputTime);
            const currentTime = parseDateString(inputTime2);

            // Compare current time and input time
            if (currentTime < inputDateTime) {
                // If current time is less than input time, calculate remaining time
                const timeDifference = 'Sớm ' + formatTimeDifference(inputDateTime - currentTime);
                return timeDifference;
            } else {
                // If current time is greater than input time, calculate overdue time
                const timeDifference = 'Quá hạn ' + formatTimeDifference(currentTime - inputDateTime);
                return timeDifference;
            }
        }

        // Function to format time difference
        function formatTimeDifference(timeDifference) {
            // Calculate days, hours, minutes, and seconds
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Format the time string
            const formattedTime = `${days} ngày ${hours} giờ ${minutes} phút ${seconds} giây`;

            return removeZeroTimeComponents(formattedTime);
            return formattedTime;

        }

        function removeZeroTimeComponents(formattedTime) {
            // Regex pattern to match "0 days," and similar components
            const pattern = /(?:0 [a-zà-ú]+,?\s*)+/iu;

            // Replace matched components with an empty string
            const cleanedTime = formattedTime.replace(pattern, match => {
                // Only replace if the matched component is "0"
                return match.startsWith('0') ? '' : match;
            });

            return cleanedTime;
        }

        function parseDateString(dateString) {
            const [datePart, timePart] = dateString.split(' ');
            const [year, month, day] = datePart.split('-');
            const [hours, minutes, seconds] = timePart.split(':');
            return new Date(year, month - 1, day, hours, minutes, seconds);
        }

        function createFileItems(files) {
            let fileItems = '';

            files.forEach(file => {
                const fileIcon = {
                    'pdf': 'pdf_icon',
                    'docx': 'word_icon',
                    'doc': 'word_icon',
                    'xlsx': 'excel_icon',
                    'pptx': 'ppt_icon'
                };
                const fileExtension = ['pdf', 'docx', 'xlsx', 'doc', 'pptx'];
                const icon = (fileExtension.includes(file.extension)) ? fileIcon[file.extension] : 'any_file_icon';

                fileItems += `
            <div style='margin-left: 0px!important; margin-right: 5px; padding-right: 35px; display: flex;' class='file-item--var' value='${file.id_tep_tin_tai_len}' isChosen>
                <img src='<?php echo base_url() ?>/assets/img/${icon}.png' alt=''>
                <span>${file.ten_tep}.${file.extension}</span>
            </div>
        `;
            });

            return fileItems;
        }
        async function reloadAssignmentPage() {
            loadingEffect(true);
            let urlParams = new URLSearchParams(window.location.search);
            let assignmentid = urlParams.get('assignmentid');
            $.ajax({
                url: `${window.location.protocol}//${window.location.hostname}/Admin/CoursesController/getAssignmentInformation`,
                method: 'GET',
                contentType: "text",
                data: {
                    assignmentid: assignmentid * 1
                },
                dataType: "json",
                success: function(response) {
                    if (response.hasOwnProperty('state')) {
                        console.log(response.message);
                        loadingEffect(false);
                        return;
                    } else {
                        $(`.assignment-title`).html(
                            `<span>${response['ten']}</span> <img src="<?php base_url()?>/assets/img/assignment_icon.png" alt="" style="height: 32px; margin-left: 10px;">`
                        );
                        $('.assignment-content').text(`${response['noi_dung']}`);

                        let tt;
                        let hl;
                        if (parseDateString(response['thoi_han']) < parseDateString(getCurrentDateTimeString())) {
                            tt = "Đã quá hạn"
                        } else {
                            tt = "Chưa đến hạn"
                        }
                        if (parseDateString(response['thoi_han_nop']) < parseDateString(getCurrentDateTimeString())) {
                            hl = "Hết hiệu lực";
                        } else {
                            hl = "Còn hiệu lực";
                        }
                        $(`.assignment-infor-table tr`).eq(0).find(`td`).eq(1).text(`${tt}/${hl}`);
                        $(`.assignment-infor-table tr`).eq(1).find(`td`).eq(1).text(`${response['thoi_han']}`);
                        $(`.assignment-infor-table tr`).eq(2).find(`td`).eq(1).text(`${response['thoi_han_nop']}`);
                        $(`.assignment-infor-table tr`).eq(3).find(`td`).eq(1).text(calculateTimeDifference(response['thoi_han'], getCurrentDateTimeString()));
                        if (parseDateString(response['thoi_han']) < parseDateString(getCurrentDateTimeString())) {
                            $(`.assignment-infor-table tr`).eq(3).find(`td`).eq(1).css("color", "#ff0000");
                        } else {
                            $(`.assignment-infor-table tr`).eq(3).find(`td`).eq(1).css("color", "#52ec4d");
                        }
                        $(`.submit-table tbody`).empty();
                        response.submits.forEach(submit => {
                            const idhv = submit.id_hoc_vien.toString().padStart(6, '0');

                            if (submit.id_bai_nop === null) {
                                const u = response.submits.length;
                                $(`.submit-table tbody`).append(`
                                        <tr>
                                            <td>${idhv}</td>
                                            <td>${submit.ho_ten}</td>
                                            <td style='color: #FFA33C;'>Chưa nộp</td>
                                            <td>--/--</td>
                                            <td></td>
                                        </tr>
                                `);
                            } else {
                                const st = calculateTimeDifference2(response.thoi_han, submit.thoi_gian_nop);
                                const sty = (response.thoi_han < submit.thoi_gian_nop) ? "style='color: #ff0000;'" : "style='color: #52ec4d;'";
                                const files = createFileItems(submit.files);

                                $(`.submit-table tbody`).append(`
                                        <tr>
                                            <td>${idhv}</td>
                                            <td>${submit.ho_ten}</td>
                                            <td ${sty}>${st}</td>
                                            <td>${submit.thoi_gian_nop}</td>
                                            <td style='text-align: right;'>
                                            <div style='display: flex; flex-direction: column; align-items: start;'>
                                                ${files}
                                            </div>
                                            </td>
                                        </tr>
                                `);
                            }
                        });

                    }
                    loadingEffect(false);

                }
            })
        }
        // foreach ($assignment["submits"] as $submit) {
        //         $idhv = str_pad($submit['id_hoc_vien'], 6, '0', STR_PAD_LEFT);
        //         if ($submit["id_bai_nop"] == null) {
        //             $u = count($assignment["submits"]);
        //             echo "
        //                     <tr>
        //                         <td>{$idhv}</td>
        //                         <td>{$submit['ho_ten']}</td>
        //                         <td style='color: #FFA33C;'>Chưa nộp</td>
        //                         <td>--/--</td>
        //                         <td>{$u}</td>
        //                     </tr>
        //                     ";
        //         } else {
        //             $st = calculateTimeDifference2($assignment["thoi_han"], $submit["thoi_gian_nop"]);
        //             if ($assignment["thoi_han"] < $submit["thoi_gian_nop"]) {
        //                 $sty = "style='color: #ff0000;'";
        //             } else {
        //                 $sty = "style='color: #52ec4d;'";
        //             }
        //             $files = "";
        //             foreach ($submit["files"] as $file) {
        //                 $file_icon = [
        //                     'pdf' => 'pdf_icon',
        //                     'docx' => 'word_icon',
        //                     'doc' => 'word_icon',
        //                     'xlsx' => 'excel_icon',
        //                     'pptx' => 'ppt_icon'
        //                 ];
        //                 $burl = base_url();
        //                 $fileExtension = ['pdf', 'docx', 'xlsx', 'doc', 'pptx'];
        //                 $icon = (array_search($file['extension'], $fileExtension) !== false) ? $file_icon[$file['extension']] : "any_file_icon";
        //                 $files = $files . "
        //                 <div style='margin-left: 0px!important; margin-right: 5px; padding-right: 35px; display: flex;' class='file-item--var' value='{$file['id_tep_tin_tai_len']}' isChosen>
        //                     <img src='$burl/assets/img/$icon.png' alt=''>
        //                     <span>{$file['ten_tep']}.{$file['extension']}</span>
        //                 </div>
        //                 ";
        //             }
        //             echo "
        //                 <tr>
        //                         <td>{$idhv}</td>
        //                         <td>{$submit['ho_ten']}</td>
        //                         <td $sty>$st</td>
        //                         <td>{$submit['thoi_gian_nop']}</td>
        //                         <td style='text-align: right;'>
        //                             <div style='display: flex;
        //                             flex-direction: column;
        //                             align-items: start;'>
        //                                 $files
        //                             </div>
        //                         </td>
        //                 </tr>
        //                 ";
        //         }
        //     }
        function normalizeString(inputString) {
            // Sử dụng biểu thức chính quy để thay thế tất cả các ký tự chữ cái thành khoảng trắng
            var normalizedString = inputString.replace(/[a-zA-Z]/g, ' ');

            return normalizedString;
        }
        $(document).ready(function() {
            reloadAssignmentPage();
            $(document).on('click', '.file-item--var', function() {
                let urlParams = new URLSearchParams(window.location.search);
                let assignmentid = urlParams.get('assignmentid');
                let id_lop_hoc = <?php echo $id_lop_hoc ?>;
                $.ajax({
                    url: "<?php echo base_url() ?>/Admin/CoursesController/getFile2",
                    contentType: "text",
                    dataType: "json",
                    data: {
                        id_lop_hoc: id_lop_hoc,
                        id_file: $(this).attr('value'),
                        id_bai_tap: assignmentid
                    },
                    success: function(response) {
                        if (response.state) {
                            var binaryData = atob(response.data);
                            var byteArray = new Uint8Array(binaryData.length);
                            for (var i = 0; i < binaryData.length; i++) {
                                byteArray[i] = binaryData.charCodeAt(i);
                            }
                            var blob = new Blob([byteArray], {
                                type: 'application/octet-stream'
                            });

                            // Create a Blob object from the file data
                            // var blob = new Blob([atob(response.data)], { type: "application/octet-stream" });

                            // Create a link element
                            var link = document.createElement("a");

                            // Set the link's href attribute to a URL representing the Blob object
                            link.href = window.URL.createObjectURL(blob);

                            // Set the download attribute to the desired file name
                            link.download = response.nameFile + "." + response.extension;

                            // Append the link to the document
                            document.body.appendChild(link);

                            // Trigger a click on the link to start the download
                            link.click();

                            // Remove the link from the document
                            document.body.removeChild(link);
                        } else {
                            // Handle the case where the server returns an error
                            toast({
                                title: "Lỗi!",
                                message: response.message,
                                type: "error",
                                duration: 100000
                            });
                        }
                    },
                    error: function() {
                        // Handle AJAX error
                        toast({
                            title: "Lỗi!",
                            message: "Đã có lỗi xảy ra, vui lòng thử lại!",
                            type: "error",
                            duration: 100000
                        });
                    }
                });
            });
            let th;
            let thn;
            let ten;
            let noi_dung;

            $(`.update-btn`).click(function() {
                // loadingEffect(true);
                // Component trong table information
                let thoi_han = $(`.assignment-infor-table tr`).eq(1).find(`td`).eq(1);
                // id = id_field.text();
                let thoi_han_nop = $(`.assignment-infor-table tr`).eq(2).find(`td`).eq(1);
                // class_name = class_name_field.text();
                th = thoi_han.text();
                // let final_date_field = $(`.class-infor-table tr`).eq(4).find(`td`).eq(1);
                thn = thoi_han_nop.text();

                let ten_bai_tap = $(`.assignment-title span`);
                ten = ten_bai_tap.text();
                let content = $(`.assignment-content`);
                noi_dung = content.text();

                thoi_han.html(`
                <input class="th" type="datetime-local" value="${th}">
            `);
                thoi_han_nop.html(`
                <input class="thn" type="datetime-local" value="${thn}">
            `)
                ten_bai_tap.html(`
                <input class="assignment-title-input" type="text" value="${ten}">
            `);
                content.html(`
                <textarea class="content-textarea"></textarea>
            `)
                $(`.content-textarea`).val(noi_dung);
                $(`.save-update-assignment-div`).css(`position`, `static`);
                $(`.save-update-assignment-div`).css(`z-index`, `1`);
                $(`.cancel-update-assignment-div`).css(`position`, `static`);
                $(`.cancel-update-assignment-div`).css(`z-index`, `1`);

                let updatebtn = $(`.update-btn`);
                updatebtn.prop(`disabled`, true);
                updatebtn.removeClass(`highlight-button`);
                updatebtn.addClass(`highlight-button--disable`);
            });
            $(`.cancel-update-assignment-btn`).click(function() {
                if (!window.confirm("Hủy bỏ thông tin chỉnh sửa hiện tại?")) {
                    return;
                }
                $(`.assignment-infor-table tr`).eq(1).find(`td`).eq(1).html(th);
                $(`.assignment-infor-table tr`).eq(2).find(`td`).eq(1).html(thn);
                $(`.assignment-title span`).text(ten);
                $(`.assignment-content`).text(noi_dung);

                $(`.save-update-assignment-div`).css(`position`, `absolute`);
                $(`.save-update-assignment-div`).css(`z-index`, `-1`);
                $(`.cancel-update-assignment-div`).css(`position`, `absolute`);
                $(`.cancel-update-assignment-div`).css(`z-index`, `-1`);

                let updatebtn = $(`.update-btn`);
                updatebtn.prop(`disabled`, false);
                updatebtn.removeClass(`highlight-button--disable`);
                updatebtn.addClass(`highlight-button`);
            });
            $(`.save-update-assignment-btn`).click(function() {
                if (!window.confirm("Lưu thông tin chỉnh sửa hiện tại?")) {
                    return;
                }
                // Lấy dữ liệu bỏ vào obj
                loadingEffect(true);
                var urlParams = new URLSearchParams(window.location.search);
                // var param1Value = urlParams.get('courrseid');
                let assignmentid = urlParams.get('assignmentid');
                let assignment = {
                    id_bai_tap: assignmentid * 1,
                    th: normalizeString($(`.th`).val()),
                    thn: normalizeString($(`.thn`).val()),
                    ten: $(`.assignment-title-input`).val(),
                    noi_dung: $(`.content-textarea`).val()
                }
                console.log(assignment);
                assignmentData = JSON.stringify(assignment);
                $.ajax({
                    url: `<?php echo base_url() ?>/Admin/CoursesController/updateAssignment`,
                    method: 'POST',
                    contentType: 'json', // Đặt kiểu dữ liệu của yêu cầu là JSON
                    dataType: "json",
                    data: assignmentData,
                    success: function(response) {
                        loadingEffect(false);
                        if (response.state) {
                            toast({
                                title: "Thành công!",
                                message: `Cập nhật thông tin thành công!`,
                                type: "success",
                                duration: 100000
                            });
                            $(`.save-update-assignment-div`).css(`position`, `absolute`);
                            $(`.save-update-assignment-div`).css(`z-index`, `-1`);
                            $(`.cancel-update-assignment-div`).css(`position`, `absolute`);
                            $(`.cancel-update-assignment-div`).css(`z-index`, `-1`);

                            let updatebtn = $(`.update-btn`);
                            updatebtn.prop(`disabled`, false);
                            updatebtn.removeClass(`highlight-button--disable`);
                            updatebtn.addClass(`highlight-button`);
                            reloadAssignmentPage();
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
        })
    </script>

</div>