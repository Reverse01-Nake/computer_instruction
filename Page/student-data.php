<?php require_once 'header.php'; 
    if ($_SESSION['group'] === "student") {
            
        echo "<h1><b class='text-danger'>คุณไม่ใช่อาจารย์!!</b></h1>";
        exit;
    }

    // กำหนดคลอสที่อาจารย์เป็นเจ้าของ
    $mycou = "SELECT course.cou_id, course.cou_name FROM course WHERE course.identifier=:code";
    $mycou = $conn->prepare($mycou);
    $mycou->bindParam(":code", $user);
    $mycou->execute();
    $Arraymycou = $mycou->fetchAll();

    $regcou = "SELECT register_course.cou_id, register_course.identifier, users.prefix, users.firstname, users.lastname, users.sex, users.class ,users.number
    FROM register_course
    INNER JOIN users ON register_course.identifier = users.identifier";
    $regcou = $conn->prepare($regcou);
    $regcou->execute();
    $Arrayregcou = $regcou->fetchAll();


?>

    <div class="card">
        <div class="card-header bg-light" style="border-radius: 20px 20px 0 0;">
            <h3 class="card-title" style="font-size: 1.3em;font-weight: 600;">ข้อมูลนักเรียน</h3>
        </div>
        <div class="card-body">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>รหัสประจำตัวนักเรียน</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>เพศ</th>
                        <th>ชั้น</th>
                        <th>เลขที่</th>
                        <th>ครอสที่เรียน</th>
                        <th>ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($Arrayregcou as $v) {
                            foreach ($Arraymycou as $couitem) {
                                if ($v['cou_id'] === $couitem['cou_id']) {
                                ?>
                                <tr>
                                    <td><?php echo $v['identifier'] ?></td>
                                    <td><?php echo $v['prefix']." ".$v['firstname']." ".$v['lastname'] ?></td>
                                    <td><?php echo $v['sex'] ?></td>
                                    <td><?php echo $v['class'] ?></td>
                                    <td><?php echo $v['number'] ?></td>
                                    <td><?php echo $couitem['cou_name'] ?></td>
                                    <td>
                                        <form action="../backend.php" method="post">
                                            <input type="hidden" name="identifier" value="<?php echo $v['identifier'] ?>">
                                            <input type="hidden" name="cou_id" value="<?php echo $v['cou_id'] ?>">
                                            <button type="submit" class="btn btn-danger" name="DelStd">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                </svg>
                                                ลบ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        } 
                    ?>
                </tbody>
            </table>

            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addStd">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                เพิ่มนักเรียน
            </button>
        </div>
    </div>
    <div class="modal fade" id="addStd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content t-login">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มนักเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../backend.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">รหัสประจำตัว</label>
                            <input type="text" class="form-control" name="id">
                        </div>
                        <div class="col-12 mb-3">
                            <select class="form-select col-6" name="course">
                                <option selected="error">กรุณาเลือก</option>
                                <?php foreach ($Arraymycou as $v) { ?>
                                    <option value="<?php echo $v['cou_id'] ?>"><?php echo $v['cou_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" name="addstd">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once 'footer.php'; ?>