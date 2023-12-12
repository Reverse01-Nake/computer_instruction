function CloseAlert() {
    const closeAlert = document.getElementById("alert");

    closeAlert.style.transition = "all 300ms ease";
    closeAlert.classList.add("closeAlert");
    setTimeout(() => {
        closeAlert.classList.remove("closeAlert");
        closeAlert.style.display = 'none';
    }, 300);
};

function Page(namePage) {
    if (namePage === 'dashboard') {
        localStorage.setItem("usePage", "dashboard");
        console.log(localStorage.getItem("usePage"));
    } else if (namePage === 'useredit') {
        localStorage.setItem("usePage", "useredit");
        console.log(localStorage.getItem("usePage"));
    } else if (namePage === 'course') {
        localStorage.setItem("usePage", "course");
        console.log(localStorage.getItem("usePage"));
    } else if (namePage === 'student-data') {
        localStorage.setItem("usePage", "student-data");
        console.log(localStorage.getItem("usePage"));
    } else if (namePage === 'content') {
        localStorage.setItem("usePage", "content");
        console.log(localStorage.getItem("usePage"));
    }
};


const usePage = localStorage.getItem("usePage")
if (usePage === 'dashboard') {
    console.log('usePage: dashboard');
    const btnPage = document.getElementById("dashboard");
    btnPage.classList.remove("text-secondary");
    btnPage.classList.remove("menuHover");
    btnPage.classList.add("active");
} else if (usePage === 'useredit') {
    console.log('usePage: useredit');
    const btnPage = document.getElementById("useredit");
    btnPage.classList.remove("text-secondary");
    btnPage.classList.remove("menuHover");
    btnPage.classList.add("active");
} else if (usePage === 'course') {
    console.log('usePage: course');
    const btnPage = document.getElementById("course");
    btnPage.classList.remove("text-secondary");
    btnPage.classList.remove("menuHover");
    btnPage.classList.add("active");
} else if (usePage === 'student-data') {
    console.log('usePage: student-data');
    const btnPage = document.getElementById("student-data");
    btnPage.classList.remove("text-secondary");
    btnPage.classList.remove("menuHover");
    btnPage.classList.add("active");
} else if (usePage === 'content') {
    console.log('usePage: content');
    const btnPage = document.getElementById("content");
    btnPage.classList.remove("text-secondary");
    btnPage.classList.remove("menuHover");
    btnPage.classList.add("active");
};

// สร้างออบเจ็ควันที่
let now = new Date();

// แสดงเวลาปัจจุบันทุกๆ 1 วินาที
setInterval(() => {
  // อัปเดตเวลาปัจจุบัน
  now = new Date();

  // แสดงเวลาปัจจุบัน
  document.querySelector(".date").textContent = now.toLocaleString("th-TH");
}, 1000);


////////////////////////////////////////////////////////////////////////////////////////////////

function EditCou(id, names, classs) {
    document.getElementById("cou_id").value = id;
    document.getElementById("cou_name").value = names;
    document.getElementById("cou_class").value = classs;
}

function AddQ(id, names) {
    document.getElementById("pNameAddq").innerHTML  = names;
    document.getElementById("cou_idNameAddq").value = id;
}
