<?php
    session_start();
    require_once 'config/connectDB.php';

    if (isset($_POST['login'])) {
        if (isset($_POST['student'])) {
            $id = $_POST['id'];
            $password = $_POST['password'];

            if (empty($id)) {
                $_SESSION['error'] = 'กรุณากรอก รหัสนักเรียน ให้เรียบร้อย';
                header("location: index.php");
            } else if (empty($password)) {
                $_SESSION['error'] = 'กรุณากรอก รหัสผ่าน ให้เรียบร้อย';
                header("location: index.php");
            } else if (strlen($password) < 8 || strlen($password) > 50) {
                $_SESSION['error'] = 'รูปแบบรหัสผ่านไม่ถูกต้อง';
                header("location: index.php");
            } else {
                try {
                    $check_code = $conn->prepare("SELECT `identifier`, `password`, `firstname`, `lastname`, `group` FROM users WHERE identifier = :code");
                    $check_code->bindParam(":code", $id);
                    $check_code->execute();
                    $row = $check_code->fetch(PDO::FETCH_ASSOC);

                    // $no = $check_code->rowCount(); // ไว้เช็คจำนวนที่ดึงข้อมูล
                    if ($check_code->rowCount() > 0) {
                        if ($row["group"] == "student") {
                            $isThen = password_verify($password, $row['password']);
                            if ($isThen) {
                                $_SESSION['user'] = $id;
                                $_SESSION['group'] = $row["group"];
                                $_SESSION['success'] = "ยินดีต้อนรับคุณ "."<b>".$row["firstname"]." ".$row["lastname"]."</b>"." เข้าสู่ระบบ";
                                header("location: Page/dashboard.php");
                            } else {
                                $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
                                header("location: index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'ท่านไม่ใช่นักเรียน';
                            header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = 'ไม่พบผู้ใช้ในระบบ';
                        header("location: index.php");
                    }

                } catch(PDOException $e) {
                    echo "Failed: " . $e->getMessage();
                }
            }
        } else {
            $id = $_POST['id'];
            $password = $_POST['password'];

            if (empty($id)) {
                $_SESSION['error'] = 'กรุณากรอก รหัสนักเรียน ให้เรียบร้อย';
                header("location: index.php");
            } else if (empty($password)) {
                $_SESSION['error'] = 'กรุณากรอก รหัสผ่าน ให้เรียบร้อย';
                header("location: index.php");
            } else if (strlen($password) < 8 || strlen($password) > 50) {
                $_SESSION['error'] = 'รูปแบบรหัสผ่านไม่ถูกต้อง';
                header("location: index.php");
            } else {
                try {
                    $check_code = $conn->prepare("SELECT `identifier`, `password`, `firstname`, `lastname`, `group` FROM users WHERE identifier = :code");
                    $check_code->bindParam(":code", $id);
                    $check_code->execute();
                    $row = $check_code->fetch(PDO::FETCH_ASSOC);

                    // $no = $check_code->rowCount(); // ไว้เช็คจำนวนที่ดึงข้อมูล
                    if ($check_code->rowCount() > 0) {
                        if ($row["group"] == "teacher") {
                            if ($row["identifier"] == $id) {
                                if (password_verify($password, $row["password"])) {
                                    $_SESSION['user'] = $id;
                                    $_SESSION['group'] = $row["group"];
                                    $_SESSION['success'] = "ยินดีต้อนรับคุณ "."<b>".$row["firstname"]." ".$row["lastname"]."</b>"." เข้าสู่ระบบ";
                                    header("location: Page/dashboard-t.php");
                                } else {
                                    $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
                                    header("location: index.php");
                                }
                            } else {
                                $_SESSION['error'] = 'ไม่พบผู้ใช้ในระบบ';
                                header("location: index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'ท่านไม่ใช่อาจารย์';
                            header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = 'ไม่พบผู้ใช้ในระบบ';
                        header("location: index.php");
                    }

                } catch(PDOException $e) {
                    echo "Failed: " . $e->getMessage();
                }
            }
        }
    } else if (isset($_POST['register'])) {
        $id = $_POST['id'];
        $prefix = $_POST['prefix'];
        $fistname = $_POST['fistname'];
        $lastname = $_POST['lastname'];
        $sex = $_POST['sex'];
        $old = $_POST['old'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $class = $_POST['class'];
        $room = $_POST['room'];
        $number = $_POST['number'];
        $phone_number = $_POST['phone_number'];

        if (empty($id)) {
            $_SESSION['error'] = 'กรุณากรอก รหัสนักเรียน ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($fistname)) {
            $_SESSION['error'] = 'กรุณากรอก ชื่อจริง ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'กรุณากรอก นามสกุล ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($old)) {
            $_SESSION['error'] = 'กรุณากรอก อายุ ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอก อีเมล ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอก รหัสผ่าน ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณากรอก ยืนยันรหัสผ่าน ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($number)) {
            $_SESSION['error'] = 'กรุณากรอก เลขที่ ให้เรียบร้อย';
            header("location: index.php");
        } else if (empty($phone_number)) {
            $_SESSION['error'] = 'กรุณากรอก เบอร์โทร ให้เรียบร้อย';
            header("location: index.php");
        } else if (strlen($password) < 8 || strlen($password) > 50) {
            $_SESSION['error'] = 'รหัสผ่านควรมีความยาวตั้งแต่ 8 - 50 ตัวอักษร';
            header("location: index.php");
        } else if ($password !== $c_password ) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกันกรุณากรอกใหม่';
            header("location: index.php");
        } else {
            try {
                $check_code = $conn->prepare("SELECT `identifier`, `email` FROM users WHERE identifier = :code");
                $check_code->bindParam(":code", $id);
                $check_code->execute();
                $row = $check_code->fetch(PDO::FETCH_ASSOC);

                // $no = $check_code->rowCount(); // ไว้เช็คจำนวนที่ดึงข้อมูล
                // echo $no;
                if ($check_code->rowCount() <= 0) {
                    if (empty($row["email"])) {
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $insert_data = $conn->prepare("INSERT INTO users (identifier, email, prefix, firstname, lastname, sex, old, password, class, room, number, phone_number) 
                        VALUES (:code, :email, :prefix, :firstname, :lastname, :sex, :old, :password, :class, :room, :number, :phone_number)");
                        $insert_data->bindParam(":code", $id);
                        $insert_data->bindParam(":email", $email);
                        $insert_data->bindParam(":prefix", $prefix);
                        $insert_data->bindParam(":firstname", $fistname);
                        $insert_data->bindParam(":lastname", $lastname);
                        $insert_data->bindParam(":sex", $sex);
                        $insert_data->bindParam(":old", $old);
                        $insert_data->bindParam(":password", $passwordHash);
                        $insert_data->bindParam(":class", $class);
                        $insert_data->bindParam(":number", $number);
                        $insert_data->bindParam(":phone_number", $phone_number);
                        $insert_data->bindParam(":room", $room);
                        $insert_data->execute();

                        $_SESSION['success'] = 'สมัครสำเร็จแล้ว กรุณา <b>Login</b> เพื่อเข้าสู่ระบบ';
                        header("location: index.php");
                    } else {
                        $_SESSION['error'] = 'มีอีเมลนี้อยู่ในระบบแล้ว';
                        header("location: index.php");
                    }
                } else {
                    $_SESSION['error'] = 'รหัสนักเรียนนี้เคยสมัครไปแล้ว';
                    header("location: index.php");
                }

            } catch(PDOException $e) {
                echo "Failed: " . $e->getMessage();
            }
        }
    } else if (isset($_POST['editUser'])) {
        // echo $_FILES['image']['name'];
        $prefix = $_POST['prefix'];
        $fistname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $sex = $_POST['sex'];
        $old = $_POST['old'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];

        if (empty($prefix)) {
            $_SESSION['error'] = 'มีบางอย่างผิดพลาด';
            header("location: Page/useredit.php");
        } else if (empty($fistname)) {
            $_SESSION['error'] = 'กรุณากรอก ชื่อจริง ให้เรียบร้อย';
            header("location: Page/useredit.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'กรุณากรอก นามสกุล ให้เรียบร้อย';
            header("location: Page/useredit.php");
        } else if (empty($sex)) {
            $_SESSION['error'] = 'กรุณากรอก อายุ ให้เรียบร้อย';
            header("location: Page/useredit.php");
        } else if (empty($old)) {
            $_SESSION['error'] = 'กรุณากรอก อายุ ให้เรียบร้อย';
            header("location: Page/useredit.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอก อีเมล ให้เรียบร้อย';
            header("location: Page/useredit.php");
        } else if (empty($phone_number)) {
            $_SESSION['error'] = 'กรุณากรอก เบอร์โทร ให้เรียบร้อย';
            header("location: Page/useredit.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอก รหัสผ่าน ให้เรียบร้อย';
            header("location: Page/useredit.php");
        } else {
            try {
                $check_code = $conn->prepare("SELECT `password` FROM users WHERE identifier = :code");
                $check_code->bindParam(":code", $_SESSION['user']);
                $check_code->execute();
                $row = $check_code->fetch(PDO::FETCH_ASSOC);

                if ($check_code->rowCount() > 0) {
                    $isThen = password_verify($password, $row['password']);
                    if ($isThen) {
                        if ($_FILES['image']['name'] != "") {
                            $stmt = $conn->prepare("UPDATE users 
                            SET profile=:profile, prefix=:prefix, firstname=:fistname, lastname=:lastname, sex=:sex, old=:old, email=:email, phone_number=:phone_number
                            WHERE identifier = :code");
                            $stmt->bindParam(":code", $_SESSION['user']);
                            $stmt->bindParam(":profile", $_FILES['image']['name']);
                            $stmt->bindParam(":prefix", $prefix);
                            $stmt->bindParam(":fistname", $fistname);
                            $stmt->bindParam(":lastname", $lastname);
                            $stmt->bindParam(":sex", $sex);
                            $stmt->bindParam(":old", $old);
                            $stmt->bindParam(":email", $email);
                            $stmt->bindParam(":phone_number", $phone_number);
                            $stmt->execute();

                            // ย้ายไฟล์ไปยังโฟลเดอร์บนเซิร์ฟเวอร์
                            $destination_path = 'assets/images/Profile/' . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination_path);

                            $_SESSION['success'] = 'แก้ไขข้อมูลสำเร็จแล้ว';
                            header("location: Page/useredit.php");
                        } else {
                            $stmt = $conn->prepare("UPDATE users 
                            SET prefix=:prefix, firstname=:fistname, lastname=:lastname, sex=:sex, old=:old, email=:email, phone_number=:phone_number
                            WHERE identifier = :code");
                            $stmt->bindParam(":code", $_SESSION['user']);
                            $stmt->bindParam(":prefix", $prefix);
                            $stmt->bindParam(":fistname", $fistname);
                            $stmt->bindParam(":lastname", $lastname);
                            $stmt->bindParam(":sex", $sex);
                            $stmt->bindParam(":old", $old);
                            $stmt->bindParam(":email", $email);
                            $stmt->bindParam(":phone_number", $phone_number);
                            $stmt->execute();

                            $_SESSION['success'] = 'แก้ไขข้อมูลสำเร็จ';
                            header("location: Page/useredit.php");
                        }
                    } else {
                        $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง กรุณาลองอีกครั้ง';
                        header("location: Page/useredit.php");
                    }
                } else {
                    $_SESSION['error'] = 'มีบางอย่างผิดพลาด';
                    header("location: Page/useredit.php");
                }

            } catch(PDOException $e) {
                echo "Failed: " . $e->getMessage();
            }
        }
    } else if (isset($_POST['addstd'])) {
        $id = $_POST['id'];
        $course = $_POST['course'];

        // echo $course."course";
        try {
            $check_code = $conn->prepare("SELECT `identifier`, `class` FROM users WHERE identifier = :code");
            $check_code->bindParam(":code", $id);
            $check_code->execute();
            $row = $check_code->fetch(PDO::FETCH_ASSOC);

            if ($check_code->rowCount() > 0) {
                $insert_data = $conn->prepare("INSERT INTO register_course (identifier, cou_id) 
                VALUES (:code, :course)");
                $insert_data->bindParam(":code", $id);
                $insert_data->bindParam(":course", $course);
                $insert_data->execute();

                $_SESSION['success'] = 'เพิ่มนักเรียนสำเร็จแล้ว';
                header("location: Page/student-data.php");
            } else {
                $_SESSION['error'] = 'ไม่พบข้อมูลนักเรียน';
                header("location: index.php");
            }

        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    } else if (isset($_POST['DelStd'])) {
        $id = $_POST['identifier'];
        $course = $_POST['cou_id'];

        // echo $course."course";
        try {

            $sql = 'DELETE FROM register_course WHERE identifier=:code AND cou_id=:course';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":code", $id);
            $stmt->bindParam(":course", $course);
            $stmt->execute();

            $_SESSION['success'] = 'ลบนักเรียนสำเร็จแล้ว';
            header("location: Page/student-data.php");

        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();

            $_SESSION['error'] = 'ผิดพลาดบางอย่าง '."Failed: " . $e->getMessage();
            header("location: Page/student-data.php");
        }
    } else if (isset($_POST['addcou'])) {
        $id = $_SESSION['user'];
        $name = $_POST['name'];
        $class = $_POST['class'];
        $file = $_FILES['video'];

        // ตรวจสอบว่าไฟล์เป็นวิดีโอหรือไม่
        if ($file['type'] != 'video/mp4') {
            $_SESSION['error'] = 'ไฟล์ไม่ใช่วิดีโอ';
            header("location: Page/content.php");
        } else {
            // บันทึกไฟล์ลงในโฟลเดอร์
            $filename = 'assets/video/' . $file['name'];
            move_uploaded_file($file['tmp_name'], $filename);

            try {
                $insert_data = $conn->prepare("INSERT INTO course (identifier, cou_name, cou_class, cou_path) 
                VALUES (:code, :name, :class, :filename)");
                $insert_data->bindParam(":code", $id);
                $insert_data->bindParam(":name", $name);
                $insert_data->bindParam(":class", $class);
                $insert_data->bindParam(":filename", $file['name']);
                $insert_data->execute();

                $_SESSION['success'] = 'เพิ่มบทเรียนเรียบร้อย';
                header("location: Page/content.php");

            } catch(PDOException $e) {
                echo "Failed: " . $e->getMessage();

                $_SESSION['error'] = 'ผิดพลาดบางอย่าง '."Failed: " . $e->getMessage();
                header("location: Page/content.php");
            }
        }
    } else if (isset($_POST['DelCou'])) {
        $course = $_POST['cou_id'];

        try {

            $sql = 'DELETE FROM quizs WHERE cou_id=:code';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":code", $course);
            $stmt->execute();
            
            $sqls = 'DELETE FROM register_course WHERE cou_id=:code';
            $stmts = $conn->prepare($sqls);
            $stmts->bindParam(":code", $course);
            $stmts->execute();
            
            $sqlss = 'DELETE FROM course WHERE cou_id=:code';
            $stmtss = $conn->prepare($sqlss);
            $stmtss->bindParam(":code", $course);
            $stmtss->execute();

            $_SESSION['success'] = 'ลบบทเรียนสำเร็จแล้ว';
            header("location: Page/content.php");

        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();

            $_SESSION['error'] = 'ผิดพลาดบางอย่าง '."Failed: " . $e->getMessage();
            header("location: Page/content.php");
        }
    } else if (isset($_POST['editcou'])) {
        $id = $_POST['cou_id'];
        $name = $_POST['cou_name'];
        $class = $_POST['cou_class'];
        $file = $_FILES['video'];

        try {
            if ($file['name'] != "") {
                if ($file['type'] != 'video/mp4') {
                    $_SESSION['error'] = 'ไฟล์ไม่ใช่วิดีโอ';
                    header("location: Page/content.php");
                } else {
                    // บันทึกไฟล์ลงในโฟลเดอร์
                    $filename = 'assets/video/' . $file['name'];
                    move_uploaded_file($file['tmp_name'], $filename);
        
                    try {
                        $stmt = $conn->prepare("UPDATE course 
                        SET cou_name=:name, cou_class=:class, cou_path=:video
                        WHERE cou_id = :code");
                        $stmt->bindParam(":code", $id);
                        $stmt->bindParam(":name", $name);
                        $stmt->bindParam(":class", $class);
                        $stmt->bindParam(":video", $file['name']);
                        $stmt->execute();
        
                        $_SESSION['success'] = 'แก้ไขบทเรียนเรียบร้อย';
                        header("location: Page/content.php");
        
                    } catch(PDOException $e) {
                        echo "Failed: " . $e->getMessage();
        
                        $_SESSION['error'] = 'ผิดพลาดบางอย่าง '."Failed: " . $e->getMessage();
                        header("location: Page/content.php");
                    }
                }
            } else {
                $stmt = $conn->prepare("UPDATE course 
                SET cou_name=:name, cou_class=:class
                WHERE cou_id = :code");
                $stmt->bindParam(":code", $id);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":class", $class);
                $stmt->execute();

                $_SESSION['success'] = 'แก้ไขบทเรียนเรียบร้อย';
                header("location: Page/content.php");
            }

        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();
        }
    } else if (isset($_POST['quizs'])) {
        $id = $_POST['id'];
        $cou_id = $_POST['cou_id'];
        $type = $_POST['type'];

        $score=0;
        for($i=1;$i<=count($id);$i++) {
            $ch= $_POST['c'.$i];
            if ($ch==$_POST['ans'.$i]) {
                $score=$score+1;
            }
        }
        
        try {

            if ($type==1) {
                $stmt = $conn->prepare("UPDATE register_course 
                SET pretest=:pretest
                WHERE identifier = :code AND cou_id = :cou_id");
                $stmt->bindParam(":code", $_SESSION['user']);
                $stmt->bindParam(":cou_id", $cou_id);
                $stmt->bindParam(":pretest", $score);
                $stmt->execute();

                $_SESSION['success'] = 'ส่งคำตอบสำเร็จ';
                header("location: Page/dashboard.php");
            } else if ($type==2) {
                $stmt = $conn->prepare("UPDATE register_course 
                SET test_during=:test_during
                WHERE identifier = :code AND cou_id = :cou_id");
                $stmt->bindParam(":code", $_SESSION['user']);
                $stmt->bindParam(":cou_id", $cou_id);
                $stmt->bindParam(":test_during", $score);
                $stmt->execute();

                $_SESSION['success'] = 'ส่งคำตอบสำเร็จ';
                header("location: Page/dashboard.php");
            } else {
                $stmt = $conn->prepare("UPDATE register_course 
                SET posttest=:posttest
                WHERE identifier = :code AND cou_id = :cou_id");
                $stmt->bindParam(":code", $_SESSION['user']);
                $stmt->bindParam(":cou_id", $cou_id);
                $stmt->bindParam(":posttest", $score);
                $stmt->execute();
                
                $_SESSION['success'] = 'ส่งคำตอบสำเร็จ';
                header("location: Page/dashboard.php");
            }

        } catch(PDOException $e) {
            echo "Failed: " . $e->getMessage();

            $_SESSION['error'] = 'ผิดพลาดบางอย่าง '."Failed: " . $e->getMessage();
            header("location: Page/dashboard.php");
        }
    } else if (isset($_POST['addq'])) {
        $cou_id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $q = $_POST['q'];
        $a1 = $_POST['a1'];
        $a2 = $_POST['a2'];
        $a3 = $_POST['a3'];
        $a4 = $_POST['a4'];
        $ans = $_POST['ans'];
        $types = 1;
        
        if ($type == "ก่อนเรียน") {
            $types = 1;
        } else if ($type == "ระหว่างเรียน") {
            $types = 2;
        } else {
            $types = 3;
        }

        if (empty($cou_id)) {
            $_SESSION['error'] = 'มีบางอย่างผิดพลาด';
            header("location: Page/content.php");
        } else if (empty($name)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อหัวข้อ';
            header("location: Page/content.php");
        } else if (empty($q)) {
            $_SESSION['error'] = 'กรุณากรอกคำถาม';
            header("location: Page/content.php");
        } else if (empty($a1)) {
            $_SESSION['error'] = 'กรุณากรอกตัวเลือกที่ 1';
            header("location: Page/content.php");
        } else if (empty($a2)) {
            $_SESSION['error'] = 'กรุณากรอกตัวเลือกที่ 2';
            header("location: Page/content.php");
        } else if (empty($a3)) {
            $_SESSION['error'] = 'กรุณากรอกตัวเลือกที่ 3';
            header("location: Page/content.php");
        } else if (empty($a4)) {
            $_SESSION['error'] = 'กรุณากรอกตัวเลือกที่ 4';
            header("location: Page/content.php");
        } else {

            try {
                $insert_data = $conn->prepare("INSERT INTO quizs (qu_name, cou_id, type_id, question, choice1, choice2, choice3, choice4, answer) 
                VALUES (:name, :cou_id, :type_id, :question, :choice1, :choice2, :choice3, :choice4, :answer)");
                $insert_data->bindParam(":name", $name);
                $insert_data->bindParam(":cou_id", $cou_id);
                $insert_data->bindParam(":type_id", $types);
                $insert_data->bindParam(":question", $q);
                $insert_data->bindParam(":choice1", $a1);
                $insert_data->bindParam(":choice2", $a2);
                $insert_data->bindParam(":choice3", $a3);
                $insert_data->bindParam(":choice4", $a4);
                $insert_data->bindParam(":answer", $ans);
                $insert_data->execute();

                $_SESSION['success'] = 'เพิ่มคำถามสำเร็จ';
                header("location: Page/content.php");

            } catch(PDOException $e) {
                echo "Failed: " . $e->getMessage();

                $_SESSION['error'] = 'ผิดพลาดบางอย่าง '."Failed: " . $e->getMessage();
                header("location: Page/content.php");
            }
        }
    }
?>