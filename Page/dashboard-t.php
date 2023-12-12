<?php require_once 'header.php'; 
    if ($_SESSION['group'] === "student") {
            
        echo "<h1><b class='text-danger'>คุณไม่ใช่อาจารย์!!</b></h1>";
        exit;
    }

    $std = "SELECT users.identifier, users.group FROM users";
    $stdData = $conn->prepare($std);
    $stdData->execute();
    $ArraystdData = $stdData->fetchAll();

    // กำหนดคลอสที่อาจารย์เป็นเจ้าของ
    $mycou = "SELECT course.cou_id FROM course WHERE course.identifier=:code";
    $mycou = $conn->prepare($mycou);
    $mycou->bindParam(":code", $user);
    $mycou->execute();
    $Arraymycou = $mycou->fetchAll();

    $regcou = "SELECT register_course.cou_id, register_course.identifier
    FROM register_course
    INNER JOIN users ON register_course.identifier = users.identifier";
    $regcou = $conn->prepare($regcou);
    $regcou->execute();
    $Arrayregcou = $regcou->fetchAll();

    $std_i = 0;
    foreach ($ArraystdData as $v) {
        if ($v['group'] === "student") {
            $std_i++;
            // echo $v['identifier']." | ".$v['group'];
        }
    }

    $std_cou = 0;
    $registered_students = [];
    foreach ($Arrayregcou as $v) {
        foreach ($Arraymycou as $vv) {
            if ($v['cou_id'] === $vv['cou_id']) {
                if (!in_array($v['identifier'], $registered_students)) {
                    // เพิ่มค่าของนักเรียนคนนั้นลงในอาร์เรย์ที่เก็บข้อมูลนักเรียนที่ลงทะเบียนแล้ว
                    $registered_students[$std_cou] = $v['identifier'];
                    // เพิ่มจำนวนนักเรียนที่ลงทะเบียน
                    $std_cou++;
                }
            }
        }
    }

    $cou_i = 0;
    foreach ($Arraymycou as $v) {
        $cou_i++;
    }
?>
    <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
            <div class="card">
                <div class="card-header bg-warning text-light px-4 pt-3 px-4 pt-3" style="border-radius: 20px 20px 0 0;">
                    <h3 class="card-title" style="font-size: 1.3em;font-weight: 600;">นักเรียนทั้งหมด</h3>
                </div>
                <div class="card-body py-5">
                    <h1 class="text-secondary">
                        <?php echo $std_i." คน" ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-light px-4 pt-3" style="border-radius: 20px 20px 0 0;">
                    <h3 class="card-title" style="font-size: 1.3em;font-weight: 600;">นักเรียนที่ลงทะเบียน</h3>
                </div>
                <div class="card-body py-5">
                <h1 class="text-secondary"><?php echo $std_cou." คน" ?></h1>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
            <div class="card">
                <div class="card-header bg-success text-light px-4 pt-3" style="border-radius: 20px 20px 0 0;">
                    <h3 class="card-title" style="font-size: 1.3em;font-weight: 600;">นักเรียนที่เรียนครบแล้ว</h3>
                </div>
                <div class="card-body py-5">
                    <h1 class="text-secondary">NaN คน</h1>
                </div>
            </div>
        </div> -->
        <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
            <div class="card">
                <div class="card-header bg-info text-light px-4 pt-3" style="border-radius: 20px 20px 0 0;">
                    <h3 class="card-title" style="font-size: 1.3em;font-weight: 600;">บทเรียนทั้งหมด</h3>
                </div>
                <div class="card-body py-5">
                    <h1 class="text-secondary"><?php echo $cou_i." บท" ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'footer.php'; ?>