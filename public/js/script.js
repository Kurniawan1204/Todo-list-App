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
// Menyimpan preferensi mode gelap di localStorage sehingga pengguna tetap berada dalam mode yang dipilih meskipun halaman direfresh.
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
    // Ketika tombol #theme-switch ditekan, mode akan berubah dan statusnya disimpan di localStorage.
themeSwitch.addEventListener('click', () => {
    darkmode = localStorage.getItem('darkmode')
    darkmode !== "active" ? enableDarkmode() : disableDarkmode()
})


// Reset Search
// Saat pengguna menghapus isi input pencarian (input[name="query"]), halaman akan otomatis kembali ke halaman utama (/).
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector('input[name="query"]');
    
    searchInput.addEventListener("input", function() {
        if (this.value === "") {
            window.location.href = "/"; // Kembali ke halaman utama
        }
    });
});

// Notification task
// Menampilkan notifikasi tugas yang akan datang dengan mengambil data dari /task/today menggunakan fetch().
// Jika ada tugas, jumlah notifikasi diperbarui dan daftar notifikasi diisi dengan tugas-tugas.
// Dropdown notifikasi dapat dibuka/tutup hanya jika ada notifikasi.
// Memeriksa notifikasi setiap 1 menit (setInterval(fetchNotifications, 60000)).
document.addEventListener("DOMContentLoaded", function () {
    const notificationIcon = document.getElementById("notificationIcon");
    const notificationCount = document.getElementById("notificationCount");
    const notificationList = document.getElementById("notificationList");
    const notificationDropdown = document.getElementById("notificationDropdown");

    // Pastikan dropdown bisa dibuka/ditutup saat ada notifikasi
    notificationIcon.addEventListener("click", () => {
        if (notificationList.children.length > 0) {
            notificationDropdown.style.display =
                notificationDropdown.style.display === "block" ? "none" : "block";
        }
    });

    function fetchNotifications() {
        fetch("/task/today")
            .then(response => response.json())
            .then(tasks => {
                console.log("Data Notifikasi:", tasks); // Debugging: Cek apakah data diterima

                if (tasks.length > 0) {
                    notificationCount.textContent = tasks.length;
                    notificationCount.style.display = "inline-block"; // Tampilkan badge
                    notificationList.innerHTML = "";

                    tasks.forEach(task => {
                        let li = document.createElement("li");
                        li.textContent = `Tugas ${task.name} segera kerjakan!`;
                        notificationList.appendChild(li);
                    });

                    notificationDropdown.style.display = "none"; // Default: Tertutup
                } else {
                    notificationCount.textContent = "";
                    notificationCount.style.display = "none"; // Sembunyikan badge
                    notificationDropdown.style.display = "none"; // Sembunyikan dropdown
                    notificationList.innerHTML = ""; // Bersihkan list
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }

    setInterval(fetchNotifications, 60000); // Cek setiap 1 menit
    fetchNotifications();
});
