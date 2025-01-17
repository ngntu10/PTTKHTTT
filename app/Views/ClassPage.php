<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php base_url()?>/assets/common/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Danh sách lớp học</title>
</head>
<body>
    <div class="logo card p-4 m-2 shadow-sm">
        <div>
            <img class="logo" src="<?php base_url()?>/assets/img/logocourse.png" alt="Logo">
        </div>

    </div>

    <div class="main">
        <div class="title w-100 text-center text-uppercase">
            <h1>Danh sách lớp học</h1>
        </div>

        <div class="class-container">
            <div class="me-2 d-flex justify-content-end">
                <input type="text" class="w-25 form-control" placeholder="Tìm khóa học">
                <button class="btn btn-info"><i class="fas fa-search" style="color: #000000;"></i></button>
            </div>
  
            <div class="class__list card p-4 m-2 mt-3 shadow-inset">
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Lập trình .NET</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Mai Xuân Hùng</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--inprocess">Đang diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Công nghệ Java</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Vũ Minh Sang</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--inprocess">Đang diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Cơ sở dữ liệu phân tán</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Nguyền Hồ Duy Tri</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--upcoming">Sắp diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Lập trình .NET</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Mai Xuân Hùng</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--inprocess">Đang diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Công nghệ Java</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Vũ Minh Sang</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--inprocess">Đang diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Cơ sở dữ liệu phân tán</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Nguyền Hồ Duy Tri</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--upcoming">Sắp diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Lập trình .NET</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Mai Xuân Hùng</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--inprocess">Đang diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Công nghệ Java</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Vũ Minh Sang</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--inprocess">Đang diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">Cơ sở dữ liệu phân tán</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Giảng viên: Nguyền Hồ Duy Tri</h6>
                                <div class="my-5"></div>
                                <p class="card-text mb-1">Thời gian: 01/09/2023 - 10/12/2023</p>
                                <p class="card-text">Trạng thái: <span class="class__item--upcoming">Sắp diễn ra</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>