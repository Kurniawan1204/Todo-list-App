document.addEventListener("DOMContentLoaded", () => {
    const content = document.getElementById("content");
    const navbarHeight = document.querySelector(".navbar").offsetHeight;
    content.style.paddingTop = `${navbarHeight + 16}px`;

    const addTaskModal = document.getElementById("addTaskModal");
    addTaskModal.addEventListener("show.bs.modal", (e) => {
        const btn = e.relatedTarget;
        const taskId = btn.getAttribute("data-list");
        document.getElementById("taskListId").value = taskId;
    });
});

// DarkMode
let darkmode = localStorage.getItem('darkmode')
const themeSwitch = document.getElementById('theme-switch')

const enableDarkmode = () => {
    document.body.classList.add('darkmode')
    localStorage.setItem('darkmode', 'active')
}

const disableDarkmode = () => {
    document.body.classList.remove('darkmode')
    localStorage.setItem('darkmode', null)
}

if(darkmode === "active") enableDarkmode()

themeSwitch.addEventListener('click', () => {
    darkmode = localStorage.getItem('darkmode')
    darkmode !== "active" ? enableDarkmode() : disableDarkmode()
})


// Reset Search
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector('input[name="query"]');
    
    searchInput.addEventListener("input", function() {
        if (this.value === "") {
            window.location.href = "/"; // Kembali ke halaman utama
        }
    });
});

// Notifikasi
document.addEventListener("DOMContentLoaded", function () {
    const notificationIcon = document.getElementById("notificationIcon");
    const notificationCount = document.getElementById("notificationCount");
    const notificationList = document.getElementById("notificationList");
    const notificationDropdown = document.getElementById("notificationDropdown");

    // Pastikan dropdown bisa dibuka/ditutup
    notificationIcon.addEventListener("click", () => {
        notificationDropdown.style.display =
            notificationDropdown.style.display === "block" ? "none" : "block";
    });

    function fetchNotifications() {
        fetch("/task/today")
            .then(response => response.json())
            .then(tasks => {
                console.log("Data Notifikasi:", tasks); // Debugging: Cek apakah data diterima

                if (tasks.length > 0) {
                    notificationCount.textContent = tasks.length;
                    notificationList.innerHTML = "";

                    tasks.forEach(task => {
                        let li = document.createElement("li");
                        li.textContent = `Tugas ${task.name} segera kerjakan!`;
                        notificationList.appendChild(li);
                    });

                    // Pastikan dropdown bisa terbuka setelah ada notifikasi baru
                    notificationDropdown.style.display = "block";
                } else {
                    notificationCount.textContent = "";
                    notificationDropdown.style.display = "none";
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }

    setInterval(fetchNotifications, 60000); // Cek setiap 1 menit
    fetchNotifications();
});
