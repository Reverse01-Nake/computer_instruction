<?php 
    require_once 'header.php'; 
    if ($_SESSION['group'] != "student") {
        
        echo "<h1><b class='text-danger'>คุณไม่ใช่นักเรียน</b></h1>";
        exit;
    }

    $sql = "SELECT register_course.pretest, register_course.test_during, register_course.posttest, register_course.cou_id, course.cou_name , course.cou_class , course.cou_path
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
                        <th style="width: 22rem;">ชื่อบทเรียน</th>
                        <th>คะแนนก่อนเรียน</th>
                        <th>คะแนนระหว่างเรียน</th>
                        <th>คะแนนหลังเรียน</th>
                        <th>ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ArrayCouData as $v) { ?>
                    <tr>
                        <td><?php echo $v['cou_name'] ?></td>
                        <td><?php echo $v['pretest'] ?></td>
                        <td><?php echo $v['test_during'] ?></td>
                        <td><?php echo $v['posttest'] ?></td>
                        <td>
                            <?php
                                if ($v['pretest']=='NaN') {
                                    $t=1;
                                } else if ($v['test_during']=='NaN') {
                                    $t=2;
                                } else if ($v['posttest']=='NaN') {
                                    $t=3;
                                } else {
                                    $t=4;
                                }
                            ?>
                            <?php if ($v['pretest']=='NaN') {?>
                                <a class="btn btn-primary" href="quizs.php?cou_id=<?php echo $v['cou_id'].'&types=1' ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    แบบทดสอบก่อนเรียน
                                </a>
                            <?php } else if ($v['test_during']=='NaN') { ?>
                                <a class="btn btn-primary" href="quizs.php?cou_id=<?php echo $v['cou_id'].'&types=2' ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    แบบทดสอบระหว่างเรียน
                                </a>
                            <?php } else if ($v['posttest']=='NaN') { ?>
                                <a class="btn btn-primary" href="quizs.php?cou_id=<?php echo $v['cou_id'].'&types=3' ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    แบบทดสอบหลังเรียน
                                </a>
                            <?php } else { ?>
                                <a class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    แบบทดสอบหมดแล้ว
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php require_once 'footer.php'; ?>