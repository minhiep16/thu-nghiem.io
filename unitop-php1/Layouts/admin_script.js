// admin_script.js

// Toggle Sidebar
var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

if (toggleButton) {
    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
}

// --- KHỞI TẠO BIỂU ĐỒ ---
// Màu sắc mới, hài hòa
const primaryColor = 'rgba(13, 110, 253, 0.6)';
const primaryBorder = 'rgba(13, 110, 253, 1)';

// Dữ liệu mô phỏng cho biểu đồ chính (kết hợp cột và đường)
const mainChartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
const mainChartData = {
    labels: mainChartLabels,
    datasets: [{
        label: 'Completed Tasks',
        data: [65, 59, 80, 81, 56, 55, 40],
        borderColor: primaryBorder,
        borderWidth: 2,
        fill: false,
        type: 'line', // Biểu đồ đường
        tension: 0.4
    }, {
        label: 'New Tasks',
        data: [28, 48, 40, 19, 86, 27, 90],
        backgroundColor: 'rgba(201, 203, 207, 0.6)',
        borderColor: 'rgba(201, 203, 207, 1)',
        borderWidth: 1,
        type: 'bar', // Biểu đồ cột
    }]
};

// Dữ liệu cho biểu đồ bánh vòng
const satisfactionChartData = {
    labels: ['Satisfied', 'Neutral', 'Unsatisfied'],
    datasets: [{
        label: 'Employee Satisfaction',
        data: [84, 12, 4],
        backgroundColor: [
            'rgba(25, 135, 84, 0.8)',
            'rgba(255, 193, 7, 0.8)',
            'rgba(220, 53, 69, 0.8)'
        ],
        hoverOffset: 4
    }]
};

// Lấy thẻ canvas
const mainCtx = document.getElementById('mainChart');
const satisfactionCtx = document.getElementById('satisfactionChart');

// Vẽ biểu đồ
if(mainCtx) {
    new Chart(mainCtx, {
        type: 'bar', // Loại hỗn hợp được định nghĩa trong dataset
        data: mainChartData,
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } }
        }
    });
}

if(satisfactionCtx){
    new Chart(satisfactionCtx, {
        type: 'doughnut',
        data: satisfactionChartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
}