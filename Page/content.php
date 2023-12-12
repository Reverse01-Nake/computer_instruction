<?php require_once 'header.php'; 
    if ($_SESSION['group'] === "student") {
            
        echo "<h1><b class='text-danger'>คุณไม่ใช่อาจารย์!!</b></h1>";
        exit;
    }

    $mycou = "SELECT course.cou_id, course.cou_name, course.cou_class, course.cou_path FROM course WHERE course.identifier=:code";
    $mycou = $conn->prepare($mycou);
    $mycou->bindParam(":code", $user);
    $mycou->execute();
    $Arraymycou = $mycou->fetchAll();
?>

    <div class="card">
        <div class="card-header bg-light" style="border-radius: 20px 20px 0 0;">
            <h3 class="card-title" style="font-size: 1.3em;font-weight: 600;">หลักสูตรที่ลงทะเบียน</h3>
        </div>
        <div class="card-body">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ชื่อบทเรียน</th>
                        <th>ชั้นปี</th>
                        <th style="width: 31rem;">ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Arraymycou as $v) { ?>
                    <tr>
                        <td><?php echo $v['cou_name'] ?></td>
                        <td><?php echo $v['cou_class'] ?></td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-warning me-2" onclick="EditCou('<?php echo $v['cou_id']; ?>','<?php echo $v['cou_name']; ?>', '<?php echo $v['cou_class']; ?>')" data-bs-toggle="modal" data-bs-target="#editcou">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                    แก้ไข
                                </button>
                                <form action="../backend.php" method="post">
                                    <input type="hidden" name="cou_id" value="<?php echo $v['cou_id'] ?>">
                                    <button type="submit" class="btn btn-danger  me-2" name="DelCou">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                        </svg>
                                        ลบ
                                    </button>
                                </form>
                                <a class="btn btn-primary  me-2" href="../assets/video/<?php echo $v['cou_path'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z"/>
                                    </svg>
                                    ดูวิดีโอ
                                </a>
                                <button type="button" class="btn btn-success  me-2" onclick="AddQ('<?php echo $v['cou_id']; ?>','<?php echo $v['cou_name']; ?>')" data-bs-toggle="modal" data-bs-target="#add-q">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    เพิ่มคำถาม
                                </button>
                                <a class="btn btn-info  me-2" href="connentq.php?cou_id=<?php echo $v['cou_id']?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                    เช็คทดสอบ
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addcou">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
            </svg>
            เพิ่มบทเรียน
            </button>
        </div>
    </div>

    <div class="modal fade" id="addcou" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content t-login">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มบทเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../backend.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">ชื่อบทเรียน</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ชั้นปี</label>
                            <input type="text" class="form-control" name="class">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">วิดีโอสอน</label>
                            <input type="file" class="form-control mb-1" name="video">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" value="Upload" name="addcou">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editcou" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content t-login">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มบทเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../backend.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">ชื่อบทเรียน</label>
                            <input type="hidden" class="form-control" name="cou_id" id="cou_id">
                            <input type="text" class="form-control" name="cou_name" id="cou_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ชั้นปี</label>
                            <input type="text" class="form-control" name="cou_class" id="cou_class">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">วิดีโอสอน</label>
                            <input type="file" class="form-control mb-1" name="video">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" value="Upload" name="editcou">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-q" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content t-logins">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มคำถาม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../backend.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <p class="mb-3" id="pNameAddq"></p>
                        <input type="hidden" id="cou_idNameAddq" name="id">
                        <label>ชื่อหัวข้อ</label>
                        <input type="text" class="form-control mb-2" name="name">
                        <label>หมวดหมู่</label>
                        <select class="form-select col-6 mb-2" name="type">
                            <option selected="1">ก่อนเรียน</option>
                            <option value="2">ระหว่างเรียน</option>
                            <option value="3">หลังเรียน</option>
                        </select>
                        <label>คำถาม</label>
                        <input type="text" class="form-control mb-2" name="q">
                        <label>คำตอบ</label>
                        <input type="text" class="form-control mb-1" name="a1" placeholder="ตัวเลือกที่ 1">
                        <input type="text" class="form-control mb-1" name="a2" placeholder="ตัวเลือกที่ 2">
                        <input type="text" class="form-control mb-1" name="a3" placeholder="ตัวเลือกที่ 3">
                        <input type="text" class="form-control mb-1" name="a4" placeholder="ตัวเลือกที่ 4">

                        <label>คำถามที่ถูก</label>
                        <select class="form-select col-6 mb-2" name="ans">
                            <option selected="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" value="addq" name="addq">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once 'footer.php'; ?>