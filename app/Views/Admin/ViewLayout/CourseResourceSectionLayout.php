<div class="content-section">
    <h3 style="margin-right: 14px; margin-top: 17px; margin-left: 27px; display: flex; align-items: center; justify-content: space-between;">Tài nguyên lớp học</h3>
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

    function rerenderCourseResources() {
        loadingEffect(true);
        let data = new FormData();
        data.append("id_lop_hoc", id_lop_hoc);
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
                                        <img src="<?php echo base_url() ?>/assets/img/link_icon.png" style="height: 14px; margin-bottom: 2px;" alt="">
                                        <a href="${links[a]["link"]}" style="text-decoration: none; color: #2C2C2C;">${links[a]["tieu_de"]}</a>
                                        <span class="item-details">Đã đăng vào ${links[a]["ngay_dang"]} bởi ${links[a]["ho_ten"]}</span>
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
                                        <img src="<?php echo base_url() ?>/assets/img/${fileExtension.indexOf(files[c]['extension']) !== -1 ? file_icon[files[c]['extension']] : 'any_file_icon' }.png" style="height: 14px; margin-bottom: 2px;" alt="">
                                        <span class="file-title" id="${files[c]['id_tep_tin_tai_len']}">${files[c]['ten_tep']}.${files[c]['extension']}</span>
                                        <span class="item-details">Đã đăng ${files[c]['ngay_dang']} bởi ${files[c]['ho_ten']}</span>
                                    </h5>
                                </div>
                            `);
                            c++;
                            break;
                        case 3:
                            $(`.folder[id="${assignments[d]["id_muc"]}"]`).prepend(`
                                <div class="resource-item assignment-variant">
                                    <h5 class="assignment-variant__title" href="">
                                        <img src="<?php echo base_url() ?>/assets/img/assignment_icon.png" style="height: 14px; margin-bottom: 2px;" alt="">
                                        <a href="<?php echo base_url() ?>//resource/assignment?assignmentid=${assignments[d]["id_bai_tap"]}" style="text-decoration: none; color: #2C2C2C;">${assignments[d]["ten"]}</a>
                                        <span class="item-details">Đã đăng ${assignments[d]['ngay_dang']} bởi ${assignments[d]['ho_ten']}</span>
                                    </h5>
                                </div>
                            `);
                            d++
                            break;
                    }
                }
            }
        })
    }
    $(document).ready(function() {
        console.log(id_lop_hoc);
        rerenderCourseResources();
    })
    $(document).on('click', '.file-variant .file-title', function() {
        console.log($(this).prop('id'));
        console.log(id_lop_hoc);
    $.ajax({
        url: "<?php echo base_url()?>/Admin/CoursesController/getFile",
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
                    var blob = new Blob([byteArray], { type: 'application/octet-stream' });

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