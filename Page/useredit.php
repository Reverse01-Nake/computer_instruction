<?php require_once 'header.php'; ?>
    <div class="card">
        <div class="card-header bg-light flex" style="border-radius: 20px 20px 0 0; position: relative;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            <h3 class="card-title" style="margin:0; font-size: 1.3em;font-weight: 600;">แก้ไขข้อมูลส่วนตัว</h3>
            <div class="flex">
                <label class="" for="">รหัสประจำตัว:&nbsp;&nbsp;</label>
                <p class="col" style="margin:0;"><?php echo $row["identifier"] ?></p>
                <?php if ($_SESSION['group'] === "student") { ?>
                    <label class="" for="">&nbsp;&nbsp;&nbsp;&nbsp;เลขที่:&nbsp;&nbsp;</label>
                    <p class="col" style="margin:0;"><?php echo "[ ". $row["number"] ." ]" ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <form action="../backend.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-2">
                        <label class="form-label">คำนำหน้า</label>
                        <div class="mb-3">
                            <select class="form-select col-12" name="prefix">
                                <option selected="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-5 mb-3">
                        <label class="form-label">ชื่อจริง</label>
                        <input class="form-control" type="text" value="<?php echo $row["firstname"] ?>" name="firstname">
                    </div>
                    <div class="col-5 mb-3">
                        <label class="form-label">นามสกุล</label>
                        <input class="form-control" type="text" value="<?php echo $row["lastname"] ?>" name="lastname">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label class="form-label">เพศ</label>
                        <div class="mb-3">
                            <select class="form-select" name="sex">
                                <?php if ($row["prefix"] === "ชาย") { ?>
                                    <option selected="ชาย">ชาย</option>
                                <?php } else { ?>
                                    <option selected="หญิง">หญิง</option>
                                <?php } ?>
                                <option value="หญิง">หญิง</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="form-label">อายุ</label>
                        <input class="form-control" type="number" value="<?php echo $row["old"] ?>" name="old">
                    </div>
                    <div class="col">
                        <label class="form-label">อีเมล</label>
                        <input class="form-control" type="email" value="<?php echo $row["email"] ?>" name="email">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <label class="form-label col-12">โปร์ไฟล์</label></label>
                                <input class="form-control" type="file" name="image">
                            </div>
                            <div class="col-4">
                                <label class="form-label col-12">เบอร์ติดต่อ</label>
                                <input class="form-control" type="text" value="<?php echo $row["phone_number"] ?>" name="phone_number">
                            </div>
                            <div class="col-5">
                                <label class="form-label col-12">รหัสผ่าน</label>
                                <input class="form-control" type="password" value="" name="password">
                            </div>
                        </div>
                    </div>
                </div><hr>
                <button type="submit" class="col btn btn-primary" name="editUser">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>ยืนยัน
                </button>
            </form>
        </div>
    </div>
<?php require_once 'footer.php'; ?>