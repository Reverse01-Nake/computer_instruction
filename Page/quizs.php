<?php require_once 'header.php'; 
    $cou_id = $_GET['cou_id'];
    $types = $_GET['types'];

    $check_code = $conn->prepare("SELECT * FROM quizs WHERE quizs.cou_id = :code AND quizs.type_id = :types");
    $check_code->bindParam(":code", $cou_id);
    $check_code->bindParam(":types", $types);
    $check_code->execute();
    $rows = $check_code->fetchAll();
    // $rowss = $check_code->fetch(PDO::FETCH_ASSOC);
?>
    <div class="card">
        <div class="card-header bg-light flex" style="border-radius: 20px 20px 0 0; position: relative;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            <h3 class="card-title" style="margin:0; font-size: 1.3em;font-weight: 600;"><?php echo $rows[0]["qu_name"];?></h3>
        </div>
        <div class="card-body">
            <form action="../backend.php" method="post">

                <?php 
                    $i = 0;
                    foreach ($rows as $v) { 
                    $i++;
                ?>
                    
                <div class="question mb-4">
                    <input name="id[<?php $i; ?>]" type="hidden" value="<?php echo $v["qu_id"];?>">
                    <p><?php echo $v["question"];?></p>
                    <input type="radio" name="<?php echo "c".$i?>" value="1"><?php echo $v["choice1"];?><br>
                    <input type="radio" name="<?php echo "c".$i?>" value="2"><?php echo $v["choice2"];?><br>
                    <input type="radio" name="<?php echo "c".$i?>" value="3"><?php echo $v["choice3"];?><br>
                    <input type="radio" name="<?php echo "c".$i?>" value="4"><?php echo $v["choice4"];?><br><hr>
                    <input type="hidden" name="<?php echo "ans".$i?>" value="<?php echo $v["answer"]; ?>">
                </div>
                <?php } ?>

                <input type="hidden" name="cou_id" value="<?php echo $cou_id;?>">
                <input type="hidden" name="type" value="<?php echo $types;?>">
                <button type="submit" class="btn btn-primary" name="quizs">ยืนยัน</button>
            </form>
        </div>
    </div>
<?php require_once 'footer.php'; ?>