<?php
    require_once 'config/connectDB.php';
    session_start();
    if (isset($_SESSION['user'])) {
        try {
            $check_code = $conn->prepare("SELECT * FROM users WHERE identifier = :code");
            $check_code->bindParam(":code", $_SESSION['user']);
            $check_code->execute();
            $row = $check_code->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คอมพิวเตอร์ช่วยสอน วิทยาการคำนวณ</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/Logo.png" />
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css" />

</head>
<body class="homePage">
    <div class="heaDer">
        <a href="index.php">HOME</a>
        <?php if (isset($_SESSION['user'])) { ?>
            <?php if ($row["group"] === "student") { ?>
                <a href="Page/dashboard.php" onclick="Page('dashboard')">DASHBOARD</a>
            <?php } else if ($row["group"] === "teacher") { ?>
                <a href="Page/dashboard-t.php" onclick="Page('dashboard')">DASHBOARD</a>
            <?php } ?>
        <?php } else { ?>
            <a href="Page/dashboard.php" onclick="Page('dashboard')">DASHBOARD</a>
        <?php } ?>
        <a href="" data-bs-toggle="modal" data-bs-target="#s-login">LOGIN</a>
        <a href="" data-bs-toggle="modal" data-bs-target="#s-register">REGISTER</a>
    </div>
    <div class="homeMain">
        <div class="homeBox">
            <div class="homeButton">
                <h1>คอมพิวเตอร์ช่วยสอน</h1>
                <h2 style="padding-left: 8px;">วิทยาการคำนวณ</h2>
            </div>
            <div class="homeButton">
                <button type="button" class="btn btn-light btn-rol btn-rols" data-bs-toggle="modal" data-bs-target="#s-login"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                    </svg> นักเรียน
                </button>
                <button type="button" class="btn btn-light btn-rol alfa" data-bs-toggle="modal" data-bs-target="#t-login"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-video3" viewBox="0 0 16 16">
                    <path d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z"/>
                    <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z"/>
                    </svg> อาจารย์
                </button>
            </div>
        </div>
        <div class="homeBox">
            <img src="assets/images/hero-img.png" alt="" style="width: 80vh;">
        </div>
    </div>

    <?php if (isset($_SESSION['success'])) {?>
        <div class="alert alert-success a-h" style="display: flex;" role="alert" id="alert">
            <p style="margin: 0;">
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </p>
            <button type="button" class="btn-close" style="margin-left: 3rem; padding: .25rem;" onclick="CloseAlert()"></button>
        </div>
    <?php } ?>  
    <?php if (isset($_SESSION['error'])) {?>
        <div class="alert alert-danger a-h" style="display: flex;" role="alert" id="alert">
            <p style="margin: 0;">
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </p>
            <button type="button" class="btn-close" style="margin-left: 3rem; padding: .25rem;" onclick="CloseAlert()"></button>
        </div>
    <?php } ?>  

    <div class="modal fade" id="s-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content s-login">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบนักเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="backend.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">รหัสนักเรียน</label>
                            <input type="text" class="form-control" name="id">
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="Password" name="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">จดจำฉันไว้</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div style="position: absolute; left: 1rem;">
                            <p type="button" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#s-register"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg> สมัครสมาชิก
                            </p>
                        </div>
                        <input type="hidden" name="student">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" name="login">เข้าสู่ระบบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="s-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content s-register">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิกนักเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="backend.php" method="post">
                    <div class="modal-body">
                        <div class="col-12 mb-3">
                                <input type="text" class="form-control" name="id" placeholder="รหัสประจำตัว">
                            </div>
                        <div class="row">
                            <div class="col-3 mb-3">
                                <select class="form-select col-6" name="prefix">
                                    <option selected="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="col-9 mb-3" style="padding-left: 0;">
                                <input type="text" class="form-control" name="fistname" placeholder="ชื่อจริง">
                            </div>
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" name="lastname" placeholder="นามสกุล">
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-select col-6" name="sex">
                                    <option selected="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control" name="old" placeholder="อายุ">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="อีเมล">
                            <div id="emailHelp" class="form-text">กรุณากรอกอีเมลของท่าน @lru.ac.th</div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="password" class="form-control" name="c_password" placeholder="ยืนยันรหัสผ่าน">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-text col-6" style="color: #000;">ชั้นเรียน</label>
                                <div class="col-12 mb-3">
                                    <select class="form-select col-6" name="class">
                                        <option selected="1">มัธยมศึกษาปีที่ 1</option>
                                        <option value="2">มัธยมศึกษาปีที่ 2</option>
                                        <option value="3">มัธยมศึกษาปีที่ 3</option>
                                        <option value="4">มัธยมศึกษาปีที่ 4</option>
                                        <option value="5">มัธยมศึกษาปีที่ 5</option>
                                        <option value="6">มัธยมศึกษาปีที่ 6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-text col-6" style="color: #000;">ห้องเรียน</label>
                                <div class="col-12 mb-3">
                                    <select class="form-select col-6" name="room">
                                        <option selected="1">ห้อง 1</option>
                                        <option value="2">ห้อง 2</option>
                                        <option value="3">ห้อง 3</option>
                                        <option value="4">ห้อง 4</option>
                                        <option value="5">ห้อง 5</option>
                                        <option value="6">ห้อง 6</option>
                                        <option value="7">ห้อง 7</option>
                                        <option value="8">ห้อง 8</option>
                                        <option value="9">ห้อง 9</option>
                                        <option value="10">ห้อง 10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 mb-3">
                                <input type="number" class="form-control" name="number" placeholder="เลขที่">
                            </div>
                            <div class="col-9 mb-3">
                                <input type="text" class="form-control" name="phone_number" placeholder="เบอร์ติดต่อ">
                            </div>
                        </div><hr>
                        <div class="mb-3 form-check col">
                            <a href="#">อ่านข้อตกลง</a>
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">เข้าใจแล้ว</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" name="register">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="t-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content t-login">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบอาจารย์</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="backend.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">รหัสประจำตัว</label>
                            <input type="text" class="form-control" name="id">
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="Password" name="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">จดจำฉันไว้</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="teacher">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" name="login">เข้าสู่ระบบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>