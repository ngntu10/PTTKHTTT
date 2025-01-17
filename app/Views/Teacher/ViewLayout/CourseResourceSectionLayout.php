<div class="content-section">
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;" class="root-folder-title">Tài nguyên lớp học
        <div class="component-container con" style="width: 62px; display: flex; justify-content: space-around; align-items: center; opacity: 0%; transition: 0.4s;">
            <button class="add-item-btn highlight-button add-item-btn--root">
                <i class="fa-solid fa-plus add-class-icon highlight-icon" style="margin-left: 0px!important;"></i>
            </button>
            <button class="delete-folder-btn highlight-button--cancel delete-folder-btn--root" style="">
                <i class="fa-solid fa-x highlight-icon--cancel" style="font-size: 12px!important; margin-left: 0px!important;"></i>
            </button>
        </div>
    </h3>
    <div class="root-folder folder" id="">
    </div>
</div>
<script>
    function findMinDatetimeIndex(datetime1, datetime2, datetime3, datetime4) {

        const datetimes = [datetime1, datetime2, datetime3, datetime4];

        let minDatetime = null;
        let minIndex = null;

        datetimes.forEach((datetime, index) => {
            // Kiểm tra nếu datetime không phải là null hoặc undefined
            if (datetime !== null && datetime !== undefined) {
                const currentDatetime = new Date(datetime);

                // Nếu maxDatetime chưa có giá trị hoặc giá trị mới lớn hơn giá trị max
                if (minDatetime === null || currentDatetime < minDatetime) {
                    minDatetime = currentDatetime;
                    minIndex = index;
                }
            }
        });

        return minIndex;
    }

    function compareObjects(a, b) {
        return a.id_muc - b.id_muc;
    }
    let id_lop_hoc = <?php echo $id_lop_hoc ?>;
    let links = null;
    let notis = null;
    let files = null;
    let assignments = null;

    async function rerenderCourseResources(id_muc = null) {
        loadingEffect(true);
        let data = new FormData();
        data.append("id_lop_hoc", id_lop_hoc);
        $(`.root-folder`).empty();
        // get folders
        $.ajax({
            url: "<?php echo base_url() ?>/Admin/CoursesController/getResources",
            contentType: false,
            type: "POST",
            processData: false,
            dataType: "json",
            data: data,
            success: function(response) {
                if (response.hasOwnProperty('error')) {
                    console.log(response.error);
                    loadingEffect(false);
                    return;
                }
                let folders = response['folders'];
                folders.sort(compareObjects);
                loadingEffect(false);
                console.log(response);
                $(`.root-folder`).prop('id', folders[0].id_muc)
                let i = 0;
                for (let folder of folders) {
                    if (i !== 0) {
                        let parent = $(`.folder[id="${folder.id_muc_cha}"]`);
                        console.log(parent);
                        parent.append(`
                            <div class="children-folder folder" id="${folder.id_muc}">
                                <div class="children-folder__component-container">
                                    <div class="children-folder__name">
                                        ${folder.ten_muc}
                                    </div>
                                    <div class="component-container con" style="width: 62px; display: flex; justify-content: space-around; align-items: center; opacity: 0%; transition: 0.4s;">
                                        <button class="add-item-btn highlight-button add-item-btn--children">
                                            <i class="fa-solid fa-plus add-class-icon highlight-icon" style="margin-left: 0px!important;"></i>
                                        </button>
                                        <button class="delete-folder-btn highlight-button--cancel delete-folder-btn--children" style="">
                                            <i class="fa-solid fa-x highlight-icon--cancel" style="font-size: 12px!important; margin-left: 0px!important;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                    i++;
                }
                // 
                links = response["links"];
                notis = response["notis"];
                files = response["files"];
                assignments = response["assignments"];
                console.log(links);
                console.log(notis);
                console.log(files);
                console.log(assignments);
                let totalItems = links.length + notis.length + files.length + assignments.length;
                console.log(totalItems);
                let a = 0;
                let b = 0;
                let c = 0;
                let d = 0;
                links.push(null);
                notis.push(null);
                files.push(null);
                assignments.push(null);
                let file_icon = {
                    pdf: 'pdf_icon',
                    docx: 'word_icon',
                    doc: 'word_icon',
                    xlsx: 'excel_icon',
                    pptx: 'ppt_icon'
                }
                let fileExtension = ['pdf', 'docx', 'xlsx', 'doc', 'pptx'];
                for (let i = 0; i < totalItems; i++) {
                    let highestPostTimeItem = findMinDatetimeIndex(links[a] === null ? null : links[a]['ngay_dang'], notis[b] === null ? null : notis[b]['ngay_dang'], files[c] === null ? null : files[c]['ngay_dang'], assignments[d] === null ? null : assignments[d]['ngay_dang']);
                    switch (highestPostTimeItem) {
                        case 0:
                            $(`.folder[id="${links[a]["id_muc"]}"]`).prepend(`
                               <div class="resource-item link-variant">
                                    <h5 class="link-variant__title">
                                        <span class="content-panel">
                                        <img src="<?php echo base_url() ?>/assets/img/link_icon.png" style="height: 14px; margin-bottom: 2px;" alt="">
                                        <a href="${links[a]["link"]}" style="text-decoration: none; color: #2C2C2C;">${links[a]["tieu_de"]}</a>
                                        <span class="item-details">Đã đăng vào ${links[a]["ngay_dang"]} bởi ${links[a]["ho_ten"]}</span>
                                        <i value="${links[a]["id_duong_link"]}" type="link" class='fa-solid fa-x delete-resource-btn' style='z-index:100; font-size: 11px!important;'></i>
                                        </span>
                                    </h5>
                                </div>
                            `);
                            a++;
                            break;
                        case 1:
                            $(`.folder[id="${notis[b]["id_muc"]}"]`).prepend(`
                                <div class="resource-item notification-variant">
                                    <h5 class="notification-variant__title">
                                        <span class="content-panel">
                                            <i class="bi bi-chat-left-text"></i>
                                            <span class="noti-title"> ${notis[b]["tieu_de"]} </span>
                                            <span class="item-details">Đã đăng vào ${notis[b]["ngay_dang"]} bởi ${notis[b]["ho_ten"]}</span>
                                            <i value="${notis[b]["id_thong_bao"]}" type="noti" class='fa-solid fa-x delete-resource-btn' style='z-index:100; font-size: 11px!important;'></i>
                                        </span>
                                    </h5>
                                    <p class="notification-variant__content">${notis[b]["noi_dung"]}</p>
                                </div>

                            `);
                            b++
                            break;
                        case 2:
                            $(`.folder[id="${files[c]["id_muc"]}"]`).prepend(`
                                <div class="resource-item file-variant">
                                    <h5 class="file-variant__title">
                                    <span class="content-panel">
                                        <img src="<?php echo base_url() ?>/assets/img/${fileExtension.indexOf(files[c]['extension']) !== -1 ? file_icon[files[c]['extension']] : 'any_file_icon' }.png" style="height: 14px; margin-bottom: 2px;" alt="">
                                        <span class="file-title" id="${files[c]['id_tep_tin_tai_len']}">${files[c]['ten_tep']}.${files[c]['extension']}</span>
                                        <span class="item-details">Đã đăng ${files[c]['ngay_dang']} bởi ${files[c]['ho_ten']}</span>
                                        <i value="${files[c]["id_tep_tin_tai_len"]}" type="file" class='fa-solid fa-x delete-resource-btn' style='z-index:100; font-size: 11px!important;'></i>
                                    </span>
                                    </h5>
                                </div>
                            `);
                            c++;
                            break;
                        case 3:
                            $(`.folder[id="${assignments[d]["id_muc"]}"]`).prepend(`
                                <div class="resource-item assignment-variant">
                                    <h5 class="assignment-variant__title" href="">
                                    <span class="content-panel">
                                        <img src="<?php echo base_url() ?>/assets/img/assignment_icon.png" style="height: 14px; margin-bottom: 2px;" alt="">
                                        <a href="<?php echo base_url() ?>//resource/assignment?assignmentid=${assignments[d]["id_bai_tap"]}" style="text-decoration: none; color: #2C2C2C;">${assignments[d]["ten"]}</a>
                                        <span class="item-details">Đã đăng ${assignments[d]['ngay_dang']} bởi ${assignments[d]['ho_ten']}</span>
                                        <i value="${assignments[d]["id_bai_tap"]}" type="assignment" class='fa-solid fa-x delete-resource-btn' style='z-index:100; font-size: 11px!important;'></i>
                                        </span>
                                    </h5>
                                </div>
                            `);
                            d++
                            break;
                    }
                }
                if (id_muc !== null) {
                    let targetElement = $(`.folder[id="${id_muc}"]`)[0];
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                            inline: 'nearest'
                        });
                    }
                }
            }
        })
    }
    $(document).ready(function() {
        console.log(id_lop_hoc);
        rerenderCourseResources();

    })
    $(document).on('click', '.delete-resource-btn', function() {
        if (!confirm("Xác nhận xóa tài nguyên này?")) {
            return;
        }
        loadingEffect(true);
        var urlParams = new URLSearchParams(window.location.search);
        // var param1Value = urlParams.get('courrseid');
        let id_lop_hoc = urlParams.get('courseid');
        let id_muc = $(this).parent().parent().parent().parent().attr("id");
        console.log(id_muc);
        let type = $(this).attr("type");
        let id = ($(this).attr("value"));
        $.ajax({
            url: "<?php echo base_url() ?>/Admin/CoursesController/removeResource",
            contentType: "text",
            dataType: "json",
            data: {
                type: type,
                id: id,
                id_muc: id_muc,
                id_lop_hoc: id_lop_hoc
            },
            success: function(response) {
                loadingEffect(false);
                if (response.state) {
                    rerenderCourseResources(id_muc);
                    toast({
                        title: "Thành công!",
                        message: response.message,
                        type: "success",
                        duration: 100000
                    });
                } else {
                    toast({
                        title: "Lỗi!",
                        message: response.message,
                        type: "error",
                        duration: 100000
                    });
                }
            },
            error: function() {
                toast({
                    title: "Lỗi!",
                    message: "Đã có lỗi xảy ra, vui lòng thử lại!",
                    type: "error",
                    duration: 100000
                });
            }


        })
    });

    $(document).on('click', '.add-item-btn--root', function() {
        loadingEffect(true);
        $.ajax({
            url: "<?php echo base_url() ?>/Admin/CoursesController/getAddResourceIntoCourseForm",
            // contentType: "text",
            dataType: "text",
            success: function(response) {
                loadingEffect(false);
                $('body').append(response);
                $(`.insert-resource-form`).attr(`value`, $(`.root-folder`).attr(`id`));
                $('.insert-resource-form__cancel-btn').click(function() {
                    if (confirm("Hủy bỏ thao tác hiện tại?")) {
                        $(`.form-container`).remove();
                    }
                })
            }
        })


    });
    $(document).on('click', '.add-item-btn--children', function() {
        loadingEffect(true);
        $btn = $(this);
        $.ajax({
            url: "<?php echo base_url() ?>/Admin/CoursesController/getAddResourceIntoCourseForm",
            // contentType: "text",
            dataType: "text",
            success: function(response) {
                loadingEffect(false);
                $('body').append(response);
                $(`.insert-resource-form`).attr(`value`, $btn.parent().parent().parent().attr(`id`));
                $('.insert-resource-form__cancel-btn').click(function() {
                    if (confirm("Hủy bỏ thao tác hiện tại?")) {
                        $(`.form-container`).remove();
                    }
                })
            }
        })


    });
    $(document).on('click', '.file-variant .file-title', function() {
        console.log($(this).prop('id'));
        console.log(id_lop_hoc);
        $.ajax({
            url: "<?php echo base_url() ?>/Admin/CoursesController/getFile",
            contentType: "text",
            dataType: "json",
            data: {
                id_lop_hoc: id_lop_hoc,
                id_file: $(this).prop('id')
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
</script>