<?php 

    require_once 'header.php'; 
    if ($_SESSION['group'] != "student") {
        
        echo "<h1><b class='text-danger'>คุณไม่ใช่นักเรียน</b></h1>";
        exit;
    }

    $sql = "SELECT course.cou_name , course.cou_class , course.cou_path
    FROM register_course
    INNER JOIN course ON register_course.cou_id = course.cou_id 
    WHERE register_course.identifier=:code";
    $couData = $conn->prepare($sql);
    $couData->bindParam(":code", $user);
    $couData->execute();
    $ArrayCouData = $couData->fetchAll();

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
                        <th>ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ArrayCouData as $v) { ?>
                    <tr>
                        <td><?php echo $v['cou_name'] ?></td>
                        <td><?php echo "ชั้นมัธยมศึกษาปีที่ ".$v['cou_class'] ?></td>
                        <td>
                            <a class="btn btn-primary" style="width: 6rem" href="../assets/video/<?php echo $v['cou_path'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z"/>
                                </svg>
                                ดูวิดีโอ
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php require_once 'footer.php'; ?>